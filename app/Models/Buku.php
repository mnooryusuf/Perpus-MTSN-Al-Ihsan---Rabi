<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
    protected $table = 'buku';
    protected $primaryKey = 'id_buku';

    protected $fillable = [
        'judul',
        'penulis',
        'penerbit',
        'tahun_terbit',
        'kategori',
        'jumlah_eksemplar',
    ];

    public function transaksis()
    {
        return $this->hasMany(Transaksi::class, 'id_buku');
    }
}
