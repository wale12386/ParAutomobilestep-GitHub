<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVisitesTechniquesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('visites_techniques', function (Blueprint $table) {
            $table->id('idvisite')->unique();
            $table->timestamp('archived_at')->nullable();
            $table->string('datev');
            $table->string('resultatv');
            $table->string('description');
            $table->string('Matricule');
            $table->foreign('Matricule')->references('matricule')->on('voitures');
            $table->boolean('read')->default(false);

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
        Schema::dropIfExists('visites_techniques');
    }
}
