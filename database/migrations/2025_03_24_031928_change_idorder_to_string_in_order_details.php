<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('order_details', function (Blueprint $table) {
            $table->string('idorder', 50)->change(); // Ubah ke VARCHAR(50)
        });
    }

    public function down()
    {
        Schema::table('order_details', function (Blueprint $table) {
            $table->integer('idorder')->change(); // Kembali ke integer jika rollback
        });
    }
};
