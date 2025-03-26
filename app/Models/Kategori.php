<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;

    protected $table = 'kategoris';
    protected $primaryKey = 'idkategori';

    // Pastikan tipe primary key sesuai dengan increments (unsigned integer)
    protected $keyType = 'int';
    public $incrementing = true;

    protected $fillable = [
        'kategori',
    ];

    // Relasi dengan model Menu
    public function menus()
    {
        return $this->hasMany(Menu::class, 'idkategori', 'idkategori');
    }
}
