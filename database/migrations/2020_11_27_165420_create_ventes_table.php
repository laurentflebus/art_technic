<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVentesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ventes', function (Blueprint $table) {
            $table->bigIncrements('id');           
            $table->boolean('a_facturer');
            $table->boolean('est_paye');
            $table->boolean('a_un_bon_commande');
            $table->timestamps();
            $table->unsignedBigInteger('client_id');
            $table->unsignedBigInteger('modereglement_id');
            $table->unsignedBigInteger('facture_id');
            $table->foreign('client_id')->references('id')->on('clients');
            $table->foreign('modereglement_id')->references('id')->on('modereglements');
            $table->foreign('facture_id')->references('id')->on('factures');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ventes');
    }
}
