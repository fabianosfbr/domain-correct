<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DomainNotCorrectHistoricalResource\Pages;
use App\Models\DomainCorrect;
use App\Models\DomainNotCorrect;
use App\Models\DomainNotCorrectHistorical;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Tables\Actions\Action;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class DomainNotCorrectHistoricalResource extends Resource
{
    protected static ?string $model = DomainNotCorrectHistorical::class;

    protected static ?string $modelLabel = 'Relatório de Não Conformidade';

    protected static ?string $navigationIcon = 'heroicon-o-exclamation-triangle';

    public static function getNavigationBadge(): ?string
    {
        return (string) DomainNotCorrectHistorical::whereNotIn('name', DomainNotCorrect::pluck('name')->toArray())->count();
    }

    public static function getNavigationBadgeColor(): ?string
    {
        return (string) DomainNotCorrectHistorical::whereNotIn('name', DomainNotCorrect::pluck('name')->toArray())->count() > 0 ? 'danger' : 'success';
    }

    public static function canAccess(): bool
    {
        return Gate::allows('accessNotCorrectHistoricalResource', auth()->user());
    }

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
                Action::make('vincular')
                    ->label('Vincular')
                    ->icon('heroicon-o-link')
                    ->modalWidth('lg')
                    ->form([
                        Placeholder::make('name')
                            ->label('Domínio')
                            ->content(
                                fn (DomainNotCorrectHistorical $record): string => "O domínio {$record->name} será vinculado ao domínio selecionado abaixo."
                            ),
                        Select::make('domain_correct_id')
                            ->label('')
                            ->required()
                            ->options(
                                DomainCorrect::pluck('name', 'id')->toArray()
                            )
                            ->searchable(),
                    ])
                    ->action(function (DomainNotCorrectHistorical $record, array $data) {
                        try {
                            DomainNotCorrect::create([
                                'name' => $record->name,
                                'domain_correct_id' => $data['domain_correct_id'],
                            ]);

                            Notification::make()
                                ->title('Sucesso')
                                ->body('Domínio vinculado com sucesso')
                                ->color('success')
                                ->send();
                        } catch (\Exception $exception) {
                            Notification::make()
                                ->title('Erro')
                                ->body('Erro ao vincular domínio')
                                ->color('danger')
                                ->send();
                        }
                    }),
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
            ->whereNotIn('name', DomainNotCorrect::pluck('name')->toArray())
            ->orderBy('created_at', 'desc')
            ->groupBy('name');
    }
}
