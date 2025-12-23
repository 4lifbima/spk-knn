<!DOCTYPE html>
<html lang="id" class="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'SPK Smart - Login')</title>
    
    <!-- Fonts: Plus Jakarta Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Lucide Icons -->
    <script src="https://unpkg.com/lucide@latest"></script>

    <!-- Tailwind Config -->
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['"Plus Jakarta Sans"', 'sans-serif'],
                    },
                    colors: {
                        primary: '#301CA0',
                        primaryHover: '#241480',
                        secondary: '#64748B',
                        darkBg: '#0F172A',
                        darkCard: '#1E293B'
                    }
                }
            }
        }
    </script>

    <style>
        /* Custom Scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }
        ::-webkit-scrollbar-track {
            background: transparent;
        }
        ::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 4px;
        }
        .dark ::-webkit-scrollbar-thumb {
            background: #475569;
        }

        /* Gradient Animation */
        @keyframes gradient {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }
        .animate-gradient {
            background-size: 200% 200%;
            animation: gradient 15s ease infinite;
        }

        /* Float Animation */
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
        }
        .animate-float {
            animation: float 6s ease-in-out infinite;
        }

        /* Fade In Animation */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-fade-in {
            animation: fadeIn 0.8s ease-out forwards;
        }

        /* Blur Background Effect */
        .backdrop-blur-glass {
            backdrop-filter: blur(20px);
            background: rgba(255, 255, 255, 0.8);
        }
        .dark .backdrop-blur-glass {
            background: rgba(30, 41, 59, 0.8);
        }
    </style>
</head>
<body class="bg-slate-50 dark:bg-darkBg font-sans antialiased overflow-x-hidden">
    
    <!-- Background Decorations -->
    <div class="fixed inset-0 overflow-hidden pointer-events-none">
        <!-- Animated Gradient Orbs -->
        <div class="absolute -top-40 -right-40 w-96 h-96 bg-gradient-to-br from-primary/30 to-purple-500/30 rounded-full blur-3xl animate-float"></div>
        <div class="absolute -bottom-40 -left-40 w-96 h-96 bg-gradient-to-tr from-blue-500/20 to-primary/20 rounded-full blur-3xl animate-float" style="animation-delay: 2s;"></div>
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-72 h-72 bg-gradient-to-br from-purple-400/10 to-pink-400/10 rounded-full blur-3xl animate-float" style="animation-delay: 4s;"></div>
        
        <!-- Grid Pattern -->
        <div class="absolute inset-0 bg-[linear-gradient(to_right,#80808012_1px,transparent_1px),linear-gradient(to_bottom,#80808012_1px,transparent_1px)] bg-[size:24px_24px]"></div>
    </div>

    <!-- Theme Toggle (Top Right) -->
    <button id="themeToggle" class="fixed top-6 right-6 z-50 p-3 rounded-full bg-white dark:bg-darkCard shadow-lg hover:shadow-xl transition-all duration-300 border border-slate-200 dark:border-slate-700 group">
        <i data-lucide="moon" class="w-5 h-5 text-slate-700 dark:text-yellow-400 hidden dark:block transition-transform group-hover:rotate-12"></i>
        <i data-lucide="sun" class="w-5 h-5 text-slate-700 block dark:hidden transition-transform group-hover:rotate-90"></i>
    </button>

    <!-- Main Content Container -->
    <div class="relative min-h-screen flex items-center justify-center px-4 py-12 sm:px-6 lg:px-8">
        
        <!-- Content Card -->
        <div class="w-full max-w-md animate-fade-in">
            
            <!-- Logo & Brand -->
            <div class="text-center mb-8">
                <div class="inline-flex items-center justify-center w-16 h-16 rounded-2xl bg-gradient-to-br from-primary to-purple-600 shadow-lg shadow-primary/30 mb-4 transform hover:scale-110 transition-transform duration-300">
                    <i data-lucide="activity" class="w-8 h-8 text-white"></i>
                </div>
                <h1 class="text-3xl font-bold text-slate-900 dark:text-white mb-2">
                    Smart<span class="text-primary">SPK</span>
                </h1>
                <p class="text-slate-500 dark:text-slate-400 text-sm">
                    Sistem Pendukung Keputusan KNN
                </p>
            </div>

            <!-- Auth Card -->
            <div class="backdrop-blur-glass rounded-2xl shadow-2xl border border-slate-200 dark:border-slate-700 overflow-hidden">
                <!-- Card Content -->
                <div class="p-8">
                    @yield('content')
                </div>
            </div>

            <!-- Footer Links -->
            <div class="mt-6 text-center">
                <p class="text-sm text-slate-500 dark:text-slate-400">
                    © 2024 SmartSPK. All rights reserved.
                </p>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script>
        // Theme Toggle
        const themeToggle = document.getElementById('themeToggle');
        
        // Load saved theme
        if (localStorage.getItem('theme') === 'dark') {
            document.documentElement.classList.add('dark');
        }

        themeToggle.addEventListener('click', () => {
            document.documentElement.classList.toggle('dark');
            localStorage.setItem('theme', document.documentElement.classList.contains('dark') ? 'dark' : 'light');
        });

        // Init Lucide Icons
        lucide.createIcons();
    </script>
</body>
</html>