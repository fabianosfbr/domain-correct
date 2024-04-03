<?php

namespace App\Filament\Resources;

use App\Enums\UserRole;
use App\Filament\Resources\UserResource\Pages;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Components\Section;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rules\Password;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';

    protected static ?string $modelLabel = 'Usuário';

    protected static ?string $pluralLabel = 'Usuários';

    public static function canAccess(): bool
    {
        return Gate::allows('accessUserResource', auth()->user());
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Informações do Usuário')
                    ->columns(2)
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->label('Nome')
                            ->required()
                            ->placeholder('Informe o nome completo'),
                        Forms\Components\TextInput::make('email')
                            ->label('E-mail')
                            ->required()
                            ->placeholder('Informe o e-mail'),
                        Forms\Components\Select::make('role')
                            ->label('Função')
                            ->searchable()
                            ->options([
                                UserRole::ADMIN->value => UserRole::ADMIN->label(),
                                UserRole::CLIENT->value => UserRole::CLIENT->label(),
                            ])
                            ->required(),
                        Forms\Components\TextInput::make('password')
                            ->label('Senha')
                            ->password()
                            ->rule(
                                Password::default()
                                    ->mixedCase()
                                    ->symbols()
                                    ->numbers()
                            )
                            ->required()
                            ->placeholder('Informe a senha')
                            ->validationMessages([
                                'required' => 'A senha é obrigatória',
                                'min' => 'A senha deve ter pelo menos 8 caracteres',
                                'same' => 'A senha deve ser igual à confirmação de senha',
                                'password.mixed' => 'A senha deve conter letras maiúsculas e minúsculas',
                                'password.symbols' => 'A senha deve conter símbolos',
                                'password.numbers' => 'A senha deve conter números',
                                'password.letters' => 'A senha deve conter letras',
                            ]),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Nome')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('email')
                    ->label('E-mail')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('role')
                    ->label('Função')
                    ->searchable()
                    ->sortable()
                    // @phpstan-ignore-next-line
                    ->formatStateUsing(fn (User $user) => $user->role->label())
                    ->badge()
                    ->color(fn (UserRole $state): string => match ($state) {
                        $state::ADMIN => $state::ADMIN->color(),
                        $state::CLIENT => $state::CLIENT->color(),
                    }),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Criado em')
                    ->searchable()
                    ->sortable()
                    ->formatStateUsing(fn (User $user) => $user->created_at->format('d/m/Y H:i')),
            ])
            ->filters([
                SelectFilter::make('role')
                    ->label('Função')
                    ->options([
                        UserRole::ADMIN->value => UserRole::ADMIN->label(),
                        UserRole::CLIENT->value => UserRole::CLIENT->label(),
                    ]),
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->label('')
                    ->iconSize('md'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
