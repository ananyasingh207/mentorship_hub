<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Mentorship Hub | Premium Mentorship Platform</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Bricolage+Grotesque:opsz,wght@12..96,300;12..96,400;12..96,500;12..96,700;12..96,800&family=DM+Sans:ital,opsz,wght@0,9..40,300;0,9..40,400;0,9..40,500;1,9..40,300&display=swap"
        rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        :root {
            --teal: #0D9488;
            --teal-light: #14B8A6;
            --teal-dark: #0F766E;
            --slate-950: #0F172A;
            --slate-900: #1E293B;
        }

        *,
        *::before,
        *::after {
            box-sizing: border-box;
        }

        body {
            font-family: 'DM Sans', sans-serif;
            background: #F8FAFC;
            overflow-x: hidden;
        }

        h1,
        h2,
        h3,
        h4,
        .display {
            font-family: 'Bricolage Grotesque', sans-serif;
        }


        /* ── Nav ── */
        nav {
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 50;
            background: rgba(248, 250, 252, 0.85);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border-bottom: 1px solid rgba(15, 23, 42, 0.07);
        }



        /* ── Hero ── */
        .hero {
            min-height: 100vh;
            display: grid;
            grid-template-columns: 1fr 1fr;
            padding-top: 80px;
            position: relative;
            overflow: hidden;
        }

        @media (max-width: 1024px) {
            .hero {
                grid-template-columns: 1fr;
            }

            .hero-right {
                display: none;
            }
        }

        .hero-left {
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding: 80px 60px 80px 80px;
            position: relative;
            z-index: 2;
        }

        @media (max-width: 640px) {
            .hero-left {
                padding: 60px 24px;
            }
        }

        .hero-right {
            position: relative;
            overflow: hidden;
            background: var(--slate-950);
        }

        .hero-right-inner {
            position: absolute;
            inset: 0;
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding: 60px 50px;
            gap: 18px;
        }

        /* ── Big Eyebrow ── */
        .eyebrow {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            font-size: 0.7rem;
            font-weight: 700;
            letter-spacing: 0.22em;
            text-transform: uppercase;
            color: var(--teal);
            margin-bottom: 24px;
        }

        .eyebrow-line {
            width: 32px;
            height: 2px;
            background: var(--teal);
            border-radius: 2px;
        }

        /* ── Display Heading ── */
        .hero-heading {
            font-size: clamp(2.8rem, 5vw, 4.5rem);
            font-weight: 800;
            line-height: 1.05;
            letter-spacing: -0.03em;
            color: var(--slate-950);
            margin: 0 0 28px;
        }

        .hero-heading em {
            font-style: italic;
            font-weight: 300;
            color: var(--teal);
        }

        .hero-heading strong {
            display: block;
            position: relative;
            width: fit-content;
        }

        .hero-heading strong::after {
            content: '';
            position: absolute;
            bottom: 4px;
            left: 0;
            right: 0;
            height: 6px;
            background: var(--teal-light);
            opacity: 0.25;
            border-radius: 2px;
        }

        .hero-sub {
            font-size: 1.1rem;
            line-height: 1.75;
            color: #475569;
            max-width: 480px;
            margin-bottom: 40px;
        }

        .btn-primary {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            padding: 15px 30px;
            background: var(--teal);
            color: white;
            font-family: 'Bricolage Grotesque', sans-serif;
            font-size: 0.95rem;
            font-weight: 700;
            border-radius: 4px;
            text-decoration: none;
            transition: all 0.25s ease;
            position: relative;
            overflow: hidden;
        }

        .btn-primary::before {
            content: '';
            position: absolute;
            inset: 0;
            background: rgba(255, 255, 255, 0.12);
            transform: translateX(-100%);
            transition: transform 0.35s ease;
        }

        .btn-primary:hover::before {
            transform: translateX(0);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 30px rgba(13, 148, 136, 0.35);
        }

        .btn-primary svg {
            transition: transform 0.25s ease;
        }

        .btn-primary:hover svg {
            transform: translateX(4px);
        }

        .btn-ghost {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 15px 26px;
            color: var(--slate-900);
            font-size: 0.95rem;
            font-weight: 500;
            border-radius: 4px;
            border: 1.5px solid rgba(15, 23, 42, 0.12);
            text-decoration: none;
            transition: all 0.25s ease;
            background: white;
        }

        .btn-ghost:hover {
            border-color: var(--teal);
            color: var(--teal);
            transform: translateY(-2px);
        }

        /* ── Hero Right Cards ── */
        .mentor-card {
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 12px;
            padding: 18px 20px;
            display: flex;
            align-items: center;
            gap: 16px;
            transform: translateX(60px);
            opacity: 0;
            transition: all 0.6s cubic-bezier(0.34, 1.56, 0.64, 1);
        }

        .mentor-card.visible {
            transform: translateX(0);
            opacity: 1;
        }

        .mentor-card:hover {
            background: rgba(13, 148, 136, 0.1);
            border-color: rgba(13, 148, 136, 0.3);
            cursor: pointer;
        }

        .mentor-avatar {
            width: 48px;
            height: 48px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Bricolage Grotesque', sans-serif;
            font-weight: 700;
            font-size: 1rem;
            flex-shrink: 0;
            color: white;
        }

        .mentor-tag {
            display: inline-block;
            font-size: 0.65rem;
            font-weight: 600;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            padding: 3px 8px;
            border-radius: 3px;
            background: rgba(13, 148, 136, 0.2);
            color: var(--teal-light);
            margin-top: 4px;
        }

        .online-dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: #22C55E;
            margin-left: auto;
            flex-shrink: 0;
            box-shadow: 0 0 0 3px rgba(34, 197, 94, 0.2);
            animation: pulse-green 2s ease-in-out infinite;
        }

        @keyframes pulse-green {

            0%,
            100% {
                box-shadow: 0 0 0 3px rgba(34, 197, 94, 0.2);
            }

            50% {
                box-shadow: 0 0 0 6px rgba(34, 197, 94, 0.1);
            }
        }

        /* Noise overlay on hero right */
        .hero-right::before {
            content: '';
            position: absolute;
            inset: 0;
            background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 256 256' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='noise'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23noise)' opacity='0.04'/%3E%3C/svg%3E");
            pointer-events: none;
            z-index: 1;
            opacity: 0.4;
        }

        .hero-right-inner {
            z-index: 2;
        }

        /* Teal accent line on hero right */
        .hero-right::after {
            content: '';
            position: absolute;
            left: 0;
            top: 20%;
            bottom: 20%;
            width: 3px;
            background: linear-gradient(to bottom, transparent, var(--teal), transparent);
        }

        /* ── Stats Bar ── */
        .stats-bar {
            background: white;
            border-top: 1px solid rgba(15, 23, 42, 0.07);
            border-bottom: 1px solid rgba(15, 23, 42, 0.07);
        }

        .stat-number {
            font-family: 'Bricolage Grotesque', sans-serif;
            font-size: 2.5rem;
            font-weight: 800;
            color: var(--slate-950);
            letter-spacing: -0.03em;
            line-height: 1;
        }

        .stat-number span {
            color: var(--teal);
        }

        /* ── Section Labels ── */
        .section-label {
            writing-mode: vertical-rl;
            text-orientation: mixed;
            font-size: 0.65rem;
            font-weight: 700;
            letter-spacing: 0.25em;
            text-transform: uppercase;
            color: #94A3B8;
            transform: rotate(180deg);
        }

        /* ── Feature Section ── */
        .features-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 0;
        }

        @media (max-width: 768px) {
            .features-grid {
                grid-template-columns: 1fr;
            }
        }

        .feature-item {
            padding: 56px;
            border: 1px solid rgba(15, 23, 42, 0.07);
            position: relative;
            overflow: hidden;
            transition: background 0.3s ease;
        }

        @media (max-width: 640px) {
            .feature-item {
                padding: 36px 24px;
            }
        }

        .feature-item::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, rgba(13, 148, 136, 0.04) 0%, transparent 60%);
            opacity: 0;
            transition: opacity 0.4s ease;
        }

        .feature-item:hover::before {
            opacity: 1;
        }

        .feature-item:hover {
            background: rgba(13, 148, 136, 0.02);
        }

        .feature-num {
            font-family: 'Bricolage Grotesque', sans-serif;
            font-size: 4rem;
            font-weight: 800;
            color: rgba(13, 148, 136, 0.1);
            line-height: 1;
            margin-bottom: 24px;
            letter-spacing: -0.04em;
            transition: color 0.3s ease;
        }

        .feature-item:hover .feature-num {
            color: rgba(13, 148, 136, 0.2);
        }

        .feature-icon-wrap {
            width: 52px;
            height: 52px;
            border-radius: 10px;
            background: rgba(13, 148, 136, 0.1);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--teal);
            margin-bottom: 20px;
        }

        /* ── Testimonial ── */
        .testimonial-section {
            background: var(--slate-950);
            position: relative;
            overflow: hidden;
        }

        .testimonial-section::before {
            content: '';
            position: absolute;
            width: 600px;
            height: 600px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(13, 148, 136, 0.15) 0%, transparent 70%);
            top: -200px;
            right: -200px;
        }

        .quote-mark {
            font-family: 'Bricolage Grotesque', sans-serif;
            font-size: 8rem;
            line-height: 0.6;
            color: rgba(13, 148, 136, 0.2);
            font-weight: 800;
            margin-bottom: 8px;
        }

        .testimonial-text {
            font-family: 'Bricolage Grotesque', sans-serif;
            font-size: clamp(1.4rem, 2.5vw, 2rem);
            font-weight: 400;
            font-style: italic;
            color: rgba(255, 255, 255, 0.9);
            line-height: 1.5;
        }

        /* ── How it Works ── */
        .step-line {
            position: absolute;
            top: 28px;
            left: calc(50% + 28px);
            right: calc(-50% + 28px);
            height: 1px;
            background: linear-gradient(to right, rgba(13, 148, 136, 0.4), rgba(13, 148, 136, 0.1));
        }

        .step-num {
            width: 56px;
            height: 56px;
            border-radius: 50%;
            border: 1.5px solid rgba(13, 148, 136, 0.3);
            background: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Bricolage Grotesque', sans-serif;
            font-size: 1.1rem;
            font-weight: 700;
            color: var(--teal);
            position: relative;
            z-index: 1;
            transition: all 0.3s ease;
            margin-bottom: 24px;
        }

        .step-item:hover .step-num {
            background: var(--teal);
            color: white;
            border-color: var(--teal);
            transform: scale(1.1);
        }

        /* ── CTA Section ── */
        .cta-section {
            background: var(--slate-950);
            position: relative;
            overflow: hidden;
        }

        .cta-grid-overlay {
            position: absolute;
            inset: 0;
            background-image:
                linear-gradient(rgba(13, 148, 136, 0.06) 1px, transparent 1px),
                linear-gradient(90deg, rgba(13, 148, 136, 0.06) 1px, transparent 1px);
            background-size: 60px 60px;
        }

        .cta-blob {
            position: absolute;
            border-radius: 50%;
            filter: blur(80px);
        }

        /* ── Footer ── */
        footer {
            background: white;
            border-top: 1px solid rgba(15, 23, 42, 0.07);
        }

        /* ── Reveal ── */
        .reveal {
            opacity: 0;
            transform: translateY(30px);
            transition: opacity 0.7s ease, transform 0.7s ease;
        }

        .reveal-left {
            opacity: 0;
            transform: translateX(-30px);
            transition: opacity 0.7s ease, transform 0.7s ease;
        }

        .reveal-right {
            opacity: 0;
            transform: translateX(30px);
            transition: opacity 0.7s ease, transform 0.7s ease;
        }

        .reveal.active,
        .reveal-left.active,
        .reveal-right.active {
            opacity: 1;
            transform: translate(0);
        }

        .delay-1 {
            transition-delay: 0.1s;
        }

        .delay-2 {
            transition-delay: 0.2s;
        }

        .delay-3 {
            transition-delay: 0.3s;
        }

        .delay-4 {
            transition-delay: 0.4s;
        }

        /* ── Misc ── */
        .teal-chip {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 5px 12px;
            background: rgba(13, 148, 136, 0.1);
            color: var(--teal-dark);
            border-radius: 3px;
            font-size: 0.72rem;
            font-weight: 700;
            letter-spacing: 0.12em;
            text-transform: uppercase;
        }

        .teal-chip::before {
            content: '';
            width: 6px;
            height: 6px;
            background: var(--teal);
            border-radius: 50%;
        }

        /* Marquee logos area */
        .marquee-wrap {
            overflow: hidden;
        }

        .marquee-track {
            display: flex;
            width: max-content;
            animation: ticker 30s linear infinite;
            gap: 60px;
            align-items: center;
        }

        @keyframes ticker {
            0% { transform: translateX(0); }
            100% { transform: translateX(calc(-50% - 30px)); }
        }

        .trust-logo {
            font-family: 'Bricolage Grotesque', sans-serif;
            font-weight: 700;
            font-size: 1rem;
            color: #94A3B8;
            letter-spacing: -0.02em;
            white-space: nowrap;
        }

        /* animated underline on hover links */
        .hover-underline {
            position: relative;
            text-decoration: none;
        }

        .hover-underline::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 0;
            width: 0;
            height: 1.5px;
            background: var(--teal);
            transition: width 0.3s ease;
        }

        .hover-underline:hover::after {
            width: 100%;
        }

        /* Progress bar animation */
        .progress-bar {
            height: 3px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 2px;
            overflow: hidden;
        }

        .progress-fill {
            height: 100%;
            border-radius: 2px;
            background: linear-gradient(to right, var(--teal), var(--teal-light));
            width: 0;
            transition: width 1.5s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .card-glow-bg {
            position: absolute;
            width: 400px;
            height: 400px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(13, 148, 136, 0.18) 0%, transparent 65%);
            top: -120px;
            right: -100px;
            pointer-events: none;
        }

        .card-glow-bg-2 {
            position: absolute;
            width: 260px;
            height: 260px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(13, 148, 136, 0.09) 0%, transparent 70%);
            bottom: -80px;
            left: -40px;
            pointer-events: none;
        }

        .featured-mentor-card {
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 18px;
            padding: 28px 24px 24px;
            position: relative;
            overflow: hidden;
            transition: transform 0.45s cubic-bezier(0.23, 1, 0.32, 1),
                border-color 0.4s ease,
                box-shadow 0.4s ease;
            cursor: pointer;
        }

        .featured-mentor-card.card-hovered {
            transform: translateY(-8px) scale(1.015);
            border-color: rgba(13, 148, 136, 0.55);
            box-shadow:
                0 0 0 1px rgba(13, 148, 136, 0.2),
                0 32px 64px rgba(0, 0, 0, 0.5),
                0 0 60px rgba(13, 148, 136, 0.15);
        }

        .fmc-inner-glow {
            position: absolute;
            inset: 0;
            background: radial-gradient(ellipse at 50% 0%, rgba(13, 148, 136, 0.12) 0%, transparent 60%);
            opacity: 0;
            transition: opacity 0.4s ease;
            pointer-events: none;
            border-radius: 18px;
        }

        .featured-mentor-card.card-hovered .fmc-inner-glow {
            opacity: 1;
        }

        .fmc-top {
            display: flex;
            align-items: center;
            gap: 14px;
            margin-bottom: 18px;
        }

        .fmc-avatar {
            width: 54px;
            height: 54px;
            border-radius: 50%;
            background: linear-gradient(135deg, #0D9488, #14B8A6);
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Bricolage Grotesque', sans-serif;
            font-weight: 800;
            font-size: 17px;
            color: white;
            flex-shrink: 0;
            box-shadow: 0 0 0 3px rgba(13, 148, 136, 0.3);
            position: relative;
        }

        .fmc-online {
            position: absolute;
            bottom: 1px;
            right: 1px;
            width: 11px;
            height: 11px;
            border-radius: 50%;
            background: #22C55E;
            border: 2px solid #1E293B;
        }

        .fmc-name {
            font-family: 'Bricolage Grotesque', sans-serif;
            font-size: 17px;
            font-weight: 700;
            color: white;
            margin: 0 0 5px;
            letter-spacing: -0.01em;
        }

        .fmc-meta {
            display: flex;
            align-items: center;
            flex-wrap: wrap;
            gap: 6px;
        }

        .fmc-stars {
            display: flex;
            gap: 2px;
        }

        .fmc-star {
            color: #FBBF24;
            font-size: 12px;
        }

        .fmc-rating {
            font-size: 12px;
            font-weight: 600;
            color: rgba(255, 255, 255, 0.7);
        }

        .fmc-sep {
            color: rgba(255, 255, 255, 0.2);
            font-size: 10px;
        }

        .fmc-match {
            font-size: 11px;
            font-weight: 700;
            color: #5EEAD4;
            background: rgba(13, 148, 136, 0.2);
            padding: 2px 8px;
            border-radius: 4px;
            letter-spacing: 0.04em;
        }

        .fmc-divider {
            height: 1px;
            background: rgba(255, 255, 255, 0.07);
            margin: 0 0 16px;
        }

        .fmc-bio {
            font-size: 13px;
            line-height: 1.65;
            color: rgba(255, 255, 255, 0.55);
            margin: 0 0 18px;
            font-style: italic;
        }

        .fmc-tags {
            display: flex;
            gap: 8px;
            margin-bottom: 20px;
        }

        .fmc-tag {
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            padding: 4px 10px;
            border-radius: 4px;
            background: rgba(13, 148, 136, 0.18);
            color: #5EEAD4;
            border: 1px solid rgba(13, 148, 136, 0.25);
        }

        .fmc-btn {
            width: 100%;
            padding: 13px 0;
            background: #0D9488;
            color: white;
            font-family: 'Bricolage Grotesque', sans-serif;
            font-size: 14px;
            font-weight: 700;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            opacity: 0;
            transform: translateY(8px);
            transition: opacity 0.35s ease, transform 0.35s ease, background 0.2s ease, box-shadow 0.2s ease;
            letter-spacing: 0.01em;
        }

        .featured-mentor-card.card-hovered .fmc-btn {
            opacity: 1;
            transform: translateY(0);
        }

        .fmc-btn.btn-clicked {
            background: #065F46;
            box-shadow: 0 0 0 4px rgba(13, 148, 136, 0.35);
        }

        /* Animated cursor */
        .hero-cursor {
            position: absolute;
            width: 28px;
            height: 28px;
            pointer-events: none;
            z-index: 20;
            opacity: 0;
            transition: opacity 0.3s;
            filter: drop-shadow(0 2px 6px rgba(0, 0, 0, 0.6));
        }

        .hero-cursor.cur-visible {
            opacity: 1;
        }

        /* Ripple on click */
        .hero-ripple {
            position: absolute;
            border-radius: 50%;
            background: rgba(13, 148, 136, 0.35);
            transform: scale(0);
            animation: heroRipple 0.6s ease-out forwards;
            pointer-events: none;
        }

        @keyframes heroRipple {
            to {
                transform: scale(4);
                opacity: 0;
            }
        }

        /* Toast */
        .hero-toast {
            position: absolute;
            bottom: 20px;
            left: 50%;
            transform: translateX(-50%) translateY(20px);
            background: rgba(13, 148, 136, 0.96);
            color: white;
            font-family: 'DM Sans', sans-serif;
            font-size: 13px;
            font-weight: 600;
            padding: 10px 20px;
            border-radius: 8px;
            white-space: nowrap;
            opacity: 0;
            transition: opacity 0.3s ease, transform 0.3s ease;
            z-index: 30;
            pointer-events: none;
        }

        .hero-toast.toast-show {
            opacity: 1;
            transform: translateX(-50%) translateY(0);
        }
    </style>
</head>

<body class="antialiased text-slate-900 overflow-x-hidden">




    {{-- Navbar --}}
    <nav>
        <div class="px-4 sm:px-6 lg:px-[80px]">
            <div class="flex justify-between items-center h-24">
                <div class="flex items-center gap-4">
                    <img src="{{ asset('assets/images/logo.png') }}" alt="Mentorship Hub"
                        class="w-14 h-14 object-contain">
                    <div>
                        <h1 class="text-xl font-extrabold tracking-tight text-slate-900"
                            style="font-family:'Bricolage Grotesque',sans-serif">Mentorship Hub</h1>
                    </div>
                </div>
                <div class="flex items-center gap-5">
                    @if (Route::has('login'))
                        @auth
                            @php
                                $dashboardRoute = match (auth()->user()->role) {
                                    'admin' => route('admin.dashboard'),
                                    'mentor' => route('mentor.dashboard'),
                                    default => route('startup.dashboard'),
                                };
                            @endphp
                            <a href="{{ $dashboardRoute }}"
                                class="text-sm font-semibold text-slate-600 hover:text-[#0D9488] transition hover-underline">Dashboard</a>
                        @else
                            <a href="{{ route('login') }}"
                                class="text-sm font-semibold text-slate-500 hover:text-slate-900 transition hover-underline">Log
                                in</a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="btn-primary text-sm">
                                    Get Started
                                    <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2.5"
                                        viewBox="0 0 24 24">
                                        <path d="M5 12h14M12 5l7 7-7 7" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </a>
                            @endif
                        @endauth
                    @endif
                </div>
            </div>
        </div>
    </nav>

    {{-- ── Hero ── --}}
    <section class="hero">

        {{-- Left --}}
        <div class="hero-left">
            <div class="eyebrow reveal">
                <div class="eyebrow-line"></div>
                Mentorship Reimagined
            </div>

            <h1 class="hero-heading reveal delay-1">
                Stop guessing.<br>
                <em>Start talking</em> to<br>
                someone who's<br>
                <strong>done it.</strong>
            </h1>

            <p class="hero-sub reveal delay-2">
                Book a 1:1 session with a vetted mentor in minutes. Not courses. Not content.
                A real conversation with someone who's already solved what you're stuck on.
            </p>

            <div class="flex flex-wrap gap-4 reveal delay-3">
                <a href="{{ route('register') }}" class="btn-primary">
                    Find Your Mentor
                    <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.5"
                        viewBox="0 0 24 24">
                        <path d="M5 12h14M12 5l7 7-7 7" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </a>
                <a href="#how-it-works" class="btn-ghost">See how it works</a>
            </div>

        </div>

        {{-- Right --}}
        <div class="hero-right">
            <div class="hero-right-inner" id="heroRightScene">

                {{-- Ambient glows --}}
                <div class="card-glow-bg"></div>
                <div class="card-glow-bg-2"></div>

                <p
                    style="font-size:0.65rem;font-weight:700;letter-spacing:0.2em;text-transform:uppercase;color:rgba(255,255,255,0.3);margin-bottom:16px;position:relative;z-index:2">
                    Featured Mentor
                </p>

                {{-- The featured card --}}
                <div class="featured-mentor-card" id="featuredCard" style="position:relative;z-index:2">
                    <div class="fmc-inner-glow"></div>

                    <div class="fmc-top">
                        <div class="fmc-avatar">
                            M
                            <div class="fmc-online"></div>
                        </div>
                        <div>
                            <p class="fmc-name">Mentor</p>
                            <div class="fmc-meta">
                                <div class="fmc-stars">
                                    <span class="fmc-star">★</span>
                                    <span class="fmc-star">★</span>
                                    <span class="fmc-star">★</span>
                                    <span class="fmc-star">★</span>
                                    <span class="fmc-star">★</span>
                                </div>
                                <span class="fmc-rating">4.8</span>
                                <span class="fmc-sep">•</span>
                                <span class="fmc-rating">5 reviews</span>
                                <span class="fmc-sep">•</span>
                                <span class="fmc-match">100% Match</span>
                            </div>
                        </div>
                    </div>

                    <div class="fmc-divider"></div>

                    <p class="fmc-bio">
                        "Experienced professional with expertise in Finance. Focused on helping individuals and teams
                        grow through guidance, strategy, and real world insights."
                    </p>

                    <div class="fmc-tags">
                        <span class="fmc-tag">Finance</span>
                    </div>

                    <button class="fmc-btn" id="fmcBtn">
                        <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2.2"
                            viewBox="0 0 24 24" aria-hidden="true">
                            <path d="M22 2L11 13M22 2l-7 20-4-9-9-4 20-7z" stroke-linecap="round"
                                stroke-linejoin="round" />
                        </svg>
                        Request Mentorship
                    </button>
                </div>

                {{-- Animated cursor --}}
                <svg class="hero-cursor" id="heroCursor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <polygon points="4,2 4,20 8,16 12,22 14,21 10,15 16,15" fill="white" stroke="#0D9488"
                        stroke-width="1.2" stroke-linejoin="round" />
                </svg>

                {{-- Success toast --}}
                <div class="hero-toast" id="heroToast">✓ Request sent! Your mentor will confirm shortly.</div>

            </div>
        </div>

    </section>


    {{-- ── Trust logos ── --}}
    <section class="py-12 bg-slate-50 border-b border-slate-100">
        <div class="max-w-6xl mx-auto px-4 mb-12 text-center">
            <p class="text-sm font-bold text-slate-400 tracking-[0.2em] uppercase">Mentors from companies like</p>
        </div>
        <div class="marquee-wrap">
            <div class="marquee-track">
                <span class="trust-logo">VentureSync</span>
                <span class="trust-logo">Nexus Lab</span>
                <span class="trust-logo">GigaSearch</span>
                <span class="trust-logo">PayFlow</span>
                <span class="trust-logo">QuickDash</span>
                <span class="trust-logo">CreditLine</span>
                <span class="trust-logo">ShopWave</span>
                <span class="trust-logo">TeamFlow</span>
                <span class="trust-logo">PayBridge</span>
                <span class="trust-logo">IdeaSync</span>
                <span class="trust-logo">DesignHub</span>
                <span class="trust-logo">WalletGo</span>
                <!-- dupe -->
                <span class="trust-logo">VentureSync</span>
                <span class="trust-logo">Nexus Lab</span>
                <span class="trust-logo">GigaSearch</span>
                <span class="trust-logo">PayFlow</span>
                <span class="trust-logo">QuickDash</span>
                <span class="trust-logo">CreditLine</span>
                <span class="trust-logo">ShopWave</span>
                <span class="trust-logo">TeamFlow</span>
                <span class="trust-logo">PayBridge</span>
                <span class="trust-logo">IdeaSync</span>
                <span class="trust-logo">DesignHub</span>
                <span class="trust-logo">WalletGo</span>
            </div>
        </div>
    </section>

    {{-- ── Features ── --}}
    <section id="features" class="py-24">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="flex gap-12 items-start mb-20">
                <div class="hidden lg:flex pt-2">
                    <span class="section-label">Features</span>
                </div>
                <div class="reveal">
                    <div class="teal-chip mb-5">What we offer</div>
                    <h2
                        style="font-family:'Bricolage Grotesque',sans-serif;font-size:clamp(2rem,4vw,3.2rem);font-weight:800;letter-spacing:-0.03em;line-height:1.1;color:var(--slate-950);max-width:560px">
                        Built for<br><em style="font-style:italic;font-weight:300;color:var(--teal)">meaningful</em>
                        mentorship.
                    </h2>
                    <p class="mt-5 text-slate-500 max-w-xl leading-relaxed">
                        Everything you need to discover the right mentor, schedule sessions, and grow with expert
                        guidance, not guesswork.
                    </p>
                </div>
            </div>

            <div class="features-grid border border-slate-100 rounded-2xl overflow-hidden">

                <div class="feature-item reveal">
                    <div class="feature-num">01</div>
                    <div class="feature-icon-wrap">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                        </svg>
                    </div>
                    <h3
                        style="font-family:'Bricolage Grotesque',sans-serif;font-size:1.4rem;font-weight:700;margin-bottom:12px">
                        Verified Mentors</h3>
                    <p class="text-slate-500 leading-relaxed text-sm">We verify all mentors. Every mentor is
                        personally vetted, real experience, real results, no fluff. You get a thinking partner, not a
                        coach with a course.</p>
                </div>

                <div class="feature-item reveal delay-1" style="border-top:none;border-left:none">
                    <div class="feature-num">02</div>
                    <div class="feature-icon-wrap">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <h3
                        style="font-family:'Bricolage Grotesque',sans-serif;font-size:1.4rem;font-weight:700;margin-bottom:12px">
                        Smart Scheduling</h3>
                    <p class="text-slate-500 leading-relaxed text-sm">Book a session in under 2 minutes. View real time
                        availability, schedule instantly, and get confirmed without endless back and forth emails.</p>
                </div>

                <div class="feature-item reveal delay-2" style="border-top:none">
                    <div class="feature-num">03</div>
                    <div class="feature-icon-wrap">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                        </svg>
                    </div>
                    <h3
                        style="font-family:'Bricolage Grotesque',sans-serif;font-size:1.4rem;font-weight:700;margin-bottom:12px">
                        Meaningful Conversations</h3>
                    <p class="text-slate-500 leading-relaxed text-sm">Not advice. A real dialogue. Mentors who have been
                        where you are, guide you through structured sessions built for long term collaboration.</p>
                </div>

                <div class="feature-item reveal delay-3" style="border-top:none;border-left:none">
                    <div class="feature-num">04</div>
                    <div class="feature-icon-wrap">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                        </svg>
                    </div>
                    <h3
                        style="font-family:'Bricolage Grotesque',sans-serif;font-size:1.4rem;font-weight:700;margin-bottom:12px">
                        Track Your Growth</h3>
                    <p class="text-slate-500 leading-relaxed text-sm">Set goals, log sessions, and see your progress
                        over time. A personal growth dashboard that keeps you accountable and motivated.</p>
                </div>

            </div>

        </div>
    </section>

    {{-- ── How It Works ── --}}
    <section id="how-it-works" class="py-24 bg-slate-50 border-t border-slate-100">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="text-center mb-20 reveal">
                <div class="teal-chip mb-5">The Process</div>
                <h2
                    style="font-family:'Bricolage Grotesque',sans-serif;font-size:clamp(2rem,4vw,3rem);font-weight:800;letter-spacing:-0.03em;color:var(--slate-950)">
                    Three steps to your next breakthrough</h2>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-10">

                <div class="step-item text-center reveal">
                    <div class="flex justify-center">
                        <div class="step-num">1</div>
                    </div>
                    <h3
                        style="font-family:'Bricolage Grotesque',sans-serif;font-size:1.2rem;font-weight:700;margin-bottom:10px">
                        Tell us your challenge</h3>
                    <p class="text-slate-500 text-sm leading-relaxed">Describe what you're stuck on — fundraising,
                        growth, hiring, product, or anything else. Be as specific as you like.</p>
                </div>

                <div class="step-item text-center reveal delay-2">
                    <div class="flex justify-center">
                        <div class="step-num">2</div>
                    </div>
                    <h3
                        style="font-family:'Bricolage Grotesque',sans-serif;font-size:1.2rem;font-weight:700;margin-bottom:10px">
                        Get matched instantly</h3>
                    <p class="text-slate-500 text-sm leading-relaxed">We surface the most relevant mentors who've solved
                        your exact problem. Browse profiles and pick your match.</p>
                </div>

                <div class="step-item text-center reveal delay-4">
                    <div class="flex justify-center">
                        <div class="step-num">3</div>
                    </div>
                    <h3
                        style="font-family:'Bricolage Grotesque',sans-serif;font-size:1.2rem;font-weight:700;margin-bottom:10px">
                        Have the conversation</h3>
                    <p class="text-slate-500 text-sm leading-relaxed">Book a session. Get real, actionable
                        advice. Come back as often as you need — unlimited sessions, one membership.</p>
                </div>

            </div>

        </div>
    </section>


    {{-- ── CTA ── --}}
    <section class="cta-section py-32 reveal">
        <div class="cta-grid-overlay"></div>
        <div class="cta-blob"
            style="width:500px;height:500px;background:radial-gradient(circle,rgba(13,148,136,0.2) 0%,transparent 70%);top:-100px;left:-100px">
        </div>
        <div class="cta-blob"
            style="width:400px;height:400px;background:radial-gradient(circle,rgba(20,184,166,0.15) 0%,transparent 70%);bottom:-80px;right:-80px">
        </div>

        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10">
            <div class="teal-chip mb-8" style="background:rgba(13,148,136,0.15);color:#5EEAD4">Ready to grow?</div>
            <h2
                style="font-family:'Bricolage Grotesque',sans-serif;font-size:clamp(2.5rem,5vw,4rem);font-weight:800;letter-spacing:-0.03em;color:white;line-height:1.05;margin-bottom:24px">
                Your next breakthrough<br>
                <em style="font-style:italic;font-weight:300;color:var(--teal-light)">starts with one conversation.</em>
            </h2>
            <p
                style="color:rgba(255,255,255,0.5);font-size:1.05rem;max-width:480px;margin:0 auto 40px;line-height:1.75">
                Join thousands of founders and professionals who stopped guessing and started growing — with mentors
                who've already done it.
            </p>
            <a href="{{ route('register') }}" class="btn-primary" style="font-size:1rem;padding:18px 36px">
                Ready to start?
                <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <path d="M5 12h14M12 5l7 7-7 7" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
            </a>
            <p style="color:rgba(255,255,255,0.25);font-size:0.8rem;margin-top:16px">No credit card required · Cancel
                anytime</p>
        </div>
    </section>

    {{-- ── Footer ── --}}
    <footer class="py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row items-center justify-between gap-6">
                <div class="flex items-center gap-3">
                    <img src="{{ asset('assets/images/logo.png') }}" alt="Mentorship Hub"
                        class="w-9 h-9 object-contain">
                    <div>
                        <h3 style="font-family:'Bricolage Grotesque',sans-serif;font-weight:700;color:var(--slate-950)">
                            Mentorship Hub</h3>
                        <p class="text-xs text-slate-400">Premium Mentorship Platform</p>
                    </div>
                </div>
                <p class="text-sm text-slate-400">© {{ date('Y') }} Mentorship Hub. All rights reserved.</p>
                <div class="flex items-center gap-6">
                    <a href="#"
                        class="text-sm text-slate-400 hover:text-[#0D9488] transition hover-underline">Privacy</a>
                    <a href="#" class="text-sm text-slate-400 hover:text-[#0D9488] transition hover-underline">Terms</a>
                    <a href="#"
                        class="text-sm text-slate-400 hover:text-[#0D9488] transition hover-underline">Contact</a>
                </div>
            </div>
        </div>
    </footer>

    <script>

        // ── Scroll Reveal ──
        const revealEls = document.querySelectorAll('.reveal, .reveal-left, .reveal-right');
        const obs = new IntersectionObserver(entries => {
            entries.forEach(e => { if (e.isIntersecting) { e.target.classList.add('active'); obs.unobserve(e.target); } });
        }, { threshold: 0.1 });
        revealEls.forEach(el => obs.observe(el));

        // ── Hero mentor cards ──
        const cards = document.querySelectorAll('.mentor-card');
        setTimeout(() => { cards.forEach(c => c.classList.add('visible')); }, 400);

        // ── Animated Counters ──
        const counters = document.querySelectorAll('.counter');
        const countObs = new IntersectionObserver(entries => {
            entries.forEach(entry => {
                if (!entry.isIntersecting) return;
                const el = entry.target;
                const target = parseInt(el.dataset.target);
                const suffix = el.dataset.suffix || '';
                let start = 0;
                const duration = 1800;
                const step = timestamp => {
                    if (!start) start = timestamp;
                    const progress = Math.min((timestamp - start) / duration, 1);
                    const ease = 1 - Math.pow(1 - progress, 3);
                    el.textContent = Math.floor(ease * target).toLocaleString() + suffix;
                    if (progress < 1) requestAnimationFrame(step);
                };
                requestAnimationFrame(step);
                countObs.unobserve(el);
            });
        }, { threshold: 0.5 });
        counters.forEach(c => countObs.observe(c));

        // ── Progress bars ──
        const fills = document.querySelectorAll('.progress-fill');
        setTimeout(() => {
            fills.forEach(f => { f.style.width = f.dataset.width + '%'; });
        }, 1200);
    </script>

    <script id="hero-right-animation-script">
        (function () {
            const scene = document.getElementById('heroRightScene');
            const card = document.getElementById('featuredCard');
            const cursor = document.getElementById('heroCursor');
            const btn = document.getElementById('fmcBtn');
            const toast = document.getElementById('heroToast');
            let running = false;

            function getBoundingRelative(el) {
                const sr = scene.getBoundingClientRect();
                const er = el.getBoundingClientRect();
                return {
                    x: er.left - sr.left,
                    y: er.top - sr.top,
                    w: er.width,
                    h: er.height
                };
            }

            function setCursor(x, y) {
                cursor.style.left = x + 'px';
                cursor.style.top = y + 'px';
            }

            function easeInOut(t) { return t < 0.5 ? 2 * t * t : -1 + (4 - 2 * t) * t; }
            function easeOut(t) { return 1 - (1 - t) * (1 - t); }

            function tweenCursor(fromX, fromY, toX, toY, duration, easeFn, done) {
                let start = null;
                function step(ts) {
                    if (!start) start = ts;
                    const progress = Math.min((ts - start) / duration, 1);
                    const e = easeFn(progress);
                    setCursor(fromX + (toX - fromX) * e, fromY + (toY - fromY) * e);
                    if (progress < 1) requestAnimationFrame(step);
                    else done();
                }
                requestAnimationFrame(step);
            }

            function spawnRipple(cx, cy) {
                const size = 40;
                const rip = document.createElement('div');
                rip.className = 'hero-ripple';
                rip.style.width = size + 'px';
                rip.style.height = size + 'px';
                rip.style.left = (cx - size / 2) + 'px';
                rip.style.top = (cy - size / 2) + 'px';
                scene.appendChild(rip);
                setTimeout(() => rip.remove(), 700);
            }

            function reset() {
                if (!card) return;
                card.classList.remove('card-hovered');
                btn.classList.remove('btn-clicked');
                toast.classList.remove('toast-show');
                cursor.classList.remove('cur-visible');
                cursor.style.transform = '';
                running = false;
            }

            function runSequence() {
                if (running || !scene || !card) return;
                running = true;

                const sr = scene.getBoundingClientRect();
                const startX = sr.width * 0.05;
                const startY = sr.height * 0.9;

                setCursor(startX, startY);
                cursor.classList.add('cur-visible');

                // 1. Move cursor toward the card centre
                setTimeout(() => {
                    const c = getBoundingRelative(card);
                    const targetX = c.x + c.w * 0.55;
                    const targetY = c.y + c.h * 0.42;

                    tweenCursor(startX, startY, targetX, targetY, 950, easeInOut, () => {
                        // 2. Hover the card
                        card.classList.add('card-hovered');

                        // 3. Move cursor to the button
                        setTimeout(() => {
                            const b = getBoundingRelative(btn);
                            const btnX = b.x + b.w * 0.5;
                            const btnY = b.y + b.h * 0.5;
                            const curX = parseFloat(cursor.style.left);
                            const curY = parseFloat(cursor.style.top);

                            tweenCursor(curX, curY, btnX, btnY, 550, easeOut, () => {
                                // 4. Click
                                cursor.style.transform = 'scale(0.78)';
                                btn.classList.add('btn-clicked');
                                spawnRipple(btnX, btnY);

                                setTimeout(() => {
                                    cursor.style.transform = '';
                                    toast.classList.add('toast-show');
                                }, 180);

                                // 5. Reset and loop
                                setTimeout(() => {
                                    toast.classList.remove('toast-show');
                                    setTimeout(() => {
                                        reset();
                                        setTimeout(runSequence, 1200);
                                    }, 400);
                                }, 2800);
                            });
                        }, 900);
                    });
                }, 400);
            }

            // Kick off after page load
            if (document.readyState === 'complete') {
                setTimeout(runSequence, 800);
            } else {
                window.addEventListener('load', () => setTimeout(runSequence, 800));
            }
        })();
    </script>
</body>

</html>