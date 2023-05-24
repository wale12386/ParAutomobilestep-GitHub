<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccidentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accidents', function (Blueprint $table) {
            $table->id('id_Accident');
            $table->date('date_A');
            $table->string('Matricule');
            $table->unsignedBigInteger('id_constat')->nullable()->unique();
            $table->foreign('id_constat')->references('id_constat')->on('constats');
            $table->timestamp('archived_at')->nullable();
            $table->foreign('Matricule')->references('Matricule')->on('voitures');
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
        Schema::dropIfExists('accidents');
    }
}
