@extends('layouts.app')

@section('title', 'Riwayat Perhitungan - SPK KNN')
@section('page-title', 'Riwayat Perhitungan')

@section('content')
<div class="space-y-4 max-w-3xl mx-auto animate-fade-up">
    @forelse($history as $item)
    <div class="bg-white dark:bg-darkCard p-4 rounded-xl shadow-sm border border-slate-100 dark:border-slate-700 flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
        <div class="flex items-center gap-4">
            <div class="p-3 bg-slate-100 dark:bg-slate-800 rounded-lg text-slate-500">
                <i data-lucide="file-clock" class="w-5 h-5"></i>
            </div>
            <div>
                <p class="text-sm font-bold text-slate-800 dark:text-white">{{ $item->result }}</p>
                <p class="text-xs text-slate-500">
                    {{ $item->created_at->format('d/m/Y H:i') }} • 
                    K={{ $item->k_value }} • 
                    {{ $item->input_kondisi }}, {{ $item->input_pemanfaatan }}, {{ $item->input_kebutuhan }}
                </p>
            </div>
        </div>
        <button onclick="showDetail({{ $item->id }})" class="px-3 py-1 text-xs border border-slate-200 dark:border-slate-600 rounded hover:bg-slate-50 dark:hover:bg-slate-700 text-slate-600 dark:text-slate-400">
            Detail
        </button>
    </div>
    @empty
    <div class="text-center py-12 text-slate-400">
        <i data-lucide="inbox" class="w-12 h-12 mx-auto mb-3 opacity-50"></i>
        <p>Belum ada riwayat perhitungan.</p>
    </div>
    @endforelse
</div>

<!-- Detail Modal -->
<div id="detailModal" class="hidden fixed inset-0 bg-black/50 z-50 flex items-center justify-center p-4">
    <div class="bg-white dark:bg-darkCard rounded-xl max-w-2xl w-full p-6 max-h-[80vh] overflow-y-auto">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-lg font-bold text-slate-800 dark:text-white">Detail Riwayat</h3>
            <button onclick="closeDetail()" class="text-slate-400 hover:text-slate-600">
                <i data-lucide="x" class="w-5 h-5"></i>
            </button>
        </div>
        <div id="detailContent">
            <!-- Content will be loaded here -->
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
async function showDetail(id) {
    try {
        const response = await fetch(`/history/${id}`, {
            headers: {
                'Accept': 'application/json',
            }
        });
        const data = await response.json();
        
        const neighbors = data.neighbors.map((n, i) => `
            <tr class="border-b border-slate-100 dark:border-slate-700">
                <td class="py-2 px-3">#${i+1}</td>
                <td class="py-2 px-3">${n.nama}</td>
                <td class="py-2 px-3 text-right font-mono">${n.distance.toFixed(4)}</td>
                <td class="py-2 px-3 text-right">
                    <span class="text-xs px-2 py-1 rounded-full ${n.status === 'Layak' ? 'bg-emerald-100 text-emerald-700' : n.status === 'Perawatan' ? 'bg-yellow-100 text-yellow-700' : 'bg-red-100 text-red-700'}">
                        ${n.status}
                    </span>
                </td>
            </tr>
        `).join('');
        
        document.getElementById('detailContent').innerHTML = `
            <div class="space-y-4">
                <div class="grid grid-cols-2 gap-4">
                    <div class="bg-slate-50 dark:bg-slate-800 p-3 rounded-lg">
                        <p class="text-xs text-slate-500 mb-1">Hasil</p>
                        <p class="font-bold text-slate-800 dark:text-white">${data.result}</p>
                    </div>
                    <div class="bg-slate-50 dark:bg-slate-800 p-3 rounded-lg">
                        <p class="text-xs text-slate-500 mb-1">Confidence</p>
                        <p class="font-bold text-primary">${data.confidence}%</p>
                    </div>
                    <div class="bg-slate-50 dark:bg-slate-800 p-3 rounded-lg">
                        <p class="text-xs text-slate-500 mb-1">Nilai K</p>
                        <p class="font-bold text-slate-800 dark:text-white">${data.k_value}</p>
                    </div>
                    <div class="bg-slate-50 dark:bg-slate-800 p-3 rounded-lg">
                        <p class="text-xs text-slate-500 mb-1">Input</p>
                        <p class="font-bold text-slate-800 dark:text-white text-xs">${data.input_kondisi}, ${data.input_pemanfaatan}, ${data.input_kebutuhan}</p>
                    </div>
                </div>
                
                <div>
                    <h4 class="font-semibold text-sm mb-2 text-slate-700 dark:text-slate-300">Tetangga Terdekat</h4>
                    <div class="border border-slate-200 dark:border-slate-700 rounded-lg overflow-hidden">
                        <table class="w-full text-sm">
                            <thead class="bg-slate-50 dark:bg-slate-800">
                                <tr>
                                    <th class="py-2 px-3 text-left text-xs text-slate-500">Rank</th>
                                    <th class="py-2 px-3 text-left text-xs text-slate-500">Nama</th>
                                    <th class="py-2 px-3 text-right text-xs text-slate-500">Jarak</th>
                                    <th class="py-2 px-3 text-right text-xs text-slate-500">Status</th>
                                </tr>
                            </thead>
                            <tbody class="text-slate-600 dark:text-slate-400">
                                ${neighbors}
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        `;
        
        document.getElementById('detailModal').classList.remove('hidden');
        lucide.createIcons();
    } catch (error) {
        console.error('Error:', error);
    }
}

function closeDetail() {
    document.getElementById('detailModal').classList.add('hidden');
}
</script>
@endpush