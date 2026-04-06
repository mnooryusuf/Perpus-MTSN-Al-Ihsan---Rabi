<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    protected $table = 'transaksi';
    protected $primaryKey = 'id_transaksi';

    protected $fillable = [
        'id_anggota',
        'id_buku',
        'id_user',
        'tanggal_pinjam',
        'tanggal_kembali',
        'tanggal_dikembalikan',
        'status',
        'denda',
    ];

    /**
     * Hitung denda keterlambatan: Rp 1.000 per hari terlambat.
     * Dihitung dari tanggal_kembali sampai tanggal_dikembalikan (atau hari ini).
     */
    public function hitungDenda(): int
    {
        if (! $this->tanggal_kembali) {
            return 0;
        }

        $batasKembali = \Carbon\Carbon::parse($this->tanggal_kembali)->startOfDay();
        $dikembalikan  = $this->tanggal_dikembalikan
            ? \Carbon\Carbon::parse($this->tanggal_dikembalikan)->startOfDay()
            : now()->startOfDay();

        $hariTerlambat = $batasKembali->diffInDays($dikembalikan, false);

        return $hariTerlambat > 0 ? $hariTerlambat * 1000 : 0;
    }

    public function anggota()
    {
        return $this->belongsTo(Anggota::class, 'id_anggota');
    }

    public function buku()
    {
        return $this->belongsTo(Buku::class, 'id_buku');
    }

    public function pustakawan()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}
