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
        Schema::create('acte_deces', function (Blueprint $table) {
            $table->id('id_acte_deces');
            
            $table->unsignedBigInteger('id_demande');
            $table->foreign('id_demande')
                  ->references('id_demande')
                  ->on('demandes')
                  ->onDelete('cascade');
            
            // Champs existants (corrects)
            $table->string('nom_defunt');
            $table->string('prenoms_defunt');
            $table->date('date_naissance_defunt');
            $table->string('lieu_naissance_defunt');
            $table->date('date_deces');
            $table->string('lieu_deces');
            $table->timestamps();
            
            $table->index('id_demande');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('acte_deces');
    }
};
