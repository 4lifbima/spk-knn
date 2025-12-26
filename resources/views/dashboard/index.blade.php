@extends('layouts.app')

@section('title', 'Dashboard - SPK KNN')
@section('page-title', 'Overview')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8 animate-fade-up">
    <!-- Stat 1 -->
    <div class="bg-white dark:bg-darkCard p-6 rounded-xl shadow-sm border border-slate-100 dark:border-slate-700 relative overflow-hidden">
        <div class="absolute right-0 top-0 h-full w-1 bg-primary"></div>
        <div class="flex justify-between items-start">
            <div>
                <p class="text-sm font-medium text-slate-500 dark:text-slate-400">Total Data Inventaris</p>
                <h3 class="text-3xl font-bold text-slate-800 dark:text-white mt-2">{{ $totalData }}</h3>
            </div>
            <div class="p-2 bg-primary/10 rounded-lg text-primary">
                <i data-lucide="database" class="w-6 h-6"></i>
            </div>
        </div>
    </div>

    <!-- Stat 2 -->
    <div class="bg-white dark:bg-darkCard p-6 rounded-xl shadow-sm border border-slate-100 dark:border-slate-700">
        <div class="flex justify-between items-start">
            <div>
                <p class="text-sm font-medium text-slate-500 dark:text-slate-400">Perlu perawatan</p>
                <h3 class="text-3xl font-bold text-slate-800 dark:text-white mt-2">{{ $perawatan }}</h3>
            </div>
            <div class="p-2 bg-yellow-100 dark:bg-yellow-900/30 rounded-lg text-yellow-600 dark:text-yellow-400">
                <i data-lucide="alert-triangle" class="w-6 h-6"></i>
            </div>
        </div>
    </div>

    <!-- Stat 3 -->
    <div class="bg-white dark:bg-darkCard p-6 rounded-xl shadow-sm border border-slate-100 dark:border-slate-700">
        <div class="flex justify-between items-start">
            <div>
                <p class="text-sm font-medium text-slate-500 dark:text-slate-400">Status Layak</p>
                <h3 class="text-3xl font-bold text-emerald-600 mt-2">{{ $layak }}</h3>
            </div>
            <div class="p-2 bg-emerald-100 dark:bg-emerald-900/30 rounded-lg text-emerald-600">
                <i data-lucide="check-circle" class="w-6 h-6"></i>
            </div>
        </div>
    </div>

    <!-- Stat 4 -->
    <div class="bg-white dark:bg-darkCard p-6 rounded-xl shadow-sm border border-slate-100 dark:border-slate-700">
        <div class="flex justify-between items-start">
            <div>
                <p class="text-sm font-medium text-slate-500 dark:text-slate-400">Perlu Diganti</p>
                <h3 class="text-3xl font-bold text-red-600 mt-2">{{ $ganti }}</h3>
            </div>
            <div class="p-2 bg-red-100 dark:bg-red-900/30 rounded-lg text-red-600">
                <i data-lucide="alert-triangle" class="w-6 h-6"></i>
            </div>
        </div>
    </div>
</div>

<!-- Welcome Section -->
<div class="bg-gradient-to-r from-primary to-blue-600 rounded-2xl p-8 text-white shadow-lg animate-fade-up relative overflow-hidden">
    <div class="relative z-10">
        <h2 class="text-2xl font-bold mb-2">Selamat Datang di SPKSmart Inventaris</h2>
        <p class="text-blue-100 max-w-2xl">Sistem Pendukung Keputusan menggunakan algoritma K-Nearest Neighbors (KNN) untuk menentukan kelayakan aset dan sarana berdasarkan kondisi, tahun, dan jumlah.</p>
        <a href="{{ route('process.index') }}" class="inline-block mt-6 px-6 py-2.5 bg-white text-primary font-semibold rounded-lg shadow hover:bg-gray-100 transition-colors">
            Mulai Analisis
        </a>
    </div>
    <!-- Decor -->
    <i data-lucide="activity" class="absolute -right-6 -bottom-6 w-48 h-48 text-white opacity-10"></i>
</div>
@endsection