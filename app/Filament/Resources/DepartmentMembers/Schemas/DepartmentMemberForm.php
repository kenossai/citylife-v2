<?php

namespace App\Filament\Resources\DepartmentMembers\Schemas;

use App\Models\Member;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class DepartmentMemberForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(1)
            ->components([
                Section::make('Assignment')
                    ->columns(2)
                    ->schema([
                        Select::make('department_id')
                            ->label('Department')
                            ->relationship('department', 'name')
                            ->searchable()
                            ->preload()
                            ->required(),
                        Select::make('member_id')
                            ->label('Member')
                            ->options(
                                Member::orderBy('first_name')
                                    ->get()
                                    ->mapWithKeys(fn ($m) => [
                                        $m->id => trim("{$m->first_name} {$m->last_name}") . " ({$m->membership_number})",
                                    ])
                            )
                            ->searchable()
                            ->required(),
                        TextInput::make('role')
                            ->label('Role in Department')
                            ->maxLength(100)
                            ->placeholder('e.g. Coordinator')
                            ->nullable()
                            ->columnSpanFull(),
                    ]),
            ]);
    }
}
