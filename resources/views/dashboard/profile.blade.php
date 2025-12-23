@extends('layouts.app')

@section('title', 'Profil - SPK KNN')
@section('page-title', 'Profil Pengguna')

@section('content')
<div class="max-w-2xl mx-auto animate-fade-up">
    <div class="bg-white dark:bg-darkCard rounded-xl shadow-sm border border-slate-100 dark:border-slate-700 overflow-hidden">
        <div class="h-32 bg-gradient-to-r from-primary to-purple-600"></div>
        <div class="px-8 pb-8">
            <div class="relative -top-12 mb-[-30px]">
                @if($user->photo)
                    <img src="{{ asset($user->photo) }}" class="w-24 h-24 rounded-full border-4 border-white dark:border-darkCard bg-slate-200 object-cover">
                @else
                    <img src="https://api.dicebear.com/7.x/avataaars/svg?seed={{ $user->name }}" class="w-24 h-24 rounded-full border-4 border-white dark:border-darkCard bg-slate-200">
                @endif
            </div>
            
            @if(session('status') === 'profile-updated')
            <div class="mb-4 p-4 bg-green-50 border border-green-200 text-green-700 rounded-lg">
                Profil berhasil diperbarui!
            </div>
            @endif
            
            <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PATCH')
                
                <div class="flex justify-between items-end mb-6">
                    <div>
                        <h2 class="text-2xl font-bold text-slate-900 dark:text-white mt-4">{{ $user->name }}</h2>
                        <p class="text-slate-500">{{ $user->role ?? 'User' }}</p>
                    </div>
                </div>

                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Nama Lengkap</label>
                        <input type="text" name="name" value="{{ old('name', $user->name) }}" required class="w-full rounded-lg border-slate-300 dark:border-slate-600 bg-slate-50 dark:bg-slate-700 py-2 px-3 text-sm focus:ring-primary focus:border-primary dark:text-white">
                        @error('name')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Username</label>
                            <input type="text" name="username" value="{{ old('username', $user->username) }}" class="w-full rounded-lg border-slate-300 dark:border-slate-600 bg-slate-50 dark:bg-slate-700 py-2 px-3 text-sm focus:ring-primary focus:border-primary dark:text-white">
                            @error('username')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Email</label>
                            <input type="email" name="email" value="{{ old('email', $user->email) }}" required class="w-full rounded-lg border-slate-300 dark:border-slate-600 bg-slate-50 dark:bg-slate-700 py-2 px-3 text-sm focus:ring-primary focus:border-primary dark:text-white">
                            @error('email')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Role</label>
                        <input type="text" name="role" value="{{ old('role', $user->role ?? 'Kepala Bagian Sarana') }}" class="w-full rounded-lg border-slate-300 dark:border-slate-600 bg-slate-50 dark:bg-slate-700 py-2 px-3 text-sm focus:ring-primary focus:border-primary dark:text-white">
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Foto Profil</label>
                        <input type="file" name="photo" accept="image/*" class="w-full rounded-lg border-slate-300 dark:border-slate-600 bg-slate-50 dark:bg-slate-700 py-2 px-3 text-sm focus:ring-primary focus:border-primary dark:text-white file:mr-4 file:py-1 file:px-3 file:rounded file:border-0 file:text-sm file:bg-primary file:text-white">
                        <p class="text-xs text-slate-500 mt-1">Format: JPG, PNG, JPEG (Max 2MB)</p>
                        @error('photo')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                
                <div class="flex gap-2 pt-6 border-t border-slate-100 dark:border-slate-700 mt-6">
                    <button type="submit" class="px-6 py-2 bg-primary text-white rounded-lg text-sm font-medium hover:bg-primaryHover transition">
                        Simpan Perubahan
                    </button>
                    <a href="{{ route('dashboard') }}" class="px-6 py-2 border border-slate-300 dark:border-slate-600 rounded-lg text-sm font-medium hover:bg-slate-50 dark:hover:bg-slate-700 dark:text-slate-300">
                        Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection