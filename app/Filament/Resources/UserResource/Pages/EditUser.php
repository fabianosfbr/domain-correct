<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Enums\UserRole;
use App\Filament\Resources\UserResource;
use Filament\Actions;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Pages\EditRecord;

class EditUser extends EditRecord
{
    protected static string $resource = UserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Informações do Usuário')
                    ->description('Editar as informações do usuário.')
                    ->columns(2)
                    ->schema([
                        TextInput::make('name')
                            ->label('Nome')
                            ->required()
                            ->placeholder('Informe o nome completo'),
                        TextInput::make('email')
                            ->label('E-mail')
                            ->required()
                            ->placeholder('Informe o e-mail'),
                        Select::make('role')
                            ->label('Função')
                            ->searchable()
                            ->options([
                                UserRole::ADMIN->value => UserRole::ADMIN->label(),
                                UserRole::CLIENT->value => UserRole::CLIENT->label(),
                            ])
                            ->required(),
                    ]),
            ]);
    }
}
