<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssurancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assurances', function (Blueprint $table) {
            $table->id('id_assurance');
            $table->boolean('read')->default(false);
            $table->timestamp('archived_at')->nullable();
            $table->date('dateAssur');
            $table->string('contratAssur');
            $table->string('Matricule');
            $table->foreign('Matricule')->references('matricule')->on('voitures');
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
        Schema::dropIfExists('assurances');
    }
}
