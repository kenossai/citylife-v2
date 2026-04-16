<?php

namespace App\Filament\Resources\Events\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class EventForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Event Details')
                    ->columns(2)
                    ->schema([
                        TextInput::make('title')
                            ->required()
                            ->maxLength(150)
                            ->live(onBlur: true)
                            ->afterStateUpdated(fn ($state, callable $set) => $set('slug', Str::slug($state)))
                            ->columnSpanFull(),
                        TextInput::make('slug')
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->maxLength(150)
                            ->helperText('Auto-generated from the title. Used in the URL.'),
                        DateTimePicker::make('event_at')
                            ->label('Event Date & Time')
                            ->required(),
                        TextInput::make('location')
                            ->maxLength(200)
                            ->default('City Life International, Sheffield')
                            ->columnSpanFull(),
                        Textarea::make('description')
                            ->rows(3)
                            ->columnSpanFull(),
                    ]),

                Section::make('Classification & Visibility')
                    ->columns(2)
                    ->schema([
                        Select::make('category')
                            ->options([
                                'Worship'    => 'Worship',
                                'Special'    => 'Special',
                                'Youth'      => 'Youth',
                                'Outreach'   => 'Outreach',
                                'Training'   => 'Training',
                                'Men'        => 'Men',
                                'Conference' => 'Conference',
                            ])
                            ->searchable()
                            ->placeholder('Select a category'),
                        TextInput::make('badge')
                            ->label('Badge Label')
                            ->placeholder('e.g. Open To All, Enrolment Open')
                            ->maxLength(60),
                        Toggle::make('is_featured')
                            ->label('Featured Event')
                            ->helperText('Shows in the featured section on the events page.'),
                        Toggle::make('requires_registration')
                            ->label('Registration Required')
                            ->default(true)
                            ->helperText('Show a Register Now button on this event.'),
                    ]),

                Section::make('Payment')
                    ->columns(2)
                    ->schema([
                        Toggle::make('requires_payment')
                            ->label('Requires Payment')
                            ->default(false)
                            ->live()
                            ->helperText('Show payment options on this event page.')
                            ->columnSpanFull(),
                        Toggle::make('show_paypal')
                            ->label('Show PayPal Button')
                            ->default(true)
                            ->helperText('paypal.com/donate/?hosted_button_id=4KEE89F86PPQG')
                            ->visible(fn ($get) => $get('requires_payment')),
                        Toggle::make('show_sumup')
                            ->label('Show SumUp Button')
                            ->default(true)
                            ->helperText('pay.sumup.com/b2c/Q5WMU9IP')
                            ->visible(fn ($get) => $get('requires_payment')),
                    ]),

                Section::make('Image & Order')
                    ->columns(2)
                    ->schema([
                        FileUpload::make('image_path')
                            ->label('Event Image')
                            ->image()
                            ->disk('public')
                            ->directory('events')
                            ->imagePreviewHeight('150')
                            ->columnSpanFull(),
                        TextInput::make('sort_order')
                            ->label('Sort Order')
                            ->numeric()
                            ->default(0),
                        Toggle::make('is_active')
                            ->label('Active')
                            ->default(true),
                    ]),
            ]);
    }
}
