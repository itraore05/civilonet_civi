<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('demandes', function (Blueprint $table) {
            // Ajoutez d'abord la colonne reference si elle n'existe pas
            if (!Schema::hasColumn('demandes', 'reference')) {
                $table->string('reference')->nullable();
            }

            // Ajoutez les nouvelles colonnes
            $table->string('transaction_id')->nullable()->after('reference');
            $table->decimal('montant', 10, 2)->nullable()->after('transaction_id');
            $table->string('methode_paiement')->nullable()->after('montant');
            $table->string('statut_paiement')->default('en_attente')->after('methode_paiement');
            $table->dateTime('date_paiement')->nullable()->after('statut_paiement');
            $table->text('raison_echec')->nullable()->after('date_paiement');
            
            // Modification du statut_demande par défaut
            $table->string('statut_demande')->default('en_attente_paiement')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('demandes', function (Blueprint $table) {
            $table->dropColumn([
                'transaction_id',
                'montant',
                'methode_paiement',
                'statut_paiement',
                'date_paiement',
                'raison_echec'
            ]);
            
            // Revenir à la valeur par défaut précédente
            $table->string('statut_demande')->default('en_cours')->change();
            
            // Ne supprimez pas la colonne reference ici pour éviter de perdre des données
        });
    }
};