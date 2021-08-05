<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFournisseursTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fournisseurs', function (Blueprint $table) {
            $table->bigIncrements('id');           
            $table->string('civilite');
            $table->string('nom');
            $table->string('prenom');
            $table->string('email');
            $table->string('telephone');
            $table->string('mobile');
            $table->string('num_compte');
            $table->string('delai_paiement');
            $table->string('reference_personnel')->nullable();
            $table->string('remarque')->nullable();
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
        Schema::dropIfExists('fournisseurs');
    }
}
