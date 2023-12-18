<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('electrics', function (Blueprint $table) {
            $table->id();
            $table->string('nama_electric');
            $table->unsignedBigInteger('id_merek');
            $table->unsignedBigInteger('id_kategori');
            $table->text('watt')->default(0);
            $table->timestamps();

            // Definisi foreign keys
            $table->foreign('id_merek')->references('id')->on('mereks');
            $table->foreign('id_kategori')->references('id')->on('categories');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('electrics');
    }
};
