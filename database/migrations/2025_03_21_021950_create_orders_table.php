<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->unsignedBigInteger('idorder')->autoIncrement(); // Ubah ke auto increment
            $table->unsignedBigInteger('idpelanggan');
            $table->date('tglorder');
            $table->decimal('total', 10, 2);
            $table->decimal('bayar', 10, 2);
            $table->decimal('kembali', 10, 2);
            $table->timestamps();

            $table->foreign('idpelanggan')->references('idpelanggan')->on('pelanggans')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
