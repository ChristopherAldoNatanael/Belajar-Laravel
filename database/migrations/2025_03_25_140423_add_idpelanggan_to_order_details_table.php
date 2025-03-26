<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIdpelangganToOrderDetailsTable extends Migration
{
    public function up()
    {
        Schema::table('order_details', function (Blueprint $table) {
            $table->bigInteger('idpelanggan')->unsigned()->nullable()->after('idorder');
            $table->foreign('idpelanggan')->references('idpelanggan')->on('pelanggans')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::table('order_details', function (Blueprint $table) {
            $table->dropForeign(['idpelanggan']);
            $table->dropColumn('idpelanggan');
        });
    }
}
