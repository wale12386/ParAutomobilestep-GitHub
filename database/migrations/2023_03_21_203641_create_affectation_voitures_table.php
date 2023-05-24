<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAffectationVoituresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('affectation_voitures', function (Blueprint $table) {
           $table->date('date_affectation');
            $table->string('Matricule');
            $table->string('CINC');
            //$table->primary(['Matricule', 'CINC']);
            $table->foreign('Matricule')->references('matricule')->on('voitures')->onDelete('cascade');
            $table->timestamp('archived_at')->nullable();

            $table->foreign('CINC')->references('CINC')->on('conducteurs')->onDelete('cascade');
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
        Schema::dropIfExists('affectation_voitures');
    }
}
