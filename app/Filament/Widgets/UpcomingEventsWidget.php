<?php

namespace App\Filament\Widgets;

use App\Filament\Resources\Events\EventResource;
use App\Models\Event;
use Filament\Actions\Action;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class UpcomingEventsWidget extends BaseWidget
{
    protected static ?int $sort = 5;

    protected static ?string $heading = 'Upcoming Events';

    protected int | string | array $columnSpan = 1;

    public function table(Table $table): Table
    {
        return $table
            ->query(Event::active()->upcoming()->limit(5))
            ->columns([
                Tables\Columns\ImageColumn::make('image_path')
                    ->label('')
                    ->width(48)
                    ->height(48)
                    ->extraImgAttributes(['class' => 'rounded-lg object-cover']),
                Tables\Columns\TextColumn::make('title')
                    ->weight('medium')
                    ->limit(35),
                Tables\Columns\TextColumn::make('event_at')
                    ->label('Date')
                    ->dateTime('D, j M Y · g:ia')
                    ->color('gray'),
                Tables\Columns\TextColumn::make('category')
                    ->badge()
                    ->color('primary')
                    ->formatStateUsing(fn (?string $state) => $state ? ucfirst($state) : null),
                Tables\Columns\IconColumn::make('is_featured')
                    ->label('Featured')
                    ->boolean()
                    ->trueIcon('heroicon-m-star')
                    ->falseIcon('heroicon-m-star')
                    ->trueColor('warning')
                    ->falseColor('gray'),
            ])
            ->recordActions([
                Action::make('edit')
                    ->icon('heroicon-m-pencil-square')
                    ->url(fn (Event $record) => EventResource::getUrl('edit', ['record' => $record])),
            ])
            ->paginated(false)
            ->emptyStateHeading('No upcoming events')
            ->emptyStateDescription('Create an event to see it here.')
            ->emptyStateIcon('heroicon-o-calendar-days');
    }
}
