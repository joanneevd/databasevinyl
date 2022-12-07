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
        Schema::create('vinyljos', function (Blueprint $table) {
            $table->bigInteger('id_vinyl')->primary();
            $table->string('title');
            $table->string('artist');
            $table->string('genre');
            $table->string('stats');
            $table->string('stok');
            $table->bigInteger('id_penjual');
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
        Schema::dropIfExists('vinyljos');
    }
};
