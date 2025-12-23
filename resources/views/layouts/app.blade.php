<!DOCTYPE html>
<html lang="id" class="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'SPK KNN - Analisis Inventaris')</title>
    
    <!-- Fonts: Plus Jakarta Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Lucide Icons -->
    <script src="https://unpkg.com/lucide@latest"></script>

    <!-- Tailwind Config for Custom Colors -->
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
            height: 8px;
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
        
        /* Smooth Transitions */
        .transition-all-300 {
            transition: all 0.3s ease-in-out;
        }

        /* Animation */
        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-fade-up {
            animation: fadeUp 0.4s ease-out forwards;
        }
    </style>
    @stack('styles')
</head>
<body class="bg-gray-50 text-slate-800 dark:bg-darkBg dark:text-slate-200 transition-colors duration-300 font-sans overflow-hidden">

    <div class="flex h-screen w-full">
        
        <!-- SIDEBAR -->
        <aside id="sidebar" class="w-64 bg-white dark:bg-darkCard border-r border-slate-200 dark:border-slate-700 flex flex-col transition-all-300 hidden md:flex z-20 absolute md:relative h-full shadow-lg md:shadow-none">
            <!-- Brand -->
            <div class="h-16 flex items-center px-6 border-b border-slate-100 dark:border-slate-700">
                <div class="w-8 h-8 rounded-lg bg-primary flex items-center justify-center text-white mr-3">
                    <i data-lucide="activity" class="w-5 h-5"></i>
                </div>
                <h1 class="font-bold text-xl tracking-tight text-slate-900 dark:text-white">Smart<span class="text-primary">SPK</span></h1>
            </div>

            <!-- Menu -->
            <nav class="flex-1 overflow-y-auto py-4 px-3 space-y-1">
                <p class="px-3 text-xs font-semibold text-slate-400 uppercase tracking-wider mb-2 mt-2">Menu Utama</p>
                
                <a href="{{ route('dashboard') }}" class="nav-item w-full flex items-center px-3 py-2.5 text-sm font-medium rounded-lg text-slate-600 dark:text-slate-400 hover:bg-slate-50 dark:hover:bg-slate-700 transition-colors group {{ request()->routeIs('dashboard') ? 'bg-primary/10 text-primary dark:bg-primary/20' : '' }}">
                    <i data-lucide="layout-dashboard" class="w-5 h-5 mr-3 group-hover:text-primary transition-colors"></i>
                    Dashboard
                </a>
                
                <a href="{{ route('dataset.index') }}" class="nav-item w-full flex items-center px-3 py-2.5 text-sm font-medium rounded-lg text-slate-600 dark:text-slate-400 hover:bg-slate-50 dark:hover:bg-slate-700 transition-colors group {{ request()->routeIs('dataset.*') ? 'bg-primary/10 text-primary dark:bg-primary/20' : '' }}">
                    <i data-lucide="database" class="w-5 h-5 mr-3 group-hover:text-primary transition-colors"></i>
                    Dataset Sarana
                </a>
                
                <a href="{{ route('preprocessing') }}" class="nav-item w-full flex items-center px-3 py-2.5 text-sm font-medium rounded-lg text-slate-600 dark:text-slate-400 hover:bg-slate-50 dark:hover:bg-slate-700 transition-colors group {{ request()->routeIs('preprocessing') ? 'bg-primary/10 text-primary dark:bg-primary/20' : '' }}">
                    <i data-lucide="filter" class="w-5 h-5 mr-3 group-hover:text-primary transition-colors"></i>
                    Preprocessing
                </a>
                
                <a href="{{ route('process.index') }}" class="nav-item w-full flex items-center px-3 py-2.5 text-sm font-medium rounded-lg text-slate-600 dark:text-slate-400 hover:bg-slate-50 dark:hover:bg-slate-700 transition-colors group {{ request()->routeIs('process.*') ? 'bg-primary/10 text-primary dark:bg-primary/20' : '' }}">
                    <i data-lucide="calculator" class="w-5 h-5 mr-3 group-hover:text-primary transition-colors"></i>
                    Proses KNN
                </a>
                
                <a href="{{ route('history.index') }}" class="nav-item w-full flex items-center px-3 py-2.5 text-sm font-medium rounded-lg text-slate-600 dark:text-slate-400 hover:bg-slate-50 dark:hover:bg-slate-700 transition-colors group {{ request()->routeIs('history.*') ? 'bg-primary/10 text-primary dark:bg-primary/20' : '' }}">
                    <i data-lucide="history" class="w-5 h-5 mr-3 group-hover:text-primary transition-colors"></i>
                    Riwayat
                </a>

                <p class="px-3 text-xs font-semibold text-slate-400 uppercase tracking-wider mb-2 mt-6">Pengguna</p>
                
                <a href="{{ route('profile.edit') }}" class="nav-item w-full flex items-center px-3 py-2.5 text-sm font-medium rounded-lg text-slate-600 dark:text-slate-400 hover:bg-slate-50 dark:hover:bg-slate-700 transition-colors group {{ request()->routeIs('profile.*') ? 'bg-primary/10 text-primary dark:bg-primary/20' : '' }}">
                    <i data-lucide="user" class="w-5 h-5 mr-3 group-hover:text-primary transition-colors"></i>
                    Profil
                </a>
                
                <a href="{{ route('settings.index') }}" class="nav-item w-full flex items-center px-3 py-2.5 text-sm font-medium rounded-lg text-slate-600 dark:text-slate-400 hover:bg-slate-50 dark:hover:bg-slate-700 transition-colors group {{ request()->routeIs('settings.*') ? 'bg-primary/10 text-primary dark:bg-primary/20' : '' }}">
                    <i data-lucide="settings" class="w-5 h-5 mr-3 group-hover:text-primary transition-colors"></i>
                    Pengaturan
                </a>
                
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full flex items-center px-3 py-2.5 text-sm font-medium rounded-lg text-red-600 hover:bg-red-50 dark:hover:bg-red-900/20 transition-colors group mt-auto">
                        <i data-lucide="log-out" class="w-5 h-5 mr-3"></i>
                        Logout
                    </button>
                </form>
            </nav>

            <!-- User Mini Profile -->
            <div class="p-4 border-t border-slate-200 dark:border-slate-700">
                <div class="flex items-center">
                    @if(Auth::user()->photo)
                        <img src="{{ asset(Auth::user()->photo) }}" alt="User" class="w-9 h-9 rounded-full bg-slate-200 object-cover">
                    @else
                        <img src="https://api.dicebear.com/7.x/avataaars/svg?seed={{ Auth::user()->name }}" alt="User" class="w-9 h-9 rounded-full bg-slate-200">
                    @endif
                    <div class="ml-3">
                        <p class="text-sm font-medium text-slate-900 dark:text-white">{{ Auth::user()->name }}</p>
                        <p class="text-xs text-slate-500">{{ Auth::user()->role ?? 'User' }}</p>
                    </div>
                </div>
            </div>
        </aside>

        <!-- MAIN CONTENT -->
        <div class="flex-1 flex flex-col h-screen overflow-hidden relative">
            
            <!-- TOPBAR -->
            <header class="h-16 bg-white dark:bg-darkCard border-b border-slate-200 dark:border-slate-700 flex items-center justify-between px-6 z-10">
                <div class="flex items-center">
                    <button id="sidebarToggle" class="md:hidden p-2 rounded-md hover:bg-slate-100 dark:hover:bg-slate-700 mr-4">
                        <i data-lucide="menu" class="w-6 h-6 text-slate-600 dark:text-slate-300"></i>
                    </button>
                    <h2 id="pageTitle" class="text-lg font-bold text-slate-800 dark:text-white">@yield('page-title', 'Dashboard')</h2>
                </div>

                <div class="flex items-center space-x-4">
                    <!-- Search -->
                    <div class="hidden md:flex relative">
                        <input type="text" placeholder="Cari data..." class="pl-10 pr-4 py-2 bg-slate-100 dark:bg-slate-700/50 border-none rounded-lg text-sm focus:ring-2 focus:ring-primary w-64 outline-none text-slate-600 dark:text-slate-300">
                        <i data-lucide="search" class="w-4 h-4 absolute left-3 top-3 text-slate-400"></i>
                    </div>

                    <!-- Theme Toggle -->
                    <button id="themeToggle" class="p-2 rounded-full hover:bg-slate-100 dark:hover:bg-slate-700 text-slate-500 dark:text-yellow-400 transition-colors">
                        <i data-lucide="moon" class="w-5 h-5 hidden dark:block"></i>
                        <i data-lucide="sun" class="w-5 h-5 block dark:hidden"></i>
                    </button>

                    <!-- Notifications -->
                    <button class="relative p-2 rounded-full hover:bg-slate-100 dark:hover:bg-slate-700 text-slate-500">
                        <i data-lucide="bell" class="w-5 h-5"></i>
                        <span class="absolute top-2 right-2 w-2 h-2 bg-red-500 rounded-full border border-white dark:border-darkCard"></span>
                    </button>
                </div>
            </header>

            <!-- CONTENT AREA -->
            <main id="mainContent" class="flex-1 overflow-y-auto p-6 bg-slate-50 dark:bg-darkBg relative">
                @yield('content')
            </main>

        </div>
    </div>

    <script>
        // Theme Toggle
        const themeToggle = document.getElementById('themeToggle');
        const sidebar = document.getElementById('sidebar');
        const sidebarToggle = document.getElementById('sidebarToggle');

        themeToggle.addEventListener('click', () => {
            document.documentElement.classList.toggle('dark');
            localStorage.setItem('theme', document.documentElement.classList.contains('dark') ? 'dark' : 'light');
        });

        // Load saved theme
        if (localStorage.getItem('theme') === 'dark') {
            document.documentElement.classList.add('dark');
        }

        sidebarToggle.addEventListener('click', () => {
            sidebar.classList.toggle('hidden');
        });

        // Init Lucide Icons
        lucide.createIcons();
    </script>
    @stack('scripts')
</body>
</html>