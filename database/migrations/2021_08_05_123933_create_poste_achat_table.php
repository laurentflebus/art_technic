<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePosteAchatTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('poste_achat', function (Blueprint $table) {
            $table->unsignedBigInteger('achat_id');
            $table->unsignedBigInteger('poste_id');
            $table->integer('quantite');
            $table->float('prix_unitaire', 8, 2);
            $table->string('detail', 50);
            $table->timestamps();
            $table->foreign('poste_id')->references('id')->on('postes')->onDelete('cascade');
            $table->foreign('achat_id')->references('id')->on('achats')->onDelete('cascade');           
            $table->primary(['poste_id', 'achat_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('poste_achat');
    }
}
