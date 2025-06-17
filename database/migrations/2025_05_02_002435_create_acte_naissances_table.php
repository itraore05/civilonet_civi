<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('acte_naissance', function (Blueprint $table) {
            $table->id('id_acte_naissance');
            
            // Version explicite recommandée
            $table->unsignedBigInteger('id_demande');
            $table->foreign('id_demande')
                  ->references('id_demande')
                  ->on('demandes')
                  ->onDelete('cascade'); // Supprime l'acte si la demande est supprimée
            
            // Champs existants (corrects)
            $table->string('nom_enfant');
            $table->string('prenoms_enfant');
            $table->date('date_naissance_enfant');
            $table->string('lieu_naissance_enfant');
            $table->string('nom_pere');
            $table->string('prenoms_pere');
            $table->string('nom_mere');
            $table->string('prenoms_mere');
            $table->timestamps();
            
            // Ajout d'un index
            $table->index('id_demande');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('acte_naissances');
    }
};
