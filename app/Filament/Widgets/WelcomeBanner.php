<?php

namespace App\Filament\Widgets;

use App\Models\User;
use Filament\Facades\Filament;
use Filament\Widgets\Widget;

class WelcomeBanner extends Widget
{
    protected string $view = 'filament.widgets.welcome-banner';

    protected int | string | array $columnSpan = 'full';

    protected static ?int $sort = -3;

    public function getGreeting(): string
    {
        $hour = now()->format('H');

        if ($hour < 12) {
            return 'Selamat Pagi';
        } elseif ($hour < 15) {
            return 'Selamat Siang';
        } elseif ($hour < 18) {
            return 'Selamat Sore';
        }

        return 'Selamat Malam';
    }

    public function getUserName(): string
    {
        /** @var User|null $user */
        $user = Filament::auth()->user();

        return $user?->name ?? 'Pengguna';
    }

    public function getUserRole(): string
    {
        /** @var User|null $user */
        $user = Filament::auth()->user();

        return $user?->role ?? 'Pustakawan';
    }

    public function getCurrentDate(): string
    {
        return now()->translatedFormat('l, d F Y');
    }

    public function getCurrentTime(): string
    {
        return now()->format('H:i');
    }
}
