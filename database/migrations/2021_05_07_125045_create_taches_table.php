<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTachesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('taches', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description');
            $table->date('datedeb');
            $table->date('datefin');
            $table->boolean('statut')->default(false);
            $table->unsignedBigInteger('idpr');
            $table->unsignedBigInteger('idpers');
            $table->foreign('idpr')->references('id')->on('projets')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('idpers')->references('id')->on('personnels')->onUpdate('cascade')->OnDelete('cascade');
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
        Schema::dropIfExists('taches');
    }
}
