<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('carts', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id();
            $table->unsignedBigInteger('idpelanggan');
            $table->unsignedBigInteger('idmenu');
            $table->integer('quantity');
            $table->timestamps();

            $table->foreign('idpelanggan')->references('idpelanggan')->on('pelanggans')->onDelete('cascade');
            $table->foreign('idmenu')->references('idmenu')->on('menus')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('carts');
    }
};
