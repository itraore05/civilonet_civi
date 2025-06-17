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
            $table->timestamp('date_traitement')
                  ->nullable()
                  ->after('statut_demande')
                  ->comment('Date de traitement de la demande');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('demandes', function (Blueprint $table) {
            $table->dropColumn('date_traitement');
        });
    }
};