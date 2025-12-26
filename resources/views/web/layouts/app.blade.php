<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ trans('route.dir') }}">
<head>
    <meta charset="UTF-8">
    <link rel="icon" href="{{ getSettingImageLink('logo_favicon') }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', config('app.name'))</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <!-- Boxicons -->
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Flag Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flag-icons@7.0.0/css/flag-icons.min.css">
    <!-- AOS Animation -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <!-- Fancybox CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.css" />
    
    <style>
        :root {
            --primary-color: #8B5A3C;
            --secondary-color: #D4A574;
            --text-dark: #2C2C2C;
            --text-light: #6C6C6C;
            --gold: #D4AF37;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Cairo', 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: var(--text-dark);
            line-height: 1.8;
        }
        
        .navbar {
            background: #fff !important;
            box-shadow: 0 2px 20px rgba(0,0,0,0.08);
            padding: 1.2rem 0;
            transition: all 0.3s;
        }
        
        .navbar.scrolled {
            padding: 0.8rem 0;
            box-shadow: 0 2px 15px rgba(0,0,0,0.1);
        }
        
        .navbar-brand {
            font-weight: 800;
            font-size: 1.8rem;
            color: var(--primary-color) !important;
            letter-spacing: -0.5px;
        }
        
        .nav-link {
            color: var(--text-dark) !important;
            font-weight: 600;
            margin: 0 0.8rem;
            transition: all 0.3s;
            position: relative;
            font-size: 1rem;
        }
        
        .nav-link::after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            bottom: -5px;
            left: 50%;
            background: var(--primary-color);
            transition: all 0.3s;
            transform: translateX(-50%);
        }
        
        .nav-link:hover::after,
        .nav-link.active::after {
            width: 100%;
        }
        
        .nav-link:hover {
            color: var(--primary-color) !important;
        }
        
        .language-switcher {
            border: 2px solid var(--primary-color);
            border-radius: 50px;
            padding: 0.5rem 1.2rem;
            text-decoration: none;
            color: var(--primary-color);
            font-weight: 600;
            transition: all 0.3s;
            display: inline-flex;
            align-items: center;
        }
        
        .language-switcher:hover {
            background: var(--primary-color);
            color: #fff;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(139, 90, 60, 0.3);
        }
        
        .language-switcher.dropdown-toggle::after {
            margin-left: 0.5rem;
        }
        
        .dropdown-menu .dropdown-item {
            display: flex;
            align-items: center;
        }
        
        .hero-section {
            background: linear-gradient(135deg, #faf9f7 0%, #f5f3f0 50%, #f0ede8 100%);
            padding: 6rem 0;
            position: relative;
            overflow: hidden;
        }
        
        .hero-section::before {
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            width: 50%;
            height: 100%;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><circle cx="50" cy="50" r="2" fill="%23D4A574" opacity="0.1"/></svg>');
            background-size: 50px 50px;
            opacity: 0.3;
        }
        
        .section-title {
            font-size: 3rem;
            font-weight: 800;
            color: var(--text-dark);
            margin-bottom: 3rem;
            position: relative;
            display: inline-block;
        }
        
        .section-title::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 0;
            width: 80px;
            height: 4px;
            background: linear-gradient(90deg, var(--primary-color), var(--secondary-color));
            border-radius: 2px;
        }
        
        .card {
            border: none;
            border-radius: 20px;
            overflow: hidden;
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            height: 100%;
            background: #fff;
            box-shadow: 0 5px 20px rgba(0,0,0,0.08);
        }
        
        .card:hover {
            transform: translateY(-15px) scale(1.02);
            box-shadow: 0 20px 40px rgba(0,0,0,0.15);
        }
        
        .card-img-top {
            height: 280px;
            object-fit: cover;
            transition: transform 0.5s;
        }
        
        .card:hover .card-img-top {
            transform: scale(1.1);
        }
        
        .btn-primary {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            border: none;
            padding: 0.9rem 2.5rem;
            border-radius: 50px;
            font-weight: 700;
            transition: all 0.3s;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            font-size: 0.9rem;
            box-shadow: 0 5px 20px rgba(139, 90, 60, 0.3);
        }
        
        .btn-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(139, 90, 60, 0.4);
            background: linear-gradient(135deg, var(--secondary-color) 0%, var(--primary-color) 100%);
        }
        
        .btn-outline-primary {
            border: 2px solid var(--primary-color);
            color: var(--primary-color);
            border-radius: 50px;
            padding: 0.6rem 1.5rem;
            font-weight: 600;
            transition: all 0.3s;
        }
        
        .btn-outline-primary:hover {
            background: var(--primary-color);
            color: #fff;
            transform: translateY(-2px);
        }
        
        .footer {
            background: linear-gradient(135deg, #1a1a1a 0%, #2c2c2c 100%);
            color: #fff;
            padding: 4rem 0 2rem;
            margin-top: 5rem;
        }
        
        .fixed-page-section {
            padding: 5rem 0;
            scroll-margin-top: 120px;
        }
        
        .fixed-page-section:nth-child(even) {
            background: linear-gradient(135deg, #fafafa 0%, #f5f5f5 100%);
        }
        
        .content-wrapper {
            font-size: 1.1rem;
            line-height: 2;
            color: var(--text-light);
        }
        
        .content-wrapper h1, .content-wrapper h2, .content-wrapper h3 {
            color: var(--text-dark);
            margin: 2rem 0 1rem;
        }
        
        .badge {
            padding: 0.5rem 1rem;
            border-radius: 50px;
            font-weight: 600;
        }
        
        .breadcrumb {
            background: transparent;
            padding: 0;
        }
        
        .breadcrumb-item a {
            color: var(--primary-color);
            text-decoration: none;
        }
        
        .breadcrumb-item.active {
            color: var(--text-light);
        }
        
        .social-link {
            opacity: 0.8;
            transition: all 0.3s;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }
        
        .social-link:hover {
            opacity: 1;
            transform: translateY(-3px) scale(1.1);
            background: rgba(212, 165, 116, 0.3) !important;
            color: var(--secondary-color) !important;
            box-shadow: 0 5px 15px rgba(212, 165, 116, 0.3);
        }
        
        .footer a {
            transition: all 0.3s;
        }
        
        .footer a:hover {
            color: var(--secondary-color) !important;
            padding-left: 5px;
        }
        
        @media (max-width: 768px) {
            .section-title {
                font-size: 2rem;
            }
            
            .hero-section {
                padding: 3rem 0;
            }
        }
    </style>
    
    @yield('css')
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light sticky-top">
        <div class="container">
            <a class="navbar-brand" href="{{ route('web.home') }}">
                <img src="{{ getSettingImageLink('logo', true) }}" alt="{{ config('app.name', 'Mirajawa') }}"
                     style="height: 40px; width: auto; object-fit: contain;">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('web.categories.index') }}">
                            {{ __('admin.categories') }}
                        </a>
                    </li>
                    @php
                        $fixedPages = $fixedPages ?? \App\Models\FixedPage::all();
                    @endphp
                    @foreach($fixedPages as $fixedPage)
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('web.home') }}#fixed-page-{{ $fixedPage->id }}">
                                {{ $fixedPage->name }}
                            </a>
                        </li>
                    @endforeach
                </ul>
                <div class="d-flex align-items-center">
                    <div class="dropdown">
                        <a href="#" class="language-switcher text-decoration-none dropdown-toggle"
                           data-bs-toggle="dropdown" aria-expanded="false">
                            <span class="fi fi-{{ trans('route.langFlag') }} fis me-2"></span>
                            <span>{{ getLanguageName(app()->getLocale()) }}</span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            @foreach(['en', 'ja', 'ar'] as $lang)
                                @if($lang !== app()->getLocale())
                                    <li>
                                        <a class="dropdown-item" href="{{ route('web.change.language', $lang) }}">
                                            <span class="fi fi-{{ getLanguageFlag($lang) }} fis me-2"></span>
                                            <span>{{ getLanguageName($lang) }}</span>
                                        </a>
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    @yield('content')

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-lg-4 mb-4 mb-md-0">
                    <h5 class="mb-3">{{ config('app.name', 'Mirajawa') }}</h5>
                    <p class="text-muted mb-0">© {{ date('Y') }} {{ config('app.name', 'Mirajawa') }}. {{ __('admin.AllRightsReserved.') }}</p>
                </div>
                <div class="col-md-6 col-lg-4 mb-4 mb-md-0">
                    <h6 class="text-light mb-3">{{ __('admin.quick_links') ?? 'Quick Links' }}</h6>
                    <div class="d-flex flex-column">
                        <a href="{{ route('web.home') }}" class="text-light text-decoration-none mb-2">
                            <i class="bi bi-house me-2"></i>{{ __('admin.home') ?? 'Home' }}
                        </a>
                        <a href="{{ route('web.categories.index') }}" class="text-light text-decoration-none mb-2">
                            <i class="bi bi-grid me-2"></i>{{ __('admin.categories') }}
                        </a>
                    </div>
                </div>
                <div class="col-md-12 col-lg-4">
                    @php
                        $socials = $socials ?? \App\Models\Social::where('is_active', true)
                            ->orderBy('id')
                            ->get();
                    @endphp
                    @if($socials && $socials->count() > 0)
                        <h6 class="text-light mb-3">{{ __('admin.follow_us') ?? 'Follow Us' }}</h6>
                        <div class="d-flex gap-3 flex-wrap">
                            @foreach($socials as $social)
                                <a href="{{ $social->url }}" 
                                   target="_blank" 
                                   rel="noopener noreferrer"
                                   class="social-link text-light text-decoration-none d-inline-flex align-items-center justify-content-center"
                                   title="{{ $social->name }}"
                                   style="width: 40px; height: 40px; border-radius: 50%; background: rgba(255, 255, 255, 0.1); font-size: 1.2rem; transition: all 0.3s;">
                                    @if($social->icon)
                                        <i class="{{ $social->icon }}"></i>
                                    @else
                                        <i class="bi bi-link-45deg"></i>
                                    @endif
                                </a>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
            <hr class="my-4" style="border-color: rgba(255, 255, 255, 0.1);">
            <div class="row">
                <div class="col-12 text-center">
                    <p class="text-muted mb-0 small">{{ __('admin.AllRightsReserved.') }}</p>
                </div>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- AOS Animation -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <!-- Fancybox JS -->
    <script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.umd.js"></script>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    
    <script>
        // Initialize AOS
        AOS.init({
            duration: 1000,
            once: true,
            offset: 100
        });
        
        // Navbar scroll effect
        window.addEventListener('scroll', function() {
            const navbar = document.querySelector('.navbar');
            if (window.scrollY > 50) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        });
        
        // Smooth scroll for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                const href = this.getAttribute('href');
                if (href !== '#' && href.includes('#')) {
                    e.preventDefault();
                    const targetId = href.split('#')[1];
                    const target = document.getElementById(targetId);
                    if (target) {
                        const offsetTop = target.offsetTop - 100;
                        window.scrollTo({
                            top: offsetTop,
                            behavior: 'smooth'
                        });
                    }
                }
            });
        });
        
        // Set active nav link based on scroll position
        window.addEventListener('scroll', function() {
            const sections = document.querySelectorAll('.fixed-page-section');
            const navLinks = document.querySelectorAll('.nav-link[href^="#"]');
            
            let current = '';
            sections.forEach(section => {
                const sectionTop = section.offsetTop - 150;
                if (window.scrollY >= sectionTop) {
                    current = section.getAttribute('id');
                }
            });
            
            navLinks.forEach(link => {
                link.classList.remove('active');
                if (link.getAttribute('href').includes(current)) {
                    link.classList.add('active');
                }
            });
        });
    </script>
    
    @yield('script')
</body>
</html>

