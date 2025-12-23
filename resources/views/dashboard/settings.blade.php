@extends('layouts.app')

@section('title', 'Pengaturan - SPK KNN')
@section('page-title', 'Pengaturan')

@section('content')
<div class="max-w-2xl mx-auto animate-fade-up">
    <div class="bg-white dark:bg-darkCard rounded-xl shadow-sm border border-slate-100 dark:border-slate-700 overflow-hidden">
        <div class="p-6 border-b border-slate-100 dark:border-slate-700">
            <h3 class="text-lg font-bold text-slate-800 dark:text-white flex items-center">
                <i data-lucide="lock" class="w-5 h-5 mr-2 text-primary"></i>
                Ubah Kata Sandi
            </h3>
            <p class="text-sm text-slate-500 mt-1">Perbarui kata sandi akun Anda untuk keamanan yang lebih baik</p>
        </div>
        
        <div class="p-6">
            @if(session('status') === 'password-updated')
            <div class="mb-4 p-4 bg-green-50 border border-green-200 text-green-700 rounded-lg flex items-center">
                <i data-lucide="check-circle" class="w-5 h-5 mr-2"></i>
                Kata sandi berhasil diperbarui!
            </div>
            @endif
            
            <form action="{{ route('settings.password') }}" method="POST" class="space-y-4">
                @csrf
                @method('PATCH')
                
                <div>
                    <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">
                        Kata Sandi Saat Ini
                    </label>
                    <input 
                        type="password" 
                        name="current_password" 
                        required 
                        class="w-full rounded-lg border-slate-300 dark:border-slate-600 bg-slate-50 dark:bg-slate-700 py-2 px-3 text-sm focus:ring-primary focus:border-primary dark:text-white"
                        placeholder="Masukkan kata sandi saat ini"
                    >
                    @error('current_password')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">
                        Kata Sandi Baru
                    </label>
                    <input 
                        type="password" 
                        name="password" 
                        required 
                        class="w-full rounded-lg border-slate-300 dark:border-slate-600 bg-slate-50 dark:bg-slate-700 py-2 px-3 text-sm focus:ring-primary focus:border-primary dark:text-white"
                        placeholder="Masukkan kata sandi baru (min. 8 karakter)"
                    >
                    @error('password')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                    <p class="text-xs text-slate-500 mt-1">Minimal 8 karakter</p>
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">
                        Konfirmasi Kata Sandi Baru
                    </label>
                    <input 
                        type="password" 
                        name="password_confirmation" 
                        required 
                        class="w-full rounded-lg border-slate-300 dark:border-slate-600 bg-slate-50 dark:bg-slate-700 py-2 px-3 text-sm focus:ring-primary focus:border-primary dark:text-white"
                        placeholder="Konfirmasi kata sandi baru"
                    >
                </div>
                
                <div class="pt-4 border-t border-slate-100 dark:border-slate-700">
                    <button 
                        type="submit" 
                        class="px-6 py-2 bg-primary text-white rounded-lg text-sm font-medium hover:bg-primaryHover transition flex items-center"
                    >
                        <i data-lucide="save" class="w-4 h-4 mr-2"></i>
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
    
    <!-- Security Tips -->
    <div class="mt-6 bg-blue-50 dark:bg-blue-900/20 p-4 rounded-xl border border-blue-100 dark:border-blue-800">
        <h4 class="font-semibold text-blue-800 dark:text-blue-300 text-sm mb-2 flex items-center">
            <i data-lucide="shield-check" class="w-4 h-4 mr-2"></i>
            Tips Keamanan
        </h4>
        <ul class="text-xs text-blue-600 dark:text-blue-400 space-y-1 ml-6 list-disc">
            <li>Gunakan kombinasi huruf besar, huruf kecil, angka, dan simbol</li>
            <li>Hindari menggunakan informasi pribadi yang mudah ditebak</li>
            <li>Jangan menggunakan kata sandi yang sama untuk akun lain</li>
            <li>Ganti kata sandi secara berkala untuk keamanan maksimal</li>
        </ul>
    </div>
</div>
@endsection