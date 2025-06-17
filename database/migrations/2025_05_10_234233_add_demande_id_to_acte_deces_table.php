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
    Schema::table('acte_deces', function (Blueprint $table) {
        $table->unsignedBigInteger('demande_id')->after('id'); // position facultative
        $table->foreign('demande_id')->references('id_demande')->on('demandes')->onDelete('cascade');
    });
}

public function down()
{
    Schema::table('acte_deces', function (Blueprint $table) {
        $table->dropForeign(['demande_id']);
        $table->dropColumn('demande_id');
    });
}

};
