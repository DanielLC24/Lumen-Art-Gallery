<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Lumen Art Gallery</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600|playfair-display:500,600,700" rel="stylesheet" />
    <style>
        :root {
            --bg: #fbfaf7;
            --surface: rgba(255, 255, 255, .82);
            --ink: #171717;
            --muted: #6d6d69;
            --line: rgba(150, 150, 145, .24);
            --gold: #c5a35d;
            --gold-deep: #8e7138;
            --silver: #b8bdc1;
            --soft: #f0eee9;
            --shadow: 0 24px 90px rgba(114, 111, 104, .18);
        }

        [data-theme="dark"] {
            --bg: #0f0f0e;
            --surface: #181715;
            --ink: #f5f1e8;
            --muted: #bcb4a5;
            --line: rgba(245, 241, 232, .14);
            --gold: #d1b06d;
            --gold-deep: #d1b06d;
            --silver: #76716a;
            --soft: #25221d;
            --shadow: 0 26px 90px rgba(0, 0, 0, .44);
        }

        * { box-sizing: border-box; }

        html {
            scroll-behavior: smooth;
        }

        body {
            margin: 0;
            background:
                radial-gradient(circle at 18% 10%, rgba(197, 163, 93, .16), transparent 26%),
                radial-gradient(circle at 82% 14%, rgba(184, 189, 193, .24), transparent 28%),
                linear-gradient(115deg, transparent 0 14%, rgba(184, 189, 193, .18) 14.4%, transparent 15.2% 42%, rgba(197, 163, 93, .10) 42.5%, transparent 43.4%),
                linear-gradient(150deg, transparent 0 28%, rgba(184, 189, 193, .15) 28.3%, transparent 29.1% 68%, rgba(184, 189, 193, .13) 68.4%, transparent 69.1%),
                var(--bg);
            background-attachment: fixed;
            color: var(--ink);
            font-family: "Instrument Sans", system-ui, sans-serif;
            letter-spacing: 0;
        }

        body::before {
            background-image:
                linear-gradient(105deg, transparent 0 47%, rgba(118, 122, 126, .10) 47.2%, transparent 48%),
                linear-gradient(28deg, transparent 0 58%, rgba(197, 163, 93, .08) 58.3%, transparent 59%),
                linear-gradient(162deg, transparent 0 74%, rgba(118, 122, 126, .09) 74.2%, transparent 75%);
            content: "";
            inset: 0;
            opacity: .74;
            pointer-events: none;
            position: fixed;
            z-index: -1;
        }

        [data-theme="dark"] body {
            background:
                radial-gradient(circle at 18% 10%, rgba(209, 176, 109, .10), transparent 28%),
                radial-gradient(circle at 82% 14%, rgba(118, 113, 106, .12), transparent 30%),
                #0f0f0e;
        }

        [data-theme="dark"] body::before {
            opacity: .15;
        }

        img, video {
            display: block;
            width: 100%;
        }

        a {
            color: inherit;
            text-decoration: none;
        }

        button, input, select, textarea {
            font: inherit;
        }

        .nav {
            align-items: center;
            backdrop-filter: blur(18px);
            background: color-mix(in srgb, var(--surface) 88%, transparent);
            border-bottom: 1px solid var(--line);
            display: flex;
            gap: 22px;
            justify-content: space-between;
            left: 0;
            padding: 16px clamp(18px, 4vw, 52px);
            position: fixed;
            right: 0;
            top: 0;
            transition: padding .28s ease, box-shadow .28s ease, background .28s ease;
            z-index: 20;
        }

        .nav.scrolled {
            background: color-mix(in srgb, var(--surface) 96%, transparent);
            box-shadow: 0 14px 44px rgba(20, 20, 20, .08);
            padding-bottom: 11px;
            padding-top: 11px;
        }

        .brand {
            align-items: center;
            display: flex;
            gap: 12px;
            font-weight: 600;
            letter-spacing: .08em;
            text-transform: uppercase;
        }

        .brand-mark {
            background: linear-gradient(135deg, rgba(255,255,255,.72), rgba(197, 163, 93, .12));
            border: 1px solid var(--gold);
            box-shadow: inset 0 0 0 1px rgba(255,255,255,.42);
            color: var(--gold);
            display: grid;
            height: 34px;
            place-items: center;
            width: 34px;
        }

        .nav-links {
            align-items: center;
            display: flex;
            gap: 22px;
            font-size: 13px;
            color: var(--muted);
        }

        .nav-actions {
            align-items: center;
            display: flex;
            gap: 10px;
        }

        .cart-link {
            position: relative;
        }

        .cart-link svg {
            height: 19px;
            width: 19px;
        }

        .cart-link .cart-badge {
            position: absolute;
            right: -8px;
            top: -8px;
        }

        .icon-button, .pill-button, .outline-button {
            align-items: center;
            border: 1px solid var(--line);
            cursor: pointer;
            display: inline-flex;
            gap: 10px;
            justify-content: center;
            min-height: 42px;
            transition: transform .25s ease, border-color .25s ease, background .25s ease;
        }

        .icon-button {
            background: var(--surface);
            color: var(--ink);
            box-shadow: inset 0 0 0 1px rgba(255,255,255,.35);
            width: 42px;
        }

        .pill-button {
            background: linear-gradient(135deg, var(--gold-deep), var(--gold));
            border-color: rgba(197, 163, 93, .65);
            color: #fffaf0;
            box-shadow: 0 12px 32px rgba(142, 113, 56, .24);
            padding: 0 18px;
        }

        .outline-button {
            background: color-mix(in srgb, var(--surface) 72%, transparent);
            color: var(--ink);
            padding: 0 18px;
        }

        .icon-button:hover, .pill-button:hover, .outline-button:hover {
            border-color: var(--gold);
            transform: translateY(-2px);
        }

        .hero {
            background: #0f0d0a;
            isolation: isolate;
            min-height: 98vh;
            overflow: hidden;
            position: relative;
        }

        .hero-media {
            animation: heroImageIn 1.8s cubic-bezier(.16, 1, .3, 1) both;
            filter: saturate(1.02) contrast(1.04);
            height: 100%;
            inset: 0;
            object-fit: cover;
            position: absolute;
            transform: scale(1.08);
            transition: transform .2s linear;
        }

        .hero::before {
            background:
                radial-gradient(circle at 18% 34%, rgba(255,255,255,.32), transparent 21%),
                linear-gradient(90deg, rgba(8, 7, 6, .74), rgba(8, 7, 6, .34) 38%, rgba(8, 7, 6, .08) 74%),
                linear-gradient(0deg, rgba(8, 7, 6, .74), transparent 34%);
            content: "";
            inset: 0;
            pointer-events: none;
            position: absolute;
            z-index: 1;
        }

        .hero::after {
            background:
                linear-gradient(115deg, transparent 0 43%, rgba(197, 163, 93, .26) 43.15%, transparent 43.8%),
                linear-gradient(90deg, rgba(255,255,255,.12), transparent 18% 82%, rgba(255,255,255,.07));
            content: "";
            inset: 0;
            mix-blend-mode: soft-light;
            opacity: .88;
            pointer-events: none;
            position: absolute;
            z-index: 1;
        }

        .hero-content {
            color: #fffaf0;
            max-width: 820px;
            padding: 22vh clamp(18px, 6vw, 86px) 12vh;
            position: relative;
            z-index: 3;
        }

        .hero-content::before {
            background: linear-gradient(180deg, var(--gold), rgba(255,255,255,.28));
            content: "";
            height: 120px;
            left: clamp(18px, 6vw, 86px);
            position: absolute;
            top: 14vh;
            width: 1px;
        }

        .hero-content > * {
            animation: heroTextIn .9s cubic-bezier(.16, 1, .3, 1) both;
        }

        .hero-content .eyebrow {
            animation-delay: .15s;
        }

        .hero-content h1 {
            animation-delay: .28s;
        }

        .hero-content p:not(.eyebrow) {
            animation-delay: .42s;
        }

        .hero-content .pill-button {
            animation-delay: .56s;
        }

        .hero-note {
            border-top: 1px solid rgba(255,255,255,.36);
            bottom: 34px;
            color: rgba(255,250,240,.74);
            display: grid;
            font-size: 12px;
            gap: 5px;
            letter-spacing: .12em;
            min-width: 210px;
            padding-top: 12px;
            position: absolute;
            right: clamp(18px, 5vw, 72px);
            text-transform: uppercase;
            z-index: 3;
        }

        .hero-note strong {
            color: #fffaf0;
            font-family: "Playfair Display", Georgia, serif;
            font-size: 22px;
            font-weight: 600;
            letter-spacing: 0;
            text-transform: none;
        }

        .eyebrow {
            color: var(--gold);
            font-size: 12px;
            font-weight: 600;
            letter-spacing: .18em;
            margin: 0 0 18px;
            text-transform: uppercase;
        }

        h1, h2, h3 {
            font-family: "Playfair Display", Georgia, serif;
            font-weight: 600;
            letter-spacing: 0;
            line-height: 1.02;
            margin: 0;
        }

        h1 {
            font-size: clamp(52px, 9vw, 128px);
            max-width: 900px;
        }

        .hero p {
            color: rgba(255, 250, 240, .78);
            font-size: clamp(17px, 2vw, 23px);
            line-height: 1.65;
            margin: 24px 0 34px;
            max-width: 620px;
        }

        .scroll-cue {
            border-left: 1px solid rgba(255,255,255,.4);
            bottom: 26px;
            color: rgba(255,255,255,.72);
            font-size: 12px;
            letter-spacing: .16em;
            padding-left: 14px;
            position: absolute;
            right: clamp(18px, 4vw, 52px);
            text-transform: uppercase;
            z-index: 3;
        }

        section {
            padding: clamp(72px, 10vw, 130px) clamp(18px, 5vw, 72px);
        }

        section:nth-of-type(even) {
            background:
                linear-gradient(120deg, rgba(255,255,255,.54), rgba(240,238,233,.42)),
                linear-gradient(35deg, transparent 0 62%, rgba(184, 189, 193, .16) 62.4%, transparent 63.1%);
            border-block: 1px solid rgba(184, 189, 193, .16);
        }

        .section-head {
            align-items: end;
            display: grid;
            gap: 24px;
            grid-template-columns: minmax(0, 1fr) minmax(260px, 420px);
            margin-bottom: 38px;
        }

        .section-head h2 {
            font-size: clamp(36px, 6vw, 72px);
        }

        .section-head p, .about-copy, .card p, .event p, .contact-info {
            color: var(--muted);
            line-height: 1.7;
        }

        .about-grid {
            display: grid;
            gap: 34px;
            grid-template-columns: 1.15fr .85fr;
        }

        .about-image {
            aspect-ratio: 16 / 10;
            object-fit: cover;
        }

        .stats {
            display: grid;
            gap: 14px;
            grid-template-columns: repeat(3, 1fr);
            margin-top: 28px;
        }

        .stat {
            border-top: 1px solid color-mix(in srgb, var(--gold) 45%, var(--line));
            padding-top: 18px;
        }

        .stat strong {
            display: block;
            font-family: "Playfair Display", Georgia, serif;
            font-size: 42px;
            line-height: 1;
        }

        .filters {
            background: color-mix(in srgb, var(--surface) 68%, transparent);
            border: 1px solid var(--line);
            box-shadow: inset 0 0 0 1px rgba(255,255,255,.36);
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
            margin-bottom: 34px;
            max-width: 100%;
            padding: 8px;
            width: fit-content;
        }

        .filter {
            background: transparent;
            border: 1px solid transparent;
            color: var(--muted);
            cursor: pointer;
            min-height: 40px;
            overflow: hidden;
            padding: 10px 15px;
            position: relative;
            transition: background .28s ease, border-color .28s ease, color .28s ease, transform .28s ease;
            z-index: 0;
        }

        .filter::before {
            background: linear-gradient(135deg, rgba(197, 163, 93, .18), rgba(255,255,255,.58));
            content: "";
            inset: 0;
            opacity: 0;
            position: absolute;
            transform: scaleX(.72);
            transform-origin: left;
            transition: opacity .28s ease, transform .28s ease;
            z-index: -1;
        }

        .filter:hover::before,
        .filter.active::before {
            opacity: 1;
            transform: scaleX(1);
        }

        .filter.active {
            border-color: var(--gold);
            color: var(--ink);
        }

        .art-grid {
            columns: 3 280px;
            column-gap: clamp(18px, 2.4vw, 30px);
            transition: opacity .25s ease;
        }

        .art-card {
            background: var(--surface);
            break-inside: avoid;
            border: 1px solid color-mix(in srgb, var(--line) 64%, white);
            box-shadow: 0 20px 68px rgba(72, 68, 60, .13);
            cursor: zoom-in;
            margin-bottom: clamp(18px, 2.4vw, 30px);
            overflow: hidden;
            position: relative;
            transform: translateZ(0);
            transition: box-shadow .35s ease, opacity .28s ease, transform .35s ease;
        }

        .art-card:hover {
            box-shadow: 0 34px 96px rgba(64, 57, 42, .24);
            transform: translateY(-6px);
        }

        .art-card.is-filtered-out {
            opacity: 0;
            pointer-events: none;
            transform: translateY(18px) scale(.965);
        }

        .art-card.is-filtering-in {
            animation: masonryFilterIn .56s cubic-bezier(.16, 1, .3, 1) both;
            animation-delay: calc(var(--filter-stagger, 0) * 38ms);
        }

        .art-card img {
            aspect-ratio: var(--ratio, 4 / 5);
            object-fit: cover;
            transition: transform .7s ease;
        }

        .art-card:hover img {
            transform: scale(1.06);
        }

        .art-overlay {
            background: linear-gradient(0deg, rgba(0,0,0,.82), transparent);
            bottom: 0;
            color: #fff;
            display: grid;
            gap: 8px;
            left: 0;
            opacity: 0;
            padding: 72px 18px 18px;
            position: absolute;
            right: 0;
            transform: translateY(12px);
            transition: opacity .3s ease, transform .3s ease;
        }

        .art-card:hover .art-overlay {
            opacity: 1;
            transform: translateY(0);
        }

        .art-overlay .outline-button {
            width: fit-content;
        }

        .price {
            color: #dfc27d;
            font-weight: 600;
        }

        .cards {
            display: grid;
            gap: 18px;
            grid-template-columns: repeat(3, minmax(0, 1fr));
        }

        .card {
            background: var(--surface);
            border: 1px solid var(--line);
            box-shadow: 0 16px 50px rgba(114, 111, 104, .10);
            overflow: hidden;
            transition: border-color .3s ease, box-shadow .3s ease, transform .3s ease;
        }

        .card:hover, .shop-card:hover {
            border-color: color-mix(in srgb, var(--gold) 70%, var(--line));
            box-shadow: 0 28px 82px rgba(114, 111, 104, .20);
            transform: translateY(-5px);
        }

        .card-body {
            padding: 22px;
        }

        .card img {
            aspect-ratio: 4 / 4.6;
            object-fit: cover;
        }

        .immersive {
            background: var(--ink);
            color: var(--bg);
            display: grid;
            gap: 28px;
            grid-template-columns: .75fr 1.25fr;
        }

        .immersive .section-head {
            display: block;
            margin: 0;
        }

        .immersive p {
            color: color-mix(in srgb, var(--bg) 72%, transparent);
        }

        .tour {
            display: grid;
            gap: 14px;
        }

        #recorrido .video-frame {
            display: none;
        }

        .tour-stage {
            aspect-ratio: 16 / 9;
            background: #050505;
            border: 1px solid rgba(255,255,255,.14);
            box-shadow: 0 28px 90px rgba(0,0,0,.34);
            overflow: hidden;
            position: relative;
        }

        .tour-stage img {
            height: 100%;
            object-fit: cover;
            opacity: .9;
            transform: scale(1.04);
            transition: opacity .35s ease, transform .7s ease;
        }

        .tour-stage.changing img {
            opacity: .4;
            transform: scale(1.1);
        }

        .tour-stage::after {
            background: linear-gradient(0deg, rgba(0,0,0,.54), transparent 45%);
            content: "";
            inset: 0;
            pointer-events: none;
            position: absolute;
        }

        .hotspot {
            align-items: center;
            background: rgba(255,255,255,.16);
            border: 1px solid rgba(255,255,255,.7);
            color: #fff;
            cursor: pointer;
            display: grid;
            height: 34px;
            left: var(--x);
            place-items: center;
            position: absolute;
            top: var(--y);
            transform: translate(-50%, -50%);
            transition: background .25s ease, transform .25s ease;
            width: 34px;
            z-index: 2;
        }

        .hotspot::before {
            border: 1px solid rgba(255,255,255,.52);
            content: "";
            inset: -9px;
            position: absolute;
        }

        .hotspot:hover, .hotspot.active {
            background: var(--gold);
            color: #111;
            transform: translate(-50%, -50%) scale(1.08);
        }

        .tour-caption {
            align-items: end;
            bottom: 0;
            color: #fff;
            display: flex;
            gap: 18px;
            justify-content: space-between;
            left: 0;
            padding: 20px;
            position: absolute;
            right: 0;
            z-index: 2;
        }

        .tour-caption h3 {
            font-size: clamp(26px, 4vw, 46px);
        }

        .tour-caption p {
            color: rgba(255,255,255,.76);
            margin: 8px 0 0;
            max-width: 520px;
        }

        .tour-info {
            background: rgba(255,255,255,.08);
            border: 1px solid rgba(255,255,255,.14);
            color: var(--bg);
            display: grid;
            gap: 10px;
            min-height: 126px;
            padding: 18px;
        }

        .tour-info p {
            margin: 0;
        }

        .tour-rooms {
            display: grid;
            gap: 10px;
            grid-template-columns: repeat(3, minmax(0, 1fr));
        }

        .room-button {
            background: rgba(255,255,255,.08);
            border: 1px solid rgba(255,255,255,.18);
            color: rgba(255,255,255,.74);
            cursor: pointer;
            min-height: 48px;
            padding: 10px 12px;
            text-align: left;
            transition: border-color .25s ease, background .25s ease, color .25s ease;
        }

        .room-button.active {
            background: rgba(197, 163, 93, .18);
            border-color: var(--gold);
            color: #fff;
        }

        .catalog {
            display: grid;
            gap: 18px;
            grid-template-columns: 1.25fr .75fr;
        }

        .catalog-hero {
            min-height: 540px;
            object-fit: cover;
        }

        .catalog-panel {
            background: var(--surface);
            border: 1px solid var(--line);
            box-shadow: inset 0 0 0 1px rgba(255,255,255,.34), var(--shadow);
            display: flex;
            flex-direction: column;
            justify-content: end;
            padding: clamp(24px, 5vw, 46px);
        }

        .events {
            display: grid;
            gap: 16px;
        }

        .event {
            align-items: center;
            border-top: 1px solid var(--line);
            display: grid;
            gap: 18px;
            grid-template-columns: 110px 1fr 170px;
            padding: 18px 0;
        }

        .event-date {
            color: var(--gold);
            font-family: "Playfair Display", Georgia, serif;
            font-size: 32px;
        }

        .shop-grid {
            display: grid;
            gap: 18px;
            grid-template-columns: repeat(4, minmax(0, 1fr));
        }

        .shop-card {
            background: var(--surface);
            border: 1px solid var(--line);
            box-shadow: 0 16px 50px rgba(114, 111, 104, .10);
            overflow: hidden;
            transition: border-color .3s ease, box-shadow .3s ease, transform .3s ease;
        }

        .shop-card img {
            aspect-ratio: 4 / 4.8;
            object-fit: cover;
        }

        .shop-actions {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
            margin-top: 14px;
        }

        .shop-actions form {
            background: transparent;
            border: 0;
            box-shadow: none;
            display: contents;
            padding: 0;
        }

        .availability {
            color: var(--muted);
            display: block;
            font-size: 13px;
            margin-top: 8px;
        }

        .testimonial-carousel {
            max-width: 940px;
        }

        .testimonial-track {
            background: var(--surface);
            border: 1px solid var(--line);
            box-shadow: var(--shadow);
            overflow: hidden;
            position: relative;
        }

        .testimonial {
            display: none;
            gap: 24px;
            grid-template-columns: 90px 1fr;
            padding: 28px;
        }

        .testimonial.active {
            animation: testimonialIn .55s ease both;
            display: grid;
        }

        .testimonial img {
            aspect-ratio: 1;
            object-fit: cover;
        }

        .testimonial-controls {
            display: flex;
            gap: 10px;
            margin-top: 14px;
        }

        .testimonial-dot {
            background: var(--surface);
            border: 1px solid var(--line);
            cursor: pointer;
            height: 12px;
            width: 42px;
        }

        .testimonial-dot.active {
            background: var(--gold);
            border-color: var(--gold);
        }

        .contact {
            display: grid;
            gap: 28px;
            grid-template-columns: .9fr 1.1fr;
        }

        form {
            background: var(--surface);
            border: 1px solid var(--line);
            box-shadow: var(--shadow);
            display: grid;
            gap: 14px;
            padding: 24px;
        }

        input, select, textarea {
            background: color-mix(in srgb, var(--bg) 84%, white);
            border: 1px solid var(--line);
            color: var(--ink);
            min-height: 48px;
            padding: 12px 14px;
            width: 100%;
        }

        select {
            appearance: none;
            background-image: linear-gradient(45deg, transparent 50%, var(--gold) 50%), linear-gradient(135deg, var(--gold) 50%, transparent 50%);
            background-position: calc(100% - 18px) 21px, calc(100% - 12px) 21px;
            background-repeat: no-repeat;
            background-size: 6px 6px, 6px 6px;
        }

        textarea {
            min-height: 130px;
            resize: vertical;
        }

        .contact-form-grid {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }

        .contact-form-grid .full {
            grid-column: 1 / -1;
        }

        .field-error {
            color: #a43f3f;
            font-size: 12px;
            margin-top: -8px;
        }

        .contact-status, .contact-errors {
            border: 1px solid rgba(197, 163, 93, .34);
            color: var(--ink);
            line-height: 1.6;
            padding: 12px 14px;
        }

        .contact-status {
            background: rgba(197, 163, 93, .14);
        }

        .contact-errors {
            background: rgba(164, 63, 63, .08);
            border-color: rgba(164, 63, 63, .24);
        }

        .privacy-check {
            align-items: start;
            color: var(--muted);
            display: flex;
            gap: 10px;
            line-height: 1.5;
        }

        .privacy-check input {
            min-height: auto;
            width: auto;
        }

        .map {
            border: 0;
            height: 260px;
            width: 100%;
        }

        footer {
            border-top: 1px solid var(--line);
            color: var(--muted);
            padding: 32px clamp(18px, 5vw, 72px);
        }

        .reveal {
            opacity: 0;
            transform: translateY(34px) scale(.985);
            transition: opacity .9s cubic-bezier(.16, 1, .3, 1), transform .9s cubic-bezier(.16, 1, .3, 1);
        }

        .reveal.visible {
            opacity: 1;
            transform: translateY(0) scale(1);
        }

        .reveal .section-head .eyebrow,
        .reveal .section-head h2,
        .reveal .section-head > p,
        .reveal > .eyebrow,
        .reveal > h2,
        .reveal > p,
        .reveal .filters,
        .reveal .about-image,
        .reveal .about-copy,
        .reveal .tour,
        .reveal .catalog-hero,
        .reveal .catalog-panel,
        .reveal .testimonial-carousel,
        .reveal.contact > div,
        .reveal.contact > form {
            opacity: 0;
            transform: translateY(26px);
        }

        .reveal .catalog-hero,
        .reveal.contact > div {
            transform: translateX(-28px);
        }

        .reveal .catalog-panel,
        .reveal.contact > form {
            transform: translateX(28px);
        }

        .reveal.visible .section-head .eyebrow,
        .reveal.visible > .eyebrow {
            animation: editorialFade .65s cubic-bezier(.16, 1, .3, 1) .05s both;
        }

        .reveal.visible .section-head h2,
        .reveal.visible > h2 {
            animation: editorialRise .8s cubic-bezier(.16, 1, .3, 1) .15s both;
        }

        .reveal.visible .section-head > p,
        .reveal.visible > p {
            animation: editorialRise .8s cubic-bezier(.16, 1, .3, 1) .28s both;
        }

        .reveal.visible .filters,
        .reveal.visible .about-image,
        .reveal.visible .testimonial-carousel {
            animation: editorialLift .85s cubic-bezier(.16, 1, .3, 1) .34s both;
        }

        .reveal.visible .about-copy,
        .reveal.visible .tour {
            animation: editorialLift .85s cubic-bezier(.16, 1, .3, 1) .46s both;
        }

        .reveal.visible .catalog-hero,
        .reveal.visible.contact > div {
            animation: editorialSlideLeft .85s cubic-bezier(.16, 1, .3, 1) .34s both;
        }

        .reveal.visible .catalog-panel,
        .reveal.visible.contact > form {
            animation: editorialSlideRight .85s cubic-bezier(.16, 1, .3, 1) .46s both;
        }

        .reveal.visible .card,
        .reveal.visible .art-card,
        .reveal.visible .shop-card,
        .reveal.visible .event {
            animation: riseIn .75s cubic-bezier(.16, 1, .3, 1) both;
            animation-delay: calc(.48s + (var(--stagger, 0) * 70ms));
        }

        .reveal.visible .art-card.is-filtered-out {
            animation: none;
            opacity: 0;
            pointer-events: none;
            transform: translateY(18px) scale(.965);
        }

        .reveal.visible .art-card.is-filtering-in {
            animation: masonryFilterIn .56s cubic-bezier(.16, 1, .3, 1) both;
            animation-delay: calc(var(--filter-stagger, 0) * 38ms);
        }

        .art-grid.filter-mode .art-card {
            animation: none;
        }

        .art-grid.filter-mode .art-card.is-filtered-out {
            opacity: 0;
            pointer-events: none;
            transform: translateY(18px) scale(.965);
        }

        .art-grid.filter-mode .art-card.is-filtering-in {
            animation: masonryFilterIn .56s cubic-bezier(.16, 1, .3, 1) both;
            animation-delay: calc(var(--filter-stagger, 0) * 38ms);
        }

        @keyframes riseIn {
            from { opacity: 0; transform: translateY(26px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @keyframes masonryFilterIn {
            from { opacity: 0; transform: translateY(24px) scale(.975); }
            to { opacity: 1; transform: translateY(0) scale(1); }
        }

        @keyframes editorialFade {
            from { opacity: 0; transform: translateY(12px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @keyframes editorialRise {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @keyframes editorialLift {
            from { opacity: 0; transform: translateY(34px) scale(.985); }
            to { opacity: 1; transform: translateY(0) scale(1); }
        }

        @keyframes editorialSlideLeft {
            from { opacity: 0; transform: translateX(-28px); }
            to { opacity: 1; transform: translateX(0); }
        }

        @keyframes editorialSlideRight {
            from { opacity: 0; transform: translateX(28px); }
            to { opacity: 1; transform: translateX(0); }
        }

        @keyframes heroImageIn {
            from {
                filter: saturate(.78) contrast(.92) blur(10px);
                opacity: 0;
                transform: scale(1.14);
            }
            to {
                filter: saturate(1.02) contrast(1.04) blur(0);
                opacity: 1;
                transform: scale(1.08);
            }
        }

        @keyframes heroTextIn {
            from { opacity: 0; transform: translateY(26px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @keyframes testimonialIn {
            from { opacity: 0; transform: translateX(24px); }
            to { opacity: 1; transform: translateX(0); }
        }

        body.lightbox-active {
            overflow: hidden;
        }

        .lightbox {
            background:
                radial-gradient(circle at 24% 18%, rgba(197, 163, 93, .18), transparent 28%),
                rgba(7, 7, 7, .94);
            display: none;
            inset: 0;
            padding: clamp(14px, 3vw, 34px);
            position: fixed;
            z-index: 60;
        }

        .lightbox.open {
            animation: lightboxFade .28s ease both;
            display: grid;
            place-items: center;
        }

        .lightbox-shell {
            color: #fffaf0;
            display: grid;
            gap: 22px;
            grid-template-columns: minmax(0, 1.45fr) minmax(280px, .55fr);
            height: min(860px, 92vh);
            max-width: 1420px;
            width: 100%;
        }

        .lightbox-stage {
            align-items: center;
            background:
                linear-gradient(135deg, rgba(255,255,255,.07), transparent),
                #060606;
            border: 1px solid rgba(255,255,255,.14);
            display: grid;
            min-height: 0;
            overflow: hidden;
            position: relative;
        }

        .lightbox-stage img {
            cursor: zoom-in;
            height: 100%;
            max-height: 100%;
            object-fit: contain;
            padding: clamp(16px, 3vw, 42px);
            transition: transform .35s cubic-bezier(.16, 1, .3, 1);
            width: 100%;
        }

        .lightbox.zoomed .lightbox-stage img {
            cursor: zoom-out;
            transform: scale(1.55);
        }

        .lightbox-panel {
            background: rgba(18, 17, 15, .9);
            border: 1px solid rgba(255,255,255,.14);
            box-shadow: 0 30px 100px rgba(0,0,0,.48);
            display: flex;
            flex-direction: column;
            gap: 18px;
            min-height: 0;
            overflow: auto;
            padding: clamp(20px, 3vw, 34px);
        }

        .lightbox-panel h2 {
            font-size: clamp(34px, 4vw, 56px);
        }

        .lightbox-panel p {
            color: rgba(255,250,240,.72);
            line-height: 1.7;
            margin: 0;
        }

        .lightbox-meta {
            border-block: 1px solid rgba(255,255,255,.14);
            display: grid;
            gap: 12px;
            padding: 18px 0;
        }

        .lightbox-meta div {
            display: grid;
            gap: 4px;
            grid-template-columns: 112px 1fr;
        }

        .lightbox-meta span {
            color: rgba(255,250,240,.52);
            font-size: 12px;
            letter-spacing: .12em;
            text-transform: uppercase;
        }

        .lightbox-meta strong {
            font-weight: 500;
        }

        .lightbox-actions {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-top: auto;
        }

        .lightbox-close,
        .lightbox-nav,
        .lightbox-zoom {
            align-items: center;
            background: rgba(255,255,255,.08);
            border: 1px solid rgba(255,255,255,.18);
            color: #fffaf0;
            cursor: pointer;
            display: inline-flex;
            justify-content: center;
            min-height: 44px;
            transition: background .25s ease, border-color .25s ease, transform .25s ease;
        }

        .lightbox-close:hover,
        .lightbox-nav:hover,
        .lightbox-zoom:hover {
            background: rgba(197, 163, 93, .18);
            border-color: var(--gold);
            transform: translateY(-2px);
        }

        .lightbox-close {
            position: absolute;
            right: 18px;
            top: 18px;
            width: 44px;
            z-index: 2;
        }

        .lightbox-nav {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            width: 48px;
            z-index: 2;
        }

        .lightbox-nav:hover {
            transform: translateY(-50%) scale(1.04);
        }

        .lightbox-prev {
            left: 18px;
        }

        .lightbox-next {
            right: 18px;
        }

        .lightbox-zoom {
            padding: 0 16px;
        }

        @keyframes lightboxFade {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        .cart-badge {
            background: var(--gold);
            color: #111;
            display: inline-grid;
            font-size: 12px;
            height: 20px;
            place-items: center;
            width: 20px;
        }

        @media (max-width: 900px) {
            .nav-links { display: none; }
            .nav {
                gap: 12px;
            }
            .brand {
                min-width: 0;
            }
            .brand span:last-child {
                overflow: hidden;
                text-overflow: ellipsis;
                white-space: nowrap;
            }
            .section-head, .about-grid, .immersive, .catalog, .contact {
                grid-template-columns: 1fr;
            }
            .section-head {
                align-items: start;
            }
            .art-grid {
                columns: 2 240px;
            }
            .lightbox-shell {
                grid-template-columns: 1fr;
                height: 94vh;
                overflow-y: auto;
            }
            .lightbox-stage {
                min-height: 44vh;
            }
            .cards, .shop-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }
            .event {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 620px) {
            body {
                background-attachment: scroll;
                overflow-x: hidden;
            }
            .nav {
                padding: 12px 14px;
            }
            .nav.scrolled {
                padding: 10px 14px;
            }
            .nav-actions {
                flex-shrink: 0;
                gap: 8px;
            }
            .brand {
                gap: 8px;
                letter-spacing: .04em;
            }
            .brand-mark {
                height: 32px;
                width: 32px;
            }
            .icon-button, .cart-link {
                min-height: 40px;
                width: 40px;
            }
            .pill-button, .outline-button {
                min-height: 44px;
                padding: 0 14px;
            }
            .hero {
                min-height: 88svh;
            }
            .hero::before {
                background:
                    linear-gradient(90deg, rgba(8, 7, 6, .82), rgba(8, 7, 6, .34) 62%, rgba(8, 7, 6, .18)),
                    linear-gradient(0deg, rgba(8, 7, 6, .78), transparent 42%);
            }
            .hero-content {
                max-width: 100%;
                padding: 18svh 18px 112px;
            }
            .hero-content::before {
                height: 74px;
                left: 18px;
                top: 13vh;
            }
            h1 {
                font-size: clamp(42px, 14vw, 64px);
                line-height: 1;
            }
            .hero p {
                font-size: 16px;
                line-height: 1.55;
                margin: 18px 0 26px;
            }
            .hero-note {
                display: none;
            }
            .scroll-cue {
                bottom: 18px;
                left: 18px;
                right: auto;
            }
            section {
                padding: 58px 18px;
            }
            .section-head {
                gap: 14px;
                margin-bottom: 26px;
            }
            .section-head h2 {
                font-size: clamp(34px, 11vw, 48px);
            }
            .filters {
                display: grid;
                grid-template-columns: repeat(2, minmax(0, 1fr));
                width: 100%;
            }
            .filter {
                min-height: 44px;
                padding: 9px 10px;
                width: 100%;
            }
            .art-grid {
                columns: 1;
            }
            .art-overlay {
                opacity: 1;
                padding: 58px 16px 16px;
                transform: none;
            }
            .art-card:hover,
            .card:hover,
            .shop-card:hover {
                transform: none;
            }
            .stats, .cards, .shop-grid {
                grid-template-columns: 1fr;
            }
            .stat strong {
                font-size: 34px;
            }
            .card-body,
            .shop-card div,
            .catalog-panel,
            form {
                padding: 18px;
            }
            .immersive {
                gap: 22px;
            }
            .tour-stage {
                aspect-ratio: auto;
                min-height: 420px;
            }
            .hotspot {
                height: 38px;
                width: 38px;
            }
            .tour-rooms {
                grid-template-columns: 1fr;
            }
            .contact-form-grid {
                grid-template-columns: 1fr;
            }
            .tour-caption {
                align-items: start;
                flex-direction: column;
                gap: 10px;
                padding: 16px;
            }
            .testimonial {
                grid-template-columns: 1fr;
            }
            .shop-actions,
            .lightbox-actions {
                display: grid;
                grid-template-columns: 1fr;
            }
            .shop-actions form,
            .shop-actions a,
            .shop-actions button,
            .lightbox-actions > * {
                width: 100%;
            }
            .lightbox {
                padding: 10px;
            }
            .lightbox.open {
                align-items: start;
                place-items: start stretch;
            }
            .lightbox-shell {
                gap: 12px;
                height: auto;
                max-height: calc(100svh - 20px);
                width: 100%;
            }
            .lightbox-stage {
                min-height: 48svh;
            }
            .lightbox-panel {
                padding: 18px;
            }
            .lightbox-panel h2 {
                font-size: clamp(30px, 10vw, 42px);
            }
            .lightbox-meta div {
                grid-template-columns: 1fr;
            }
            .lightbox-close {
                right: 10px;
                top: 10px;
            }
            .lightbox-prev {
                left: 10px;
            }
            .lightbox-next {
                right: 10px;
            }
            footer {
                padding: 28px 18px;
            }
            .reveal,
            .reveal .section-head .eyebrow,
            .reveal .section-head h2,
            .reveal .section-head > p,
            .reveal > .eyebrow,
            .reveal > h2,
            .reveal > p,
            .reveal .filters,
            .reveal .about-image,
            .reveal .about-copy,
            .reveal .tour,
            .reveal .catalog-hero,
            .reveal .catalog-panel,
            .reveal .testimonial-carousel,
            .reveal.contact > div,
            .reveal.contact > form {
                animation: none !important;
                opacity: 1 !important;
                transform: none !important;
            }
            .reveal .card,
            .reveal .art-card,
            .reveal .shop-card,
            .reveal .event {
                animation: none !important;
                opacity: 1;
                transform: none;
            }
        }
    </style>
</head>
<body>
    <nav class="nav">
        <a class="brand" href="#inicio" aria-label="Lumen Art Gallery">
            <span class="brand-mark">L</span>
            <span>Lumen Art Gallery</span>
        </a>
        <div class="nav-links">
            <a href="#galeria">Obras</a>
            <a href="#artistas">Artistas</a>
            <a href="#eventos">Eventos</a>
            <a href="#tienda">Tienda</a>
            <a href="#contacto">Contacto</a>
        </div>
        <div class="nav-actions">
            <a class="icon-button cart-link" href="{{ route('cart.index') }}" aria-label="Ver carrito">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                    <path d="M6 6h15l-1.5 8.5H8L6 3H3"></path>
                    <circle cx="9" cy="20" r="1.5"></circle>
                    <circle cx="18" cy="20" r="1.5"></circle>
                </svg>
                <span class="cart-badge">{{ array_sum(session('cart', [])) }}</span>
            </a>
            <button class="icon-button" id="themeToggle" aria-label="Cambiar tema">◐</button>
        </div>
    </nav>

    <header class="hero" id="inicio">
        <img class="hero-media" src="{{ asset('images/lumen-hero-cinematic.png') }}" alt="Recepcion cinematografica de una galeria contemporanea con marmol, luz suave y arte abstracto">
        <div class="hero-content">
            <p class="eyebrow">Contemporary Art Gallery</p>
            <h1>Lumen Art Gallery</h1>
            <p>Una experiencia curada para descubrir obras contemporáneas, artistas emergentes y piezas exclusivas con una mirada sofisticada.</p>
            <a class="pill-button" href="#galeria">Explorar Colección</a>
        </div>
        <div class="hero-note" aria-hidden="true">
            Apertura privada
            <strong>Temporada 2026</strong>
        </div>
        <a class="scroll-cue" href="#sobre">Desplazar</a>
    </header>

    <main>
        <section id="sobre" class="reveal">
            <div class="section-head">
                <div>
                    <p class="eyebrow">Sobre la galería</p>
                    <h2>Arte, luz y silencio cuidadosamente compuestos.</h2>
                </div>
                <p>Lumen nace como un espacio para coleccionistas, artistas y visitantes que buscan una relación íntima con la obra. Cada sala está diseñada para que el arte respire y tenga protagonismo absoluto.</p>
            </div>
            <div class="about-grid">
                <img class="about-image" src="https://images.unsplash.com/photo-1545989253-02cc26577f88?auto=format&fit=crop&w=1400&q=85" alt="Visitantes observando obras en una galería moderna" loading="lazy">
                <div class="about-copy">
                    <p>La filosofía de Lumen combina curaduría contemporánea, tecnología visual y una experiencia de compra discreta. El sitio está pensado como una galería digital inmersiva, responsiva y lista para crecer hacia una tienda real.</p>
                    <div class="stats">
                        <div class="stat"><strong data-count="500">0</strong><span>Obras exhibidas</span></div>
                        <div class="stat"><strong data-count="50">0</strong><span>Artistas</span></div>
                        <div class="stat"><strong data-count="10">0</strong><span>Años</span></div>
                    </div>
                </div>
            </div>
        </section>

        <section id="galeria" class="reveal">
            <div class="section-head">
                <div>
                    <p class="eyebrow">Obras destacadas</p>
                    <h2>Colección seleccionada.</h2>
                </div>
            </div>
            <div class="filters">
                <button class="filter active" data-filter="all" aria-pressed="true">Todo</button>
                <button class="filter" data-filter="abstracto" aria-pressed="false">Abstracto</button>
                <button class="filter" data-filter="moderno" aria-pressed="false">Moderno</button>
                <button class="filter" data-filter="digital" aria-pressed="false">Digital</button>
                <button class="filter" data-filter="escultura" aria-pressed="false">Escultura</button>
                <button class="filter" data-filter="fotografia" aria-pressed="false">Fotografía</button>
            </div>
            <div class="art-grid">
                @foreach ($artworks as $artwork)
                    <article
                        class="art-card"
                        data-category="{{ $artwork->category }}"
                        data-title="{{ e($artwork->title) }}"
                        data-artist="{{ e($artwork->artist?->name) }}"
                        data-price="{{ e($artwork->price) }}"
                        data-technique="{{ e($artwork->technique) }}"
                        data-dimensions="{{ e($artwork->dimensions) }}"
                        data-year="{{ e($artwork->year) }}"
                        data-availability="{{ e($artwork->availability) }}"
                        data-description="{{ e($artwork->description) }}"
                        data-image="{{ e($artwork->image_url) }}"
                        data-detail-url="{{ route('artworks.show', $artwork->slug) }}"
                        role="button"
                        tabindex="0"
                        style="--ratio: {{ $loop->iteration % 2 === 0 ? '4 / 3' : '4 / 5' }}; --stagger: {{ $loop->index }}"
                    >
                        <img src="{{ $artwork->image_url }}" alt="{{ $artwork->title }} de {{ $artwork->artist?->name }}" loading="lazy" onerror="this.src='https://images.unsplash.com/photo-1579783902614-a3fb3927b6a5?auto=format&fit=crop&w=900&q=85'">
                        <div class="art-overlay">
                            <strong>{{ $artwork->title }}</strong>
                            <span>{{ $artwork->artist?->name }}</span>
                            <span class="price">{{ $artwork->price }}</span>
                            <button class="outline-button lightbox-trigger" type="button">Vista museo</button>
                            <a class="outline-button" href="{{ route('artworks.show', $artwork->slug) }}">Ver detalles</a>
                        </div>
                    </article>
                @endforeach
            </div>
        </section>

        <section id="artistas" class="reveal">
            <div class="section-head">
                <div>
                    <p class="eyebrow">Artistas</p>
                    <h2>Voces visuales con presencia propia.</h2>
                </div>
            </div>
            <div class="cards">
                @forelse ($artists as $artist)
                    <article class="card" style="--stagger: {{ $loop->index }}">
                        <img src="{{ $artist->photo_url }}" alt="Retrato de {{ $artist->name }}" loading="lazy" onerror="this.src='https://images.unsplash.com/photo-1513364776144-60967b0f800f?auto=format&fit=crop&w=800&q=85'">
                        <div class="card-body">
                            <h3>{{ $artist->name }}</h3>
                            <p>{{ $artist->specialty }}. Obras clave: {{ $artist->featured_works ?: $artist->artworks_count . ' obras registradas' }}.</p>
                        </div>
                    </article>
                @empty
                    <article class="card">
                        <div class="card-body"><h3>Sin artistas</h3><p>Agrega artistas desde el panel admin para mostrarlos aqui.</p></div>
                    </article>
                @endforelse
            </div>
        </section>

        <section class="immersive reveal" id="recorrido">
            <div class="section-head">
                <p class="eyebrow">Recorrido virtual</p>
                <h2>Una visita cinematográfica desde cualquier pantalla.</h2>
                <p>Este bloque puede crecer después con video real, panoramas 360 o una experiencia interactiva en WebGL.</p>
                <a class="outline-button" href="#contacto">Iniciar recorrido</a>
            </div>
            <div class="video-frame">
                <img src="https://images.unsplash.com/photo-1577720643272-265f09367456?auto=format&fit=crop&w=1400&q=85" alt="Sala de exposición con obras iluminadas" loading="lazy">
                <span class="play">▶</span>
            </div>
            <div class="tour" aria-label="Recorrido virtual interactivo">
                <div class="tour-stage" id="tourStage">
                    <img id="tourImage" src="https://images.unsplash.com/photo-1577720643272-265f09367456?auto=format&fit=crop&w=1600&q=85" alt="Sala principal de Lumen Art Gallery" loading="lazy">
                    <div id="tourHotspots"></div>
                    <div class="tour-caption">
                        <div>
                            <h3 id="tourTitle">Sala Principal</h3>
                            <p id="tourDescription">Un espacio de bienvenida con piezas monumentales, luz controlada y una circulacion abierta.</p>
                        </div>
                    </div>
                </div>
                <div class="tour-info">
                    <strong id="hotspotTitle">Muro de recepcion</strong>
                    <p id="hotspotDescription">Selecciona un punto luminoso dentro de la sala para ver informacion curatorial.</p>
                </div>
                <div class="tour-rooms">
                    <button class="room-button active" type="button" data-room="0">Sala Principal</button>
                    <button class="room-button" type="button" data-room="1">Sala Mexicana</button>
                    <button class="room-button" type="button" data-room="2">Sala Digital</button>
                </div>
            </div>
        </section>

        <section class="reveal">
            <div class="catalog">
                <img class="catalog-hero" src="https://images.unsplash.com/photo-1515405295579-ba7b45403062?auto=format&fit=crop&w=1400&q=85" alt="Obra premium en catálogo de lujo" loading="lazy">
                <div class="catalog-panel">
                    <p class="eyebrow">Colección exclusiva</p>
                    <h2>Ediciones limitadas para coleccionistas.</h2>
                    <p>Presentación premium de piezas seleccionadas con información detallada, disponibilidad y una experiencia tipo catálogo de lujo.</p>
                    <a class="pill-button" href="#tienda">Ver catálogo</a>
                </div>
            </div>
        </section>

        <section id="eventos" class="reveal">
            <div class="section-head">
                <div>
                    <p class="eyebrow">Exposiciones y eventos</p>
                    <h2>Agenda curatorial.</h2>
                </div>
            </div>
            <div class="events">
                @forelse ($events as $event)
                    <article class="event" style="--stagger: {{ $loop->index }}">
                        <span class="event-date">{{ $event->event_date->format('d M') }}</span>
                        <div>
                            <h3>{{ $event->title }}</h3>
                            <p>{{ $event->description }}</p>
                        </div>
                        <a class="outline-button" href="#contacto">Reservar</a>
                    </article>
                @empty
                    <article class="event">
                        <span class="event-date">--</span>
                        <div><h3>Sin eventos publicados</h3><p>Agrega eventos desde el panel admin para mostrarlos aqui.</p></div>
                        <a class="outline-button" href="{{ route('admin.events.create') }}">Crear evento</a>
                    </article>
                @endforelse
            </div>
        </section>

        <section id="tienda" class="reveal">
            <div class="section-head">
                <div>
                    <p class="eyebrow">Tienda de arte</p>
                    <h2>Carrito, favoritos y disponibilidad.</h2>
                </div>
            </div>
            <div class="shop-grid">
                @forelse ($shopArtworks as $shopArtwork)
                    <article class="shop-card" style="--stagger: {{ $loop->index }}">
                        <img src="{{ $shopArtwork->image_url }}" alt="{{ $shopArtwork->title }} de {{ $shopArtwork->artist?->name }}" loading="lazy" onerror="this.src='https://images.unsplash.com/photo-1579783902614-a3fb3927b6a5?auto=format&fit=crop&w=800&q=85'">
                        <div class="card-body">
                            <h3>{{ $shopArtwork->title }}</h3>
                            <p>{{ $shopArtwork->artist?->name }} · {{ $shopArtwork->technique }}</p>
                            <strong>{{ $shopArtwork->price }}</strong>
                            <span class="availability">{{ $shopArtwork->availability }}</span>
                            <div class="shop-actions">
                                <form action="{{ route('favorites.toggle', $shopArtwork) }}" method="POST">
                                    @csrf
                                    <button class="outline-button" type="submit">{{ in_array($shopArtwork->id, session('favorites', [])) ? '♥' : '♡' }}</button>
                                </form>
                                @if ($shopArtwork->isPurchasable())
                                    <form action="{{ route('cart.add', $shopArtwork) }}" method="POST">
                                        @csrf
                                        <button class="pill-button" type="submit">Añadir</button>
                                    </form>
                                @else
                                    <a class="outline-button" href="{{ route('artworks.show', $shopArtwork->slug) }}">Consultar</a>
                                @endif
                            </div>
                        </div>
                    </article>
                @empty
                    <article class="shop-card">
                        <div class="card-body">
                            <h3>Sin obras en tienda</h3>
                            <p>Agrega precios numericos en el admin para que las obras aparezcan aqui.</p>
                        </div>
                    </article>
                @endforelse
            </div>
            <p style="margin-top: 18px;"><a class="outline-button" href="{{ route('cart.index') }}">Ver carrito</a></p>
        </section>

        <section class="reveal">
            <div class="section-head">
                <div>
                    <p class="eyebrow">Testimonios</p>
                    <h2>Miradas de coleccionistas.</h2>
                </div>
            </div>
            <div class="testimonial-carousel">
                <div class="testimonial-track">
                    <article class="testimonial active">
                        <img src="https://images.unsplash.com/photo-1517841905240-472988babdf9?auto=format&fit=crop&w=400&q=85" alt="Retrato de visitante de galeria" loading="lazy">
                        <div>
                            <h3>Mariana Keller</h3>
                            <p>"Lumen tiene una curaduria impecable. La experiencia digital conserva esa sensacion de silencio, detalle y exclusividad que uno espera de una galeria contemporanea."</p>
                        </div>
                    </article>
                    <article class="testimonial">
                        <img src="https://images.unsplash.com/photo-1508214751196-bcfd4ca60f91?auto=format&fit=crop&w=400&q=85" alt="Retrato de coleccionista" loading="lazy">
                        <div>
                            <h3>Sofia Aranda</h3>
                            <p>"El recorrido virtual ayuda a entender la escala de las obras antes de visitar la sala. Se siente elegante, claro y muy cercano al trato de una galeria privada."</p>
                        </div>
                    </article>
                    <article class="testimonial">
                        <img src="https://images.unsplash.com/photo-1506794778202-cad84cf45f1d?auto=format&fit=crop&w=400&q=85" alt="Retrato de visitante" loading="lazy">
                        <div>
                            <h3>Leonardo Mestre</h3>
                            <p>"La ficha de cada pieza, la navegacion y los detalles visuales hacen que comprar o solicitar informacion sea mucho mas natural."</p>
                        </div>
                    </article>
                </div>
                <div class="testimonial-controls" aria-label="Controles de testimonios">
                    <button class="testimonial-dot active" type="button" data-testimonial="0" aria-label="Testimonio 1"></button>
                    <button class="testimonial-dot" type="button" data-testimonial="1" aria-label="Testimonio 2"></button>
                    <button class="testimonial-dot" type="button" data-testimonial="2" aria-label="Testimonio 3"></button>
                </div>
            </div>
        </section>

        <section id="contacto" class="contact reveal">
            <div>
                <p class="eyebrow">Contacto</p>
                <h2>Agenda una visita privada.</h2>
                <p class="contact-info">Av. Reforma 180, Ciudad de México<br>Martes a domingo, 11:00 - 19:00<br>@lumenartgallery</p>
                <iframe class="map" title="Mapa de Lumen Art Gallery" loading="lazy" src="https://www.google.com/maps?q=Ciudad%20de%20Mexico&output=embed"></iframe>
            </div>
            <form class="contact-form-grid" action="{{ route('contact.store') }}" method="POST">
                @csrf

                @if (session('contact_status'))
                    <div class="contact-status full">{{ session('contact_status') }}</div>
                @endif

                @if ($errors->any())
                    <div class="contact-errors full">
                        @foreach ($errors->all() as $error)
                            <div>{{ $error }}</div>
                        @endforeach
                    </div>
                @endif

                <input type="text" name="full_name" value="{{ old('full_name') }}" placeholder="Nombre completo" autocomplete="name" required>
                <input type="email" name="email" value="{{ old('email') }}" placeholder="Correo electronico" autocomplete="email" required>
                <input type="tel" name="phone" value="{{ old('phone') }}" placeholder="Numero de telefono" autocomplete="tel" required>
                <select name="preferred_contact" aria-label="Medio de contacto preferido">
                    <option value="">Contacto preferido</option>
                    <option value="Correo" @selected(old('preferred_contact') === 'Correo')>Correo</option>
                    <option value="Telefono" @selected(old('preferred_contact') === 'Telefono')>Telefono</option>
                    <option value="WhatsApp" @selected(old('preferred_contact') === 'WhatsApp')>WhatsApp</option>
                </select>
                <select name="interest" class="full" aria-label="Tipo de consulta">
                    <option value="">Tipo de consulta</option>
                    <option value="Comprar una obra" @selected(old('interest') === 'Comprar una obra')>Comprar una obra</option>
                    <option value="Agendar visita privada" @selected(old('interest') === 'Agendar visita privada')>Agendar visita privada</option>
                    <option value="Informacion de exposiciones" @selected(old('interest') === 'Informacion de exposiciones')>Informacion de exposiciones</option>
                    <option value="Propuesta artistica" @selected(old('interest') === 'Propuesta artistica')>Propuesta artistica</option>
                    <option value="Otro" @selected(old('interest') === 'Otro')>Otro</option>
                </select>
                <input class="full" type="text" name="subject" value="{{ old('subject') }}" placeholder="Asunto" required>
                <textarea class="full" name="message" placeholder="Cuentanos que obra, artista o visita te interesa" required>{{ old('message') }}</textarea>
                <label class="privacy-check full">
                    <input type="checkbox" name="privacy" value="1" required @checked(old('privacy'))>
                    <span>Acepto que Lumen Art Gallery use mis datos para responder esta solicitud de contacto.</span>
                </label>
                <button class="pill-button full" type="submit">Enviar mensaje</button>
            </form>
        </section>
    </main>

    <footer>
        Lumen Art Gallery · Galería contemporánea · Proyecto Laravel
    </footer>

    <div class="lightbox" id="lightbox" aria-hidden="true" role="dialog" aria-modal="true" aria-label="Vista ampliada de obra">
        <div class="lightbox-shell">
            <div class="lightbox-stage">
                <button class="lightbox-close" type="button" aria-label="Cerrar">×</button>
                <button class="lightbox-nav lightbox-prev" type="button" aria-label="Obra anterior">‹</button>
                <img id="lightboxImage" src="" alt="Vista ampliada de obra">
                <button class="lightbox-nav lightbox-next" type="button" aria-label="Obra siguiente">›</button>
            </div>
            <aside class="lightbox-panel">
                <p class="eyebrow">Vista museo</p>
                <h2 id="lightboxTitle"></h2>
                <p id="lightboxArtist"></p>
                <div class="lightbox-meta">
                    <div><span>Tecnica</span><strong id="lightboxTechnique"></strong></div>
                    <div><span>Medidas</span><strong id="lightboxDimensions"></strong></div>
                    <div><span>Año</span><strong id="lightboxYear"></strong></div>
                    <div><span>Precio</span><strong id="lightboxPrice"></strong></div>
                    <div><span>Estado</span><strong id="lightboxAvailability"></strong></div>
                </div>
                <p id="lightboxDescription"></p>
                <div class="lightbox-actions">
                    <button class="lightbox-zoom" id="lightboxZoom" type="button">Zoom</button>
                    <a class="pill-button" id="lightboxDetails" href="#">Ver detalles</a>
                </div>
            </aside>
        </div>
    </div>

    <script>
        const root = document.documentElement;
        const themeToggle = document.querySelector('#themeToggle');
        const savedTheme = localStorage.getItem('lumen-theme');
        const nav = document.querySelector('.nav');
        const heroMedia = document.querySelector('.hero-media');

        if (savedTheme) {
            root.dataset.theme = savedTheme;
        }

        themeToggle.addEventListener('click', () => {
            const next = root.dataset.theme === 'dark' ? 'light' : 'dark';
            root.dataset.theme = next;
            localStorage.setItem('lumen-theme', next);
        });

        function updateScrollEffects() {
            const scrollY = window.scrollY;
            nav.classList.toggle('scrolled', scrollY > 40);
            if (heroMedia) {
                heroMedia.style.transform = `scale(1.08) translateY(${Math.min(scrollY * 0.07, 42)}px)`;
            }
        }

        window.addEventListener('scroll', updateScrollEffects, { passive: true });
        updateScrollEffects();

        const revealSections = document.querySelectorAll('.reveal');

        if ('IntersectionObserver' in window) {
            const observer = new IntersectionObserver((entries) => {
                entries.forEach((entry) => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('visible');
                        if (entry.target.id === 'sobre') animateStats();
                    }
                });
            }, { threshold: .08, rootMargin: '0px 0px -8% 0px' });

            revealSections.forEach((item) => observer.observe(item));
        } else {
            revealSections.forEach((item) => item.classList.add('visible'));
        }

        let statsDone = false;
        function animateStats() {
            if (statsDone) return;
            statsDone = true;
            document.querySelectorAll('[data-count]').forEach((el) => {
                const target = Number(el.dataset.count);
                let current = 0;
                const step = Math.max(1, Math.floor(target / 50));
                const timer = setInterval(() => {
                    current += step;
                    if (current >= target) {
                        current = target;
                        clearInterval(timer);
                    }
                    el.textContent = current + '+';
                }, 24);
            });
        }

        document.querySelectorAll('.filter').forEach((button) => {
            button.addEventListener('click', () => {
                document.querySelector('.art-grid')?.classList.add('filter-mode');
                document.querySelectorAll('.filter').forEach((item) => {
                    item.classList.remove('active');
                    item.setAttribute('aria-pressed', 'false');
                });
                button.classList.add('active');
                button.setAttribute('aria-pressed', 'true');
                const filter = button.dataset.filter;
                const cards = Array.from(document.querySelectorAll('.art-card'));
                let visibleIndex = 0;

                cards.forEach((card) => {
                    const shouldShow = filter === 'all' || card.dataset.category === filter;

                    if (shouldShow) {
                        card.style.display = 'block';
                        card.classList.remove('is-filtered-out');
                        card.classList.remove('is-filtering-in');
                        card.style.setProperty('--filter-stagger', visibleIndex);
                        visibleIndex += 1;

                        requestAnimationFrame(() => {
                            card.classList.add('is-filtering-in');
                        });

                        window.setTimeout(() => {
                            card.classList.remove('is-filtering-in');
                        }, 760);

                        return;
                    }

                    card.classList.add('is-filtered-out');
                    card.classList.remove('is-filtering-in');

                    window.setTimeout(() => {
                        if (card.classList.contains('is-filtered-out')) {
                            card.style.display = 'none';
                        }
                    }, 280);
                });
            });
        });

        const tourRooms = [
            {
                title: 'Sala Principal',
                description: 'Un espacio de bienvenida con piezas monumentales, luz controlada y una circulacion abierta.',
                image: 'https://images.unsplash.com/photo-1577720643272-265f09367456?auto=format&fit=crop&w=1600&q=85',
                alt: 'Sala principal de Lumen Art Gallery',
                hotspots: [
                    { x: '28%', y: '48%', title: 'Muro de recepcion', description: 'Punto inicial del recorrido, ideal para orientar al visitante y presentar la curaduria general.' },
                    { x: '54%', y: '38%', title: 'Obra central', description: 'Una pieza de gran formato colocada como eje visual para marcar el ritmo de la visita.' },
                    { x: '76%', y: '56%', title: 'Acceso lateral', description: 'Conexion hacia salas de coleccion permanente y exposiciones temporales.' },
                ],
            },
            {
                title: 'Sala Mexicana',
                description: 'Una sala dedicada a pintura mexicana moderna, obra en papel y dialogos curatoriales con artistas historicos.',
                image: 'https://images.unsplash.com/photo-1554188248-986adbb73be4?auto=format&fit=crop&w=1600&q=85',
                alt: 'Sala mexicana con obras contemporaneas',
                hotspots: [
                    { x: '24%', y: '42%', title: 'Linea moderna', description: 'Agrupacion de obras inspiradas en Rivera, Tamayo, Siqueiros, Izquierdo y Kahlo.' },
                    { x: '51%', y: '52%', title: 'Mesa documental', description: 'Material de sala con fichas curatoriales, tecnicas, procedencias y referencias historicas.' },
                    { x: '81%', y: '40%', title: 'Pieza destacada', description: 'Obra seleccionada para venta privada o consulta especializada con el equipo de galeria.' },
                ],
            },
            {
                title: 'Sala Digital',
                description: 'Ambiente inmersivo para videoarte, piezas generativas y experiencias audiovisuales de coleccion.',
                image: 'https://images.unsplash.com/photo-1634986666676-ec8fd927c23d?auto=format&fit=crop&w=1600&q=85',
                alt: 'Sala digital inmersiva con visuales contemporaneos',
                hotspots: [
                    { x: '34%', y: '46%', title: 'Proyeccion envolvente', description: 'Pantalla principal para videoarte, animacion generativa y piezas audiovisuales.' },
                    { x: '58%', y: '35%', title: 'Hotspot interactivo', description: 'Punto pensado para activar informacion, audio de artista o vista ampliada de obra.' },
                    { x: '73%', y: '63%', title: 'Zona de descanso', description: 'Espacio de pausa para observar ciclos audiovisuales sin interrumpir la experiencia.' },
                ],
            },
        ];

        const tourStage = document.querySelector('#tourStage');
        const tourImage = document.querySelector('#tourImage');
        const tourTitle = document.querySelector('#tourTitle');
        const tourDescription = document.querySelector('#tourDescription');
        const tourHotspots = document.querySelector('#tourHotspots');
        const hotspotTitle = document.querySelector('#hotspotTitle');
        const hotspotDescription = document.querySelector('#hotspotDescription');

        function renderTourRoom(index) {
            const room = tourRooms[index];
            tourStage.classList.add('changing');
            document.querySelectorAll('.room-button').forEach((button) => {
                button.classList.toggle('active', Number(button.dataset.room) === index);
            });

            window.setTimeout(() => {
                tourImage.src = room.image;
                tourImage.alt = room.alt;
                tourTitle.textContent = room.title;
                tourDescription.textContent = room.description;
                tourHotspots.innerHTML = '';

                room.hotspots.forEach((hotspot, hotspotIndex) => {
                    const button = document.createElement('button');
                    button.type = 'button';
                    button.className = 'hotspot';
                    button.style.setProperty('--x', hotspot.x);
                    button.style.setProperty('--y', hotspot.y);
                    button.textContent = hotspotIndex + 1;
                    button.setAttribute('aria-label', hotspot.title);
                    button.addEventListener('click', () => {
                        document.querySelectorAll('.hotspot').forEach((item) => item.classList.remove('active'));
                        button.classList.add('active');
                        hotspotTitle.textContent = hotspot.title;
                        hotspotDescription.textContent = hotspot.description;
                    });
                    tourHotspots.appendChild(button);
                });

                hotspotTitle.textContent = room.hotspots[0].title;
                hotspotDescription.textContent = room.hotspots[0].description;
                tourHotspots.querySelector('.hotspot')?.classList.add('active');
                tourStage.classList.remove('changing');
            }, 180);
        }

        document.querySelectorAll('.room-button').forEach((button) => {
            button.addEventListener('click', () => renderTourRoom(Number(button.dataset.room)));
        });

        if (tourStage) {
            renderTourRoom(0);
        }

        const testimonials = document.querySelectorAll('.testimonial');
        const testimonialDots = document.querySelectorAll('.testimonial-dot');
        let testimonialIndex = 0;

        function showTestimonial(index) {
            testimonialIndex = index;
            testimonials.forEach((item, itemIndex) => item.classList.toggle('active', itemIndex === index));
            testimonialDots.forEach((item, itemIndex) => item.classList.toggle('active', itemIndex === index));
        }

        testimonialDots.forEach((dot) => {
            dot.addEventListener('click', () => showTestimonial(Number(dot.dataset.testimonial)));
        });

        if (testimonials.length > 1) {
            window.setInterval(() => {
                showTestimonial((testimonialIndex + 1) % testimonials.length);
            }, 5200);
        }

        document.querySelectorAll('.pill-button, .outline-button, .icon-button, .filter').forEach((button) => {
            button.addEventListener('pointermove', (event) => {
                const rect = button.getBoundingClientRect();
                const x = event.clientX - rect.left - rect.width / 2;
                const y = event.clientY - rect.top - rect.height / 2;
                button.style.transform = `translate(${x * .03}px, ${y * .05}px)`;
            });
            button.addEventListener('pointerleave', () => {
                button.style.transform = '';
            });
        });

        const lightbox = document.querySelector('#lightbox');
        const lightboxImage = document.querySelector('#lightboxImage');
        const lightboxTitle = document.querySelector('#lightboxTitle');
        const lightboxArtist = document.querySelector('#lightboxArtist');
        const lightboxTechnique = document.querySelector('#lightboxTechnique');
        const lightboxDimensions = document.querySelector('#lightboxDimensions');
        const lightboxYear = document.querySelector('#lightboxYear');
        const lightboxPrice = document.querySelector('#lightboxPrice');
        const lightboxAvailability = document.querySelector('#lightboxAvailability');
        const lightboxDescription = document.querySelector('#lightboxDescription');
        const lightboxDetails = document.querySelector('#lightboxDetails');
        const lightboxClose = document.querySelector('.lightbox-close');
        const lightboxPrev = document.querySelector('.lightbox-prev');
        const lightboxNext = document.querySelector('.lightbox-next');
        const lightboxZoom = document.querySelector('#lightboxZoom');
        const artworkCards = Array.from(document.querySelectorAll('.art-card'));
        let currentArtworkIndex = 0;

        function visibleArtworkCards() {
            return artworkCards.filter((card) => card.style.display !== 'none' && ! card.classList.contains('is-filtered-out'));
        }

        function openArtworkLightbox(card) {
            const visibleCards = visibleArtworkCards();
            currentArtworkIndex = Math.max(0, visibleCards.indexOf(card));
            renderArtworkLightbox(visibleCards[currentArtworkIndex] || card);
            lightbox.classList.add('open');
            lightbox.classList.remove('zoomed');
            lightbox.setAttribute('aria-hidden', 'false');
            document.body.classList.add('lightbox-active');
        }

        function renderArtworkLightbox(card) {
            if (! card) return;

            lightboxImage.src = card.dataset.image;
            lightboxImage.alt = `${card.dataset.title} de ${card.dataset.artist}`;
            lightboxTitle.textContent = card.dataset.title;
            lightboxArtist.textContent = card.dataset.artist;
            lightboxTechnique.textContent = card.dataset.technique;
            lightboxDimensions.textContent = card.dataset.dimensions;
            lightboxYear.textContent = card.dataset.year;
            lightboxPrice.textContent = card.dataset.price;
            lightboxAvailability.textContent = card.dataset.availability;
            lightboxDescription.textContent = card.dataset.description;
            lightboxDetails.href = card.dataset.detailUrl;
        }

        function closeArtworkLightbox() {
            lightbox.classList.remove('open', 'zoomed');
            lightbox.setAttribute('aria-hidden', 'true');
            document.body.classList.remove('lightbox-active');
        }

        function moveArtworkLightbox(direction) {
            const visibleCards = visibleArtworkCards();
            if (! visibleCards.length) return;

            currentArtworkIndex = (currentArtworkIndex + direction + visibleCards.length) % visibleCards.length;
            lightbox.classList.remove('zoomed');
            renderArtworkLightbox(visibleCards[currentArtworkIndex]);
        }

        artworkCards.forEach((card) => {
            card.addEventListener('click', (event) => {
                if (event.target.closest('a')) return;
                openArtworkLightbox(card);
            });
            card.addEventListener('keydown', (event) => {
                if (event.key === 'Enter' || event.key === ' ') {
                    event.preventDefault();
                    openArtworkLightbox(card);
                }
            });
        });

        lightboxClose.addEventListener('click', closeArtworkLightbox);
        lightboxPrev.addEventListener('click', () => moveArtworkLightbox(-1));
        lightboxNext.addEventListener('click', () => moveArtworkLightbox(1));
        lightboxZoom.addEventListener('click', () => lightbox.classList.toggle('zoomed'));
        lightboxImage.addEventListener('click', () => lightbox.classList.toggle('zoomed'));
        lightbox.addEventListener('click', (event) => {
            if (event.target === lightbox) closeArtworkLightbox();
        });

        document.addEventListener('keydown', (event) => {
            if (! lightbox.classList.contains('open')) return;

            if (event.key === 'Escape') closeArtworkLightbox();
            if (event.key === 'ArrowLeft') moveArtworkLightbox(-1);
            if (event.key === 'ArrowRight') moveArtworkLightbox(1);
        });

        let cart = 0;
        document.querySelectorAll('.add-cart').forEach((button) => {
            button.addEventListener('click', () => {
                cart += 1;
                document.querySelector('#cartCount').textContent = cart;
            });
        });

        document.querySelectorAll('.favorite').forEach((button) => {
            button.addEventListener('click', () => {
                button.textContent = button.textContent.trim() === '♡' ? '♥' : '♡';
            });
        });
    </script>
</body>
</html>
