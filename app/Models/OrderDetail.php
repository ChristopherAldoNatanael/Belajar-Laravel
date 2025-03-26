<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    protected $fillable = [
        'idorder',
        'idpelanggan', // Pastikan ini ada
        'idmenu',
        'pelanggan',
        'telp',
        'alamat',
        'quantity',
        'total',
        'status',
        'id_transaksi',
    ];

    public function menu()
    {
        return $this->belongsTo(Menu::class, 'idmenu', 'idmenu');
    }

    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class, 'idpelanggan', 'idpelanggan');
    }
}
