<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Anggota extends Model
{
    protected $table = 'anggota';
    protected $primaryKey = 'id_anggota';

    protected $fillable = [
        'user_id',
        'nis_nip',
        'kelas',
        'alamat',
        'no_hp',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function transaksis()
    {
        return $this->hasMany(Transaksi::class, 'id_anggota');
    }
}
