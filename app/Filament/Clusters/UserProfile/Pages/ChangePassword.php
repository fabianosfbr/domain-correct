<?php

namespace App\Filament\Clusters\UserProfile\Pages;

use App\Filament\Clusters\UserProfile;
use App\Models\User;
use Filament\Facades\Filament;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class ChangePassword extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-key';

    protected static string $view = 'filament.clusters.user-profile.pages.change-password';

    protected static ?string $title = 'Trocar a senha';

    protected ?string $heading = '';

    protected ?string $subheading = '';

    protected static ?string $cluster = UserProfile::class;

    protected static ?int $navigationSort = 3;

    public ?array $data = [];

    public User $user;

    public function mount(): void
    {
        $this->user = auth()->user();

        // @phpstan-ignore-next-line
        $this->form->fill();
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Trocar a senha')
                    ->columns([
                        'sm' => 1,
                    ])
                    ->schema([
                        TextInput::make('password')
                            ->label('Senha')
                            ->required()
                            ->revealable()
                            ->password()
                            ->rule(Password::min(8)->mixedCase()->letters()->numbers()->symbols())
                            ->autocomplete('new-password')
                            ->dehydrated(fn ($state): bool => filled($state))
                            ->dehydrateStateUsing(fn ($state): string => Hash::make($state))
                            ->placeholder('A senha deve ter pelo menos 8 caracteres, incluindo letras maiúsculas, minúsculas, números e símbolos.')
                            ->live(debounce: 500)
                            ->same('passwordConfirmation')
                            ->autofocus()
                            ->validationMessages([
                                'required' => 'A senha é obrigatória',
                                'mixed_case' => 'A senha deve conter letras maiúsculas e minúsculas',
                                'letters' => 'A senha deve conter letras',
                                'numbers' => 'A senha deve conter números',
                                'symbols' => 'A senha deve conter símbolos',
                                'min' => 'A senha deve ter pelo menos 8 caracteres',
                                'capital' => 'A senha deve conter letras maiúsculas',
                                'same' => 'A confirmação de senha deve ser igual à senha',

                            ]),
                        TextInput::make('passwordConfirmation')
                            ->label('Confirmar senha')
                            ->password()
                            ->revealable()
                            ->required()
                            ->placeholder('Confirme a senha digitada acima')
                            ->dehydrated(false),
                    ])
                    ->icon('heroicon-o-key'),
            ])
            ->statePath('data');
    }

    public function submit()
    {
        // @phpstan-ignore-next-line
        $data = $this->form->getState();

        $this->user->update([
            'password' => $data['password'],
        ]);

        if (request()->hasSession() && array_key_exists('password', $data)) {
            request()->session()->put(['password_hash_' . Filament::getAuthGuard() => $data['password']]);
        }

        // @phpstan-ignore-next-line
        $this->form->fill();

        Notification::make()
            ->title('Senha alterada')
            ->body('Sua senha foi alterada com sucesso.')
            ->color('success')
            ->duration(5000)
            ->send();
    }
}
