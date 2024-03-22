<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use App\Models\DomainNotCorrectHistorical;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\DomainNotCorrectHistoricalResource\Pages;
use App\Filament\Resources\DomainNotCorrectHistoricalResource\RelationManagers;

class DomainNotCorrectHistoricalResource extends Resource
{
    protected static ?string $model = DomainNotCorrectHistorical::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->paginated([10, 25, 50, 100])
            ->columns([
                TextColumn::make('address')
                    ->searchable(),
                TextColumn::make('not_correct_count')
                    ->label('Nº Not Correct'),
                //
            ])
            ->filters([
                //
            ])
            ->actions([
                // Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListDomainNotCorrectHistoricals::route('/'),
            'create' => Pages\CreateDomainNotCorrectHistorical::route('/create'),
            'edit' => Pages\EditDomainNotCorrectHistorical::route('/{record}/edit'),
        ];
    }
}
