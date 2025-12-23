@extends('layouts.guest')

@section('title', 'Lupa Password - SPK Smart')

@section('content')
<!-- Page Title -->
<div class="mb-6">
    <h2 class="text-2xl font-bold text-slate-900 dark:text-white mb-1">
        Lupa Password? 🔐
    </h2>
    <p class="text-sm text-slate-500 dark:text-slate-400">
        Tidak masalah! Masukkan email Anda dan kami akan mengirimkan link reset password.
    </p>
</div>

<!-- Session Status -->
@if (session('status'))
    <div class="mb-4 p-4 bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 rounded-lg flex items-start text-green-700 dark:text-green-400 text-sm">
        <i data-lucide="check-circle" class="w-5 h-5 mr-2 flex-shrink-0 mt-0.5"></i>
        <span>{{ session('status') }}</span>
    </div>
@endif

<!-- Forgot Password Form -->
<form method="POST" action="{{ route('password.email') }}" class="space-y-5">
    @csrf

    <!-- Email Field -->
    <div>
        <label for="email" class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">
            Email Address
        </label>
        <div class="relative">
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <i data-lucide="mail" class="w-5 h-5 text-slate-400"></i>
            </div>
            <input 
                id="email" 
                type="email" 
                name="email" 
                value="{{ old('email') }}"
                required 
                autofocus
                class="block w-full pl-10 pr-4 py-3 bg-slate-50 dark:bg-slate-800/50 border border-slate-200 dark:border-slate-700 rounded-lg text-slate-900 dark:text-white placeholder-slate-400 focus:ring-2 focus:ring-primary focus:border-transparent transition-all duration-200"
                placeholder="nama@email.com"
            >
        </div>
        @error('email')
            <p class="mt-2 text-sm text-red-600 dark:text-red-400 flex items-center">
                <i data-lucide="alert-circle" class="w-4 h-4 mr-1"></i>
                {{ $message }}
            </p>
        @enderror
    </div>

    <!-- Info Box -->
    <div class="bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800 rounded-lg p-4">
        <div class="flex items-start">
            <i data-lucide="info" class="w-5 h-5 text-blue-600 dark:text-blue-400 mr-2 flex-shrink-0 mt-0.5"></i>
            <p class="text-sm text-blue-700 dark:text-blue-300">
                Link reset password akan dikirim ke email Anda. Pastikan untuk memeriksa folder spam jika tidak menemukannya di inbox.
            </p>
        </div>
    </div>

    <!-- Submit Button -->
    <button 
        type="submit"
        class="w-full py-3 px-4 bg-gradient-to-r from-primary to-purple-600 hover:from-primaryHover hover:to-purple-700 text-white font-semibold rounded-lg shadow-lg shadow-primary/30 hover:shadow-xl hover:shadow-primary/40 transform hover:-translate-y-0.5 transition-all duration-200 flex items-center justify-center group"
    >
        <i data-lucide="send" class="w-5 h-5 mr-2 group-hover:translate-x-1 transition-transform"></i>
        <span>Kirim Link Reset Password</span>
    </button>

    <!-- Divider -->
    <div class="relative my-6">
        <div class="absolute inset-0 flex items-center">
            <div class="w-full border-t border-slate-200 dark:border-slate-700"></div>
        </div>
        <div class="relative flex justify-center text-sm">
            <span class="px-4 bg-white dark:bg-darkCard text-slate-500 dark:text-slate-400">
                Atau
            </span>
        </div>
    </div>

    <!-- Back to Login -->
    <div class="text-center">
        <a 
            href="{{ route('login') }}" 
            class="inline-flex items-center text-sm font-medium text-slate-600 dark:text-slate-400 hover:text-primary dark:hover:text-primary transition-colors group"
        >
            <i data-lucide="arrow-left" class="w-4 h-4 mr-2 group-hover:-translate-x-1 transition-transform"></i>
            Kembali ke Login
        </a>
    </div>
</form>

<script>
    // Re-initialize Lucide icons after page load
    document.addEventListener('DOMContentLoaded', function() {
        lucide.createIcons();
    });
</script>
@endsection