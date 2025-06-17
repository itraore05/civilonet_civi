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
        Schema::create('acte_mariage', function (Blueprint $table) {
            $table->id('id_acte_mariage');
            
            $table->unsignedBigInteger('id_demande');
            $table->foreign('id_demande')
                  ->references('id_demande')
                  ->on('demandes')
                  ->onDelete('cascade');
            
            // Champs existants (corrects)
            $table->string('nom_epoux');
            $table->string('prenoms_epoux');
            $table->date('date_naissance_epoux');
            $table->string('lieu_naissance_epoux');
            $table->string('nom_epouse');
            $table->string('prenoms_epouse');
            $table->date('date_naissance_epouse');
            $table->string('lieu_naissance_epouse');
            $table->date('date_mariage');
            $table->string('lieu_mariage');
            $table->timestamps();
            
            $table->index('id_demande');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('acte_mariage');
    }
};
