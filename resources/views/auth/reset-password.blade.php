@extends('layouts.guest')

@section('title', 'Reset Password - SPK Smart')

@section('content')
<!-- Page Title -->
<div class="mb-6">
    <h2 class="text-2xl font-bold text-slate-900 dark:text-white mb-1">
        Reset Password 🔑
    </h2>
    <p class="text-sm text-slate-500 dark:text-slate-400">
        Masukkan password baru Anda untuk mengamankan akun
    </p>
</div>

<!-- Reset Password Form -->
<form method="POST" action="{{ route('password.store') }}" class="space-y-5">
    @csrf

    <!-- Password Reset Token -->
    <input type="hidden" name="token" value="{{ $request->route('token') }}">

    <!-- Email Field (Read-only) -->
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
                value="{{ old('email', $request->email) }}"
                required 
                autofocus
                autocomplete="username"
                class="block w-full pl-10 pr-4 py-3 bg-slate-100 dark:bg-slate-800/30 border border-slate-200 dark:border-slate-700 rounded-lg text-slate-600 dark:text-slate-400 cursor-not-allowed"
                readonly
            >
        </div>
        @error('email')
            <p class="mt-2 text-sm text-red-600 dark:text-red-400 flex items-center">
                <i data-lucide="alert-circle" class="w-4 h-4 mr-1"></i>
                {{ $message }}
            </p>
        @enderror
    </div>

    <!-- New Password Field -->
    <div>
        <label for="password" class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">
            Password Baru
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
    </div>

    <!-- Password Confirmation Field -->
    <div>
        <label for="password_confirmation" class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">
            Konfirmasi Password Baru
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
                placeholder="Ulangi password baru"
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

    <!-- Password Requirements -->
    <div class="bg-slate-50 dark:bg-slate-800/30 border border-slate-200 dark:border-slate-700 rounded-lg p-4">
        <h4 class="text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2 flex items-center">
            <i data-lucide="shield-check" class="w-4 h-4 mr-2 text-primary"></i>
            Persyaratan Password
        </h4>
        <ul class="text-xs text-slate-600 dark:text-slate-400 space-y-1 ml-6 list-disc">
            <li>Minimal 8 karakter</li>
            <li>Kombinasi huruf dan angka (direkomendasikan)</li>
            <li>Hindari password yang mudah ditebak</li>
        </ul>
    </div>

    <!-- Submit Button -->
    <button 
        type="submit"
        class="w-full py-3 px-4 bg-gradient-to-r from-primary to-purple-600 hover:from-primaryHover hover:to-purple-700 text-white font-semibold rounded-lg shadow-lg shadow-primary/30 hover:shadow-xl hover:shadow-primary/40 transform hover:-translate-y-0.5 transition-all duration-200 flex items-center justify-center group"
    >
        <i data-lucide="key" class="w-5 h-5 mr-2 group-hover:rotate-12 transition-transform"></i>
        <span>Reset Password</span>
    </button>
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