@extends('layouts.app')

@section('title', 'Preprocessing Data - SPK KNN')
@section('page-title', 'Preprocessing Data')

@section('content')
<div class="space-y-6 animate-fade-up">
    <!-- Steps -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <div class="bg-white dark:bg-darkCard p-5 rounded-xl border border-slate-100 dark:border-slate-700 shadow-sm relative">
            <div class="flex items-center mb-3">
                <div class="w-8 h-8 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center font-bold mr-3">1</div>
                <h4 class="font-semibold dark:text-white">Data Cleaning</h4>
            </div>
            <p class="text-sm text-slate-500">Memastikan tidak ada missing value pada kolom kondisi dan tahun.</p>
            <div class="mt-3">
                <span class="px-2 py-1 bg-green-100 text-green-700 text-xs rounded font-bold">Done</span>
            </div>
        </div>
        <div class="bg-white dark:bg-darkCard p-5 rounded-xl border-2 border-primary/20 shadow-sm relative">
            <div class="flex items-center mb-3">
                <div class="w-8 h-8 rounded-full bg-primary text-white flex items-center justify-center font-bold mr-3">2</div>
                <h4 class="font-semibold text-primary">Normalisasi (Min-Max)</h4>
            </div>
            <p class="text-sm text-slate-500">Mengubah range nilai fitur numerik (Tahun, Kondisi, Jumlah) ke skala 0-1.</p>
            <div class="mt-3">
                <span class="px-2 py-1 bg-blue-100 text-blue-700 text-xs rounded font-bold">Active View</span>
            </div>
        </div>
        <div class="bg-white dark:bg-darkCard p-5 rounded-xl border border-slate-100 dark:border-slate-700 shadow-sm relative">
            <div class="flex items-center mb-3">
                <div class="w-8 h-8 rounded-full bg-slate-100 text-slate-600 flex items-center justify-center font-bold mr-3">3</div>
                <h4 class="font-semibold dark:text-white">Splitting Data</h4>
            </div>
            <p class="text-sm text-slate-500">Membagi dataset menjadi Data Training dan Data Testing (default 80:20).</p>
        </div>
    </div>

    <!-- Visualization -->
    <div class="bg-white dark:bg-darkCard rounded-xl shadow-sm p-6 border border-slate-100 dark:border-slate-700">
        <h3 class="font-bold text-lg mb-4 text-slate-800 dark:text-white">Visualisasi Normalisasi</h3>
        <p class="text-slate-500 text-sm mb-6">Rumus Min-Max: <code class="bg-slate-100 dark:bg-slate-700 px-1 py-0.5 rounded text-primary">x' = (x - min(x)) / (max(x) - min(x))</code></p>
        
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left">
                <thead class="bg-slate-50 dark:bg-slate-800 text-xs uppercase text-slate-500">
                    <tr>
                        <th class="px-4 py-3">Nama Sarana</th>
                        <th class="px-4 py-3">Kondisi (Raw)</th>
                        <th class="px-4 py-3 text-primary">Kondisi (Norm)</th>
                        <th class="px-4 py-3">Jumlah (Raw)</th>
                        <th class="px-4 py-3 text-primary">Jumlah (Norm)</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 dark:divide-slate-700">
                    <tr class="dark:text-slate-300">
                        <td class="px-4 py-3 font-medium">Laptop Dell XPS</td>
                        <td class="px-4 py-3">5</td>
                        <td class="px-4 py-3 font-mono text-primary">1.00</td>
                        <td class="px-4 py-3">12</td>
                        <td class="px-4 py-3 font-mono text-primary">0.24</td>
                    </tr>
                    <tr class="dark:text-slate-300 bg-slate-50/50 dark:bg-slate-800/30">
                        <td class="px-4 py-3 font-medium">Proyektor Epson</td>
                        <td class="px-4 py-3">2</td>
                        <td class="px-4 py-3 font-mono text-primary">0.25</td>
                        <td class="px-4 py-3">5</td>
                        <td class="px-4 py-3 font-mono text-primary">0.10</td>
                    </tr>
                    <tr class="dark:text-slate-300">
                        <td class="px-4 py-3 font-medium">Kursi Staff</td>
                        <td class="px-4 py-3">1</td>
                        <td class="px-4 py-3 font-mono text-primary">0.00</td>
                        <td class="px-4 py-3">20</td>
                        <td class="px-4 py-3 font-mono text-primary">0.40</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection