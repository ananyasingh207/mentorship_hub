<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Mentorship Hub | Premium Mentorship Platform</title>

    {{-- Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap"
        rel="stylesheet">

    {{-- Vite --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            font-family: 'Inter', sans-serif;
            background: #F8FAFC;
        }

        .glass-effect {
            background: rgba(255, 255, 255, 0.75);
            backdrop-filter: blur(18px);
            -webkit-backdrop-filter: blur(18px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.2);
        }

        .hero-gradient {
            background:
                radial-gradient(circle at top left, rgba(13, 148, 136, 0.14), transparent 30%),
                radial-gradient(circle at bottom right, rgba(15, 23, 42, 0.08), transparent 30%);
        }

        .premium-border {
            border: 1px solid rgba(15, 23, 42, 0.08);
        }

        .premium-shadow {
            box-shadow:
                0 10px 30px rgba(15, 23, 42, 0.06),
                0 2px 10px rgba(13, 148, 136, 0.08);
        }

        .teal-glow {
            box-shadow:
                0 0 0 1px rgba(13, 148, 136, 0.08),
                0 12px 30px rgba(13, 148, 136, 0.18);
        }

        .gradient-text {
            background: linear-gradient(135deg, #0D9488 0%, #14B8A6 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .feature-card:hover {
            transform: translateY(-8px);
        }

        .hero-grid {
            background-image:
                linear-gradient(rgba(15, 23, 42, 0.03) 1px, transparent 1px),
                linear-gradient(90deg, rgba(15, 23, 42, 0.03) 1px, transparent 1px);
            background-size: 40px 40px;
        }
    </style>
</head>

<body class="antialiased text-slate-900 overflow-x-hidden">

    {{-- Navbar --}}
    <nav class="fixed top-0 w-full z-50 glass-effect">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="flex justify-between items-center h-20">

                {{-- Logo --}}
                <div class="flex items-center gap-3">
                    <img src="{{ asset('assets/images/logo.png') }}" alt="Mentorship Hub"
                        class="w-11 h-11 object-contain">

                    <div>
                        <h1 class="text-lg font-extrabold tracking-tight text-slate-900">
                            Mentorship Hub
                        </h1>

                        <p class="text-xs text-slate-500 font-medium">
                            Premium Mentorship Platform
                        </p>
                    </div>
                </div>

                {{-- Nav Actions --}}
                <div class="flex items-center gap-4">

                    @if (Route::has('login'))

                        @auth
                            @php
                                $dashboardRoute = match(auth()->user()->role) {
                                    'admin' => route('admin.dashboard'),
                                    'mentor' => route('mentor.dashboard'),
                                    default => route('startup.dashboard'),
                                };
                            @endphp
                            <a href="{{ $dashboardRoute }}"
                                class="text-sm font-semibold text-slate-600 hover:text-slate-900 transition">
                                Dashboard
                            </a>

                        @else

                            <a href="{{ route('login') }}"
                                class="text-sm font-semibold text-slate-600 hover:text-slate-900 transition">
                                Log in
                            </a>

                            @if (Route::has('register'))

                                <a href="{{ route('register') }}"
                                    class="px-5 py-2.5 bg-[#0D9488] text-white text-sm font-semibold rounded-2xl hover:bg-[#0F766E] teal-glow transition-all duration-300">
                                    Get Started
                                </a>

                            @endif

                        @endauth

                    @endif

                </div>

            </div>

        </div>
    </nav>

    {{-- Hero --}}
    <section class="relative pt-36 lg:pt-44 pb-28 overflow-hidden hero-gradient hero-grid">

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">

            <div class="text-center">

                {{-- Badge --}}
                <div
                    class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-white premium-border premium-shadow mb-8">

                    <span class="w-2 h-2 rounded-full bg-[#0D9488]"></span>

                    <span class="text-xs font-bold tracking-[0.2em] uppercase text-[#0D9488]">
                        Mentorship Reimagined
                    </span>

                </div>

                {{-- Heading --}}
                <h1
                    class="text-5xl sm:text-6xl lg:text-7xl font-black tracking-tight leading-tight max-w-5xl mx-auto mb-8">

                    Connect with mentors who

                    <span class="gradient-text">
                        accelerate growth.
                    </span>

                </h1>

                {{-- Description --}}
                <p class="text-lg sm:text-xl text-slate-600 max-w-3xl mx-auto leading-relaxed mb-12">

                    A modern mentorship platform designed for ambitious founders,
                    students, and professionals seeking meaningful guidance,
                    structured growth, and high-value connections.

                </p>

                {{-- CTA --}}
                <div class="flex flex-col sm:flex-row items-center justify-center gap-5">

                    <a href="{{ route('register') }}"
                        class="w-full sm:w-auto px-8 py-4 bg-[#0D9488] text-white text-lg font-semibold rounded-2xl hover:bg-[#0F766E] teal-glow transition-all duration-300 hover:-translate-y-1">

                        Start Your Journey

                    </a>

                    <a href="#features"
                        class="w-full sm:w-auto px-8 py-4 bg-white text-slate-700 text-lg font-semibold rounded-2xl premium-border premium-shadow hover:bg-slate-50 transition-all duration-300">

                        Explore Platform

                    </a>

                </div>

            </div>

        </div>

    </section>

    {{-- Features --}}
    <section id="features" class="py-24">

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- Heading --}}
            <div class="text-center mb-20">

                <span class="text-[#0D9488] text-sm font-bold tracking-[0.25em] uppercase">
                    Features
                </span>

                <h2 class="mt-4 text-4xl lg:text-5xl font-black tracking-tight text-slate-900">
                    Built for meaningful mentorship.
                </h2>

                <p class="mt-6 text-lg text-slate-600 max-w-2xl mx-auto">
                    Everything you need to discover mentors,
                    schedule sessions, and grow with confidence.
                </p>

            </div>

            {{-- Cards --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">

                {{-- Card 1 --}}
                <div
                    class="feature-card p-8 bg-white rounded-3xl premium-border premium-shadow transition-all duration-300">

                    <div
                        class="w-14 h-14 bg-[#0D9488]/10 rounded-2xl flex items-center justify-center text-[#0D9488] mb-6">

                        <svg class="w-7 h-7" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">

                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M17 20h5V4H2v16h5m10 0v-5a3 3 0 00-6 0v5m6 0H7" />

                        </svg>

                    </div>

                    <h3 class="text-2xl font-bold text-slate-900 mb-4">
                        Verified Mentors
                    </h3>

                    <p class="text-slate-600 leading-relaxed">
                        Connect with experienced professionals, founders,
                        and experts carefully selected to deliver
                        valuable mentorship experiences.
                    </p>

                </div>

                {{-- Card 2 --}}
                <div
                    class="feature-card p-8 bg-white rounded-3xl premium-border premium-shadow transition-all duration-300">

                    <div
                        class="w-14 h-14 bg-[#0D9488]/10 rounded-2xl flex items-center justify-center text-[#0D9488] mb-6">

                        <svg class="w-7 h-7" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">

                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 00-2 2z" />

                        </svg>

                    </div>

                    <h3 class="text-2xl font-bold text-slate-900 mb-4">
                        Smart Scheduling
                    </h3>

                    <p class="text-slate-600 leading-relaxed">
                        Effortlessly schedule mentorship sessions with
                        a seamless booking experience built for
                        modern professionals.
                    </p>

                </div>

                {{-- Card 3 --}}
                <div
                    class="feature-card p-8 bg-white rounded-3xl premium-border premium-shadow transition-all duration-300">

                    <div
                        class="w-14 h-14 bg-[#0D9488]/10 rounded-2xl flex items-center justify-center text-[#0D9488] mb-6">

                        <svg class="w-7 h-7" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">

                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M7 8h10M7 12h6m-8 8l-4-4m0 0l4-4m-4 4h18" />

                        </svg>

                    </div>

                    <h3 class="text-2xl font-bold text-slate-900 mb-4">
                        Meaningful Conversations
                    </h3>

                    <p class="text-slate-600 leading-relaxed">
                        Build strong mentor relationships through
                        direct communication, guided discussions,
                        and long-term collaboration.
                    </p>

                </div>

            </div>

        </div>

    </section>

    {{-- CTA Section --}}
    <section class="pb-28">

        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="relative overflow-hidden rounded-[2rem] bg-slate-950 px-8 py-16 lg:px-16 text-center">

                <div class="absolute inset-0 opacity-20">
                    <div class="absolute top-0 left-0 w-72 h-72 bg-[#0D9488] rounded-full blur-3xl"></div>
                    <div class="absolute bottom-0 right-0 w-72 h-72 bg-cyan-500 rounded-full blur-3xl"></div>
                </div>

                <div class="relative z-10">

                    <span
                        class="inline-flex px-4 py-2 rounded-full bg-white/10 text-[#5EEAD4] text-xs font-bold tracking-[0.25em] uppercase mb-6">
                        Premium Experience
                    </span>

                    <h2 class="text-4xl lg:text-5xl font-black text-white tracking-tight mb-6">
                        Ready to grow with guidance?
                    </h2>

                    <p class="text-slate-300 text-lg max-w-2xl mx-auto mb-10 leading-relaxed">
                        Join a platform designed to help ambitious people
                        connect, learn, and accelerate their journey
                        through mentorship.
                    </p>

                    <a href="{{ route('register') }}"
                        class="inline-flex items-center justify-center px-8 py-4 bg-[#0D9488] text-white text-lg font-semibold rounded-2xl hover:bg-[#0F766E] transition-all duration-300 hover:-translate-y-1 teal-glow">

                        Create Account

                    </a>

                </div>

            </div>

        </div>

    </section>

    {{-- Footer --}}
    <footer class="py-10 border-t border-slate-200 bg-white/80 backdrop-blur-xl">

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="flex flex-col md:flex-row items-center justify-between gap-6">

                {{-- Left --}}
                <div class="flex items-center gap-3">

                    <img src="{{ asset('assets/images/logo.png') }}" alt="Mentorship Hub"
                        class="w-9 h-9 object-contain">

                    <div>

                        <h3 class="font-bold text-slate-900">
                            Mentorship Hub
                        </h3>

                        <p class="text-sm text-slate-500">
                            Premium Mentorship Platform
                        </p>

                    </div>

                </div>

                {{-- Center --}}
                <p class="text-sm text-slate-500">
                    © {{ date('Y') }} Mentorship Hub. All rights reserved.
                </p>

                {{-- Links --}}
                <div class="flex items-center gap-6">

                    <a href="#" class="text-sm text-slate-500 hover:text-slate-900 transition">
                        Privacy
                    </a>

                    <a href="#" class="text-sm text-slate-500 hover:text-slate-900 transition">
                        Terms
                    </a>

                    <a href="#" class="text-sm text-slate-500 hover:text-slate-900 transition">
                        Contact
                    </a>

                </div>

            </div>

        </div>

    </footer>

</body>

</html>