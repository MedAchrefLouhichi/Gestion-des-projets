<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use phpDocumentor\Reflection\Types\Nullable;

class CreateProjetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projets', function (Blueprint $table) {
            $table->id();
            $table->string('titre');
            $table->string('type');
            $table->text('descrtiption');
            $table->date('datedeb');
            $table->date('datefin');
            $table->boolean('avance')->default(false);
            $table->unsignedBigInteger('idcl');
            $table->unsignedBigInteger('idcomm');
            $table->foreign('idcomm')->references('id')->on('commercials')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('idcl')->references('id')->on('clients')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('projets');
    }
}
