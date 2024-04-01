<?php

namespace App\Filament\Pages\Auth;

use Filament\Forms\Form;
use Filament\Pages\Auth\Register as BaseRegister;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Rules\Password;

class RegisterPage extends BaseRegister
{
    public function form(Form $form): Form
    {
        return $form
            ->schema([
                $this->getNameFormComponent()
                    ->validationMessages([
                        'required' => 'O nome é obrigatório',
                        'string' => 'O nome deve ser uma string',
                        'max' => 'O nome deve ter no máximo 255 caracteres',
                    ]),
                $this->getEmailFormComponent()
                    ->validationMessages([
                        'required' => 'O email é obrigatório',
                        'email' => 'O email deve ser um email válido',
                        'max' => 'O email deve ter no máximo 255 caracteres',
                        'unique' => 'O email já está em uso',
                    ]),
                $this->getPasswordFormComponent()
                    ->rule(
                        Password::default()
                            ->mixedCase()
                            ->symbols()
                            ->numbers()
                    )
                    ->validationMessages([
                        'required' => 'A senha é obrigatória',
                        'min' => 'A senha deve ter pelo menos 8 caracteres',
                        'same' => 'A senha deve ser igual à confirmação de senha',
                        'password.mixed' => 'A senha deve conter letras maiúsculas e minúsculas',
                        'password.symbols' => 'A senha deve conter símbolos',
                        'password.numbers' => 'A senha deve conter números',
                        'password.letters' => 'A senha deve conter letras',
                    ]),
                $this->getPasswordConfirmationFormComponent(),
            ]);
    }

    /**
     * @param  array<string, mixed>  $data
     */
    protected function handleRegistration(array $data): Model
    {
        $user = $this->getUserModel()::create($data);
        $token = $user->createToken('api_token')->plainTextToken;
        $user->keep_token = $token;
        $user->update();

        return $user;
    }
}
