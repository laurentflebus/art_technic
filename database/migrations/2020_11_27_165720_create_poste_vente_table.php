<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePosteVenteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('poste_vente', function (Blueprint $table) {
            $table->unsignedBigInteger('poste_id');
            $table->unsignedBigInteger('vente_id');
            $table->integer('quantite');
            $table->float('prix_unitaire', 8, 2);
            $table->string('detail', 50);
            $table->timestamps();
            $table->foreign('poste_id')->references('id')->on('postes')->onDelete('cascade');
            $table->foreign('vente_id')->references('id')->on('ventes')->onDelete('cascade');           
            $table->primary(['poste_id', 'vente_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('poste_vente');
    }
}
