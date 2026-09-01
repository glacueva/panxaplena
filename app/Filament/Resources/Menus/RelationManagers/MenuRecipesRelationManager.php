<?php

namespace App\Filament\Resources\Menus\RelationManagers;

use App\Enums\DayOfWeek;
use App\Enums\Meal;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Grouping\Group;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class MenuRecipesRelationManager extends RelationManager
{
    protected static string $relationship = 'menuRecipes';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('recipe_id')
                    ->relationship('recipe', 'name')
                    ->required()
                    ->searchable()
                    ->createOptionForm([
                        TextInput::make('name')->required(),
                    ]),
                TextInput::make('recipe_quantity')
                    ->required()
                    ->numeric(),
                Select::make('day_of_week')
                    ->options(DayOfWeek::class)
                    ->required(),
                Select::make('meal')
                    ->options(Meal::class)
                    ->required(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->columns([
                TextColumn::make('recipe.name')
                    ->label('Recipe')
                    ->numeric(),
                TextColumn::make('recipe_quantity')
                    ->numeric(),
                TextColumn::make('day_of_week')
                    ->badge()
                    ->searchable(),
                TextColumn::make('meal')
                    ->badge()
                    ->searchable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                CreateAction::make(),
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort(function (Builder $query): Builder {
                return $query->orderedByDayAndMeal();
            })
            ->groups([
                Group::make('day_of_week')
                    ->getTitleFromRecordUsing(fn ($record): string => ucfirst($record->day_of_week->value))
                    ->orderQueryUsing(fn (Builder $query, string $direction) => $query->orderedByDayAndMeal())
                    ->collapsible(),
            ])
            ->defaultGroup('day_of_week')
            ->defaultPaginationPageOption(100)
            ->collapsedGroupsByDefault();
    }
}
