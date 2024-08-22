<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('hypothesis_id');
            $table->unsignedBigInteger('evidence_id');
            $table->float('value');
            $table->foreign('hypothesis_id')->references('id')->on('hypotheses')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('evidence_id')->references('id')->on('evidence')->onDelete('cascade')->onUpdate('cascade');
            $table->enum('condition', ['and', 'or'])->nullable();
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
        Schema::dropIfExists('roles');
    }
};
