<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVidangesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vidanges', function (Blueprint $table) {
            $table->id('idvidenge');
            $table->string('kilométrage');
            $table->string('montant');
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
        Schema::dropIfExists('vidanges');
    }
}
