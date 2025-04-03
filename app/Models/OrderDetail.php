<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    protected $fillable = [
        'idorder',
        'idpelanggan',
        'idmenu',
        'pelanggan',
        'telp',
        'alamat',
        'quantity',
        'total',
        'status',
        'id_transaksi',
    ];

    // Add status validation rules
    public static $statusRules = [
        'status' => 'required|in:Pending,In Transit,Out for Delivery,Delivered,Cancelled'
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
