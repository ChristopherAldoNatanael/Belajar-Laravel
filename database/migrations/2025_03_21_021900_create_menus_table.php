<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('menus', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->unsignedBigInteger('idmenu')->autoIncrement();
            $table->unsignedInteger('idkategori'); // Sesuai dengan increments di kategoris
            $table->string('menu');
            $table->string('gambar');
            $table->decimal('harga', 10, 2);
            $table->text('deskripsi');
            $table->timestamps();

            $table->foreign('idkategori')->references('idkategori')->on('kategoris')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('menus');
    }
};
