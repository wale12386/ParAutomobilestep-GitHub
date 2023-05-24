<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDeplacementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('deplacements', function (Blueprint $table) {
            $table->id('id_deplacement');
            $table->string('destination');
            $table->integer('kilometrage');
            $table->integer('qte_carburant');
            $table->string('Matricule');
            $table->string('CINC');
            $table->timestamp('archived_at')->nullable();

            $table->foreign('CINC')->references('CINC')->on('conducteurs')->onDelete('cascade');
            $table->foreign('Matricule')->references('matricule')->on('voitures')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('deplacements');
    }
}
