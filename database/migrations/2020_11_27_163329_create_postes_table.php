<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('postes', function (Blueprint $table) {
            $table->bigIncrements('id');           
            $table->string('numero', 50);
            $table->string('intitule', 50);
            $table->string('code_barre', 50);
            $table->integer('quantite')->nullable();
            $table->float('prix_unitaire', 8, 2);
            $table->timestamps();
            $table->unsignedBigInteger('tva_id');
            $table->foreign('tva_id')->references('id')->on('tvas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('postes');
    }
}
