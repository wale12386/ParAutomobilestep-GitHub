<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVoituresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void ((((((((((((((((((((((,,                                                        =22222222222222222222222000000000000000000000000000000000000000000000000000000000000000000000"f"""""""""""""""""""""""""""""""FFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFzuuuuuuuuuuuuuuuuuuuuuuuu*
     * èy***************_________________________ppppppppppppppppppppppppppp))))7))))))))))))))))))))))
     */
    public function up()
    {
        Schema::create('voitures', function (Blueprint $table) {
            $table->string('matricule')->unique();
            $table->primary('matricule');
            $table->string('photo');
            $table->string('couleur');
            $table->string('GPS');
            $table->string('Date_1ere_cerculation');
            $table->unsignedBigInteger('id_marque');
            $table->foreign('id_marque')->references('idmarque')->on('marques');
            $table->unsignedBigInteger('id_modele');
            $table->foreign('id_modele')->references('idmodele')->on('modeles');
            $table->timestamp('archived_at')->nullable();
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
        Schema::dropIfExists('voitures');
    }
}
