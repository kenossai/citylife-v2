<?php

namespace App\Filament\Resources\Sermons\Schemas;

use App\Models\Leader;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Notifications\Notification;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Support\HtmlString;

class SermonForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Sermon Details')
                    ->columns(2)
                    ->schema([
                        TextInput::make('title')
                            ->required()
                            ->maxLength(150)
                            ->columnSpanFull(),
                        Select::make('leader_id')
                            ->label('Pastor / Speaker')
                            ->relationship('leader', 'name')
                            ->searchable()
                            ->preload()
                            ->placeholder('Select a pastor…')
                            ->helperText('Leave empty and use Guest Speaker below for external speakers.')
                            ->nullable(),
                        TextInput::make('guest_speaker_name')
                            ->label('Guest Speaker')
                            ->placeholder('Guest speaker name')
                            ->maxLength(150)
                            ->helperText('Only fill this if the speaker is not one of our pastors.'),
                        TextInput::make('scripture')
                            ->label('Scripture Reference')
                            ->placeholder('Galatians 5')
                            ->maxLength(100),
                        Textarea::make('description')
                            ->rows(3)
                            ->columnSpanFull(),
                        DatePicker::make('preached_at')
                            ->label('Date Preached')
                            ->required(),
                        TextInput::make('service_label')
                            ->label('Service Label')
                            ->placeholder('Sunday Morning Service')
                            ->maxLength(100),
                    ]),

                Section::make('Media Links')
                    ->columns(2)
                    ->schema([
                        TextInput::make('thumbnail_path')
                            ->label('Thumbnail Path / URL')
                            ->maxLength(300),
                        Toggle::make('auto_fetch_live')
                            ->label('Auto-Fetch Live Stream')
                            ->helperText('Automatically get YouTube live stream URL on Sundays at 11:15 AM.')
                            ->columnSpanFull()
                            ->reactive()
                            ->afterStateUpdated(function (bool $state, callable $set) {
                                if (! $state) {
                                    return;
                                }

                                $apiKey    = config('services.youtube.api_key');
                                $channelId = config('services.youtube.channel_id');

                                if (! $apiKey || ! $channelId) {
                                    $set('auto_fetch_live', false);
                                    Notification::make()
                                        ->title('YouTube API not configured')
                                        ->body('YOUTUBE_API_KEY or YOUTUBE_CHANNEL_ID is missing in your .env file.')
                                        ->warning()
                                        ->send();
                                    return;
                                }

                                try {
                                    $client = new \Google\Client();
                                    $client->setDeveloperKey($apiKey);
                                    $youtube  = new \Google\Service\YouTube($client);
                                    $response = $youtube->search->listSearch('id,snippet', [
                                        'channelId'  => $channelId,
                                        'eventType'  => 'live',
                                        'type'       => 'video',
                                        'maxResults' => 1,
                                    ]);

                                    $items = $response->getItems();

                                    if (empty($items)) {
                                        $set('auto_fetch_live', false);
                                        Notification::make()
                                            ->title('No live stream found')
                                            ->body('No live or upcoming stream found at this time. Make sure your channel has an active live stream.')
                                            ->warning()
                                            ->send();
                                        return;
                                    }

                                    $videoId = $items[0]->getId()->getVideoId();
                                    $set('video_url', 'https://www.youtube.com/watch?v=' . $videoId);

                                    Notification::make()
                                        ->title('Live stream found!')
                                        ->body('Video URL has been populated automatically.')
                                        ->success()
                                        ->send();
                                } catch (\Throwable $e) {
                                    $set('auto_fetch_live', false);
                                    Notification::make()
                                        ->title('YouTube API error')
                                        ->body($e->getMessage())
                                        ->danger()
                                        ->send();
                                }
                            }),
                        TextInput::make('video_url')
                            ->label('Video URL')
                            ->placeholder('https://youtube.com/watch?v=...')
                            ->helperText('Enter YouTube or video URL manually.')
                            ->maxLength(300)
                            ->columnSpanFull()
                            ->disabled(fn ($get) => (bool) $get('auto_fetch_live'))
                            ->dehydrated(true),
                        FileUpload::make('notes_path')
                            ->label('Sermon Notes (PDF)')
                            ->disk('public')
                            ->directory('sermon-notes')
                            ->acceptedFileTypes(['application/pdf'])
                            ->maxSize(10240)
                            ->helperText('Upload a PDF of the sermon notes (max 10 MB).')
                            ->columnSpanFull(),
                    ]),

                Section::make('Sermon Notes Content (SEO Optimized)')
                    ->schema([
                        RichEditor::make('notes_content')
                            ->label('')
                            ->helperText('Add typeable sermon notes content for better SEO visibility and search indexing.')
                            ->toolbarButtons([
                                'bold', 'italic', 'underline', 'strike',
                                'link', 'h2', 'h3',
                                'blockquote', 'codeBlock',
                                'bulletList', 'orderedList',
                                'attachFiles', 'undo', 'redo',
                            ])
                            ->columnSpanFull(),
                    ]),

                Section::make('Visibility')
                    ->columns(2)
                    ->schema([
                        Toggle::make('is_featured')
                            ->label('Featured on Homepage')
                            ->helperText('Only one sermon should be featured at a time.'),
                        Toggle::make('is_active')
                            ->label('Active')
                            ->default(true),
                        Toggle::make('is_upcoming')
                            ->label('Upcoming Sermon')
                            ->helperText('Mark as upcoming to show a scheduled badge on the frontend.'),
                    ]),
            ]);
    }
}
