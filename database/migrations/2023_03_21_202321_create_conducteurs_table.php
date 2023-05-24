<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConducteursTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('conducteurs', function (Blueprint $table) {
            $table->string('CINC')->unique();
            $table->primary('CINC');
            $table->string('nom');
            $table->string('prenom');
            $table->string('adresse');
            $table->date('date_naissance');
            $table->string('photo')->nullable();
            $table->string('telephone');
            $table->string('email')->unique();
            $table->timestamp('archived_at')->nullable();

            $table->string('password');
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
        Schema::dropIfExists('conducteurs');
    }
}
