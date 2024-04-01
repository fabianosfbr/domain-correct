<?php

namespace App\Filament\Clusters\UserProfile\Pages;

use App\Filament\Clusters\UserProfile;
use App\Infolists\Components\GenerateApiKey;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Concerns\InteractsWithInfolists;
use Filament\Infolists\Contracts\HasInfolists;
use Filament\Infolists\Infolist;
use Filament\Notifications\Notification;
use Filament\Pages\Concerns\InteractsWithFormActions;
use Filament\Pages\Page;
use Filament\Support\Enums\IconPosition;
use Illuminate\Support\HtmlString;

class ViewUserProfilePage extends Page implements HasInfolists
{
    use InteractsWithFormActions;
    use InteractsWithInfolists;

    protected static ?string $navigationIcon = 'heroicon-o-user';

    protected static ?string $navigationLabel = 'Perfil';

    protected static ?string $slug = 'me';

    protected ?string $heading = '';

    protected ?string $subheading = '';

    protected static string $view = 'filament.clusters.user-profile.pages.view-user-profile-page';

    protected static ?string $cluster = UserProfile::class;

    public ?array $data = [];

    public function personalInfolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->record(auth()->user())
            ->schema([
                Section::make('Informações Pessoais')
                    ->columns([
                        'sm' => 1,
                        'md' => 2,
                    ])
                    ->schema([
                        TextEntry::make('name')
                            ->label('Nome'),
                        TextEntry::make('email')
                            ->label('E-mail'),
                    ]),
                Section::make('Dados da Conta')
                    ->columns([
                        'sm' => 3,
                    ])
                    ->schema([
                        TextEntry::make('keep_token')
                            ->label('API key')
                            ->icon('heroicon-m-key')
                            ->listWithLineBreaks()
                            ->iconPosition(IconPosition::After)
                            ->iconColor('warning')
                            ->copyable()
                            ->copyMessage('Copied!')
                            ->copyMessageDuration(1500)
                            ->columnSpan(2)
                            ->formatStateUsing(
                                fn (string $state): HtmlString => new HtmlString(
                                    '<div>'.
                                        substr_replace($state, str_repeat('*', ceil(strlen($state) * 0.90)), 0, ceil(strlen($state) * 0.90))
                                        .'</div>'
                                )
                            )
                            ->html(),
                        GenerateApiKey::make('generate_api_token')
                            ->label('Gerar nova API key')
                            ->columnSpan(1),
                    ]),
            ]);
    }

    public function generateApiToken()
    {
        $user = auth()->user();
        $user->tokens()->delete();
        $token = $user->createToken('api_token')->plainTextToken;
        $user->keep_token = $token;
        $user->update();

        Notification::make()
            ->title('Token cadastrado com sucesso!')
            ->body($token)
            ->color('success')
            ->duration(5000)
            ->send();
    }
}
