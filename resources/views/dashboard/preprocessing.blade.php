@extends('layouts.app')

@section('title', 'Preprocessing Data - SPK KNN')
@section('page-title', 'Preprocessing Data')

@section('content')
<div class="space-y-6 animate-fade-up">
    
    <!-- Info Banner -->
    <div class="bg-gradient-to-r from-primary/10 to-blue-500/10 dark:from-primary/20 dark:to-blue-500/20 rounded-xl p-6 border border-primary/20">
        <div class="flex items-start gap-4">
            <div class="w-12 h-12 rounded-xl bg-primary/20 flex items-center justify-center flex-shrink-0">
                <i data-lucide="info" class="w-6 h-6 text-primary"></i>
            </div>
            <div>
                <h3 class="font-bold text-slate-800 dark:text-white mb-1">Apa itu Preprocessing?</h3>
                <p class="text-sm text-slate-600 dark:text-slate-400 leading-relaxed">
                    <strong>Preprocessing</strong> adalah tahap persiapan data sebelum diproses oleh algoritma KNN. 
                    Pada tahap ini, sistem melakukan <strong>encoding variabel kategoris</strong> ke nilai numerik (1-3) lalu 
                    <strong>normalisasi Min-Max</strong> untuk mengubah nilai ke skala 0-1 agar semua fitur memiliki bobot yang seimbang.
                </p>
            </div>
        </div>
    </div>

    <!-- Steps -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <div class="bg-white dark:bg-darkCard p-5 rounded-xl border border-slate-100 dark:border-slate-700 shadow-sm relative">
            <div class="flex items-center mb-3">
                <div class="w-8 h-8 rounded-full bg-green-100 text-green-600 flex items-center justify-center font-bold mr-3">
                    <i data-lucide="check" class="w-4 h-4"></i>
                </div>
                <h4 class="font-semibold dark:text-white">Encoding Kategoris</h4>
            </div>
            <p class="text-sm text-slate-500">Mengubah nilai kategoris (Baik, Rusak Ringan, dll) ke nilai numerik 1-3.</p>
            <div class="mt-3">
                <span class="px-2 py-1 bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-400 text-xs rounded font-bold">Selesai</span>
            </div>
        </div>
        <div class="bg-white dark:bg-darkCard p-5 rounded-xl border-2 border-primary/30 shadow-sm relative">
            <div class="flex items-center mb-3">
                <div class="w-8 h-8 rounded-full bg-primary text-white flex items-center justify-center font-bold mr-3">2</div>
                <h4 class="font-semibold text-primary">Normalisasi Min-Max</h4>
            </div>
            <p class="text-sm text-slate-500">Mengubah range nilai ke skala 0-1 dengan formula (x-min)/(max-min).</p>
            <div class="mt-3">
                <span class="px-2 py-1 bg-primary/10 text-primary text-xs rounded font-bold">Aktif</span>
            </div>
        </div>
        <div class="bg-white dark:bg-darkCard p-5 rounded-xl border border-slate-100 dark:border-slate-700 shadow-sm relative">
            <div class="flex items-center mb-3">
                <div class="w-8 h-8 rounded-full bg-slate-100 dark:bg-slate-700 text-slate-600 dark:text-slate-400 flex items-center justify-center font-bold mr-3">3</div>
                <h4 class="font-semibold dark:text-white">Siap Proses</h4>
            </div>
            <p class="text-sm text-slate-500">Data ternormalisasi siap untuk proses klasifikasi KNN.</p>
            <div class="mt-3">
                <a href="{{ route('process.index') }}" class="px-2 py-1 bg-slate-100 text-slate-600 dark:bg-slate-700 dark:text-slate-400 text-xs rounded font-bold hover:bg-slate-200 dark:hover:bg-slate-600 transition-colors inline-flex items-center">
                    <i data-lucide="arrow-right" class="w-3 h-3 mr-1"></i> Lanjut Proses KNN
                </a>
            </div>
        </div>
    </div>

    <!-- Encoding Table -->
    <div class="bg-white dark:bg-darkCard rounded-xl shadow-sm p-6 border border-slate-100 dark:border-slate-700">
        <div class="flex items-center gap-3 mb-4">
            <div class="w-10 h-10 rounded-lg bg-blue-100 dark:bg-blue-900/30 flex items-center justify-center">
                <i data-lucide="list-ordered" class="w-5 h-5 text-blue-600 dark:text-blue-400"></i>
            </div>
            <div>
                <h3 class="font-bold text-lg text-slate-800 dark:text-white">Encoding Variabel Kategoris</h3>
                <p class="text-sm text-slate-500">Konversi nilai kategoris ke numerik untuk perhitungan KNN</p>
            </div>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div class="bg-slate-50 dark:bg-slate-800/50 rounded-lg p-4">
                <h4 class="font-semibold text-sm text-slate-700 dark:text-slate-300 mb-2">Kondisi Sarana</h4>
                <ul class="text-sm space-y-1">
                    <li class="flex justify-between"><span class="text-emerald-600">Baik</span> <span class="font-mono font-bold">3</span></li>
                    <li class="flex justify-between"><span class="text-yellow-600">Rusak Ringan</span> <span class="font-mono font-bold">2</span></li>
                    <li class="flex justify-between"><span class="text-red-600">Rusak Berat</span> <span class="font-mono font-bold">1</span></li>
                </ul>
            </div>
            <div class="bg-slate-50 dark:bg-slate-800/50 rounded-lg p-4">
                <h4 class="font-semibold text-sm text-slate-700 dark:text-slate-300 mb-2">Tingkat Pemanfaatan</h4>
                <ul class="text-sm space-y-1">
                    <li class="flex justify-between"><span class="text-blue-600">Sering Digunakan</span> <span class="font-mono font-bold">3</span></li>
                    <li class="flex justify-between"><span class="text-slate-600">Kadang Digunakan</span> <span class="font-mono font-bold">2</span></li>
                    <li class="flex justify-between"><span class="text-orange-600">Tidak Digunakan</span> <span class="font-mono font-bold">1</span></li>
                </ul>
            </div>
            <div class="bg-slate-50 dark:bg-slate-800/50 rounded-lg p-4">
                <h4 class="font-semibold text-sm text-slate-700 dark:text-slate-300 mb-2">Tingkat Kebutuhan</h4>
                <ul class="text-sm space-y-1">
                    <li class="flex justify-between"><span class="text-purple-600">Sangat Dibutuhkan</span> <span class="font-mono font-bold">3</span></li>
                    <li class="flex justify-between"><span class="text-indigo-600">Dibutuhkan</span> <span class="font-mono font-bold">2</span></li>
                    <li class="flex justify-between"><span class="text-gray-600">Sangat Tidak Dibutuhkan</span> <span class="font-mono font-bold">1</span></li>
                </ul>
            </div>
        </div>
    </div>

    <!-- Formula Card -->
    <div class="bg-white dark:bg-darkCard rounded-xl shadow-sm p-6 border border-slate-100 dark:border-slate-700">
        <div class="flex items-center gap-3 mb-4">
            <div class="w-10 h-10 rounded-lg bg-primary/10 flex items-center justify-center">
                <i data-lucide="function-square" class="w-5 h-5 text-primary"></i>
            </div>
            <div>
                <h3 class="font-bold text-lg text-slate-800 dark:text-white">Rumus Min-Max Normalization</h3>
                <p class="text-sm text-slate-500">Formula untuk mengubah data ke skala 0-1</p>
            </div>
        </div>
        <div class="bg-slate-50 dark:bg-slate-800/50 rounded-lg p-4 text-center">
            <code class="text-lg font-mono text-primary font-bold">x' = (x - min) / (max - min) = (x - 1) / 2</code>
        </div>
        <div class="mt-4 grid grid-cols-1 md:grid-cols-3 gap-4 text-sm">
            <div class="flex items-center gap-2">
                <span class="w-6 h-6 rounded bg-primary/10 text-primary font-mono font-bold text-xs flex items-center justify-center">x'</span>
                <span class="text-slate-600 dark:text-slate-400">= Nilai hasil normalisasi (0-1)</span>
            </div>
            <div class="flex items-center gap-2">
                <span class="w-6 h-6 rounded bg-primary/10 text-primary font-mono font-bold text-xs flex items-center justify-center">x</span>
                <span class="text-slate-600 dark:text-slate-400">= Nilai encoded (1, 2, atau 3)</span>
            </div>
            <div class="flex items-center gap-2">
                <span class="w-16 h-6 rounded bg-primary/10 text-primary font-mono font-bold text-xs flex items-center justify-center">min=1</span>
                <span class="text-slate-600 dark:text-slate-400">& <span class="font-mono bg-primary/10 px-1 rounded text-primary">max=3</span></span>
            </div>
        </div>
    </div>

    <!-- Normalized Data Table -->
    <div class="bg-white dark:bg-darkCard rounded-xl shadow-sm border border-slate-100 dark:border-slate-700">
        <div class="p-6 border-b border-slate-100 dark:border-slate-700 flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <h3 class="font-bold text-lg text-slate-800 dark:text-white">Hasil Normalisasi Data</h3>
                <p class="text-sm text-slate-500 mt-1">Data inventaris yang sudah di-encode dan dinormalisasi</p>
            </div>
            <span class="px-3 py-1 bg-primary/10 text-primary text-sm font-medium rounded-lg">
                {{ $normalized->count() }} Data
            </span>
        </div>
        
        @if($normalized->isEmpty())
        <div class="p-12 text-center">
            <div class="w-16 h-16 mx-auto rounded-full bg-slate-100 dark:bg-slate-700 flex items-center justify-center mb-4">
                <i data-lucide="database" class="w-8 h-8 text-slate-400"></i>
            </div>
            <h4 class="font-semibold text-slate-700 dark:text-slate-300 mb-2">Belum Ada Data</h4>
            <p class="text-sm text-slate-500 mb-4">Tambahkan data inventaris terlebih dahulu untuk melihat hasil preprocessing.</p>
            <a href="{{ route('dataset.index') }}" class="inline-flex items-center px-4 py-2 bg-primary hover:bg-primaryHover text-white rounded-lg text-sm font-medium transition-colors">
                <i data-lucide="plus" class="w-4 h-4 mr-2"></i> Tambah Dataset
            </a>
        </div>
        @else
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left">
                <thead class="bg-slate-50 dark:bg-slate-800/50 text-xs uppercase text-slate-500">
                    <tr>
                        <th class="px-3 py-3">Nama Sarana</th>
                        <th class="px-3 py-3 text-center">Kondisi</th>
                        <th class="px-3 py-3 text-center bg-blue-50 dark:bg-blue-900/20 text-blue-600">Enc</th>
                        <th class="px-3 py-3 text-center bg-primary/5 text-primary">Norm</th>
                        <th class="px-3 py-3 text-center">Pemanfaatan</th>
                        <th class="px-3 py-3 text-center bg-blue-50 dark:bg-blue-900/20 text-blue-600">Enc</th>
                        <th class="px-3 py-3 text-center bg-primary/5 text-primary">Norm</th>
                        <th class="px-3 py-3 text-center">Kebutuhan</th>
                        <th class="px-3 py-3 text-center bg-blue-50 dark:bg-blue-900/20 text-blue-600">Enc</th>
                        <th class="px-3 py-3 text-center bg-primary/5 text-primary">Norm</th>
                        <th class="px-3 py-3 text-center">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 dark:divide-slate-700">
                    @foreach($normalized as $index => $item)
                    <tr class="dark:text-slate-300 {{ $index % 2 == 0 ? '' : 'bg-slate-50/50 dark:bg-slate-800/30' }}">
                        <td class="px-3 py-3 font-medium">{{ $item['nama'] }}</td>
                        <td class="px-3 py-3 text-center text-xs">{{ $item['kondisi_raw'] }}</td>
                        <td class="px-3 py-3 text-center font-mono text-blue-600 font-semibold bg-blue-50 dark:bg-blue-900/20">{{ $item['kondisi_encoded'] }}</td>
                        <td class="px-3 py-3 text-center font-mono text-primary font-semibold bg-primary/5">{{ number_format($item['kondisi_norm'], 2) }}</td>
                        <td class="px-3 py-3 text-center text-xs">{{ $item['pemanfaatan_raw'] }}</td>
                        <td class="px-3 py-3 text-center font-mono text-blue-600 font-semibold bg-blue-50 dark:bg-blue-900/20">{{ $item['pemanfaatan_encoded'] }}</td>
                        <td class="px-3 py-3 text-center font-mono text-primary font-semibold bg-primary/5">{{ number_format($item['pemanfaatan_norm'], 2) }}</td>
                        <td class="px-3 py-3 text-center text-xs">{{ $item['kebutuhan_raw'] }}</td>
                        <td class="px-3 py-3 text-center font-mono text-blue-600 font-semibold bg-blue-50 dark:bg-blue-900/20">{{ $item['kebutuhan_encoded'] }}</td>
                        <td class="px-3 py-3 text-center font-mono text-primary font-semibold bg-primary/5">{{ number_format($item['kebutuhan_norm'], 2) }}</td>
                        <td class="px-3 py-3 text-center">
                            <span class="px-2 py-1 text-xs font-semibold rounded-full 
                                @if($item['status'] === 'Layak') bg-emerald-100 text-emerald-700 dark:bg-emerald-900/30 dark:text-emerald-400
                                @elseif($item['status'] === 'Perlu Diganti') bg-red-100 text-red-700 dark:bg-red-900/30 dark:text-red-400
                                @else bg-yellow-100 text-yellow-700 dark:bg-yellow-900/30 dark:text-yellow-400
                                @endif">
                                {{ $item['status'] }}
                            </span>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @endif
    </div>

    <!-- Continue Button -->
    @if($normalized->isNotEmpty())
    <div class="flex justify-center">
        <a href="{{ route('process.index') }}" class="inline-flex items-center px-6 py-3 bg-primary hover:bg-primaryHover text-white rounded-xl text-sm font-medium transition-colors shadow-lg shadow-primary/25">
            <i data-lucide="play" class="w-5 h-5 mr-2"></i>
            Lanjut ke Proses KNN
            <i data-lucide="arrow-right" class="w-5 h-5 ml-2"></i>
        </a>
    </div>
    @endif
</div>
@endsection

@push('scripts')
<script>
    lucide.createIcons();
</script>
@endpush