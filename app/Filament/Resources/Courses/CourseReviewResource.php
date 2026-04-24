<?php

namespace App\Filament\Resources\Courses;

use App\Filament\Resources\Courses\Pages\ListCourseReviews;
use App\Models\CourseReview;
use BackedEnum;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Resources\Resource;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class CourseReviewResource extends Resource
{
    protected static ?string $model = CourseReview::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedStar;

    public static function getNavigationGroup(): ?string { return 'Courses'; }
    public static function getNavigationLabel(): string  { return 'Course Reviews'; }
    public static function getNavigationSort(): ?int     { return 6; }

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            Toggle::make('is_approved')
                ->label('Approved')
                ->default(false),

            Textarea::make('body')
                ->label('Review')
                ->rows(4)
                ->disabled(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->defaultSort('created_at', 'desc')
            ->columns([
                TextColumn::make('member.full_name')
                    ->label('Member')
                    ->getStateUsing(fn (CourseReview $record) => $record->member
                        ? "{$record->member->first_name} {$record->member->last_name}"
                        : '—')
                    ->searchable(query: fn ($query, string $search) => $query->whereHas('member', fn ($q) => $q
                        ->where('first_name', 'like', "%{$search}%")
                        ->orWhere('last_name', 'like', "%{$search}%")
                    ))
                    ->sortable(false),

                TextColumn::make('course.title')
                    ->label('Course')
                    ->searchable()
                    ->sortable()
                    ->limit(35),

                TextColumn::make('rating')
                    ->label('Rating')
                    ->formatStateUsing(fn (int $state): string => str_repeat('★', $state) . str_repeat('☆', 5 - $state))
                    ->color(fn (int $state): string => match (true) {
                        $state >= 4 => 'success',
                        $state === 3 => 'warning',
                        default     => 'danger',
                    })
                    ->sortable(),

                TextColumn::make('body')
                    ->label('Review')
                    ->limit(60)
                    ->placeholder('—')
                    ->wrap(),

                IconColumn::make('is_approved')
                    ->label('Approved')
                    ->boolean()
                    ->trueIcon('heroicon-m-check-badge')
                    ->falseIcon('heroicon-m-x-circle')
                    ->trueColor('success')
                    ->falseColor('gray'),

                TextColumn::make('created_at')
                    ->label('Submitted')
                    ->dateTime('M j, Y')
                    ->sortable(),
            ])
            ->filters([
                TernaryFilter::make('is_approved')
                    ->label('Approval Status')
                    ->trueLabel('Approved')
                    ->falseLabel('Pending'),

                SelectFilter::make('rating')
                    ->options([
                        5 => '★★★★★ (5)',
                        4 => '★★★★☆ (4)',
                        3 => '★★★☆☆ (3)',
                        2 => '★★☆☆☆ (2)',
                        1 => '★☆☆☆☆ (1)',
                    ]),
            ])
            ->actions([
                EditAction::make()->label('Approve / Edit'),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListCourseReviews::route('/'),
            'edit'  => Pages\EditCourseReview::route('/{record}/edit'),
        ];
    }
}
