<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->bigIncrements('id');           
            $table->string('civilite', 50);
            $table->string('nom', 50);
            $table->string('prenom', 50);
            $table->string('email', 50);
            $table->string('telephone', 50);
            $table->string('mobile', 50);
            $table->string('rue');
            $table->string('nrue');
            $table->string('pays');
            $table->timestamps();
            $table->unsignedBigInteger('assujetti_id');
            $table->unsignedBigInteger('localite_id');
            $table->foreign('assujetti_id')->references('id')->on('assujettis');
            $table->foreign('localite_id')->references('id')->on('localites');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clients');
    }
}
