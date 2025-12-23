@extends('layouts.guest')

@section('title', 'Login - SPK Smart')

@section('content')
<!-- Page Title -->
<div class="mb-6">
    <h2 class="text-2xl font-bold text-slate-900 dark:text-white mb-1">
        Selamat Datang! 👋
    </h2>
    <p class="text-sm text-slate-500 dark:text-slate-400">
        Silakan login untuk melanjutkan ke dashboard
    </p>
</div>

<!-- Session Status -->
@if (session('status'))
    <div class="mb-4 p-4 bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 rounded-lg flex items-center text-green-700 dark:text-green-400 text-sm">
        <i data-lucide="check-circle" class="w-5 h-5 mr-2"></i>
        {{ session('status') }}
    </div>
@endif

<!-- Login Form -->
<form method="POST" action="{{ route('login') }}" class="space-y-5">
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
                autocomplete="username"
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

    <!-- Password Field -->
    <div>
        <label for="password" class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">
            Password
        </label>
        <div class="relative">
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <i data-lucide="lock" class="w-5 h-5 text-slate-400"></i>
            </div>
            <input 
                id="password" 
                type="password" 
                name="password" 
                required 
                autocomplete="current-password"
                class="block w-full pl-10 pr-12 py-3 bg-slate-50 dark:bg-slate-800/50 border border-slate-200 dark:border-slate-700 rounded-lg text-slate-900 dark:text-white placeholder-slate-400 focus:ring-2 focus:ring-primary focus:border-transparent transition-all duration-200"
                placeholder="••••••••"
            >
            <button 
                type="button" 
                onclick="togglePassword()"
                class="absolute inset-y-0 right-0 pr-3 flex items-center text-slate-400 hover:text-slate-600 dark:hover:text-slate-300"
            >
                <i data-lucide="eye" id="eye-icon" class="w-5 h-5"></i>
            </button>
        </div>
        @error('password')
            <p class="mt-2 text-sm text-red-600 dark:text-red-400 flex items-center">
                <i data-lucide="alert-circle" class="w-4 h-4 mr-1"></i>
                {{ $message }}
            </p>
        @enderror
    </div>

    <!-- Remember Me & Forgot Password -->
    <div class="flex items-center justify-between">
        <label class="flex items-center cursor-pointer group">
            <input 
                type="checkbox" 
                name="remember" 
                id="remember_me"
                class="w-4 h-4 text-primary bg-slate-50 dark:bg-slate-800 border-slate-300 dark:border-slate-600 rounded focus:ring-2 focus:ring-primary cursor-pointer"
            >
            <span class="ml-2 text-sm text-slate-600 dark:text-slate-400 group-hover:text-slate-900 dark:group-hover:text-slate-200 transition-colors">
                Ingat saya
            </span>
        </label>

        @if (Route::has('password.request'))
            <a 
                href="{{ route('password.request') }}" 
                class="text-sm font-medium text-primary hover:text-primaryHover transition-colors"
            >
                Lupa password?
            </a>
        @endif
    </div>

    <!-- Submit Button -->
    <button 
        type="submit"
        class="w-full py-3 px-4 bg-gradient-to-r from-primary to-purple-600 hover:from-primaryHover hover:to-purple-700 text-white font-semibold rounded-lg shadow-lg shadow-primary/30 hover:shadow-xl hover:shadow-primary/40 transform hover:-translate-y-0.5 transition-all duration-200 flex items-center justify-center group"
    >
        <span>Masuk ke Dashboard</span>
        <i data-lucide="arrow-right" class="w-5 h-5 ml-2 group-hover:translate-x-1 transition-transform"></i>
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

    <!-- Register Link -->
    <div class="text-center">
        <p class="text-sm text-slate-600 dark:text-slate-400">
            Belum punya akun?
            <a 
                href="{{ route('register') }}" 
                class="font-semibold text-primary hover:text-primaryHover transition-colors"
            >
                Daftar Sekarang
            </a>
        </p>
    </div>
</form>

<script>
    function togglePassword() {
        const passwordInput = document.getElementById('password');
        const eyeIcon = document.getElementById('eye-icon');
        
        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            eyeIcon.setAttribute('data-lucide', 'eye-off');
        } else {
            passwordInput.type = 'password';
            eyeIcon.setAttribute('data-lucide', 'eye');
        }
        
        lucide.createIcons();
    }

    // Re-initialize Lucide icons after page load
    document.addEventListener('DOMContentLoaded', function() {
        lucide.createIcons();
    });
</script>
@endsection