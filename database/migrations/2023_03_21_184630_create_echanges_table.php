<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEchangesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('echanges', function (Blueprint $table) {
            $table->id('idechange');
            $table->date('dateEch');
            $table->string('kilometrage');
            $table->string('Niveaucarburant');
            $table->string('accidentelle');
            $table->string('conducteur1');
            $table->timestamp('archived_at')->nullable();

           
            $table->string('conducteur2');
            $table->string('Matricule');
            $table->foreign('Matricule')->references('Matricule')->on('voitures');
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
        Schema::dropIfExists('echanges');
    }
}
