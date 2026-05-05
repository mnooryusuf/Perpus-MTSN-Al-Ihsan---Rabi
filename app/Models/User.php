<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

use Filament\Models\Contracts\HasAvatar;
use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Illuminate\Support\Facades\Storage;

class User extends Authenticatable implements HasAvatar, FilamentUser
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    protected $table = 'user';

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
        'role',
        'avatar_url',
    ];

    public function getFilamentAvatarUrl(): ?string
    {
        return $this->avatar_url ? asset('storage/' . $this->avatar_url) : null;
    }

    public function canAccessPanel(Panel $panel): bool
    {
        if ($panel->getId() === 'admin') {
            return in_array($this->role, ['admin', 'pustakawan']);
        }

        if ($panel->getId() === 'app') {
            return in_array($this->role, ['siswa', 'guru', 'admin', 'pustakawan']);
        }

        return false;
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function anggota()
    {
        return $this->hasOne(Anggota::class, 'user_id');
    }

    public function transaksis()
    {
        return $this->hasMany(Transaksi::class, 'id_user');
    }
}
