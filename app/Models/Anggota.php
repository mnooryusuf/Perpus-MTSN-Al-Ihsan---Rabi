<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Anggota extends Model
{
    protected $table = 'anggota';
    protected $primaryKey = 'nis_nip';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'nis_nip',
        'user_id',
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
