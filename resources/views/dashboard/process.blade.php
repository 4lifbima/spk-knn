@extends('layouts.app')

@section('title', 'Proses KNN - SPK KNN')
@section('page-title', 'Proses Klasifikasi KNN')

@section('content')
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6 animate-fade-up">
    
    <!-- Input Section -->
    <div class="lg:col-span-1 space-y-6">
        <div class="bg-white dark:bg-darkCard p-6 rounded-xl shadow-sm border border-slate-100 dark:border-slate-700">
            <h3 class="font-bold text-lg mb-4 text-slate-800 dark:text-white flex items-center">
                <i data-lucide="sliders" class="w-5 h-5 mr-2 text-primary"></i> Parameter Input
            </h3>
            
            <form id="knnForm" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Nilai K (Tetangga)</label>
                    <div class="flex items-center gap-2">
                        <input type="range" min="1" max="7" step="2" value="3" id="kSlider" name="k_value" class="w-full h-2 bg-slate-200 rounded-lg appearance-none cursor-pointer accent-primary">
                        <span id="kDisplay" class="font-bold text-primary w-8 text-center">3</span>
                    </div>
                    <p class="text-xs text-slate-400 mt-1">Gunakan angka ganjil untuk menghindari seri.</p>
                </div>

                <hr class="border-slate-100 dark:border-slate-700">

                <div>
                    <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Kondisi Sarana</label>
                    <select id="inputKondisi" name="kondisi" class="w-full rounded-lg border-slate-300 dark:border-slate-600 bg-slate-50 dark:bg-slate-700 py-2 px-3 text-sm focus:ring-primary focus:border-primary dark:text-white">
                        <option value="Baik">Baik</option>
                        <option value="Rusak Ringan">Rusak Ringan</option>
                        <option value="Rusak Berat">Rusak Berat</option>
                    </select>
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Tingkat Pemanfaatan</label>
                    <select id="inputPemanfaatan" name="pemanfaatan" class="w-full rounded-lg border-slate-300 dark:border-slate-600 bg-slate-50 dark:bg-slate-700 py-2 px-3 text-sm focus:ring-primary focus:border-primary dark:text-white">
                        <option value="Sering Digunakan">Sering Digunakan</option>
                        <option value="Kadang Digunakan">Kadang Digunakan</option>
                        <option value="Tidak Digunakan">Tidak Digunakan</option>
                    </select>
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Tingkat Kebutuhan</label>
                    <select id="inputKebutuhan" name="kebutuhan" class="w-full rounded-lg border-slate-300 dark:border-slate-600 bg-slate-50 dark:bg-slate-700 py-2 px-3 text-sm focus:ring-primary focus:border-primary dark:text-white">
                        <option value="Sangat Dibutuhkan">Sangat Dibutuhkan</option>
                        <option value="Dibutuhkan">Dibutuhkan</option>
                        <option value="Sangat Tidak Dibutuhkan">Sangat Tidak Dibutuhkan</option>
                    </select>
                </div>
                
                <button type="submit" class="w-full bg-primary hover:bg-primaryHover text-white font-semibold py-2.5 rounded-lg shadow transition-all transform active:scale-95 flex justify-center items-center">
                    <i data-lucide="calculator" class="w-4 h-4 mr-2"></i> Hitung Klasifikasi
                </button>
            </form>
        </div>

        <!-- Info Card -->
        <div class="bg-blue-50 dark:bg-blue-900/20 p-4 rounded-xl border border-blue-100 dark:border-blue-800">
            <h4 class="font-semibold text-blue-800 dark:text-blue-300 text-sm mb-2">Metode: Euclidean Distance</h4>
            <p class="text-xs text-blue-600 dark:text-blue-400">
                Sistem menghitung jarak 3 dimensi (Kondisi, Pemanfaatan, Kebutuhan) antara data uji dan data latih.
                <br><br>
                <span class="font-mono bg-white dark:bg-slate-900 px-1 rounded">d = √[(K₁-K₂)² + (P₁-P₂)² + (B₁-B₂)²]</span>
            </p>
        </div>
    </div>

    <!-- Result Section -->
    <div class="lg:col-span-2 space-y-6" id="resultContainer">
        <div class="h-full flex flex-col items-center justify-center bg-slate-100 dark:bg-slate-800/50 rounded-xl border border-dashed border-slate-300 dark:border-slate-600 min-h-[400px]">
            <div class="p-4 bg-white dark:bg-slate-700 rounded-full mb-4 shadow-sm">
                <i data-lucide="bar-chart-2" class="w-8 h-8 text-slate-400"></i>
            </div>
            <p class="text-slate-500 font-medium">Masukkan data dan tekan "Hitung" untuk melihat hasil.</p>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
const kSlider = document.getElementById('kSlider');
const kDisplay = document.getElementById('kDisplay');
const knnForm = document.getElementById('knnForm');
const resultContainer = document.getElementById('resultContainer');

kSlider.addEventListener('input', (e) => {
    kDisplay.textContent = e.target.value;
});

knnForm.addEventListener('submit', async (e) => {
    e.preventDefault();
    
    const formData = new FormData(knnForm);
    
    try {
        const response = await fetch('{{ route("process.calculate") }}', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json',
            },
            body: formData
        });
        
        const data = await response.json();
        
        if (data.success) {
            displayResult(data);
        }
    } catch (error) {
        console.error('Error:', error);
    }
});

function displayResult(data) {
    let resultColor, iconResult;
    
    if (data.result === 'Layak Digunakan') {
        resultColor = 'text-emerald-600 bg-emerald-50 dark:bg-emerald-900/20 border-emerald-200';
        iconResult = 'check-circle';
    } else if (data.result === 'Perlu Perawatan') {
        resultColor = 'text-yellow-600 bg-yellow-50 dark:bg-yellow-900/20 border-yellow-200';
        iconResult = 'alert-triangle';
    } else {
        resultColor = 'text-red-600 bg-red-50 dark:bg-red-900/20 border-red-200';
        iconResult = 'alert-octagon';
    }
    
    const neighborsHtml = data.neighbors.map((n, i) => `
        <tr class="border-b border-slate-100 dark:border-slate-700 text-sm">
            <td class="py-2 px-3 font-medium text-slate-700 dark:text-slate-300">#${i+1}</td>
            <td class="py-2 px-3 text-slate-600 dark:text-slate-400">${n.nama}</td>
            <td class="py-2 px-3 text-slate-600 dark:text-slate-400 text-right font-mono">${n.distance.toFixed(4)}</td>
            <td class="py-2 px-3 text-right">
                <span class="text-xs px-2 py-1 rounded-full ${n.status === 'Layak' ? 'bg-emerald-100 text-emerald-700' : n.status === 'Perawatan' ? 'bg-yellow-100 text-yellow-700' : 'bg-red-100 text-red-700'}">
                    ${n.status}
                </span>
            </td>
        </tr>
    `).join('');
    
    resultContainer.innerHTML = `
        <div class="bg-white dark:bg-darkCard rounded-xl shadow-lg border border-slate-200 dark:border-slate-700 overflow-hidden animate-fade-up">
            <div class="p-6 text-center border-b border-slate-100 dark:border-slate-700">
                <p class="text-slate-500 text-sm uppercase tracking-wide font-semibold mb-2">Hasil Rekomendasi</p>
                <div class="inline-flex items-center justify-center p-4 rounded-full mb-4 ${resultColor} border-4">
                    <i data-lucide="${iconResult}" class="w-10 h-10"></i>
                </div>
                <h2 class="text-3xl font-bold text-slate-800 dark:text-white mb-1">${data.result}</h2>
                <p class="text-slate-500">Confidence Level: <span class="font-bold text-primary">${data.confidence}%</span> dari ${data.k_value} Tetangga</p>
                <div class="mt-3 flex justify-center gap-3 text-xs">
                    <span class="px-2 py-1 bg-emerald-100 text-emerald-700 rounded">Layak: ${data.votes.layak}</span>
                    <span class="px-2 py-1 bg-yellow-100 text-yellow-700 rounded">Perawatan: ${data.votes.perawatan}</span>
                    <span class="px-2 py-1 bg-red-100 text-red-700 rounded">Ganti: ${data.votes.ganti}</span>
                </div>
            </div>
            
            <div class="bg-slate-50 dark:bg-slate-800/50 p-6">
                <h4 class="text-sm font-bold text-slate-700 dark:text-slate-300 mb-4 flex items-center">
                    <i data-lucide="users" class="w-4 h-4 mr-2"></i> ${data.k_value} Tetangga Terdekat (Nearest Neighbors)
                </h4>
                <div class="bg-white dark:bg-darkCard rounded-lg border border-slate-200 dark:border-slate-700 overflow-hidden">
                    <table class="w-full">
                        <thead class="bg-slate-100 dark:bg-slate-800 text-xs font-semibold text-slate-500 uppercase">
                            <tr>
                                <th class="py-2 px-3 text-left">Rank</th>
                                <th class="py-2 px-3 text-left">Nama Sarana</th>
                                <th class="py-2 px-3 text-right">Jarak (Euclidean)</th>
                                <th class="py-2 px-3 text-right">Label</th>
                            </tr>
                        </thead>
                        <tbody>
                            ${neighborsHtml}
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="flex gap-4 animate-fade-up">
            <a href="{{ route('dataset.index') }}" class="flex-1 py-3 bg-white dark:bg-darkCard border border-slate-200 dark:border-slate-700 rounded-lg shadow-sm text-slate-600 dark:text-slate-300 font-medium hover:bg-slate-50 dark:hover:bg-slate-700 text-center">
                Lihat Dataset
            </a>
            <button onclick="location.reload()" class="flex-1 py-3 bg-slate-800 hover:bg-slate-900 text-white rounded-lg shadow-sm font-medium">
                Reset Kalkulasi
            </button>
        </div>
    `;
    
    lucide.createIcons();
}
</script>
@endpush