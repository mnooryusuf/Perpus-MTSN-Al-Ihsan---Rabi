<x-filament-widgets::widget>
    <div class="welcome-banner">
        <div class="welcome-banner-bg"></div>
        <div class="welcome-banner-content">
            <div class="welcome-banner-left">
                <div class="welcome-badge">
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                    {{ $this->getCurrentTime() }} WITA
                </div>
                <h2 class="welcome-greeting">{{ $this->getGreeting() }}, <span>{{ $this->getUserName() }}!</span></h2>
                <p class="welcome-subtitle">{{ $this->getCurrentDate() }}</p>
                <p class="welcome-role">
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                    {{ ucfirst($this->getUserRole()) }}
                </p>
            </div>
            <div class="welcome-banner-right">
                <img src="{{ asset('images/library-illustration.png') }}" alt="Perpustakaan" class="welcome-illustration">
            </div>
        </div>

        {{-- Decorative elements --}}
        <div class="welcome-dot welcome-dot-1"></div>
        <div class="welcome-dot welcome-dot-2"></div>
        <div class="welcome-dot welcome-dot-3"></div>
    </div>

    <style>
        .welcome-banner {
            position: relative;
            border-radius: 16px;
            overflow: hidden;
            background: linear-gradient(135deg, #1a3a2a 0%, #0f2b1d 40%, #1a4a30 100%);
            min-height: 180px;
        }

        .welcome-banner-bg {
            position: absolute;
            inset: 0;
            background:
                radial-gradient(circle at 80% 20%, rgba(217, 169, 56, 0.15) 0%, transparent 50%),
                radial-gradient(circle at 20% 80%, rgba(217, 169, 56, 0.08) 0%, transparent 50%);
        }

        .welcome-banner-content {
            position: relative;
            z-index: 2;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 2rem 2.5rem;
            gap: 2rem;
        }

        .welcome-banner-left {
            flex: 1;
        }

        .welcome-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            padding: 0.3rem 0.75rem;
            background: rgba(217, 169, 56, 0.15);
            border: 1px solid rgba(217, 169, 56, 0.3);
            border-radius: 100px;
            color: #f0c75e;
            font-size: 0.7rem;
            font-weight: 600;
            letter-spacing: 0.05em;
            margin-bottom: 1rem;
        }

        .welcome-greeting {
            color: #fff;
            font-size: 1.6rem;
            font-weight: 800;
            letter-spacing: -0.03em;
            margin: 0 0 0.35rem;
            line-height: 1.2;
        }

        .welcome-greeting span {
            background: linear-gradient(135deg, #d9a938, #f0c75e);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .welcome-subtitle {
            color: rgba(255, 255, 255, 0.7);
            font-size: 0.9rem;
            margin: 0 0 0.5rem;
            font-weight: 400;
        }

        .welcome-role {
            display: inline-flex;
            align-items: center;
            gap: 0.35rem;
            color: rgba(255, 255, 255, 0.5);
            font-size: 0.8rem;
            font-weight: 500;
            margin: 0;
        }

        .welcome-banner-right {
            flex-shrink: 0;
        }

        .welcome-illustration {
            width: 140px;
            height: 140px;
            border-radius: 16px;
            object-fit: cover;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3), 0 0 0 1px rgba(217, 169, 56, 0.2);
            animation: bannerFloat 6s ease-in-out infinite;
        }

        @keyframes bannerFloat {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-6px); }
        }

        .welcome-dot {
            position: absolute;
            border-radius: 50%;
            z-index: 1;
        }

        .welcome-dot-1 {
            width: 6px;
            height: 6px;
            top: 20%;
            right: 35%;
            background: rgba(217, 169, 56, 0.3);
            animation: dotTwinkle 3s ease-in-out infinite;
        }

        .welcome-dot-2 {
            width: 4px;
            height: 4px;
            bottom: 25%;
            right: 40%;
            background: rgba(255, 255, 255, 0.2);
            animation: dotTwinkle 4s ease-in-out infinite 1s;
        }

        .welcome-dot-3 {
            width: 5px;
            height: 5px;
            top: 60%;
            left: 45%;
            background: rgba(217, 169, 56, 0.2);
            animation: dotTwinkle 5s ease-in-out infinite 0.5s;
        }

        @keyframes dotTwinkle {
            0%, 100% { opacity: 0.3; transform: scale(1); }
            50% { opacity: 1; transform: scale(1.5); }
        }

        @media (max-width: 768px) {
            .welcome-banner-content {
                flex-direction: column;
                text-align: center;
                padding: 1.5rem;
            }

            .welcome-banner-right {
                display: none;
            }

            .welcome-greeting {
                font-size: 1.3rem;
            }
        }
    </style>
</x-filament-widgets::widget>
