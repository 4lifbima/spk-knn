@extends('layouts.guest')

@section('title', 'Register - SPK Smart')

@section('content')
<!-- Page Title -->
<div class="mb-6">
    <h2 class="text-2xl font-bold text-slate-900 dark:text-white mb-1">
        Buat Akun Baru 🚀
    </h2>
    <p class="text-sm text-slate-500 dark:text-slate-400">
        Daftar untuk mengakses sistem analisis inventaris
    </p>
</div>

<!-- Register Form -->
<form method="POST" action="{{ route('register') }}" class="space-y-5">
    @csrf

    <!-- Name Field -->
    <div>
        <label for="name" class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">
            Nama Lengkap
        </label>
        <div class="relative">
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <i data-lucide="user" class="w-5 h-5 text-slate-400"></i>
            </div>
            <input 
                id="name" 
                type="text" 
                name="name" 
                value="{{ old('name') }}"
                required 
                autofocus
                autocomplete="name"
                class="block w-full pl-10 pr-4 py-3 bg-slate-50 dark:bg-slate-800/50 border border-slate-200 dark:border-slate-700 rounded-lg text-slate-900 dark:text-white placeholder-slate-400 focus:ring-2 focus:ring-primary focus:border-transparent transition-all duration-200"
                placeholder="John Doe"
            >
        </div>
        @error('name')
            <p class="mt-2 text-sm text-red-600 dark:text-red-400 flex items-center">
                <i data-lucide="alert-circle" class="w-4 h-4 mr-1"></i>
                {{ $message }}
            </p>
        @enderror
    </div>

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
                autocomplete="new-password"
                class="block w-full pl-10 pr-12 py-3 bg-slate-50 dark:bg-slate-800/50 border border-slate-200 dark:border-slate-700 rounded-lg text-slate-900 dark:text-white placeholder-slate-400 focus:ring-2 focus:ring-primary focus:border-transparent transition-all duration-200"
                placeholder="Minimal 8 karakter"
            >
            <button 
                type="button" 
                onclick="togglePassword('password')"
                class="absolute inset-y-0 right-0 pr-3 flex items-center text-slate-400 hover:text-slate-600 dark:hover:text-slate-300"
            >
                <i data-lucide="eye" id="eye-icon-password" class="w-5 h-5"></i>
            </button>
        </div>
        @error('password')
            <p class="mt-2 text-sm text-red-600 dark:text-red-400 flex items-center">
                <i data-lucide="alert-circle" class="w-4 h-4 mr-1"></i>
                {{ $message }}
            </p>
        @enderror
        <p class="mt-2 text-xs text-slate-500 dark:text-slate-400 flex items-center">
            <i data-lucide="info" class="w-3 h-3 mr-1"></i>
            Password minimal 8 karakter
        </p>
    </div>

    <!-- Password Confirmation Field -->
    <div>
        <label for="password_confirmation" class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">
            Konfirmasi Password
        </label>
        <div class="relative">
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <i data-lucide="lock" class="w-5 h-5 text-slate-400"></i>
            </div>
            <input 
                id="password_confirmation" 
                type="password" 
                name="password_confirmation" 
                required 
                autocomplete="new-password"
                class="block w-full pl-10 pr-12 py-3 bg-slate-50 dark:bg-slate-800/50 border border-slate-200 dark:border-slate-700 rounded-lg text-slate-900 dark:text-white placeholder-slate-400 focus:ring-2 focus:ring-primary focus:border-transparent transition-all duration-200"
                placeholder="Ulangi password"
            >
            <button 
                type="button" 
                onclick="togglePassword('password_confirmation')"
                class="absolute inset-y-0 right-0 pr-3 flex items-center text-slate-400 hover:text-slate-600 dark:hover:text-slate-300"
            >
                <i data-lucide="eye" id="eye-icon-password_confirmation" class="w-5 h-5"></i>
            </button>
        </div>
        @error('password_confirmation')
            <p class="mt-2 text-sm text-red-600 dark:text-red-400 flex items-center">
                <i data-lucide="alert-circle" class="w-4 h-4 mr-1"></i>
                {{ $message }}
            </p>
        @enderror
    </div>

    <!-- Terms & Conditions (Optional) -->
    <div class="flex items-start">
        <div class="flex items-center h-5">
            <input 
                id="terms" 
                type="checkbox" 
                required
                class="w-4 h-4 text-primary bg-slate-50 dark:bg-slate-800 border-slate-300 dark:border-slate-600 rounded focus:ring-2 focus:ring-primary cursor-pointer"
            >
        </div>
        <label for="terms" class="ml-2 text-sm text-slate-600 dark:text-slate-400">
            Saya setuju dengan 
            <a href="#" class="text-primary hover:text-primaryHover font-medium">Syarat & Ketentuan</a> 
            serta 
            <a href="#" class="text-primary hover:text-primaryHover font-medium">Kebijakan Privasi</a>
        </label>
    </div>

    <!-- Submit Button -->
    <button 
        type="submit"
        class="w-full py-3 px-4 bg-gradient-to-r from-primary to-purple-600 hover:from-primaryHover hover:to-purple-700 text-white font-semibold rounded-lg shadow-lg shadow-primary/30 hover:shadow-xl hover:shadow-primary/40 transform hover:-translate-y-0.5 transition-all duration-200 flex items-center justify-center group"
    >
        <span>Buat Akun</span>
        <i data-lucide="user-plus" class="w-5 h-5 ml-2 group-hover:scale-110 transition-transform"></i>
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

    <!-- Login Link -->
    <div class="text-center">
        <p class="text-sm text-slate-600 dark:text-slate-400">
            Sudah punya akun?
            <a 
                href="{{ route('login') }}" 
                class="font-semibold text-primary hover:text-primaryHover transition-colors"
            >
                Login Sekarang
            </a>
        </p>
    </div>
</form>

<script>
    function togglePassword(fieldId) {
        const passwordInput = document.getElementById(fieldId);
        const eyeIcon = document.getElementById(`eye-icon-${fieldId}`);
        
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