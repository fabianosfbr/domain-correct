<?php

namespace App\Filament\Resources\DomainCorrectResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;

class NotCorrectRelationManager extends RelationManager
{
    protected static string $relationship = 'not_correct';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label('Domínio')
                    ->required()
                    ->columnSpan(2)
                    ->maxLength(100),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->heading('Lista de domínios sugestos')
            ->paginated([10, 25, 50, 100])
            ->recordUrl(null)
            ->striped()
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Domínio'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make()
                    ->label('Adicionar Sugestão')
                    ->modalWidth('lg')
                    ->modalHeading('Adicionar Sugestão'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
