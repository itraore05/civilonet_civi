<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteBulkAction;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Gestion des utilisateurs';

    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nom')
                    ->label('Nom')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('prenoms')
                    ->label('Prénoms')
                    ->required()
                    ->maxLength(255),
                Forms\Components\DatePicker::make('date_naissance')
                    ->label('Date de naissance')
                    ->required(),
                Forms\Components\TextInput::make('lieu_naissance')
                    ->label('Lieu de naissance')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('email')
                    ->label('Email')
                    ->email()
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('telephone')
                    ->label('Téléphone')
                    ->required()
                    ->maxLength(15),
                Forms\Components\Select::make('role')
                    ->label('Rôle')
                    ->options([
                        'admin' => 'Administrateur',
                        'user' => 'Utilisateur',
                    ])
                    ->required(),
                Forms\Components\Toggle::make('is_active')
                    ->label('Utilisateur actif ?')
                    ->default(true),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nom')
                    ->label('Nom')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('prenoms')
                    ->label('Prénoms')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('email')
                    ->label('Email')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('telephone')
                    ->label('Téléphone')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('date_naissance')
                    ->label('Date de naissance')
                    ->sortable()
                    ->date('d/m/Y'),  // Formatage de la date
                BadgeColumn::make('role')
                    ->label('Rôle')
                    ->getStateUsing(function ($record) {
                        return $record->role === 'admin' ? 'Administrateur' : 'Utilisateur';
                    })
                    ->colors([
                        'success' => 'admin',
                        'warning' => 'user',
                    ])
                    ->sortable(),
                BadgeColumn::make('is_active')
                    ->label('Statut')
                    ->getStateUsing(function ($record) {
                        return $record->is_active ? 'Actif' : 'Inactif';
                    })
                    ->colors([
                        'success' => true,
                        'danger' => false,
                    ])
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                EditAction::make(),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            // Tu peux ajouter ici des gestionnaires de relations comme `hasMany` ou `belongsTo` si nécessaire.
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
