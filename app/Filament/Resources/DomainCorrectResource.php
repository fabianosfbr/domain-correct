<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DomainCorrectResource\Pages;
use App\Filament\Resources\DomainCorrectResource\RelationManagers\NotCorrectRelationManager;
use App\Models\DomainCorrect;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class DomainCorrectResource extends Resource
{
    protected static ?string $model = DomainCorrect::class;

    protected static ?string $modelLabel = 'Controle de Domínios';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->label('Domínio')
                    ->required(),
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
                    ->label('Domínio')
                    ->searchable(),
                TextColumn::make('not_correct_count')
                    ->counts('not_correct')
                    ->label('Nº Sugestões'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->label('Sugestões'),
            ])
            ->bulkActions([]);
    }

    public static function getRelations(): array
    {
        return [
            NotCorrectRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListDomainCorrects::route('/'),
            'create' => Pages\CreateDomainCorrect::route('/create'),
            'edit' => Pages\EditDomainCorrect::route('/{record}/edit'),
        ];
    }
}
