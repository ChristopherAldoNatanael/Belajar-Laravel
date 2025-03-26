<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('order_details', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('idorderdetail');
            $table->unsignedBigInteger('idorder'); // Sesuai dengan orders
            $table->unsignedBigInteger('idmenu'); // Sesuai dengan menus
            $table->integer('jumlah');
            $table->decimal('hargajual', 10, 2);
            $table->timestamps();

            $table->foreign('idorder')->references('idorder')->on('orders')->onDelete('cascade');
            $table->foreign('idmenu')->references('idmenu')->on('menus')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('order_details');
    }
};
