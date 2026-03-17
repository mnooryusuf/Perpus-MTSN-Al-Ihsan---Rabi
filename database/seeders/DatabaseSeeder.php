<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Create Pustakawan (Admin)
        User::updateOrCreate(
            ['username' => 'admin'],
            [
                'name' => 'Administrator Puspus',
                'email' => 'admin@perpus.com',
                'password' => \Illuminate\Support\Facades\Hash::make('password'),
                'role' => 'pustakawan',
            ]
        );

        // 2. Create Guru
        $guruUser = User::updateOrCreate(
            ['username' => 'guru1'],
            [
                'name' => 'Drs. H. Ahmad Fauzi',
                'email' => 'ahmad@guru.com',
                'password' => \Illuminate\Support\Facades\Hash::make('password'),
                'role' => 'guru',
            ]
        );

        \App\Models\Anggota::updateOrCreate(
            ['nis_nip' => '197501012000031001'],
            [
                'user_id' => $guruUser->id,
                'kelas' => null, // Guru tidak punya kelas tetap biasanya di data anggota
                'alamat' => 'Jl. Pendidikan No. 45',
                'no_hp' => '081234567890',
            ]
        );

        // 3. Create Siswa
        $siswaUser = User::updateOrCreate(
            ['username' => 'siswa1'],
            [
                'name' => 'Budi Setiawan',
                'email' => 'budi@siswa.com',
                'password' => \Illuminate\Support\Facades\Hash::make('password'),
                'role' => 'siswa',
            ]
        );

        \App\Models\Anggota::updateOrCreate(
            ['nis_nip' => '202610001'],
            [
                'user_id' => $siswaUser->id,
                'kelas' => 'IX-A',
                'alamat' => 'Bumi Mas Permai Block C',
                'no_hp' => '089876543210',
            ]
        );

        // 4. Create Sample Books
        \App\Models\Buku::updateOrCreate(
            ['judul' => 'Laskar Pelangi'],
            [
                'penulis' => 'Andrea Hirata',
                'penerbit' => 'Bentang Pustaka',
                'tahun_terbit' => 2005,
                'kategori' => 'Fiksi',
                'jumlah_eksemplar' => 5,
            ]
        );

        \App\Models\Buku::updateOrCreate(
            ['judul' => 'Matematika Kelas IX'],
            [
                'penulis' => 'Kemdikbud',
                'penerbit' => 'Pusat Perbukuan',
                'tahun_terbit' => 2022,
                'kategori' => 'Pelajaran',
                'jumlah_eksemplar' => 20,
            ]
        );
    }
}
