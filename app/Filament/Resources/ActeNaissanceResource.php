<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ActeNaissanceResource\Pages;
use App\Models\ActeNaissance;
use App\Models\Demande;
use Filament\Notifications\Notification;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Textarea;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\App;
use Illuminate\Http\Request;

class ActeNaissanceResource extends Resource
{
    protected static ?string $model = ActeNaissance::class;
    protected static ?string $navigationIcon = 'heroicon-o-user-plus';
    protected static ?string $navigationGroup = 'Gestion des Actes';
    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('demande_id')
                    ->label('Demande associée')
                    ->options(
                        Demande::where('statut_demande', 'en_traitement')
                            ->where('type_acte', 'naissance')
                            ->pluck('id_demande', 'id_demande')
                    )
                    ->required(),
                
                TextInput::make('nom_enfant')
                    ->required()
                    ->maxLength(255),
                
                TextInput::make('prenoms_enfant')
                    ->required()
                    ->maxLength(255),
                
                DatePicker::make('date_naissance_enfant')
                    ->required(),
                
                TextInput::make('lieu_naissance_enfant')
                    ->required()
                    ->maxLength(255),
                
                TextInput::make('nom_pere')
                    ->required()
                    ->maxLength(255),
                
                TextInput::make('prenoms_pere')
                    ->required()
                    ->maxLength(255),
                
                TextInput::make('nom_mere')
                    ->required()
                    ->maxLength(255),
                
                TextInput::make('prenoms_mere')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('demande.id_demande')
                    ->label('N° Demande')
                    ->sortable()
                    ->searchable(),
                
                TextColumn::make('nom_enfant')
                    ->label('Nom enfant')
                    ->searchable(),
                
                TextColumn::make('prenoms_enfant')
                    ->label('Prénoms enfant')
                    ->searchable(),
                
                TextColumn::make('date_naissance_enfant')
                    ->label('Date naissance')
                    ->date(),
                
                TextColumn::make('lieu_naissance_enfant')
                    ->label('Lieu naissance'),
                
                BadgeColumn::make('demande.statut_demande')
                    ->label('Statut')
                    ->colors([
                        'warning' => 'en_attente',
                        'primary' => 'en_traitement',
                        'success' => 'traitee',
                        'danger' => 'rejetee',
                    ])
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'en_attente' => 'En attente',
                        'en_traitement' => 'En traitement',
                        'traitee' => 'Traitée',
                        'rejetee' => 'Rejetée',
                        default => $state,
                    }),
                
                TextColumn::make('demande.pdf_path')
                    ->label('Document PDF')
                    ->formatStateUsing(fn ($state) => $state ? 'Disponible' : 'Non disponible')
                    ->badge()
                    ->color(fn ($state) => $state ? 'success' : 'warning'),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('demande.statut_demande')
                    ->label('Statut demande')
                    ->options([
                        'en_attente' => 'En attente',
                        'en_traitement' => 'En traitement',
                        'traitee' => 'Traitée',
                        'rejetee' => 'Rejetée',
                    ]),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                
                // Action pour valider la demande et générer un PDF automatiquement
                Tables\Actions\Action::make('traiter')
                    ->label('Valider')
                    ->icon('heroicon-o-check-circle')
                    ->color('success')
                    ->modalHeading('Valider cette demande')
                    ->modalSubheading('Un document PDF officiel sera automatiquement généré après validation')
                    ->modalButton('Valider la demande')
                    ->action(function (ActeNaissance $record) {
                        try {
                            // Récupérer l'ID de la demande associée à l'acte de naissance
                            $demandeId = $record->demande->id_demande;
                            
                            // Version alternative: utiliser directement le modèle
                            $demande = Demande::find($demandeId);
                            
                            if (!$demande) {
                                throw new \Exception("Demande introuvable");
                            }
                            
                            // Instancier le contrôleur avec le service PDF via le conteneur IoC
                            $pdfGenerator = App::make(\App\Services\PdfGeneratorService::class);
                            $controller = new \App\Http\Controllers\DemandeValidationController($pdfGenerator);
                            $result = $controller->validerDemande($demandeId, new Request());
                            
                            // Analyser la réponse (c'est un objet JsonResponse)
                            $responseData = json_decode($result->getContent(), true);
                            
                            if (isset($responseData['success']) && $responseData['success'] === true) {
                                Notification::make()
                                    ->title('Acte de naissance validé')
                                    ->body('La demande #'.$demandeId.' a été validée et le document PDF a été généré automatiquement.')
                                    ->success()
                                    ->send();
                            } else {
                                throw new \Exception("Échec de la validation: " . ($responseData['message'] ?? 'Erreur inconnue'));
                            }
                        } catch (\Exception $e) {
                            Notification::make()
                                ->title('Erreur de validation')
                                ->body('Une erreur est survenue lors de la validation de la demande: ' . $e->getMessage())
                                ->danger()
                                ->send();
                        }
                    })
                    ->visible(fn (ActeNaissance $record): bool => $record->demande->statut_demande !== 'traitee'),
                
                // Action pour rejeter la demande
                Tables\Actions\Action::make('rejeter')
                    ->label('Rejeter')
                    ->icon('heroicon-o-x-circle')
                    ->color('danger')
                    ->form([
                        Textarea::make('motif_rejet')
                            ->label('Motif du rejet')
                            ->required()
                            ->maxLength(500)
                            ->placeholder('Veuillez spécifier la raison du rejet de cette demande')
                    ])
                    ->modalHeading('Rejeter la demande')
                    ->modalSubheading('Veuillez indiquer le motif du rejet de cette demande')
                    ->modalButton('Confirmer le rejet')
                    ->action(function (array $data, ActeNaissance $record) {
                        try {
                            // Récupérer l'ID de la demande associée à l'acte de naissance
                            $demandeId = $record->demande->id_demande;
                            
                            // Instancier le contrôleur avec le service PDF via le conteneur IoC
                            $pdfGenerator = App::make(\App\Services\PdfGeneratorService::class);
                            $controller = new \App\Http\Controllers\DemandeValidationController($pdfGenerator);
                            
                            // Créer une requête avec le motif du rejet
                            $request = new Request();
                            $request->merge(['motif_rejet' => $data['motif_rejet']]);
                            
                            $result = $controller->rejeterDemande($demandeId, $request);
                            
                            // Analyser la réponse (c'est un objet JsonResponse)
                            $responseData = json_decode($result->getContent(), true);
                            
                            if (isset($responseData['success']) && $responseData['success'] === true) {
                                Notification::make()
                                    ->title('Demande rejetée')
                                    ->body('La demande #'.$demandeId.' a été rejetée avec succès.')
                                    ->success()
                                    ->send();
                            } else {
                                throw new \Exception("Échec du rejet: " . ($responseData['message'] ?? 'Erreur inconnue'));
                            }
                        } catch (\Exception $e) {
                            Notification::make()
                                ->title('Erreur de rejet')
                                ->body('Une erreur est survenue lors du rejet de la demande: ' . $e->getMessage())
                                ->danger()
                                ->send();
                        }
                    })
                    ->visible(fn (ActeNaissance $record): bool => !in_array($record->demande->statut_demande, ['rejetee', 'traitee'])),
                
                // Action pour télécharger le PDF généré
                Tables\Actions\Action::make('telechargerPdf')
                    ->label('Télécharger PDF')
                    ->icon('')
                    ->color('primary')
                    ->url(fn (ActeNaissance $record) => route('demande.telecharger-pdf', ['demandeId' => $record->demande->id_demande]))
                    ->openUrlInNewTab()
                    ->visible(fn (ActeNaissance $record): bool => $record->demande->statut_demande === 'traitee' && $record->demande->pdf_path),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->whereHas('demande', function (Builder $query) {
                $query->where('type_acte', 'naissance');
            });
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
            'index' => Pages\ListActeNaissances::route('/'),
            'create' => Pages\CreateActeNaissance::route('/create'),
            'edit' => Pages\EditActeNaissance::route('/{record}/edit'),
        ];
    }
}