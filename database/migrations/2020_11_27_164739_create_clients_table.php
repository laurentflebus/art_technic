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
            $table->string('civilite');
            $table->string('nom');
            $table->string('prenom');
            $table->string('email');
            $table->string('telephone');
            $table->string('mobile');
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
