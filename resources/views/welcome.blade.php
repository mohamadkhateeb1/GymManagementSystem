<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Elite Club | نادي النخبة الرياضي</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@400;500;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    <style>
        :root {
            --bg: #0f1115;
            --surface: #171a21;
            --surface-2: #1d212a;
            --border: rgba(255, 255, 255, 0.08);
            --text: #f4f5f7;
            --text-soft: #b7bcc6;
            --gold: #c9a961;
            --gold-light: #e6cf91;
            --gold-dark: #a7833e;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            background: var(--bg);
            color: var(--text);
            font-family: 'Tajawal', sans-serif;
            line-height: 1.7;
            overflow-x: hidden;
        }

        a {
            text-decoration: none;
            color: inherit;
        }

        img {
            max-width: 100%;
            display: block;
        }

        .container {
            max-width: 1180px;
            margin: 0 auto;
            padding: 0 24px;
        }

        /* =========================================================
           NAVBAR
           ========================================================= */

        .navbar {
            position: sticky;
            top: 0;
            z-index: 100;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            padding: 16px 0;
            background: rgba(15, 17, 21, 0.9);
            backdrop-filter: blur(14px);
            border-bottom: 1px solid var(--border);
        }

        .navbar-inner {
            display: flex;
            align-items: center;
            justify-content: space-between;
            width: 100%;
            position: relative;
        }

        .nav-brand {
            display: flex;
            align-items: center;
            gap: 11px;
        }

        .nav-brand-icon {
            width: 42px;
            height: 42px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 12px;
            background: linear-gradient(135deg, var(--gold-light), var(--gold-dark));
            color: #171717;
            font-size: 18px;
        }

        .nav-brand-text {
            font-size: 19px;
            font-weight: 850;
            letter-spacing: .5px;
        }

        .nav-links {
            display: flex;
            align-items: center;
            gap: 28px;
        }

        .nav-links a {
            color: var(--text-soft);
            font-size: 14.5px;
            font-weight: 700;
            transition: color .2s ease;
        }

        .nav-links a:hover {
            color: var(--gold-light);
        }

        .nav-auth {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 10px 18px;
            border-radius: 10px;
            font-size: 14px;
            font-weight: 800;
            cursor: pointer;
            transition: all .2s ease;
            white-space: nowrap;
            border: 1px solid transparent;
        }

        .btn-outline {
            color: var(--text);
            background: transparent;
            border-color: var(--border);
        }

        .btn-outline:hover {
            border-color: color-mix(in srgb, var(--gold) 45%, var(--border));
            color: var(--gold-light);
        }

        .btn-gold {
            color: #171717;
            background: linear-gradient(135deg, var(--gold-light), var(--gold-dark));
            box-shadow: 0 6px 18px rgba(184, 146, 62, .22);
        }

        .btn-gold:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 26px rgba(184, 146, 62, .3);
        }

        /* =========================================================
           MOBILE NAV TOGGLE + MENU
           ========================================================= */

        .nav-toggle {
            display: none;
            width: 42px;
            height: 42px;
            align-items: center;
            justify-content: center;
            border-radius: 10px;
            border: 1px solid var(--border);
            background: transparent;
            color: var(--text);
            font-size: 18px;
            cursor: pointer;
            flex-shrink: 0;
        }

        .mobile-menu {
            display: none;
            position: absolute;
            top: calc(100% + 12px);
            left: 0;
            right: 0;
            flex-direction: column;
            gap: 4px;
            padding: 16px;
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: 14px;
            box-shadow: 0 18px 40px rgba(0, 0, 0, .35);
        }

        .mobile-menu.open {
            display: flex;
        }

        .mobile-menu a {
            padding: 12px 10px;
            border-radius: 9px;
            color: var(--text);
            font-size: 15px;
            font-weight: 700;
            transition: background .18s ease, color .18s ease;
        }

        .mobile-menu a:hover {
            background: color-mix(in srgb, var(--gold) 8%, transparent);
            color: var(--gold-light);
        }

        .mobile-menu .btn {
            margin-top: 6px;
            width: 100%;
        }

        /* =========================================================
           HERO
           ========================================================= */

        .hero {
            position: relative;
            padding: 100px 0 90px;
            overflow: hidden;
            text-align: center;
        }

        .hero::before {
            content: "";
            position: absolute;
            top: -180px;
            left: 50%;
            transform: translateX(-50%);
            width: 700px;
            height: 700px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(201, 169, 97, .12), transparent 65%);
            pointer-events: none;
        }

        .hero-kicker {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 8px 16px;
            margin-bottom: 22px;
            border-radius: 999px;
            background: rgba(201, 169, 97, .08);
            border: 1px solid rgba(201, 169, 97, .22);
            color: var(--gold-light);
            font-size: 13px;
            font-weight: 700;
        }

        .hero h1 {
            position: relative;
            font-size: 52px;
            font-weight: 900;
            line-height: 1.3;
            margin-bottom: 20px;
        }

        .hero h1 span {
            color: var(--gold-light);
        }

        .hero p {
            position: relative;
            max-width: 620px;
            margin: 0 auto 34px;
            color: var(--text-soft);
            font-size: 17px;
            font-weight: 500;
        }

        .hero-actions {
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 14px;
            flex-wrap: wrap;
        }

        .hero-actions .btn {
            padding: 15px 30px;
            font-size: 15.5px;
        }

        /* =========================================================
           STATS
           ========================================================= */

        .stats {
            padding: 40px 0;
            border-top: 1px solid var(--border);
            border-bottom: 1px solid var(--border);
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
            text-align: center;
        }

        .stat-value {
            font-size: 34px;
            font-weight: 900;
            color: var(--gold-light);
        }

        .stat-label {
            margin-top: 6px;
            color: var(--text-soft);
            font-size: 14px;
            font-weight: 600;
        }

        /* =========================================================
           SECTION HEADER (shared)
           ========================================================= */

        .section {
            padding: 90px 0;
        }

        .section-header {
            text-align: center;
            max-width: 620px;
            margin: 0 auto 56px;
        }

        .section-kicker {
            display: inline-block;
            margin-bottom: 14px;
            color: var(--gold);
            font-size: 13.5px;
            font-weight: 800;
            letter-spacing: 1px;
            text-transform: uppercase;
        }

        .section-header h2 {
            font-size: 34px;
            font-weight: 850;
            margin-bottom: 14px;
        }

        .section-header p {
            color: var(--text-soft);
            font-size: 15.5px;
            font-weight: 500;
        }

        /* =========================================================
           FEATURES
           ========================================================= */

        .features-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 22px;
        }

        .feature-card {
            padding: 32px 26px;
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: 18px;
            transition: transform .25s ease, border-color .25s ease, box-shadow .25s ease;
        }

        .feature-card:hover {
            transform: translateY(-6px);
            border-color: color-mix(in srgb, var(--gold) 30%, var(--border));
            box-shadow: 0 20px 45px rgba(0, 0, 0, .28);
        }

        .feature-icon {
            width: 56px;
            height: 56px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 15px;
            margin-bottom: 20px;
            background: color-mix(in srgb, var(--gold) 10%, var(--surface-2));
            border: 1px solid color-mix(in srgb, var(--gold) 20%, var(--border));
            color: var(--gold-light);
            font-size: 23px;
        }

        .feature-card h3 {
            font-size: 18.5px;
            font-weight: 800;
            margin-bottom: 10px;
        }

        .feature-card p {
            color: var(--text-soft);
            font-size: 14.5px;
            font-weight: 500;
            line-height: 1.8;
        }

        /* =========================================================
           ABOUT / IMAGE SPLIT
           ========================================================= */

        .about-split {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 50px;
            align-items: center;
        }

        .about-media {
            position: relative;
            border-radius: 22px;
            overflow: hidden;
            aspect-ratio: 4/3;
            background: linear-gradient(135deg, var(--surface-2), var(--surface));
            border: 1px solid var(--border);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .about-media i {
            font-size: 90px;
            color: color-mix(in srgb, var(--gold) 55%, var(--surface));
            opacity: .5;
        }

        .about-text h2 {
            font-size: 32px;
            font-weight: 850;
            margin-bottom: 18px;
        }

        .about-text p {
            color: var(--text-soft);
            font-size: 15.5px;
            font-weight: 500;
            margin-bottom: 22px;
        }

        .about-list {
            list-style: none;
            display: flex;
            flex-direction: column;
            gap: 13px;
        }

        .about-list li {
            display: flex;
            align-items: center;
            gap: 11px;
            font-size: 14.5px;
            font-weight: 700;
        }

        .about-list i {
            color: var(--gold);
            font-size: 15px;
        }

        /* =========================================================
           CTA
           ========================================================= */

        .cta {
            text-align: center;
            padding: 80px 0;
            background: linear-gradient(160deg, color-mix(in srgb, var(--gold) 8%, var(--surface)), var(--surface));
            border-top: 1px solid var(--border);
            border-bottom: 1px solid var(--border);
        }

        .cta h2 {
            font-size: 30px;
            font-weight: 850;
            margin-bottom: 14px;
        }

        .cta p {
            color: var(--text-soft);
            font-size: 15.5px;
            margin-bottom: 30px;
        }

        /* =========================================================
           FOOTER
           ========================================================= */

        .footer {
            padding: 40px 0;
            text-align: center;
        }

        .footer-brand {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 9px;
            margin-bottom: 12px;
            font-size: 16px;
            font-weight: 800;
        }

        .footer p {
            color: var(--text-soft);
            font-size: 13px;
        }

        /* =========================================================
           RESPONSIVE
           ========================================================= */

        @media (max-width: 900px) {
            .nav-links {
                display: none;
            }

            .nav-auth {
                display: none;
            }

            .nav-toggle {
                display: flex;
            }

            .hero h1 {
                font-size: 38px;
            }

            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 26px;
            }

            .features-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .about-split {
                grid-template-columns: 1fr;
            }

            .about-media {
                order: -1;
            }
        }

        @media (max-width: 640px) {
            .features-grid {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 560px) {
            .hero {
                padding: 60px 0 50px;
            }

            .hero h1 {
                font-size: 28px;
            }

            .hero p {
                font-size: 14.5px;
            }

            .hero-actions {
                flex-direction: column;
                align-items: stretch;
            }

            .hero-actions .btn {
                width: 100%;
            }

            .section {
                padding: 50px 0;
            }

            .section-header {
                margin-bottom: 38px;
            }

            .section-header h2 {
                font-size: 24px;
            }

            .section-header p {
                font-size: 14px;
            }

            .stats {
                padding: 28px 0;
            }

            .stats-grid {
                gap: 20px;
            }

            .stat-value {
                font-size: 24px;
            }

            .stat-label {
                font-size: 12px;
            }

            .feature-card {
                padding: 24px 20px;
            }

            .about-text h2 {
                font-size: 24px;
            }

            .about-media i {
                font-size: 60px;
            }

            .cta {
                padding: 55px 0;
            }

            .cta h2 {
                font-size: 22px;
            }
        }

        @media (max-width: 380px) {
            .nav-brand-text {
                font-size: 16px;
            }

            .nav-brand-icon {
                width: 36px;
                height: 36px;
                font-size: 15px;
            }
        }
    </style>
</head>

<body>

    {{-- =========================================================
         NAVBAR
    ========================================================== --}}
    <nav class="navbar">
        <div class="container navbar-inner">
            <a href="/" class="nav-brand">
                <div class="nav-brand-icon"><i class="fas fa-crown"></i></div>
                <span class="nav-brand-text">ELITE CLUB</span>
            </a>

            <div class="nav-links">
                <a href="#about">من نحن</a>
                <a href="#features">خدماتنا</a>
                <a href="#cta">تواصل معنا</a>
            </div>

            <div class="nav-auth">
                <a href="/employee/login" class="btn btn-outline"><i class="fas fa-user-tie"></i> <span>دخول
                        المدربين</span></a>
                <a href="/admin/login" class="btn btn-outline"><i class="fas fa-user-shield"></i> <span>دخول
                        الإدارة</span></a>
            </div>

            <button type="button" class="nav-toggle" id="navToggle" aria-label="فتح القائمة">
                <i class="fas fa-bars"></i>
            </button>

            <div class="mobile-menu" id="mobileMenu">
                <a href="#about">من نحن</a>
                <a href="#features">خدماتنا</a>
                <a href="#cta">تواصل معنا</a>
                <a href="/employee/login" class="btn btn-outline"><i class="fas fa-user-tie"></i> دخول المدربين</a>
                <a href="/admin/login" class="btn btn-outline"><i class="fas fa-user-shield"></i> دخول الإدارة</a>
            </div>
        </div>
    </nav>

    {{-- =========================================================
         HERO
    ========================================================== --}}
    <header class="hero">
        <div class="container">
            <span class="hero-kicker"><i class="fas fa-dumbbell"></i> نادي النخبة الرياضي</span>
            <h1>ابنِ جسدك، وارتقِ بنفسك<br>مع <span>Elite Club</span></h1>
            <p>منظومة متكاملة لإدارة تدريبك ونظامك الغذائي، بمتابعة حقيقية من نخبة المدربين، وتقنية حديثة تواكب طموحك
                خطوة بخطوة.</p>
            <div class="hero-actions">
                <a href="#features" class="btn btn-gold"><i class="fas fa-circle-info"></i> تعرّف على خدماتنا</a>
                <a href="#cta" class="btn btn-outline"><i class="fas fa-phone"></i> تواصل معنا</a>
            </div>
        </div>
    </header>

    {{-- =========================================================
         STATS
    ========================================================== --}}
    <section class="stats">
        <div class="container">
            <div class="stats-grid">
                <div>
                    <div class="stat-value">+500</div>
                    <div class="stat-label">عضو نشط</div>
                </div>
                <div>
                    <div class="stat-value">+20</div>
                    <div class="stat-label">مدرب محترف</div>
                </div>
                <div>
                    <div class="stat-value">+8</div>
                    <div class="stat-label">سنوات خبرة</div>
                </div>
                <div>
                    <div class="stat-value">24/7</div>
                    <div class="stat-label">متابعة مستمرة</div>
                </div>
            </div>
        </div>
    </section>

    {{-- =========================================================
         FEATURES
    ========================================================== --}}
    <section class="section" id="features">
        <div class="container">
            <div class="section-header">
                <span class="section-kicker">خدماتنا</span>
                <h2>كل ما تحتاجه بمكان واحد</h2>
                <p>من التدريب الشخصي إلى المتابعة الغذائية، صمّمنا كل تفصيلة لخدمة هدفك.</p>
            </div>

            <div class="features-grid">
                <div class="feature-card">
                    <div class="feature-icon"><i class="fas fa-dumbbell"></i></div>
                    <h3>خطط تدريبية مخصصة</h3>
                    <p>برامج تدريب مصممة حسب مستواك وهدفك، مع متابعة أسبوعية من مدربك الشخصي.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon"><i class="fas fa-apple-alt"></i></div>
                    <h3>أنظمة غذائية متكاملة</h3>
                    <p>خطط غذائية متوازنة تتناسب مع أهدافك، محسوبة بدقة من حيث السعرات والماكروز.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon"><i class="fas fa-chart-line"></i></div>
                    <h3>متابعة وتتبّع التقدّم</h3>
                    <p>سجّل حضورك وتابع تطوّر جسدك وأدائك أولاً بأول عبر تطبيقك الخاص.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon"><i class="fas fa-user-tie"></i></div>
                    <h3>مدربون معتمدون</h3>
                    <p>نخبة من المدربين المحترفين بخبرة طويلة بمختلف التخصصات الرياضية.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon"><i class="fas fa-bell"></i></div>
                    <h3>إشعارات وتذكيرات فورية</h3>
                    <p>تنبيهات لحظية باقتراب أو انتهاء اشتراكك، ومواعيد جلساتك، بلا أي تفويت.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon"><i class="fas fa-mobile-screen"></i></div>
                    <h3>تطبيق جوّال مخصص</h3>
                    <p>تابع كل شي من مكانك — تمارينك، وجباتك، واشتراكك — بضغطة واحدة.</p>
                </div>
            </div>
        </div>
    </section>

    {{-- =========================================================
         ABOUT
    ========================================================== --}}
    <section class="section" id="about">
        <div class="container">
            <div class="about-split">
                <div class="about-media">
                    <i class="fas fa-crown"></i>
                </div>
                <div class="about-text">
                    <h2>لماذا Elite Club؟</h2>
                    <p>مش مجرد نادي رياضي — إحنا منظومة متكاملة بتجمع بين الخبرة البشرية والتقنية الحديثة، لنوصلك لهدفك
                        بأقصر وقت وأعلى كفاءة.</p>
                    <ul class="about-list">
                        <li><i class="fas fa-check-circle"></i> متابعة يومية حقيقية من مدربك</li>
                        <li><i class="fas fa-check-circle"></i> إدارة كاملة لاشتراكك ودفعاتك</li>
                        <li><i class="fas fa-check-circle"></i> بيئة تدريب احترافية ومجهزة بالكامل</li>
                        <li><i class="fas fa-check-circle"></i> دعم فني ومتابعة مستمرة عبر التطبيق</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    {{-- =========================================================
         CTA
    ========================================================== --}}
    <section class="cta" id="cta">
        <div class="container">
            <h2>جاهز تبدأ التحوّل؟</h2>
            <p>زور النادي أو تواصل معنا للاستفسار عن الاشتراكات والخطط المتاحة.</p>
            <a href="tel:+000000000" class="btn btn-gold" style="padding:16px 34px; font-size:16px;">
                <i class="fas fa-phone"></i> تواصل معنا الآن
            </a>
        </div>
    </section>

    {{-- =========================================================
         FOOTER
    ========================================================== --}}
    <footer class="footer">
        <div class="container">
            <div class="footer-brand">
                <i class="fas fa-crown" style="color: var(--gold-light);"></i> ELITE CLUB
            </div>
            <p>© {{ date('Y') }} Elite Club. جميع الحقوق محفوظة.</p>
        </div>
    </footer>

    <script>
        const navToggle = document.getElementById('navToggle');
        const mobileMenu = document.getElementById('mobileMenu');

        navToggle.addEventListener('click', function() {
            mobileMenu.classList.toggle('open');
            const icon = navToggle.querySelector('i');
            icon.classList.toggle('fa-bars');
            icon.classList.toggle('fa-xmark');
        });

        // إغلاق القائمة تلقائياً عند الضغط على أي رابط جوّاها
        mobileMenu.querySelectorAll('a').forEach(function(link) {
            link.addEventListener('click', function() {
                mobileMenu.classList.remove('open');
                navToggle.querySelector('i').classList.add('fa-bars');
                navToggle.querySelector('i').classList.remove('fa-xmark');
            });
        });
    </script>

</body>

</html>
