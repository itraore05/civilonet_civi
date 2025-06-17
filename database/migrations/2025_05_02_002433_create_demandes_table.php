<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('demandes', function (Blueprint $table) {
            $table->id('id_demande');
            
            // Clé étrangère vers users (version explicite)
            $table->unsignedBigInteger('id_utilisateur');
            $table->foreign('id_utilisateur')
                  ->references('id_utilisateur')
                  ->on('users')
                  ->onDelete('cascade');
            
            // Clé étrangère nullable vers admin
            $table->unsignedBigInteger('id_administrateur')->nullable();
            $table->foreign('id_administrateur')
                  ->references('id_utilisateur')
                  ->on('users')
                  ->onDelete('set null');
            
            $table->enum('type_acte', ['naissance', 'mariage', 'deces']);
            $table->timestamp('date_demande')->useCurrent();
            $table->enum('statut_demande', ['en_cours', 'traitee', 'rejetee'])->default('en_cours');
            $table->timestamps();
            
            // Index pour améliorer les performances
            $table->index('id_utilisateur');
            $table->index('id_administrateur');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('demandes');
    }
};