@extends('layouts.app')

@section('title', 'Edit Data Inventaris - SPK KNN')
@section('page-title', 'Edit Data Inventaris')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="bg-white dark:bg-darkCard rounded-xl shadow-sm border border-slate-100 dark:border-slate-700 animate-fade-up">
        <div class="p-6 border-b border-slate-100 dark:border-slate-700 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <a href="{{ route('dataset.index') }}" class="text-slate-400 hover:text-slate-600 dark:hover:text-slate-300 transition-colors">
                    <i data-lucide="arrow-left" class="w-5 h-5"></i>
                </a>
                <h3 class="font-bold text-lg text-slate-800 dark:text-white">Edit Data Inventaris</h3>
            </div>
            <span class="px-3 py-1 text-xs font-semibold rounded-full 
                @if($inventaris->status === 'Layak') bg-emerald-100 text-emerald-700 dark:bg-emerald-900/30 dark:text-emerald-400
                @elseif($inventaris->status === 'Perlu Diganti') bg-red-100 text-red-700 dark:bg-red-900/30 dark:text-red-400
                @else bg-yellow-100 text-yellow-700 dark:bg-yellow-900/30 dark:text-yellow-400
                @endif">
                {{ $inventaris->status }}
            </span>
        </div>
        
        @if($errors->any())
        <div class="mx-6 mt-4 p-4 bg-red-50 border border-red-200 text-red-700 rounded-lg">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        
        <form action="{{ route('dataset.update', $inventaris->id) }}" method="POST" class="p-6 space-y-6">
            @csrf
            @method('PUT')
            
            <!-- Nama Sarana -->
            <div>
                <label for="nama" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">
                    Nama Sarana <span class="text-red-500">*</span>
                </label>
                <input type="text" name="nama" id="nama" value="{{ old('nama', $inventaris->nama) }}" required 
                    class="w-full rounded-lg border-slate-300 dark:border-slate-600 bg-slate-50 dark:bg-slate-700 py-3 px-4 text-sm focus:ring-primary focus:border-primary dark:text-white"
                    placeholder="Masukkan nama sarana">
            </div>
            
            <!-- Tahun -->
            <div>
                <label for="tahun" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">
                    Tahun Pengadaan <span class="text-red-500">*</span>
                </label>
                <input type="number" name="tahun" id="tahun" value="{{ old('tahun', $inventaris->tahun) }}" min="1900" max="{{ date('Y') + 1 }}" required 
                    class="w-full rounded-lg border-slate-300 dark:border-slate-600 bg-slate-50 dark:bg-slate-700 py-3 px-4 text-sm focus:ring-primary focus:border-primary dark:text-white"
                    placeholder="{{ date('Y') }}">
            </div>
            
            <!-- Kondisi -->
            <div>
                <label for="kondisi" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">
                    Kondisi Sarana <span class="text-red-500">*</span>
                </label>
                <select name="kondisi" id="kondisi" required 
                    class="w-full rounded-lg border-slate-300 dark:border-slate-600 bg-slate-50 dark:bg-slate-700 py-3 px-4 text-sm focus:ring-primary focus:border-primary dark:text-white">
                    <option value="Baik" {{ old('kondisi', $inventaris->kondisi) == 'Baik' ? 'selected' : '' }}>Baik</option>
                    <option value="Rusak Ringan" {{ old('kondisi', $inventaris->kondisi) == 'Rusak Ringan' ? 'selected' : '' }}>Rusak Ringan</option>
                    <option value="Rusak Berat" {{ old('kondisi', $inventaris->kondisi) == 'Rusak Berat' ? 'selected' : '' }}>Rusak Berat</option>
                </select>
            </div>
            
            <!-- Tingkat Pemanfaatan -->
            <div>
                <label for="tingkat_pemanfaatan" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">
                    Tingkat Pemanfaatan <span class="text-red-500">*</span>
                </label>
                <select name="tingkat_pemanfaatan" id="tingkat_pemanfaatan" required 
                    class="w-full rounded-lg border-slate-300 dark:border-slate-600 bg-slate-50 dark:bg-slate-700 py-3 px-4 text-sm focus:ring-primary focus:border-primary dark:text-white">
                    <option value="Sering Digunakan" {{ old('tingkat_pemanfaatan', $inventaris->tingkat_pemanfaatan) == 'Sering Digunakan' ? 'selected' : '' }}>Sering Digunakan</option>
                    <option value="Kadang Digunakan" {{ old('tingkat_pemanfaatan', $inventaris->tingkat_pemanfaatan) == 'Kadang Digunakan' ? 'selected' : '' }}>Kadang Digunakan</option>
                    <option value="Tidak Digunakan" {{ old('tingkat_pemanfaatan', $inventaris->tingkat_pemanfaatan) == 'Tidak Digunakan' ? 'selected' : '' }}>Tidak Digunakan</option>
                </select>
            </div>
            
            <!-- Tingkat Kebutuhan -->
            <div>
                <label for="tingkat_kebutuhan" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">
                    Tingkat Kebutuhan <span class="text-red-500">*</span>
                </label>
                <select name="tingkat_kebutuhan" id="tingkat_kebutuhan" required 
                    class="w-full rounded-lg border-slate-300 dark:border-slate-600 bg-slate-50 dark:bg-slate-700 py-3 px-4 text-sm focus:ring-primary focus:border-primary dark:text-white">
                    <option value="Sangat Dibutuhkan" {{ old('tingkat_kebutuhan', $inventaris->tingkat_kebutuhan) == 'Sangat Dibutuhkan' ? 'selected' : '' }}>Sangat Dibutuhkan</option>
                    <option value="Dibutuhkan" {{ old('tingkat_kebutuhan', $inventaris->tingkat_kebutuhan) == 'Dibutuhkan' ? 'selected' : '' }}>Dibutuhkan</option>
                    <option value="Sangat Tidak Dibutuhkan" {{ old('tingkat_kebutuhan', $inventaris->tingkat_kebutuhan) == 'Sangat Tidak Dibutuhkan' ? 'selected' : '' }}>Sangat Tidak Dibutuhkan</option>
                </select>
            </div>
            
            <!-- Info Status -->
            <div class="bg-slate-50 dark:bg-slate-800/50 rounded-lg p-4">
                <h4 class="text-sm font-medium text-slate-700 dark:text-slate-300 mb-3 flex items-center">
                    <i data-lucide="info" class="w-4 h-4 mr-2"></i>
                    Keterangan Status Otomatis
                </h4>
                <p class="text-sm text-slate-600 dark:text-slate-400 mb-3">
                    Status kelayakan dihitung dari skor total 3 variabel (masing-masing bernilai 1-3):
                </p>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-3 text-sm">
                    <div class="flex items-center gap-2">
                        <span class="w-3 h-3 rounded-full bg-emerald-500"></span>
                        <span class="text-slate-600 dark:text-slate-400">Skor ≥ 7 = <strong class="text-emerald-600">Layak</strong></span>
                    </div>
                    <div class="flex items-center gap-2">
                        <span class="w-3 h-3 rounded-full bg-yellow-500"></span>
                        <span class="text-slate-600 dark:text-slate-400">Skor 5-6 = <strong class="text-yellow-600">Perawatan</strong></span>
                    </div>
                    <div class="flex items-center gap-2">
                        <span class="w-3 h-3 rounded-full bg-red-500"></span>
                        <span class="text-slate-600 dark:text-slate-400">Skor ≤ 4 = <strong class="text-red-600">Perlu Diganti</strong></span>
                    </div>
                </div>
            </div>
            
            <!-- Action Buttons -->
            <div class="flex flex-col sm:flex-row gap-3 pt-4">
                <a href="{{ route('dataset.index') }}" class="flex-1 px-6 py-3 border border-slate-300 dark:border-slate-600 rounded-lg text-sm font-medium text-center hover:bg-slate-50 dark:hover:bg-slate-700 dark:text-slate-300 transition-colors">
                    Batal
                </a>
                <button type="submit" class="flex-1 px-6 py-3 bg-primary hover:bg-primaryHover text-white rounded-lg text-sm font-medium flex items-center justify-center transition-colors">
                    <i data-lucide="save" class="w-4 h-4 mr-2"></i>
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
    
    <!-- Meta Info -->
    <div class="mt-4 text-center text-sm text-slate-500 dark:text-slate-400">
        <p>ID: {{ $inventaris->id }} | Dibuat: {{ $inventaris->created_at->format('d M Y H:i') }} | Terakhir diubah: {{ $inventaris->updated_at->format('d M Y H:i') }}</p>
    </div>
</div>
@endsection

@push('scripts')
<script>
    lucide.createIcons();
</script>
@endpush
