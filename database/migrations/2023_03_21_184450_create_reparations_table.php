<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReparationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reparations', function (Blueprint $table) {
            $table->id('idreparation');
            $table->date('dateR');
            $table->string('montant');
            $table->string('dégât');
            $table->string('Matricule');
            $table->foreign('Matricule')->references('Matricule')->on('voitures');
            $table->unsignedBigInteger('id_fournisseur');
            $table->timestamp('archived_at')->nullable();
            $table->foreign('id_fournisseur')->references('id_fournisseur')->on('fournisseurs');

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
        Schema::dropIfExists('reparations');
    }
}
