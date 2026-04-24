<?php

namespace App\Filament\Widgets;

use App\Filament\Resources\Members\MemberResource;
use App\Models\Member;
use Filament\Actions\Action;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class LatestMembersWidget extends BaseWidget
{
    protected static bool $isDiscovered = false;

    protected static ?int $sort = 4;

    protected static ?string $heading = 'Latest Members';

    protected int | string | array $columnSpan = 1;

    public function table(Table $table): Table
    {
        return $table
            ->query(Member::latest()->limit(5))
            ->columns([
                Tables\Columns\ImageColumn::make('avatar_path')
                    ->label('')
                    ->circular()
                    ->defaultImageUrl(fn (Member $record) => 'https://ui-avatars.com/api/?name=' . urlencode($record->full_name) . '&background=f59e0b&color=fff'),
                Tables\Columns\TextColumn::make('full_name')
                    ->label('Name')
                    ->weight('medium')
                    ->searchable(['first_name', 'last_name']),
                Tables\Columns\TextColumn::make('membership_number')
                    ->badge()
                    ->color('gray'),
                Tables\Columns\TextColumn::make('membership_status')
                    ->badge()
                    ->formatStateUsing(fn (string $state) => ucfirst($state))
                    ->color(fn (string $state) => match ($state) {
                        'active'   => 'success',
                        'inactive' => 'danger',
                        'pending'  => 'warning',
                        default    => 'gray',
                    }),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Joined')
                    ->since()
                    ->color('gray'),
            ])
            ->recordActions([
                Action::make('edit')
                    ->icon('heroicon-m-pencil-square')
                    ->url(fn (Member $record) => MemberResource::getUrl('edit', ['record' => $record])),
            ])
            ->paginated(false);
    }
}
