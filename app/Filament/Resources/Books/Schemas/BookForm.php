<?php

namespace App\Filament\Resources\Books\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class BookForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Book Details')
                    ->columns(1)
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
                        TextInput::make('author')
                            ->required()
                            ->maxLength(150),
                        Select::make('leader_id')
                            ->label('Author (Leader)')
                            ->relationship('leader', 'name')
                            ->searchable()
                            ->preload()
                            ->nullable()
                            ->helperText('Link to a leader profile. The "Author" field above is still used for display.'),
                        TextInput::make('subtitle')
                            ->label('Subtitle / Tagline')
                            ->maxLength(255)
                            ->columnSpanFull(),
                        Textarea::make('description')
                            ->rows(4)
                            ->columnSpanFull(),
                        TagsInput::make('categories')
                            ->label('Categories / Tags')
                            ->placeholder('e.g. Spiritual Growth')
                            ->columnSpanFull(),
                    ]),

                Section::make('Publication Info')
                    ->columns(1)
                    ->schema([
                        TextInput::make('publisher')
                            ->maxLength(150)
                            ->default('City Life Press'),
                        TextInput::make('published_month')
                            ->label('Published Date')
                            ->placeholder('March 2025')
                            ->maxLength(20),
                        TextInput::make('page_count')
                            ->label('Page Count')
                            ->numeric()
                            ->minValue(1),
                        TextInput::make('isbn')
                            ->label('ISBN')
                            ->maxLength(30),
                        TextInput::make('language')
                            ->maxLength(50)
                            ->default('English'),
                        TextInput::make('format')
                            ->label('Format')
                            ->placeholder('Paperback + eBook')
                            ->maxLength(100),
                    ]),

                Section::make('Purchase Links')
                    ->columns(1)
                    ->schema([
                        TextInput::make('amazon_url')
                            ->label('Amazon URL')
                            ->url()
                            ->maxLength(300)
                            ->columnSpanFull()
                            ->helperText('Readers will be directed here to purchase.'),
                        TextInput::make('kindle_url')
                            ->label('Kindle URL')
                            ->url()
                            ->maxLength(300),
                    ]),

                Section::make('Cover Image & Visibility')
                    ->columns(2)
                    ->schema([
                        FileUpload::make('featured_image')
                            ->label('Book Cover Image')
                            ->image()
                            ->disk('public')
                            ->directory('books')
                            ->columnSpanFull(),
                        Toggle::make('is_published')
                            ->label('Published')
                            ->default(false),
                    ]),
            ]);
    }
}
