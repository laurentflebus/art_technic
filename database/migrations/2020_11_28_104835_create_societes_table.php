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
            $table->string('nom');
            $table->string('num_tva');
            $table->string('registre')->nullable();
            $table->string('num_compte')->nullable();
            $table->string('telephone')->nullable();
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
