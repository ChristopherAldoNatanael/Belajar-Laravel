<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    protected $table = 'menus';
    protected $primaryKey = 'idmenu'; // Menentukan primary key
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'idkategori', 'menu', 'gambar', 'harga', 'deskripsi'
    ];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'idkategori', 'idkategori');
    }

    public function carts()
    {
        return $this->hasMany(Cart::class, 'idmenu', 'idmenu');
    }
    
}

