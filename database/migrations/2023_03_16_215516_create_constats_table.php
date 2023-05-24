<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConstatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('constats', function (Blueprint $table) {
            $table->id('id_constat');
            $table->date('date_c');
            $table->string('lieu_c');
            $table->string('matriculev');
            $table->string('assurancev');
            $table->string('vehicule_id');
            $table->timestamp('archived_at')->nullable();
            $table->foreign('vehicule_id')->references('matricule')->on('voitures');
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
        Schema::dropIfExists('constats');
    }
}
