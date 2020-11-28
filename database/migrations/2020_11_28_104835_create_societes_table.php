<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSocietesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('societes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nom', 50);
            $table->string('num_tva', 50);
            $table->string('registre', 50)->nullable();
            $table->string('num_compte', 50)->nullable();
            $table->string('telephone', 50)->nullable();
            $table->string('rue')->nullable();
            $table->string('nrue')->nullable();
            $table->string('pays')->nullable();
            $table->text('remarque')->nullable();
            $table->timestamps();
            $table->unsignedBigInteger('localite_id');
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
        Schema::dropIfExists('societes');
    }
}
