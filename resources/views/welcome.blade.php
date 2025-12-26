<!DOCTYPE html>
<html lang="id" class="light scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('icon.png') }}" type="image/x-icon">
    <link rel="apple-touch-icon" href="{{ asset('icon.png') }}" type="image/x-icon">
    <link rel="shortcuts icon" href="{{ asset('icon.png') }}" type="image/x-icon">
    <title>SmartSPK - Sistem Pendukung Keputusan Inventaris</title>
    <meta name="description" content="Sistem Pendukung Keputusan menggunakan metode KNN K-Nearest Neighbor untuk inventarisasi barang di SMK Negeri 1 Kota Gorontalo">
    <meta name="keywords" content="Sistem Pendukung Keputusan, KNN, K-Nearest Neighbor, inventarisasi, barang, SMK Negeri 1 Kota Gorontalo">
    <meta name="author" content="SMK Negeri 1 Kota Gorontalo">

    {{-- meta tag Og --}}
    <meta property="og:title" content="SmartSPK - Sistem Pendukung Keputusan Inventaris">
    <meta property="og:description" content="Sistem Pendukung Keputusan menggunakan metode KNN K-Nearest Neighbor untuk inventarisasi barang di SMK Negeri 1 Kota Gorontalo">
    <meta property="og:url" content="{{ url('/') }}">
    <meta property="og:site_name" content="SmartSPK">
    <meta property="og:type" content="website">
    <meta property="og:image" content="{{ asset('icon.png') }}">
    <meta property="og:image:alt" content="SmartSPK - Sistem Pendukung Keputusan Inventaris">
    <meta property="og:image:width" content="1024">
    <meta property="og:image:height" content="1024">

    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="SmartSPK - Sistem Pendukung Keputusan Inventaris">
    <meta name="twitter:description" content="Sistem Pendukung Keputusan menggunakan metode KNN K-Nearest Neighbor untuk inventarisasi barang di SMK Negeri 1 Kota Gorontalo">
    <meta name="twitter:url" content="{{ url('/') }}">
    <meta name="twitter:site" content="@smkn1kotagorontalo">
    <meta name="twitter:creator" content="@smkn1kotagorontalo">
    <meta name="twitter:image" content="{{ asset('icon.png') }}">
    <meta name="twitter:image:alt" content="SmartSPK - Sistem Pendukung Keputusan Inventaris">

    {{-- canonical --}}
    <link rel="canonical" href="{{ url('/') }}">
    
    <!-- Fonts: Plus Jakarta Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Lucide Icons -->
    <script src="https://unpkg.com/lucide@latest"></script>

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
        /* Animations */
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
        }
        .animate-float {
            animation: float 6s ease-in-out infinite;
        }

        @keyframes gradient {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }
        .animate-gradient {
            background-size: 200% 200%;
            animation: gradient 15s ease infinite;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        .animate-fade-in-up {
            animation: fadeInUp 0.8s ease-out forwards;
        }

        @keyframes scaleIn {
            from {
                opacity: 0;
                transform: scale(0.9);
            }
            to {
                opacity: 1;
                transform: scale(1);
            }
        }
        .animate-scale-in {
            animation: scaleIn 0.6s ease-out forwards;
        }

        /* Scrollbar */
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

        /* Glass effect */
        .glass-effect {
            backdrop-filter: blur(20px);
            background: rgba(255, 255, 255, 0.9);
        }
        .dark .glass-effect {
            background: rgba(15, 23, 42, 0.9);
        }
    </style>
</head>
<body class="bg-slate-50 dark:bg-darkBg text-slate-800 dark:text-slate-200 font-sans antialiased">

    <!-- Navbar -->
    <nav class="fixed top-0 left-0 right-0 z-50 glass-effect border-b border-slate-200 dark:border-slate-700">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <!-- Logo -->
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-primary to-purple-600 flex items-center justify-center shadow-lg">
                        <i data-lucide="activity" class="w-6 h-6 text-white"></i>
                    </div>
                    <span class="text-xl font-bold text-slate-900 dark:text-white">
                        Smart<span class="text-primary dark:text-white">SPK</span>
                    </span>
                </div>

                <!-- Desktop Menu -->
                <div class="hidden md:flex items-center space-x-8">
                    <a href="#home" class="text-sm font-medium text-slate-700 dark:text-slate-300 hover:text-primary transition-colors">Beranda</a>
                    <a href="#features" class="text-sm font-medium text-slate-700 dark:text-slate-300 hover:text-primary transition-colors">Fitur</a>
                    <a href="#how-it-works" class="text-sm font-medium text-slate-700 dark:text-slate-300 hover:text-primary transition-colors">Cara Kerja</a>
                    <a href="#about" class="text-sm font-medium text-slate-700 dark:text-slate-300 hover:text-primary transition-colors">Tentang</a>
                </div>

                <!-- Auth Buttons & Theme Toggle -->
                <div class="flex items-center space-x-3">
                    <button id="themeToggle" class="p-2 rounded-lg hover:bg-slate-100 dark:hover:bg-slate-800 transition-colors">
                        <i data-lucide="moon" class="w-5 h-5 hidden dark:block text-yellow-400"></i>
                        <i data-lucide="sun" class="w-5 h-5 block dark:hidden text-slate-700"></i>
                    </button>
                    
                    <a href="{{ route('login') }}" class="hidden sm:inline-flex px-4 py-2 text-slate-700 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-800 rounded-lg text-sm font-medium transition-colors">
                        Login
                    </a>
                    <a href="{{ route('register') }}" class="hidden sm:inline-flex px-4 py-2 bg-primary hover:bg-primaryHover text-white rounded-lg text-sm font-semibold transition-all transform hover:scale-105 shadow-lg shadow-primary/30">
                        Daftar
                    </a>

                    <!-- Mobile Menu Button -->
                    <button id="mobileMenuBtn" class="md:hidden p-3 rounded-2xl hover:bg-slate-100 dark:hover:bg-slate-800 border-2 border-slate-200 dark:border-slate-700 transition-colors">
                        <i data-lucide="menu" class="w-5 h-5"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div id="mobileMenu" class="hidden md:hidden border-t border-slate-200 dark:border-slate-700 glass-effect">
            <div class="px-4 py-4 space-y-3">
                <a href="#home" class="block px-3 py-2 rounded-lg text-sm font-medium text-slate-700 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-800">Beranda</a>
                <a href="#features" class="block px-3 py-2 rounded-lg text-sm font-medium text-slate-700 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-800">Fitur</a>
                <a href="#how-it-works" class="block px-3 py-2 rounded-lg text-sm font-medium text-slate-700 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-800">Cara Kerja</a>
                <a href="#about" class="block px-3 py-2 rounded-lg text-sm font-medium text-slate-700 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-800">Tentang</a>
                <a href="{{ route('login') }}" class="block px-3 py-2 rounded-lg text-sm font-medium text-slate-700 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-800">Login</a>
                <a href="{{ route('register') }}" class="block px-3 py-2 bg-primary hover:bg-primaryHover text-white rounded-lg text-sm font-semibold text-center transition-all transform hover:scale-105 shadow-lg shadow-primary/30">Daftar</a>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section id="home" class="relative min-h-screen flex items-center justify-center overflow-hidden pt-16">
        <!-- Background Effects -->
        <div class="absolute inset-0 overflow-hidden pointer-events-none">
            <div class="absolute -top-40 -right-40 w-96 h-96 bg-gradient-to-br from-primary/30 to-purple-500/30 rounded-full blur-3xl animate-float"></div>
            <div class="absolute -bottom-40 -left-40 w-96 h-96 bg-gradient-to-tr from-blue-500/20 to-primary/20 rounded-full blur-3xl animate-float" style="animation-delay: 2s;"></div>
            <div class="absolute inset-0 bg-[linear-gradient(to_right,#80808012_1px,transparent_1px),linear-gradient(to_bottom,#80808012_1px,transparent_1px)] bg-[size:24px_24px]"></div>
        </div>

        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20">
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                <!-- Left Content -->
                <div class="text-center lg:text-left animate-fade-in-up">
                    <div class="inline-flex items-center px-4 py-2 bg-primary/10 dark:bg-primary/20 rounded-full text-primary text-sm font-semibold mb-6">
                        <i data-lucide="sparkles" class="w-4 h-4 mr-2"></i>
                        Teknologi K-Nearest Neighbors
                    </div>
                    
                    <h1 class="text-4xl sm:text-5xl lg:text-6xl font-bold text-slate-900 dark:text-white mb-6 leading-tight">
                        Analisis Inventaris
                        <span class="block text-transparent bg-clip-text bg-gradient-to-r from-primary to-purple-600 animate-gradient">
                            Lebih Cerdas & Akurat
                        </span>
                    </h1>
                    
                    <p class="text-lg text-slate-600 dark:text-slate-400 mb-8 max-w-2xl mx-auto lg:mx-0">
                        Sistem Pendukung Keputusan berbasis KNN untuk menentukan kelayakan inventaris dengan tingkat akurasi tinggi. Otomatis, efisien, dan dapat diandalkan.
                    </p>
                    
                    <div class="flex flex-col sm:flex-row gap-4 justify-center lg:justify-start">
                        <a href="#" class="inline-flex items-center justify-center px-8 py-4 bg-gradient-to-r from-primary to-purple-600 hover:from-primaryHover hover:to-purple-700 text-white rounded-xl font-semibold shadow-2xl shadow-primary/40 transform hover:-translate-y-1 transition-all group">
                            <span>Mulai Sekarang</span>
                            <i data-lucide="arrow-right" class="w-5 h-5 ml-2 group-hover:translate-x-1 transition-transform"></i>
                        </a>
                        <a href="#features" class="inline-flex items-center justify-center px-8 py-4 bg-white dark:bg-slate-800 text-slate-900 dark:text-white border-2 border-slate-200 dark:border-slate-700 rounded-xl font-semibold hover:border-primary dark:hover:border-primary transition-all group">
                            <i data-lucide="play-circle" class="w-5 h-5 mr-2 group-hover:scale-110 transition-transform"></i>
                            <span>Pelajari Lebih Lanjut</span>
                        </a>
                    </div>

                </div>

                <!-- Right Illustration -->
                <div class="relative animate-scale-in" style="animation-delay: 0.2s;">
                    <div class="relative bg-white dark:bg-slate-800 rounded-3xl shadow-2xl p-8 border border-slate-200 dark:border-slate-700">
                        <!-- Mock Dashboard Preview -->
                        <div class="space-y-4">
                            <div class="flex items-center justify-between">
                                <div class="h-3 w-32 bg-slate-200 dark:bg-slate-700 rounded"></div>
                                <div class="h-8 w-8 bg-primary/20 rounded-lg"></div>
                            </div>
                            
                            <div class="grid grid-cols-2 gap-4">
                                <div class="bg-gradient-to-br from-primary/10 to-purple-500/10 p-4 rounded-xl border border-primary/20">
                                    <div class="h-2 w-20 bg-primary/40 rounded mb-2"></div>
                                    <div class="h-6 w-16 bg-primary rounded"></div>
                                </div>
                                <div class="bg-gradient-to-br from-blue-500/10 to-cyan-500/10 p-4 rounded-xl border border-blue-500/20">
                                    <div class="h-2 w-20 bg-blue-400/40 rounded mb-2"></div>
                                    <div class="h-6 w-16 bg-blue-500 rounded"></div>
                                </div>
                            </div>

                            <div class="h-40 bg-gradient-to-br from-slate-100 to-slate-200 dark:from-slate-700 dark:to-slate-600 rounded-xl flex items-center justify-center">
                                <i data-lucide="bar-chart-3" class="w-16 h-16 text-primary"></i>
                            </div>

                            <div class="flex items-center space-x-3">
                                <div class="w-10 h-10 rounded-full bg-primary/20"></div>
                                <div class="flex-1 space-y-2">
                                    <div class="h-2 w-32 bg-slate-200 dark:bg-slate-700 rounded"></div>
                                    <div class="h-2 w-24 bg-slate-200 dark:bg-slate-700 rounded"></div>
                                </div>
                            </div>
                        </div>

                        <!-- Floating Elements -->
                        <div class="absolute -top-4 -right-4 w-20 h-20 bg-gradient-to-br from-primary to-purple-600 rounded-2xl shadow-xl flex items-center justify-center animate-float">
                            <i data-lucide="zap" class="w-10 h-10 text-white"></i>
                        </div>
                        <div class="absolute -bottom-4 -left-4 w-16 h-16 bg-gradient-to-br from-blue-500 to-cyan-500 rounded-xl shadow-xl flex items-center justify-center animate-float" style="animation-delay: 1s;">
                            <i data-lucide="check" class="w-8 h-8 text-white"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section id="features" class="py-20 bg-white dark:bg-slate-900">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <div class="inline-flex items-center px-4 py-2 bg-primary/10 dark:bg-primary/20 rounded-full text-primary text-sm font-semibold mb-4">
                    <i data-lucide="star" class="w-4 h-4 mr-2"></i>
                    Fitur Unggulan
                </div>
                <h2 class="text-3xl sm:text-4xl font-bold text-slate-900 dark:text-white mb-4">
                    Kenapa Memilih SmartSPK?
                </h2>
                <p class="text-lg text-slate-600 dark:text-slate-400 max-w-2xl mx-auto">
                    Solusi lengkap untuk analisis inventaris dengan teknologi machine learning terkini
                </p>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Feature Card 1 -->
                <div class="group bg-slate-50 dark:bg-slate-800 p-8 rounded-2xl border border-slate-200 dark:border-slate-700 hover:border-primary dark:hover:border-primary transition-all hover:shadow-xl hover:-translate-y-1">
                    <div class="w-14 h-14 bg-gradient-to-br from-primary to-purple-600 rounded-xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform shadow-lg shadow-primary/30">
                        <i data-lucide="cpu" class="w-7 h-7 text-white"></i>
                    </div>
                    <h3 class="text-xl font-bold text-slate-900 dark:text-white mb-3">
                        Algoritma KNN Canggih
                    </h3>
                    <p class="text-slate-600 dark:text-slate-400">
                        Menggunakan K-Nearest Neighbors dengan Euclidean Distance untuk hasil akurat dan konsisten
                    </p>
                </div>

                <!-- Feature Card 2 -->
                <div class="group bg-slate-50 dark:bg-slate-800 p-8 rounded-2xl border border-slate-200 dark:border-slate-700 hover:border-primary dark:hover:border-primary transition-all hover:shadow-xl hover:-translate-y-1">
                    <div class="w-14 h-14 bg-gradient-to-br from-blue-500 to-cyan-500 rounded-xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform shadow-lg shadow-blue-500/30">
                        <i data-lucide="gauge" class="w-7 h-7 text-white"></i>
                    </div>
                    <h3 class="text-xl font-bold text-slate-900 dark:text-white mb-3">
                        Real-time Analysis
                    </h3>
                    <p class="text-slate-600 dark:text-slate-400">
                        Proses analisis instant dengan visualisasi data yang mudah dipahami dan interaktif
                    </p>
                </div>

                <!-- Feature Card 3 -->
                <div class="group bg-slate-50 dark:bg-slate-800 p-8 rounded-2xl border border-slate-200 dark:border-slate-700 hover:border-primary dark:hover:border-primary transition-all hover:shadow-xl hover:-translate-y-1">
                    <div class="w-14 h-14 bg-gradient-to-br from-emerald-500 to-teal-500 rounded-xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform shadow-lg shadow-emerald-500/30">
                        <i data-lucide="shield-check" class="w-7 h-7 text-white"></i>
                    </div>
                    <h3 class="text-xl font-bold text-slate-900 dark:text-white mb-3">
                        Data Preprocessing
                    </h3>
                    <p class="text-slate-600 dark:text-slate-400">
                        Normalisasi Min-Max otomatis untuk konsistensi data dan akurasi perhitungan optimal
                    </p>
                </div>

                <!-- Feature Card 4 -->
                <div class="group bg-slate-50 dark:bg-slate-800 p-8 rounded-2xl border border-slate-200 dark:border-slate-700 hover:border-primary dark:hover:border-primary transition-all hover:shadow-xl hover:-translate-y-1">
                    <div class="w-14 h-14 bg-gradient-to-br from-amber-500 to-orange-500 rounded-xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform shadow-lg shadow-amber-500/30">
                        <i data-lucide="line-chart" class="w-7 h-7 text-white"></i>
                    </div>
                    <h3 class="text-xl font-bold text-slate-900 dark:text-white mb-3">
                        Dashboard Intuitif
                    </h3>
                    <p class="text-slate-600 dark:text-slate-400">
                        Interface modern dan user-friendly dengan statistik lengkap dan navigasi mudah
                    </p>
                </div>

                <!-- Feature Card 5 -->
                <div class="group bg-slate-50 dark:bg-slate-800 p-8 rounded-2xl border border-slate-200 dark:border-slate-700 hover:border-primary dark:hover:border-primary transition-all hover:shadow-xl hover:-translate-y-1">
                    <div class="w-14 h-14 bg-gradient-to-br from-pink-500 to-rose-500 rounded-xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform shadow-lg shadow-pink-500/30">
                        <i data-lucide="history" class="w-7 h-7 text-white"></i>
                    </div>
                    <h3 class="text-xl font-bold text-slate-900 dark:text-white mb-3">
                        Riwayat Lengkap
                    </h3>
                    <p class="text-slate-600 dark:text-slate-400">
                        Tracking semua analisis dengan detail lengkap untuk audit dan evaluasi berkelanjutan
                    </p>
                </div>

                <!-- Feature Card 6 -->
                <div class="group bg-slate-50 dark:bg-slate-800 p-8 rounded-2xl border border-slate-200 dark:border-slate-700 hover:border-primary dark:hover:border-primary transition-all hover:shadow-xl hover:-translate-y-1">
                    <div class="w-14 h-14 bg-gradient-to-br from-violet-500 to-purple-500 rounded-xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform shadow-lg shadow-violet-500/30">
                        <i data-lucide="smartphone" class="w-7 h-7 text-white"></i>
                    </div>
                    <h3 class="text-xl font-bold text-slate-900 dark:text-white mb-3">
                        Fully Responsive
                    </h3>
                    <p class="text-slate-600 dark:text-slate-400">
                        Akses dari desktop, tablet, atau smartphone dengan pengalaman optimal di semua device
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- How It Works Section -->
    <section id="how-it-works" class="py-20 bg-slate-50 dark:bg-darkBg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <div class="inline-flex items-center px-4 py-2 bg-primary/10 dark:bg-primary/20 rounded-full text-primary text-sm font-semibold mb-4">
                    <i data-lucide="lightbulb" class="w-4 h-4 mr-2"></i>
                    Cara Kerja
                </div>
                <h2 class="text-3xl sm:text-4xl font-bold text-slate-900 dark:text-white mb-4">
                    Proses Analisis yang Simple
                </h2>
                <p class="text-lg text-slate-600 dark:text-slate-400 max-w-2xl mx-auto">
                    Hanya 4 langkah mudah untuk mendapatkan hasil analisis inventaris yang akurat
                </p>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-8">
                <!-- Step 1 -->
                <div class="relative text-center">
                    <div class="mx-auto w-20 h-20 bg-gradient-to-br from-primary to-purple-600 rounded-2xl flex items-center justify-center text-white text-2xl font-bold mb-6 shadow-xl shadow-primary/30">
                        1
                    </div>
                    <h3 class="text-lg font-bold text-slate-900 dark:text-white mb-2">Input Data</h3>
                    <p class="text-slate-600 dark:text-slate-400 text-sm">
                        Masukkan data inventaris dengan kondisi dan jumlah yang akan dianalisis
                    </p>
                    <!-- Arrow -->
                    <div class="hidden lg:block absolute top-10 -right-4 text-slate-300 dark:text-slate-700">
                        <i data-lucide="arrow-right" class="w-8 h-8"></i>
                    </div>
                </div>

                <!-- Step 2 -->
                <div class="relative text-center">
                    <div class="mx-auto w-20 h-20 bg-gradient-to-br from-blue-500 to-cyan-500 rounded-2xl flex items-center justify-center text-white text-2xl font-bold mb-6 shadow-xl shadow-blue-500/30">
                        2
                    </div>
                    <h3 class="text-lg font-bold text-slate-900 dark:text-white mb-2">Preprocessing</h3>
                    <p class="text-slate-600 dark:text-slate-400 text-sm">
                        Sistem melakukan normalisasi data secara otomatis menggunakan Min-Max
                    </p>
                    <!-- Arrow -->
                    <div class="hidden lg:block absolute top-10 -right-4 text-slate-300 dark:text-slate-700">
                        <i data-lucide="arrow-right" class="w-8 h-8"></i>
                    </div>
                </div>

                <!-- Step 3 -->
                <div class="relative text-center">
                    <div class="mx-auto w-20 h-20 bg-gradient-to-br from-emerald-500 to-teal-500 rounded-2xl flex items-center justify-center text-white text-2xl font-bold mb-6 shadow-xl shadow-emerald-500/30">
                        3
                    </div>
                    <h3 class="text-lg font-bold text-slate-900 dark:text-white mb-2">Analisis KNN</h3>
                    <p class="text-slate-600 dark:text-slate-400 text-sm">
                        Algoritma menghitung jarak dengan K tetangga terdekat menggunakan Euclidean
                    </p>
                    <!-- Arrow -->
                    <div class="hidden lg:block absolute top-10 -right-4 text-slate-300 dark:text-slate-700">
                        <i data-lucide="arrow-right" class="w-8 h-8"></i>
                    </div>
                </div>

                <!-- Step 4 -->
                <div class="text-center">
                    <div class="mx-auto w-20 h-20 bg-gradient-to-br from-amber-500 to-orange-500 rounded-2xl flex items-center justify-center text-white text-2xl font-bold mb-6 shadow-xl shadow-amber-500/30">
                        4
                    </div>
                    <h3 class="text-lg font-bold text-slate-900 dark:text-white mb-2">Hasil Rekomendasi</h3>
                    <p class="text-slate-600 dark:text-slate-400 text-sm">
                        Dapatkan hasil klasifikasi dengan confidence level yang jelas dan detail
                    </p>
                </div>
            </div>

            <!-- Visual Formula -->
            <div class="mt-16 bg-white dark:bg-slate-800 rounded-2xl p-8 border border-slate-200 dark:border-slate-700 max-w-3xl mx-auto">
                <div class="text-center mb-6">
                    <h3 class="text-xl font-bold text-slate-900 dark:text-white mb-4">Rumus Euclidean Distance</h3>
                    <div class="bg-slate-100 dark:bg-slate-700 rounded-lg p-6 font-mono text-sm">
                        <div class="text-center">
                            <span class="text-primary font-semibold">d(x,y) = √</span>
                            <span class="text-slate-700 dark:text-slate-300">Σ(x<sub>i</sub> - y<sub>i</sub>)<sup>2</sup></span>
                        </div>
                    </div>
                </div>
                <p class="text-center text-slate-600 dark:text-slate-400 text-sm">
                    Formula matematika yang digunakan untuk menghitung jarak antar data dalam algoritma KNN
                </p>
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section class="py-20 bg-white dark:bg-slate-900">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <div class="inline-flex items-center px-4 py-2 bg-primary/10 dark:bg-primary/20 rounded-full text-primary text-sm font-semibold mb-4">
                    <i data-lucide="users" class="w-4 h-4 mr-2"></i>
                    Testimoni Pengguna
                </div>
                <h2 class="text-3xl sm:text-4xl font-bold text-slate-900 dark:text-white mb-4">
                    Apa Kata Mereka?
                </h2>
                <p class="text-lg text-slate-600 dark:text-slate-400 max-w-2xl mx-auto">
                    Pengalaman nyata dari pengguna SmartSPK dalam mengelola inventaris
                </p>
            </div>

            <div class="grid md:grid-cols-3 gap-8">
                <!-- Testimonial 1 -->
                <div class="bg-slate-50 dark:bg-slate-800 p-8 rounded-2xl border border-slate-200 dark:border-slate-700">
                    <div class="flex items-center mb-4">
                        <div class="w-12 h-12 bg-gradient-to-br from-primary to-purple-600 rounded-full flex items-center justify-center text-white font-bold mr-4">
                            A
                        </div>
                        <div>
                            <h4 class="font-bold text-slate-900 dark:text-white">Andi Prasetyo</h4>
                            <p class="text-sm text-slate-600 dark:text-slate-400">Manajer Gudang</p>
                        </div>
                    </div>
                    <p class="text-slate-600 dark:text-slate-400 mb-4">
                        "SmartSPK membantu kami mengurangi kesalahan dalam penilaian inventaris hingga 90%. Proses yang dulunya memakan waktu berhari-hari kini hanya butuh beberapa menit!"
                    </p>
                    <div class="flex text-yellow-400">
                        <i data-lucide="star" class="w-5 h-5"></i>
                        <i data-lucide="star" class="w-5 h-5"></i>
                        <i data-lucide="star" class="w-5 h-5"></i>
                        <i data-lucide="star" class="w-5 h-5"></i>
                        <i data-lucide="star" class="w-5 h-5"></i>
                    </div>
                </div>

                <!-- Testimonial 2 -->
                <div class="bg-slate-50 dark:bg-slate-800 p-8 rounded-2xl border border-slate-200 dark:border-slate-700">
                    <div class="flex items-center mb-4">
                        <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-cyan-500 rounded-full flex items-center justify-center text-white font-bold mr-4">
                            B
                        </div>
                        <div>
                            <h4 class="font-bold text-slate-900 dark:text-white">Budi Santoso</h4>
                            <p class="text-sm text-slate-600 dark:text-slate-400">Staff Administrasi</p>
                        </div>
                    </div>
                    <p class="text-slate-600 dark:text-slate-400 mb-4">
                        "Dashboard yang intuitif dan laporan yang komprehensif membuat pekerjaan saya jauh lebih mudah. Fitur riwayat analisis sangat membantu untuk audit."
                    </p>
                    <div class="flex text-yellow-400">
                        <i data-lucide="star" class="w-5 h-5"></i>
                        <i data-lucide="star" class="w-5 h-5"></i>
                        <i data-lucide="star" class="w-5 h-5"></i>
                        <i data-lucide="star" class="w-5 h-5"></i>
                        <i data-lucide="star" class="w-5 h-5"></i>
                    </div>
                </div>

                <!-- Testimonial 3 -->
                <div class="bg-slate-50 dark:bg-slate-800 p-8 rounded-2xl border border-slate-200 dark:border-slate-700">
                    <div class="flex items-center mb-4">
                        <div class="w-12 h-12 bg-gradient-to-br from-emerald-500 to-teal-500 rounded-full flex items-center justify-center text-white font-bold mr-4">
                            C
                        </div>
                        <div>
                            <h4 class="font-bold text-slate-900 dark:text-white">Citra Dewi</h4>
                            <p class="text-sm text-slate-600 dark:text-slate-400">Kepala Divisi</p>
                        </div>
                    </div>
                    <p class="text-slate-600 dark:text-slate-400 mb-4">
                        "Implementasi SmartSPK memberikan efisiensi luar biasa bagi organisasi kami. Akurasi analisis yang tinggi membantu dalam pengambilan keputusan strategis."
                    </p>
                    <div class="flex text-yellow-400">
                        <i data-lucide="star" class="w-5 h-5"></i>
                        <i data-lucide="star" class="w-5 h-5"></i>
                        <i data-lucide="star" class="w-5 h-5"></i>
                        <i data-lucide="star" class="w-5 h-5"></i>
                        <i data-lucide="star" class="w-5 h-5"></i>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-20 bg-gradient-to-br from-primary to-purple-600">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-3xl sm:text-4xl font-bold text-white mb-4">
                Siap Tingkatkan Efisiensi Inventaris Anda?
            </h2>
            <p class="text-xl text-white mb-8 max-w-2xl mx-auto">
                Bergabunglah dengan ribuan pengguna yang telah mengoptimalkan manajemen inventaris mereka
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('register') }}" class="inline-flex items-center justify-center px-8 py-4 bg-white text-primary rounded-xl font-semibold shadow-2xl hover:bg-slate-50 transform hover:-translate-y-1 transition-all group">
                    <i data-lucide="zap" class="w-5 h-5 mr-2"></i>
                    <span>Coba Gratis Sekarang</span>
                </a>
                <a href="{{ route('login') }}" class="inline-flex items-center justify-center px-8 py-4 bg-transparent border-2 border-white text-white rounded-xl font-semibold hover:bg-white/10 transform hover:-translate-y-1 transition-all group">
                    <i data-lucide="book-open" class="w-5 h-5 mr-2"></i>
                    <span>Lihat Demo</span>
                </a>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-slate-900 text-slate-400 py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid md:grid-cols-4 gap-8">
                <div class="col-span-1 md:col-span-2">
                    <div class="flex items-center space-x-3 mb-6">
                        <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-primary to-purple-600 flex items-center justify-center shadow-lg">
                            <i data-lucide="activity" class="w-6 h-6 text-white"></i>
                        </div>
                        <span class="text-xl font-bold text-white">
                            Smart<span class="text-primary">SPK</span>
                        </span>
                    </div>
                    <p class="text-slate-400 mb-6 max-w-md">
                        Sistem Pendukung Keputusan berbasis KNN untuk analisis inventaris yang akurat, efisien, dan dapat diandalkan.
                    </p>
                    <div class="flex space-x-4">
                        <a href="#" class="w-10 h-10 bg-slate-800 rounded-lg flex items-center justify-center hover:bg-primary hover:text-white transition-colors">
                            <i data-lucide="facebook" class="w-5 h-5"></i>
                        </a>
                        <a href="#" class="w-10 h-10 bg-slate-800 rounded-lg flex items-center justify-center hover:bg-primary hover:text-white transition-colors">
                            <i data-lucide="twitter" class="w-5 h-5"></i>
                        </a>
                        <a href="#" class="w-10 h-10 bg-slate-800 rounded-lg flex items-center justify-center hover:bg-primary hover:text-white transition-colors">
                            <i data-lucide="linkedin" class="w-5 h-5"></i>
                        </a>
                        <a href="#" class="w-10 h-10 bg-slate-800 rounded-lg flex items-center justify-center hover:bg-primary hover:text-white transition-colors">
                            <i data-lucide="github" class="w-5 h-5"></i>
                        </a>
                    </div>
                </div>

                <div>
                    <h3 class="text-white font-semibold mb-4">Produk</h3>
                    <ul class="space-y-2">
                        <li><a href="#" class="hover:text-white transition-colors">Fitur Utama</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Harga</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Demo</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Dokumentasi</a></li>
                    </ul>
                </div>

                <div>
                    <h3 class="text-white font-semibold mb-4">Dukungan</h3>
                    <ul class="space-y-2">
                        <li><a href="#" class="hover:text-white transition-colors">Bantuan</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Kontak</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">FAQ</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Status</a></li>
                    </ul>
                </div>
            </div>

            <div class="border-t border-slate-800 mt-12 pt-8 text-center">
                <p>&copy; 2025 SmartSPK. Hak Cipta Dilindungi.</p>
            </div>
        </div>
    </footer>

    <script>
        // Mobile Menu Toggle
        const mobileMenuBtn = document.getElementById('mobileMenuBtn');
        const mobileMenu = document.getElementById('mobileMenu');

        mobileMenuBtn.addEventListener('click', () => {
            mobileMenu.classList.toggle('hidden');
        });

        // Theme Toggle
        const themeToggle = document.getElementById('themeToggle');
        
        themeToggle.addEventListener('click', () => {
            document.documentElement.classList.toggle('dark');
            localStorage.setItem('theme', document.documentElement.classList.contains('dark') ? 'dark' : 'light');
        });

        // Check saved theme
        const savedTheme = localStorage.getItem('theme');
        if (savedTheme === 'dark') {
            document.documentElement.classList.add('dark');
        }

        // Initialize Lucide Icons
        lucide.createIcons();

        // Smooth scrolling for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });

        // Header scroll effect
        window.addEventListener('scroll', () => {
            const header = document.querySelector('nav');
            if (window.scrollY > 50) {
                header.classList.add('shadow-lg');
            } else {
                header.classList.remove('shadow-lg');
            }
        });
    </script>
</body>
</html>