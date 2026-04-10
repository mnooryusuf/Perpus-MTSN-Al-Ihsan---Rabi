@props([
    'livewire' => null,
])

@php
    $renderHookScopes = $livewire?->getRenderHookScopes();
@endphp

<!DOCTYPE html>
<html
    lang="{{ str_replace('_', '-', app()->getLocale()) }}"
    dir="{{ __('filament-panels::layout.direction') ?? 'ltr' }}"
    @class([
        'fi',
        'dark' => filament()->hasDarkMode() && filament()->hasDarkModeForced(),
    ])
>
    <head>
        {{ \Filament\Support\Facades\FilamentView::renderHook(\Filament\View\PanelsRenderHook::HEAD_START, scopes: $renderHookScopes) }}

        <meta charset="utf-8" />
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />

        @if ($favicon = filament()->getFavicon())
            <link rel="icon" href="{{ $favicon }}" />
        @endif

        @php
            $title = trim(strip_tags($livewire?->getTitle() ?? ''));
            $brandName = trim(strip_tags(filament()->getBrandName()));
        @endphp

        <title>
            {{ filled($title) ? $title : null }}
            {{ filled($brandName) && filled($title) ? ' - ' : null }}
            {{ filled($brandName) ? $brandName : null }}
        </title>

        {{ \Filament\Support\Facades\FilamentView::renderHook(\Filament\View\PanelsRenderHook::STYLES_BEFORE, scopes: $renderHookScopes) }}

        <style>
            [x-cloak=''],
            [x-cloak='x-cloak'],
            [x-cloak='1'] {
                display: none !important;
            }
            [x-cloak='inline-flex'] {
                display: inline-flex !important;
            }
            @media (max-width: 1023px) {
                [x-cloak='-lg'] {
                    display: none !important;
                }
            }
            @media (min-width: 1024px) {
                [x-cloak='lg'] {
                    display: none !important;
                }
            }
        </style>

        @filamentStyles

        {{ filament()->getTheme()->getHtml() }}
        {{ filament()->getFontPreloadHtml() }}
        {{ filament()->getMonoFontPreloadHtml() }}
        {{ filament()->getSerifFontPreloadHtml() }}
        {{ filament()->getFontHtml() }}
        {{ filament()->getMonoFontHtml() }}
        {{ filament()->getSerifFontHtml() }}

        <style>
            :root {
                --font-family: '{!! filament()->getFontFamily() !!}';
                --mono-font-family: '{!! filament()->getMonoFontFamily() !!}';
                --serif-font-family: '{!! filament()->getSerifFontFamily() !!}';
                --sidebar-width: {{ filament()->getSidebarWidth() }};
                --collapsed-sidebar-width: {{ filament()->getCollapsedSidebarWidth() }};
                --default-theme-mode: {{ filament()->getDefaultThemeMode()->value }};
            }
            html.fi {
                --livewire-progress-bar-color: var(--primary-500);
            }
        </style>

        {{-- Custom Login Split Screen Styles --}}
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

        <style>
            .login-split-container {
                display: flex;
                min-height: 100vh;
                min-height: 100dvh;
                font-family: 'Plus Jakarta Sans', var(--font-family), sans-serif;
            }

            /* ===== LEFT PANEL ===== */
            .login-left-panel {
                display: none;
                position: relative;
                width: 50%;
                background: linear-gradient(135deg, #1a3a2a 0%, #0f2b1d 40%, #1a4a30 100%);
                overflow: hidden;
            }

            @media (min-width: 1024px) {
                .login-left-panel {
                    display: flex;
                    flex-direction: column;
                    justify-content: center;
                    align-items: center;
                }
            }

            .login-left-panel::before {
                content: '';
                position: absolute;
                inset: 0;
                background:
                    radial-gradient(circle at 20% 80%, rgba(217, 169, 56, 0.15) 0%, transparent 50%),
                    radial-gradient(circle at 80% 20%, rgba(217, 169, 56, 0.1) 0%, transparent 50%);
                z-index: 1;
            }

            .login-left-panel::after {
                content: '';
                position: absolute;
                top: -50%;
                right: -20%;
                width: 80%;
                height: 200%;
                background: radial-gradient(ellipse, rgba(255,255,255,0.03) 0%, transparent 70%);
                z-index: 1;
            }

            .login-left-content {
                position: relative;
                z-index: 2;
                display: flex;
                flex-direction: column;
                align-items: center;
                padding: 3rem;
                text-align: center;
                max-width: 520px;
            }

            .login-illustration-wrapper {
                position: relative;
                width: 320px;
                height: 320px;
                margin-bottom: 2.5rem;
                border-radius: 24px;
                overflow: hidden;
                box-shadow:
                    0 25px 50px -12px rgba(0, 0, 0, 0.5),
                    0 0 0 1px rgba(217, 169, 56, 0.2);
                animation: floatAnimation 6s ease-in-out infinite;
            }

            @keyframes floatAnimation {
                0%, 100% { transform: translateY(0px); }
                50% { transform: translateY(-10px); }
            }

            .login-illustration-wrapper img {
                width: 100%;
                height: 100%;
                object-fit: cover;
            }

            .login-illustration-glow {
                position: absolute;
                inset: -2px;
                border-radius: 26px;
                background: linear-gradient(135deg, rgba(217, 169, 56, 0.4), transparent, rgba(217, 169, 56, 0.2));
                z-index: -1;
                filter: blur(8px);
            }

            .login-left-title {
                color: #fff;
                font-size: 1.75rem;
                font-weight: 800;
                letter-spacing: -0.03em;
                margin-bottom: 0.5rem;
                line-height: 1.2;
            }

            .login-left-title span {
                background: linear-gradient(135deg, #d9a938, #f0c75e);
                -webkit-background-clip: text;
                -webkit-text-fill-color: transparent;
                background-clip: text;
            }

            .login-left-subtitle {
                color: rgba(255, 255, 255, 0.7);
                font-size: 0.95rem;
                font-weight: 400;
                line-height: 1.6;
                max-width: 380px;
            }

            .login-left-features {
                display: flex;
                gap: 2rem;
                margin-top: 2.5rem;
                padding-top: 2rem;
                border-top: 1px solid rgba(255, 255, 255, 0.1);
            }

            .login-feature-item {
                display: flex;
                flex-direction: column;
                align-items: center;
                gap: 0.5rem;
            }

            .login-feature-icon {
                width: 40px;
                height: 40px;
                border-radius: 10px;
                background: rgba(217, 169, 56, 0.15);
                border: 1px solid rgba(217, 169, 56, 0.25);
                display: flex;
                align-items: center;
                justify-content: center;
                color: #d9a938;
                font-size: 1.1rem;
            }

            .login-feature-label {
                color: rgba(255, 255, 255, 0.6);
                font-size: 0.75rem;
                font-weight: 500;
            }

            /* Decorative elements */
            .login-decoration {
                position: absolute;
                border-radius: 50%;
                z-index: 0;
            }
            .login-decoration-1 {
                width: 300px;
                height: 300px;
                bottom: -100px;
                left: -100px;
                border: 1px solid rgba(217, 169, 56, 0.08);
            }
            .login-decoration-2 {
                width: 200px;
                height: 200px;
                top: 60px;
                right: -50px;
                border: 1px solid rgba(255, 255, 255, 0.05);
            }
            .login-decoration-3 {
                width: 8px;
                height: 8px;
                top: 20%;
                left: 15%;
                background: rgba(217, 169, 56, 0.3);
                animation: twinkle 3s ease-in-out infinite;
            }
            .login-decoration-4 {
                width: 6px;
                height: 6px;
                top: 70%;
                right: 20%;
                background: rgba(217, 169, 56, 0.2);
                animation: twinkle 4s ease-in-out infinite 1s;
            }
            .login-decoration-5 {
                width: 4px;
                height: 4px;
                top: 40%;
                left: 80%;
                background: rgba(255, 255, 255, 0.15);
                animation: twinkle 5s ease-in-out infinite 0.5s;
            }

            @keyframes twinkle {
                0%, 100% { opacity: 0.3; transform: scale(1); }
                50% { opacity: 1; transform: scale(1.5); }
            }

            /* ===== RIGHT PANEL ===== */
            .login-right-panel {
                width: 100%;
                display: flex;
                flex-direction: column;
                justify-content: center;
                align-items: center;
                padding: 2rem;
                background: linear-gradient(180deg, #fefdf8 0%, #faf4e8 100%);
                position: relative;
                overflow: hidden;
            }

            @media (min-width: 1024px) {
                .login-right-panel {
                    width: 50%;
                    padding: 3rem;
                }
            }

            .login-right-panel::before {
                content: '';
                position: absolute;
                top: 0;
                right: 0;
                width: 300px;
                height: 300px;
                background: radial-gradient(circle, rgba(217, 169, 56, 0.06) 0%, transparent 70%);
                z-index: 0;
            }

            .dark .login-right-panel {
                background: linear-gradient(180deg, #1a1a2e 0%, #16213e 100%);
            }

            .login-form-wrapper {
                width: 100%;
                max-width: 420px;
                position: relative;
                z-index: 1;
            }

            /* Mobile branding */
            .login-mobile-brand {
                display: flex;
                flex-direction: column;
                align-items: center;
                margin-bottom: 2rem;
            }

            @media (min-width: 1024px) {
                .login-mobile-brand {
                    display: none;
                }
            }

            .login-mobile-brand img {
                width: 64px;
                height: 64px;
                object-fit: contain;
                margin-bottom: 1rem;
            }

            .login-mobile-brand h2 {
                font-size: 1.25rem;
                font-weight: 700;
                color: #1a3a2a;
                margin: 0;
            }

            .dark .login-mobile-brand h2 {
                color: #fff;
            }

            .login-mobile-brand p {
                font-size: 0.8rem;
                color: #6b7280;
                margin: 0.25rem 0 0;
            }

            /* Welcome text */
            .login-welcome {
                margin-bottom: 2rem;
            }

            .login-welcome-badge {
                display: inline-flex;
                align-items: center;
                gap: 0.5rem;
                padding: 0.35rem 0.85rem;
                background: rgba(217, 169, 56, 0.1);
                border: 1px solid rgba(217, 169, 56, 0.2);
                border-radius: 100px;
                color: #b8860b;
                font-size: 0.75rem;
                font-weight: 600;
                margin-bottom: 1.25rem;
                letter-spacing: 0.02em;
            }

            .dark .login-welcome-badge {
                background: rgba(217, 169, 56, 0.15);
                color: #d9a938;
            }

            .login-welcome h1 {
                font-size: 1.75rem;
                font-weight: 800;
                color: #111827;
                letter-spacing: -0.03em;
                margin: 0 0 0.5rem;
                line-height: 1.2;
            }

            .dark .login-welcome h1 {
                color: #f9fafb;
            }

            .login-welcome p {
                color: #6b7280;
                font-size: 0.9rem;
                margin: 0;
                line-height: 1.5;
            }

            .dark .login-welcome p {
                color: #9ca3af;
            }

            /* Form card */
            .login-form-card {
                background: #fff;
                border-radius: 16px;
                padding: 2rem;
                box-shadow:
                    0 1px 3px rgba(0, 0, 0, 0.04),
                    0 6px 16px rgba(0, 0, 0, 0.04),
                    0 0 0 1px rgba(0, 0, 0, 0.03);
            }

            .dark .login-form-card {
                background: rgba(255, 255, 255, 0.05);
                box-shadow:
                    0 1px 3px rgba(0, 0, 0, 0.2),
                    0 0 0 1px rgba(255, 255, 255, 0.08);
            }

            /* Footer */
            .login-footer {
                margin-top: 2rem;
                text-align: center;
                color: #9ca3af;
                font-size: 0.75rem;
            }

            .login-footer a {
                color: #b8860b;
                text-decoration: none;
                font-weight: 500;
            }

            /* Override Filament simple page styles */
            .fi-simple-layout {
                background: transparent !important;
                min-height: auto !important;
            }

            .fi-simple-main-ctn {
                display: contents !important;
            }

            .fi-simple-main {
                padding: 0 !important;
                max-width: none !important;
                width: 100% !important;
            }

            .fi-simple-page {
                background: transparent !important;
                box-shadow: none !important;
                border: none !important;
                padding: 0 !important;
                max-width: none !important;
            }

            .fi-simple-page-content {
                padding: 0 !important;
            }

            /* Hide the default Filament header on login page */
            .fi-simple-header {
                display: none !important;
            }
        </style>

        @stack('styles')

        {{ \Filament\Support\Facades\FilamentView::renderHook(\Filament\View\PanelsRenderHook::STYLES_AFTER, scopes: $renderHookScopes) }}

        @if (! filament()->hasDarkMode())
            <script>
                localStorage.setItem('theme', 'light')
            </script>
        @elseif (filament()->hasDarkModeForced())
            <script>
                localStorage.setItem('theme', 'dark')
            </script>
        @else
            <script>
                const loadDarkMode = () => {
                    window.theme = localStorage.getItem('theme') ?? @js(filament()->getDefaultThemeMode()->value)

                    if (
                        window.theme === 'dark' ||
                        (window.theme === 'system' &&
                            window.matchMedia('(prefers-color-scheme: dark)')
                                .matches)
                    ) {
                        document.documentElement.classList.add('dark')
                    }
                }

                loadDarkMode()

                document.addEventListener('livewire:navigated', loadDarkMode)
            </script>
        @endif

        {{ \Filament\Support\Facades\FilamentView::renderHook(\Filament\View\PanelsRenderHook::HEAD_END, scopes: $renderHookScopes) }}
    </head>

    <body
        {{
            $attributes
                ->merge($livewire?->getExtraBodyAttributes() ?? [], escape: false)
                ->class([
                    'fi-body',
                    'fi-panel-' . filament()->getId(),
                ])
        }}
    >
        {{ \Filament\Support\Facades\FilamentView::renderHook(\Filament\View\PanelsRenderHook::BODY_START, scopes: $renderHookScopes) }}

        <div class="login-split-container">
            {{-- LEFT PANEL --}}
            <div class="login-left-panel">
                {{-- Decorative elements --}}
                <div class="login-decoration login-decoration-1"></div>
                <div class="login-decoration login-decoration-2"></div>
                <div class="login-decoration login-decoration-3"></div>
                <div class="login-decoration login-decoration-4"></div>
                <div class="login-decoration login-decoration-5"></div>

                <div class="login-left-content">
                    <div class="login-illustration-wrapper">
                        <div class="login-illustration-glow"></div>
                        <img src="{{ asset('images/library-illustration.png') }}" alt="Perpustakaan MTs Al-Ihsan">
                    </div>

                    <h1 class="login-left-title">
                        Perpustakaan <span>Digital</span>
                    </h1>
                    <p class="login-left-subtitle">
                        Sistem Informasi Perpustakaan MTs Al-Ihsan Gambah Dalam Kandangan — Kelola koleksi buku, sirkulasi peminjaman, dan laporan dengan mudah.
                    </p>

                    <div class="login-left-features">
                        <div class="login-feature-item">
                            <div class="login-feature-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 19.5v-15A2.5 2.5 0 0 1 6.5 2H19a1 1 0 0 1 1 1v18a1 1 0 0 1-1 1H6.5a1 1 0 0 1 0-5H20"/></svg>
                            </div>
                            <span class="login-feature-label">Katalog Buku</span>
                        </div>
                        <div class="login-feature-item">
                            <div class="login-feature-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                            </div>
                            <span class="login-feature-label">Data Anggota</span>
                        </div>
                        <div class="login-feature-item">
                            <div class="login-feature-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14.5 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7.5L14.5 2z"/><polyline points="14 2 14 8 20 8"/><line x1="16" x2="8" y1="13" y2="13"/><line x1="16" x2="8" y1="17" y2="17"/><line x1="10" x2="8" y1="9" y2="9"/></svg>
                            </div>
                            <span class="login-feature-label">Laporan</span>
                        </div>
                    </div>
                </div>
            </div>

            {{-- RIGHT PANEL --}}
            <div class="login-right-panel">
                <div class="login-form-wrapper">
                    {{-- Mobile brand --}}
                    <div class="login-mobile-brand">
                        <img src="{{ asset('images/logo.png') }}" alt="Logo MTs Al-Ihsan">
                        <h2>Aplikasi Perpustakaan</h2>
                        <p>MTs Al-Ihsan Gambah Dalam Kandangan</p>
                    </div>

                    {{-- Welcome text --}}
                    <div class="login-welcome">
                        <div class="login-welcome-badge">
                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4"/><polyline points="10 17 15 12 10 7"/><line x1="15" x2="3" y1="12" y2="12"/></svg>
                            Sistem Perpustakaan
                        </div>
                        <h1>Selamat Datang!</h1>
                        <p>Silakan masuk dengan akun Anda untuk mengelola perpustakaan.</p>
                    </div>

                    {{-- Form card --}}
                    <div class="login-form-card">
                        {{ $slot }}
                    </div>

                    {{-- Footer --}}
                    <div class="login-footer">
                        <p>&copy; {{ date('Y') }} Perpustakaan MTs Al-Ihsan Gambah Dalam Kandangan</p>
                    </div>
                </div>
            </div>
        </div>

        @livewire(Filament\Livewire\Notifications::class)

        {{ \Filament\Support\Facades\FilamentView::renderHook(\Filament\View\PanelsRenderHook::SCRIPTS_BEFORE, scopes: $renderHookScopes) }}

        @filamentScripts(withCore: true)

        @if (filament()->hasBroadcasting() && config('filament.broadcasting.echo'))
            <script data-navigate-once>
                window.Echo = new window.EchoFactory(@js(config('filament.broadcasting.echo')))
                window.dispatchEvent(new CustomEvent('EchoLoaded'))
            </script>
        @endif

        @if (filament()->hasDarkMode() && (! filament()->hasDarkModeForced()))
            <script>
                loadDarkMode()
            </script>
        @endif

        @stack('scripts')

        {{ \Filament\Support\Facades\FilamentView::renderHook(\Filament\View\PanelsRenderHook::SCRIPTS_AFTER, scopes: $renderHookScopes) }}

        {{ \Filament\Support\Facades\FilamentView::renderHook(\Filament\View\PanelsRenderHook::BODY_END, scopes: $renderHookScopes) }}
    </body>
</html>
