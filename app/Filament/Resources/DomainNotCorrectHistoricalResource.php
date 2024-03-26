<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DomainNotCorrectHistoricalResource\Pages;
use App\Models\DomainNotCorrectHistorical;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

class DomainNotCorrectHistoricalResource extends Resource
{
    protected static ?string $model = DomainNotCorrectHistorical::class;

    protected static ?string $modelLabel = 'Relatório de Não Conformidade';

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
            ->recordUrl(null)
            ->striped()
            ->columns([
                TextColumn::make('name')
                    ->label('Domínio'),
                TextColumn::make('created_at')
                    ->label('Data de Criação')
                    ->date('d/m/Y'),
                TextColumn::make('total')
                    ->label('Nº Occurrences'),
                //
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->label('Vincular'),
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

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->select(
                DB::raw('MIN(id) as id'),
                DB::raw('MAX(created_at) as created_at'),
                DB::raw('name'),
                DB::raw('count(*) as total')
            )
            ->orderBy('created_at', 'desc')
            ->groupBy('name');
    }
}
