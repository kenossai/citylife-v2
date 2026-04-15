<?php

namespace App\Filament\Resources\Sermons\Schemas;

use App\Data\BibleBooks;
use App\Models\Leader;
use App\Models\SermonSeries;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TagsInput;
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
                            ->live(onBlur: true)
                            ->afterStateUpdated(fn ($state, callable $set) => $set('slug', \Illuminate\Support\Str::slug($state)))
                            ->columnSpanFull(),
                        TextInput::make('slug')
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->maxLength(200)
                            ->helperText('Auto-generated from the title. Used in the URL.')
                            ->columnSpanFull(),
                        Select::make('sermon_series_id')
                            ->label('Series')
                            ->options(fn () => SermonSeries::where('is_active', true)->orderBy('title')->pluck('title', 'id'))
                            ->searchable()
                            ->nullable()
                            ->placeholder('Not part of a series')
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
                        TagsInput::make('scripture')
                            ->label('Scripture References')
                            ->placeholder('Type a reference and press Enter…')
                            ->suggestions(BibleBooks::all())
                            ->helperText('Add one or more references, e.g. "John 3:16", "Romans 8:28–30". Press Enter after each.'),
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
                        FileUpload::make('thumbnail_path')
                            ->label('Thumbnail Image')
                            ->disk('public')
                            ->directory('sermon-thumbnails')
                            ->image()
                            ->imageEditor()
                            ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp'])
                            ->maxSize(5120)
                            ->helperText('Upload a thumbnail image (JPG, PNG or WebP, max 5 MB).')
                            ->columnSpanFull(),
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
                            ->helperText('Enter a YouTube URL — duration will be fetched automatically.')
                            ->maxLength(300)
                            ->columnSpanFull()
                            ->live(onBlur: true)
                            ->disabled(fn ($get) => (bool) $get('auto_fetch_live'))
                            ->dehydrated(true)
                            ->afterStateUpdated(function (?string $state, callable $set) {
                                if (! $state) {
                                    return;
                                }

                                preg_match('/(?:youtube\.com\/(?:watch\?v=|embed\/)|youtu\.be\/)([a-zA-Z0-9_-]{11})/', $state, $m);
                                $videoId = $m[1] ?? null;

                                if (! $videoId) {
                                    return;
                                }

                                $apiKey = config('services.youtube.api_key');
                                if (! $apiKey) {
                                    return;
                                }

                                try {
                                    $client = new \Google\Client();
                                    $client->setDeveloperKey($apiKey);
                                    $youtube  = new \Google\Service\YouTube($client);
                                    $response = $youtube->videos->listVideos('contentDetails', ['id' => $videoId]);
                                    $items    = $response->getItems();

                                    if (empty($items)) {
                                        return;
                                    }

                                    $iso = $items[0]->getContentDetails()->getDuration(); // e.g. PT42M17S
                                    preg_match('/PT(?:(\d+)H)?(?:(\d+)M)?(?:(\d+)S)?/', $iso, $parts);

                                    $hours   = (int) ($parts[1] ?? 0);
                                    $minutes = (int) ($parts[2] ?? 0);
                                    $seconds = (int) ($parts[3] ?? 0);

                                    $duration = $hours > 0
                                        ? sprintf('%d:%02d:%02d', $hours, $minutes, $seconds)
                                        : sprintf('%d:%02d', $minutes, $seconds);

                                    $set('duration', $duration);

                                    Notification::make()
                                        ->title('Duration fetched: ' . $duration)
                                        ->success()
                                        ->send();
                                } catch (\Throwable $e) {
                                    // Silently fail — duration stays empty
                                }
                            }),
                        TextInput::make('duration')
                            ->label('Duration')
                            ->placeholder('Auto-filled from YouTube URL')
                            ->maxLength(20)
                            ->helperText('Auto-fetched when a YouTube URL is entered. You can also set it manually.')
                            ->columnSpanFull(),
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
                        Select::make('notes_format')
                            ->label('Content Type')
                            ->options([
                                'html'  => 'Rich Text (HTML)',
                                'plain' => 'Plain Text',
                            ])
                            ->default('html')
                            ->helperText('Choose how the sermon notes content should be formatted')
                            ->selectablePlaceholder(false),
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
                            ->extraInputAttributes(['class' => 'notes-editor-scroll'])
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

                    ]),
            ]);
    }
}
