<?php

namespace App\Filament\Pages\Auth;

use Filament\Forms\Form;
use Filament\Pages\Auth\Login as BaseLogin;

class LoginPage extends BaseLogin
{
    public function form(Form $form): Form
    {
        return $form
            ->schema([
                $this->getEmailFormComponent()
                    ->validationMessages([
                        'required' => 'O email é obrigatório',
                        'email' => 'O email deve ser um email válido',
                    ]),
                $this->getPasswordFormComponent()
                    ->validationMessages([
                        'required' => 'A senha é obrigatória',
                        'password' => 'A senha deve ter pelo menos 8 caracteres',
                    ]),
                $this->getRememberFormComponent(),
            ]);
    }
}
