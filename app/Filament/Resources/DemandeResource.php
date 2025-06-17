<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DemandeResource\Pages;
use App\Filament\Resources\DemandeResource\RelationManagers;
use App\Models\Demande;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class DemandeResource extends Resource
{
    protected static ?string $model = Demande::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('id_utilisateur')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('id_administrateur')
                    ->numeric(),
                Forms\Components\TextInput::make('type_acte')
                    ->required(),
                Forms\Components\DateTimePicker::make('date_demande')
                    ->required(),
                Forms\Components\TextInput::make('statut_demande')
                    ->required()
                    ->maxLength(255)
                    ->default('en_attente_paiement'),
                Forms\Components\TextInput::make('reference')
                    ->maxLength(255),
                Forms\Components\TextInput::make('transaction_id')
                    ->maxLength(255),
                Forms\Components\TextInput::make('montant')
                    ->numeric(),
                Forms\Components\TextInput::make('methode_paiement')
                    ->maxLength(255),
                Forms\Components\TextInput::make('statut_paiement')
                    ->required()
                    ->maxLength(255)
                    ->default('en_attente'),
                Forms\Components\DateTimePicker::make('date_paiement'),
                Forms\Components\Textarea::make('raison_echec')
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id_utilisateur')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('id_administrateur')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('type_acte'),
                Tables\Columns\TextColumn::make('date_demande')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('statut_demande')
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('reference')
                    ->searchable(),
                Tables\Columns\TextColumn::make('transaction_id')
                    ->searchable(),
                Tables\Columns\TextColumn::make('montant')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('methode_paiement')
                    ->searchable(),
                Tables\Columns\TextColumn::make('statut_paiement')
                    ->searchable(),
                Tables\Columns\TextColumn::make('date_paiement')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListDemandes::route('/'),
            'create' => Pages\CreateDemande::route('/create'),
            'edit' => Pages\EditDemande::route('/{record}/edit'),
        ];
    }
}
