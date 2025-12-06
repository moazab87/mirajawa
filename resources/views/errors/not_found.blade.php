<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex, nofollow">
    <meta name="description" content="Page not found - The requested page could not be found.">

    <!-- Canonical to home -->
    <link rel="canonical" href="/">

    <!-- Open Graph -->
    <meta property="og:title" content="404 - Page Not Found">
    <meta property="og:description" content="The page you're looking for doesn't exist.">
    <meta property="og:type" content="website">

    <title>404 - Page Not Found | AppName</title>

    <!-- Optional Bootstrap 5 (graceful degradation if fails) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <!-- Critical inline CSS -->
    <style>
        /* ============================================
           CRITICAL CSS - Works standalone
           ============================================ */

        /* Reset & Variables */
        *,
        *::before,
        *::after {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        :root {
            --brand-primary: #0ea5e9;
            --brand-primary-dark: #0284c7;
            --font-stack: system-ui, -apple-system, "Segoe UI", Roboto, sans-serif;

            /* Light mode */
            --bg-primary: #ffffff;
            --bg-secondary: #f8f9fa;
            --text-primary: #212529;
            --text-secondary: #6c757d;
            --border-color: #dee2e6;
            --focus-ring: var(--brand-primary);
            --button-hover-bg: #e9ecef;
        }

        /* Dark mode */
        @media (prefers-color-scheme: dark) {
            :root {
                --bg-primary: #1a1a1a;
                --bg-secondary: #2d2d2d;
                --text-primary: #f8f9fa;
                --text-secondary: #adb5bd;
                --border-color: #495057;
                --button-hover-bg: #343a40;
            }
        }

        /* Dark mode toggle (manual) */
        html[data-theme="dark"] {
            --bg-primary: #1a1a1a;
            --bg-secondary: #2d2d2d;
            --text-primary: #f8f9fa;
            --text-secondary: #adb5bd;
            --border-color: #495057;
            --button-hover-bg: #343a40;
        }

        html[data-theme="light"] {
            --bg-primary: #ffffff;
            --bg-secondary: #f8f9fa;
            --text-primary: #212529;
            --text-secondary: #6c757d;
            --border-color: #dee2e6;
            --button-hover-bg: #e9ecef;
        }

        /* Base styles */
        html {
            scroll-behavior: smooth;
        }

        @media (prefers-reduced-motion: reduce) {
            html {
                scroll-behavior: auto;
            }

            *,
            *::before,
            *::after {
                animation-duration: 0.01ms !important;
                animation-iteration-count: 1 !important;
                transition-duration: 0.01ms !important;
            }
        }

        body {
            font-family: var(--font-stack);
            background: var(--bg-primary);
            color: var(--text-primary);
            line-height: 1.6;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            transition: background 0.2s, color 0.2s;
        }

        /* Skip link */
        .skip-link {
            position: absolute;
            top: -100px;
            left: 0;
            background: var(--brand-primary);
            color: white;
            padding: 0.5rem 1rem;
            text-decoration: none;
            z-index: 9999;
            border-radius: 0 0 4px 0;
        }

        .skip-link:focus {
            top: 0;
            outline: 3px solid var(--focus-ring);
            outline-offset: 2px;
        }

        /* Header */
        header {
            padding: 1rem;
            border-bottom: 1px solid var(--border-color);
        }

        .header-content {
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 1rem;
        }

        .logo {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--text-primary);
            text-decoration: none;
        }

        .logo:hover {
            color: var(--brand-primary);
        }

        .header-actions {
            display: flex;
            gap: 0.75rem;
            align-items: center;
        }

        /* Main content */
        main {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem 1rem;
        }

        .container {
            max-width: 700px;
            width: 100%;
        }

        .error-content {
            text-align: center;
        }

        /* Typography */
        .error-code {
            font-size: clamp(4rem, 15vw, 8rem);
            font-weight: 700;
            color: var(--brand-primary);
            line-height: 1;
            margin-bottom: 1rem;
        }

        h1 {
            font-size: clamp(1.75rem, 5vw, 2.5rem);
            font-weight: 700;
            margin-bottom: 1rem;
        }

        .message {
            font-size: 1.125rem;
            color: var(--text-secondary);
            margin-bottom: 2rem;
        }

        /* Illustration */
        .illustration {
            margin-bottom: 2rem;
            opacity: 0.85;
        }

        .illustration svg {
            max-width: 280px;
            width: 100%;
            height: auto;
        }

        /* Actions */
        .actions {
            display: flex;
            gap: 1rem;
            justify-content: center;
            flex-wrap: wrap;
            margin-bottom: 2.5rem;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.75rem 1.5rem;
            border-radius: 0.5rem;
            font-weight: 500;
            text-decoration: none;
            border: 2px solid transparent;
            cursor: pointer;
            font-size: 1rem;
            font-family: inherit;
            transition: all 0.2s;
        }

        .btn-primary {
            background: var(--brand-primary);
            color: white;
            border-color: var(--brand-primary);
        }

        .btn-primary:hover {
            background: var(--brand-primary-dark);
            border-color: var(--brand-primary-dark);
        }

        .btn-primary:focus {
            outline: 3px solid var(--focus-ring);
            outline-offset: 2px;
        }

        .btn-secondary {
            background: var(--bg-secondary);
            color: var(--text-primary);
            border-color: var(--border-color);
        }

        .btn-secondary:hover {
            background: var(--button-hover-bg);
        }

        .btn-secondary:focus {
            outline: 3px solid var(--focus-ring);
            outline-offset: 2px;
        }

        .btn-icon {
            background: transparent;
            border: none;
            color: var(--text-secondary);
            padding: 0.5rem;
            cursor: pointer;
        }

        .btn-icon:hover {
            color: var(--brand-primary);
        }

        .btn-icon:focus {
            outline: 2px solid var(--focus-ring);
            outline-offset: 2px;
            border-radius: 4px;
        }

        /* Help section */
        .help-section {
            margin-top: 3rem;
            padding-top: 2rem;
            border-top: 1px solid var(--border-color);
        }

        .help-links {
            display: flex;
            gap: 1.5rem;
            justify-content: center;
            flex-wrap: wrap;
            font-size: 0.9375rem;
        }

        .help-links a {
            color: var(--text-secondary);
            text-decoration: none;
            transition: color 0.2s;
        }

        .help-links a:hover {
            color: var(--brand-primary);
        }

        .help-links a:focus {
            outline: 2px solid var(--focus-ring);
            outline-offset: 2px;
            border-radius: 2px;
        }

        /* Diagnostics */
        .diagnostic {
            margin-top: 2rem;
        }

        .diagnostic-toggle {
            background: none;
            border: none;
            color: var(--text-secondary);
            font-size: 0.875rem;
            cursor: pointer;
            padding: 0.5rem;
            text-decoration: underline;
        }

        .diagnostic-toggle:hover {
            color: var(--brand-primary);
        }

        .diagnostic-toggle:focus {
            outline: 2px solid var(--focus-ring);
            outline-offset: 2px;
            border-radius: 4px;
        }

        .diagnostic-content {
            display: none;
            margin-top: 1rem;
            padding: 1rem;
            background: var(--bg-secondary);
            border: 1px solid var(--border-color);
            border-radius: 0.5rem;
            text-align: left;
            font-size: 0.875rem;
        }

        .diagnostic-content.active {
            display: block;
        }

        .diagnostic-content dl {
            display: grid;
            gap: 0.75rem;
        }

        .diagnostic-content dt {
            font-weight: 600;
            color: var(--text-primary);
        }

        .diagnostic-content dd {
            color: var(--text-secondary);
            font-family: 'Courier New', monospace;
            word-break: break-all;
            margin: 0;
        }

        /* Footer */
        footer {
            padding: 2rem 1rem;
            text-align: center;
            font-size: 0.875rem;
            color: var(--text-secondary);
            border-top: 1px solid var(--border-color);
        }

        /* RTL support */
        [dir="rtl"] {
            text-align: right;
        }

        [dir="rtl"] .error-content {
            text-align: center;
        }

        [dir="rtl"] .header-content {
            flex-direction: row-reverse;
        }

        [dir="rtl"] .search-group {
            flex-direction: row-reverse;
        }

        [dir="rtl"] .diagnostic-content {
            text-align: right;
        }

        /* Utility classes */
        .visually-hidden {
            position: absolute;
            width: 1px;
            height: 1px;
            margin: -1px;
            padding: 0;
            overflow: hidden;
            clip: rect(0, 0, 0, 0);
            white-space: nowrap;
            border: 0;
        }

        .icon {
            width: 20px;
            height: 20px;
            display: inline-block;
            vertical-align: middle;
        }

        /* Responsive adjustments */
        @media (max-width: 576px) {
            .actions {
                flex-direction: column;
                width: 100%;
            }

            .btn {
                width: 100%;
                justify-content: center;
            }

            .help-links {
                flex-direction: column;
                gap: 0.75rem;
            }
        }
    </style>
</head>

<body>
    <!-- Skip to main content -->
    <a href="#main-content" class="skip-link">Skip to main content</a>

    <!-- Header -->
    <header role="banner">
        <div class="header-content">
            <a href="/" class="logo">
                <span>AppName</span>
            </a>

            <div class="header-actions">
                <!-- Language toggle -->
                <button type="button" class="btn-icon" id="lang-toggle" aria-label="Switch language"
                    title="Switch language">
                    <svg class="icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="12" cy="12" r="10" />
                        <path
                            d="M2 12h20M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z" />
                    </svg>
                    <span class="visually-hidden" id="lang-label">EN</span>
                </button>

                <!-- Theme toggle -->
                <button type="button" class="btn-icon" id="theme-toggle" aria-label="Toggle dark mode"
                    title="Toggle dark mode">
                    <svg class="icon" id="theme-icon-light" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2">
                        <circle cx="12" cy="12" r="5" />
                        <line x1="12" y1="1" x2="12" y2="3" />
                        <line x1="12" y1="21" x2="12" y2="23" />
                        <line x1="4.22" y1="4.22" x2="5.64" y2="5.64" />
                        <line x1="18.36" y1="18.36" x2="19.78" y2="19.78" />
                        <line x1="1" y1="12" x2="3" y2="12" />
                        <line x1="21" y1="12" x2="23" y2="12" />
                        <line x1="4.22" y1="19.78" x2="5.64" y2="18.36" />
                        <line x1="18.36" y1="5.64" x2="19.78" y2="4.22" />
                    </svg>
                    <svg class="icon" id="theme-icon-dark" style="display:none;" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2">
                        <path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z" />
                    </svg>
                </button>
            </div>
        </div>
    </header>

    <!-- Main content -->
    <main id="main-content" role="main">
        <div class="container">
            <div class="error-content">
                <!-- Illustration -->
                <div class="illustration" aria-hidden="true">
                    <svg viewBox="0 0 400 300" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <!-- Magnifying glass -->
                        <circle cx="150" cy="120" r="70" stroke="currentColor" stroke-width="8"
                            opacity="0.2" />
                        <line x1="205" y1="175" x2="260" y2="230" stroke="currentColor"
                            stroke-width="8" stroke-linecap="round" opacity="0.2" />
                        <!-- Question mark -->
                        <path d="M150 90 Q150 70, 170 70 Q190 70, 190 90 Q190 110, 150 120 M150 145 L150 150"
                            stroke="#0ea5e9" stroke-width="6" stroke-linecap="round" fill="none" />
                        <!-- Floating document -->
                        <rect x="240" y="60" width="80" height="100" rx="4" fill="currentColor"
                            opacity="0.1" />
                        <line x1="260" y1="80" x2="300" y2="80" stroke="currentColor"
                            stroke-width="3" opacity="0.2" />
                        <line x1="260" y1="100" x2="300" y2="100" stroke="currentColor"
                            stroke-width="3" opacity="0.2" />
                        <line x1="260" y1="120" x2="280" y2="120" stroke="currentColor"
                            stroke-width="3" opacity="0.2" />
                    </svg>
                </div>

                <div class="error-code" aria-hidden="true">404</div>

                <h1 id="error-heading">
                    <span class="lang-en">Page Not Found</span>
                    <span class="lang-ar" style="display:none;">الصفحة غير موجودة</span>
                </h1>

                <p class="message">
                    <span class="lang-en">The page you're looking for doesn't exist or has been moved. Let's get you
                        back on track.</span>
                    <span class="lang-ar" style="display:none;">الصفحة التي تبحث عنها غير موجودة أو تم نقلها. دعنا
                        نساعدك في العودة إلى المسار الصحيح.</span>
                </p>

                <!-- Primary actions -->
                <div class="actions">
                    <a href="/" class="btn btn-primary">
                        <svg class="icon" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2">
                            <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z" />
                            <polyline points="9 22 9 12 15 12 15 22" />
                        </svg>
                        <span class="lang-en">Go Home</span>
                        <span class="lang-ar" style="display:none;">الصفحة الرئيسية</span>
                    </a>

                    <button type="button" id="go-back-btn" class="btn btn-secondary">
                        <svg class="icon" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2">
                            <line x1="19" y1="12" x2="5" y2="12" />
                            <polyline points="12 19 5 12 12 5" />
                        </svg>
                        <span class="lang-en">Go Back</span>
                        <span class="lang-ar" style="display:none;">رجوع</span>
                    </button>
                </div>

                <!-- Help section -->
                <div class="help-section">
                    <nav aria-label="Help links">
                        <div class="help-links">
                            <a href="/sitemap">
                                <span class="lang-en">View Sitemap</span>
                                <span class="lang-ar" style="display:none;">خريطة الموقع</span>
                            </a>
                            <a href="mailto:support@example.com?subject=404%20Error%20-%20Page%20Not%20Found&body=I%20encountered%20a%20404%20error%20at%3A%0A%0AURL%3A%20[Browser%20will%20fill]%0ATime%3A%20[Browser%20will%20fill]"
                                id="support-link">
                                <span class="lang-en">Contact Support</span>
                                <span class="lang-ar" style="display:none;">اتصل بالدعم</span>
                            </a>
                            <a href="#" id="report-link">
                                <span class="lang-en">Report Broken Link</span>
                                <span class="lang-ar" style="display:none;">الإبلاغ عن رابط معطل</span>
                            </a>
                        </div>
                    </nav>
                </div>

                <!-- Diagnostics (collapsible) -->
                <div class="diagnostic">
                    <button type="button" class="diagnostic-toggle" id="diagnostic-toggle" aria-expanded="false"
                        aria-controls="diagnostic-content">
                        <span class="lang-en">▸ Technical Details</span>
                        <span class="lang-ar" style="display:none;">▸ التفاصيل التقنية</span>
                    </button>
                    <div class="diagnostic-content" id="diagnostic-content" role="region">
                        <dl>
                            <dt>
                                <span class="lang-en">Requested Path:</span>
                                <span class="lang-ar" style="display:none;">المسار المطلوب:</span>
                            </dt>
                            <dd id="diag-path">-</dd>

                            <dt>
                                <span class="lang-en">Came From:</span>
                                <span class="lang-ar" style="display:none;">المصدر:</span>
                            </dt>
                            <dd id="diag-referrer">-</dd>

                            <dt>
                                <span class="lang-en">Time:</span>
                                <span class="lang-ar" style="display:none;">الوقت:</span>
                            </dt>
                            <dd id="diag-time">-</dd>
                        </dl>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer role="contentinfo">
        <p>
            <span class="lang-en">&copy; 2025 AppName. All rights reserved.</span>
            <span class="lang-ar" style="display:none;">&copy; 2025 AppName. جميع الحقوق محفوظة.</span>
        </p>
    </footer>

    <!-- Optional Bootstrap JS (graceful degradation) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>

    <!-- Progressive enhancement JavaScript -->
    <script>
        (function() {
            'use strict';

            // Wait for DOM
            if (document.readyState === 'loading') {
                document.addEventListener('DOMContentLoaded', init);
            } else {
                init();
            }

            function init() {
                initThemeToggle();
                initLanguageToggle();
                initGoBack();
                initDiagnostics();
                initReportLink();
            }

            // Theme toggle with localStorage persistence
            function initThemeToggle() {
                var themeToggle = document.getElementById('theme-toggle');
                var iconLight = document.getElementById('theme-icon-light');
                var iconDark = document.getElementById('theme-icon-dark');

                if (!themeToggle || !iconLight || !iconDark) return;

                // Load saved theme or detect preference
                var savedTheme = null;
                try {
                    savedTheme = localStorage.getItem('theme');
                } catch (e) {
                    // localStorage not available
                }

                var prefersDark = window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches;
                var currentTheme = savedTheme || (prefersDark ? 'dark' : 'light');

                applyTheme(currentTheme);

                themeToggle.addEventListener('click', function() {
                    currentTheme = currentTheme === 'light' ? 'dark' : 'light';
                    applyTheme(currentTheme);
                    try {
                        localStorage.setItem('theme', currentTheme);
                    } catch (e) {
                        // Fail silently
                    }
                });

                function applyTheme(theme) {
                    document.documentElement.setAttribute('data-theme', theme);
                    if (theme === 'dark') {
                        iconLight.style.display = 'none';
                        iconDark.style.display = 'inline-block';
                        themeToggle.setAttribute('aria-label', 'Switch to light mode');
                    } else {
                        iconLight.style.display = 'inline-block';
                        iconDark.style.display = 'none';
                        themeToggle.setAttribute('aria-label', 'Switch to dark mode');
                    }
                }
            }

            // Language toggle (EN/AR)
            function initLanguageToggle() {
                var langToggle = document.getElementById('lang-toggle');
                var langLabel = document.getElementById('lang-label');
                var html = document.documentElement;

                if (!langToggle || !langLabel) return;

                var currentLang = 'en';

                langToggle.addEventListener('click', function() {
                    currentLang = currentLang === 'en' ? 'ar' : 'en';
                    applyLanguage(currentLang);
                });

                function applyLanguage(lang) {
                    var isArabic = lang === 'ar';

                    // Update HTML attributes
                    html.setAttribute('lang', lang);
                    html.setAttribute('dir', isArabic ? 'rtl' : 'ltr');

                    // Toggle visibility of text elements
                    var enElements = document.querySelectorAll('.lang-en');
                    var arElements = document.querySelectorAll('.lang-ar');

                    for (var i = 0; i < enElements.length; i++) {
                        enElements[i].style.display = isArabic ? 'none' : '';
                    }
                    for (var i = 0; i < arElements.length; i++) {
                        arElements[i].style.display = isArabic ? '' : 'none';
                    }

                    // Update button label
                    langLabel.textContent = isArabic ? 'AR' : 'EN';

                    // Update search placeholder
                    var searchInput = document.querySelector('.search-input');
                    if (searchInput) {
                        var placeholder = isArabic ?
                            searchInput.getAttribute('data-placeholder-ar') :
                            searchInput.getAttribute('data-placeholder-en');
                        if (placeholder) {
                            searchInput.setAttribute('placeholder', placeholder);
                        }
                    }
                }
            }

            // Go Back button with fallback
            function initGoBack() {
                var goBackBtn = document.getElementById('go-back-btn');
                if (!goBackBtn) return;

                goBackBtn.addEventListener('click', function() {
                    if (window.history.length > 1 && document.referrer) {
                        window.history.back();
                    } else {
                        // Fallback to home
                        window.location.href = '/';
                    }
                });
            }

            // Populate diagnostics panel
            function initDiagnostics() {
                var toggle = document.getElementById('diagnostic-toggle');
                var content = document.getElementById('diagnostic-content');
                var pathEl = document.getElementById('diag-path');
                var referrerEl = document.getElementById('diag-referrer');
                var timeEl = document.getElementById('diag-time');

                if (!toggle || !content) return;

                // Populate diagnostic info
                if (pathEl) {
                    pathEl.textContent = window.location.pathname + window.location.search || '/';
                }
                if (referrerEl) {
                    referrerEl.textContent = document.referrer || 'Direct access';
                }
                if (timeEl) {
                    try {
                        timeEl.textContent = new Date().toISOString();
                    } catch (e) {
                        timeEl.textContent = new Date().toString();
                    }
                }

                // Toggle functionality
                toggle.addEventListener('click', function() {
                    var isExpanded = toggle.getAttribute('aria-expanded') === 'true';
                    toggle.setAttribute('aria-expanded', !isExpanded);

                    if (isExpanded) {
                        content.classList.remove('active');
                        toggle.innerHTML = toggle.innerHTML.replace('▾', '▸');
                    } else {
                        content.classList.add('active');
                        toggle.innerHTML = toggle.innerHTML.replace('▸', '▾');
                    }
                });
            }

            // Report broken link - enhanced mailto with current URL
            function initReportLink() {
                var reportLink = document.getElementById('report-link');
                var supportLink = document.getElementById('support-link');

                if (reportLink) {
                    var currentUrl = window.location.href;
                    var timestamp = '';
                    try {
                        timestamp = new Date().toISOString();
                    } catch (e) {
                        timestamp = new Date().toString();
                    }

                    var subject = encodeURIComponent('Broken Link Report');
                    var body = encodeURIComponent(
                        'I found a broken link:\n\n' +
                        'URL: ' + currentUrl + '\n' +
                        'Referrer: ' + (document.referrer || 'Direct access') + '\n' +
                        'Time: ' + timestamp + '\n\n' +
                        'Additional details:\n'
                    );

                    reportLink.href = 'mailto:support@example.com?subject=' + subject + '&body=' + body;
                }

                if (supportLink) {
                    var currentUrl = window.location.href;
                    var timestamp = '';
                    try {
                        timestamp = new Date().toISOString();
                    } catch (e) {
                        timestamp = new Date().toString();
                    }

                    var subject = encodeURIComponent('404 Error - Page Not Found');
                    var body = encodeURIComponent(
                        'I encountered a 404 error at:\n\n' +
                        'URL: ' + currentUrl + '\n' +
                        'Time: ' + timestamp + '\n\n' +
                        'Please help.\n'
                    );

                    supportLink.href = 'mailto:support@example.com?subject=' + subject + '&body=' + body;
                }
            }

            // Copy current URL to clipboard (bonus feature)
            function copyToClipboard(text) {
                // Try modern clipboard API first
                if (navigator.clipboard && navigator.clipboard.writeText) {
                    return navigator.clipboard.writeText(text);
                }

                // Fallback to execCommand
                var textArea = document.createElement('textarea');
                textArea.value = text;
                textArea.style.position = 'fixed';
                textArea.style.left = '-999999px';
                textArea.style.top = '-999999px';
                document.body.appendChild(textArea);
                textArea.focus();
                textArea.select();

                try {
                    document.execCommand('copy');
                    textArea.remove();
                    return Promise.resolve();
                } catch (err) {
                    textArea.remove();
                    return Promise.reject(err);
                }
            }

            // Listen for prefers-color-scheme changes
            if (window.matchMedia) {
                var darkModeQuery = window.matchMedia('(prefers-color-scheme: dark)');

                // Modern browsers
                if (darkModeQuery.addEventListener) {
                    darkModeQuery.addEventListener('change', function(e) {
                        var savedTheme = null;
                        try {
                            savedTheme = localStorage.getItem('theme');
                        } catch (err) {}

                        // Only auto-switch if user hasn't manually set a preference
                        if (!savedTheme) {
                            var newTheme = e.matches ? 'dark' : 'light';
                            document.documentElement.setAttribute('data-theme', newTheme);
                        }
                    });
                }
                // Legacy browsers
                else if (darkModeQuery.addListener) {
                    darkModeQuery.addListener(function(e) {
                        var savedTheme = null;
                        try {
                            savedTheme = localStorage.getItem('theme');
                        } catch (err) {}

                        if (!savedTheme) {
                            var newTheme = e.matches ? 'dark' : 'light';
                            document.documentElement.setAttribute('data-theme', newTheme);
                        }
                    });
                }
            }
        })();
    </script>
</body>

</html>
