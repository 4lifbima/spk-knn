@extends('layouts.app')

@section('title', 'Dataset Sarana - SPK KNN')
@section('page-title', 'Dataset Sarana')

@section('content')
<div class="bg-white dark:bg-darkCard rounded-xl shadow-sm border border-slate-100 dark:border-slate-700 flex flex-col h-full animate-fade-up">
    <div class="p-6 border-b border-slate-100 dark:border-slate-700 flex flex-col md:flex-row md:items-center justify-between gap-4">
        <h3 class="font-bold text-lg text-slate-800 dark:text-white">Data Inventaris</h3>
        <div class="flex flex-col md:flex-row gap-2 md:items-center">
            <!-- Search Form -->
            <form action="{{ route('dataset.index') }}" method="GET" class="flex gap-2">
                <input type="hidden" name="per_page" value="{{ $perPage }}">
                <div class="relative">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama, tahun, status..." 
                        class="pl-10 pr-4 py-2 rounded-lg border border-slate-300 dark:border-slate-600 bg-slate-50 dark:bg-slate-700 text-sm focus:ring-primary focus:border-primary dark:text-white w-full md:w-64">
                    <i data-lucide="search" class="w-4 h-4 absolute left-3 top-1/2 -translate-y-1/2 text-slate-400"></i>
                </div>
                <button type="submit" class="px-4 py-2 bg-slate-600 hover:bg-slate-700 text-white rounded-lg text-sm font-medium flex items-center transition-colors">
                    <i data-lucide="search" class="w-4 h-4 md:mr-2"></i>
                    <span class="hidden md:inline">Cari</span>
                </button>
                @if(request('search'))
                <a href="{{ route('dataset.index', ['per_page' => $perPage]) }}" class="px-4 py-2 border border-slate-300 dark:border-slate-600 rounded-lg text-sm font-medium hover:bg-slate-50 dark:hover:bg-slate-700 dark:text-slate-300 flex items-center transition-colors">
                    <i data-lucide="x" class="w-4 h-4"></i>
                </a>
                @endif
            </form>
            
            <div class="flex gap-2">
                <button onclick="document.getElementById('importModal').classList.remove('hidden')" class="px-4 py-2 bg-emerald-600 hover:bg-emerald-700 text-white rounded-lg text-sm font-medium flex items-center transition-colors">
                    <i data-lucide="upload" class="w-4 h-4 mr-2"></i> Import Data
                </button>
                <button onclick="document.getElementById('addModal').classList.remove('hidden')" class="px-4 py-2 bg-primary hover:bg-primaryHover text-white rounded-lg text-sm font-medium flex items-center transition-colors">
                    <i data-lucide="plus" class="w-4 h-4 mr-2"></i> Tambah Data
                </button>
            </div>
        </div>
    </div>
    
    @if(session('success'))
    <div class="mx-6 mt-4 p-4 bg-green-50 border border-green-200 text-green-700 rounded-lg">
        {{ session('success') }}
    </div>
    @endif
    
    @if(session('error'))
    <div class="mx-6 mt-4 p-4 bg-red-50 border border-red-200 text-red-700 rounded-lg">
        {{ session('error') }}
    </div>
    @endif
    
    @if($errors->any())
    <div class="mx-6 mt-4 p-4 bg-red-50 border border-red-200 text-red-700 rounded-lg">
        <ul class="list-disc list-inside">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    
    <div class="overflow-x-auto flex-1">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-slate-50 dark:bg-slate-800/50">
                    <th class="px-6 py-4 text-xs font-semibold text-slate-500 uppercase tracking-wider">Nama Sarana</th>
                    <th class="px-6 py-4 text-xs font-semibold text-slate-500 uppercase tracking-wider">Tahun</th>
                    <th class="px-6 py-4 text-xs font-semibold text-slate-500 uppercase tracking-wider">Kondisi</th>
                    <th class="px-6 py-4 text-xs font-semibold text-slate-500 uppercase tracking-wider">Jumlah</th>
                    <th class="px-6 py-4 text-xs font-semibold text-slate-500 uppercase tracking-wider">Status (Label)</th>
                    <th class="px-6 py-4 text-xs font-semibold text-slate-500 uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100 dark:divide-slate-700">
                @forelse($dataset as $item)
                <tr class="hover:bg-slate-50 dark:hover:bg-slate-800/50 transition-colors">
                    <td class="px-6 py-4 text-sm font-medium text-slate-900 dark:text-white">{{ $item->nama }}</td>
                    <td class="px-6 py-4 text-sm text-slate-500 dark:text-slate-400">{{ $item->tahun }}</td>
                    <td class="px-6 py-4 text-sm text-slate-500 dark:text-slate-400">
                        <div class="flex items-center">
                            <span class="w-20 bg-slate-200 dark:bg-slate-700 h-2 rounded-full overflow-hidden mr-2">
                                <div class="bg-primary h-full" style="width: {{ ($item->kondisi/5)*100 }}%"></div>
                            </span>
                            {{ $item->kondisi }}/5
                        </div>
                    </td>
                    <td class="px-6 py-4 text-sm text-slate-500 dark:text-slate-400">{{ $item->jumlah }} Unit</td>
                    <td class="px-6 py-4">
                        <span class="px-3 py-1 text-xs font-semibold rounded-full 
                            @if($item->status === 'Layak') bg-emerald-100 text-emerald-700 dark:bg-emerald-900/30 dark:text-emerald-400
                            @elseif($item->status === 'Perlu Diganti') bg-red-100 text-red-700 dark:bg-red-900/30 dark:text-red-400
                            @else bg-yellow-100 text-yellow-700 dark:bg-yellow-900/30 dark:text-yellow-400
                            @endif">
                            {{ $item->status }}
                        </span>
                    </td>
                    <td class="px-6 py-4">
                        <div class="flex items-center gap-2">
                            <a href="{{ route('dataset.edit', $item->id) }}" class="text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300" title="Edit">
                                <i data-lucide="pencil" class="w-4 h-4"></i>
                            </a>
                            <form action="{{ route('dataset.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data ini?')" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-800 dark:text-red-400 dark:hover:text-red-300" title="Hapus">
                                    <i data-lucide="trash-2" class="w-4 h-4"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-6 py-8 text-center text-slate-500">
                        @if(request('search'))
                            Tidak ada data yang cocok dengan pencarian "{{ request('search') }}"
                        @else
                            Tidak ada data inventaris
                        @endif
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    <!-- Pagination Section -->
    <div class="p-4 border-t border-slate-100 dark:border-slate-700 flex flex-col md:flex-row justify-between items-center gap-4 text-sm text-slate-500">
        <div class="flex items-center gap-4">
            <span>Menampilkan {{ $dataset->firstItem() ?? 0 }} - {{ $dataset->lastItem() ?? 0 }} dari {{ $dataset->total() }} data</span>
            
            <!-- Per Page Selector -->
            <form action="{{ route('dataset.index') }}" method="GET" class="flex items-center gap-2">
                @if(request('search'))
                <input type="hidden" name="search" value="{{ request('search') }}">
                @endif
                <label class="text-slate-600 dark:text-slate-400">Tampilkan:</label>
                <select name="per_page" onchange="this.form.submit()" class="rounded-lg border-slate-300 dark:border-slate-600 bg-slate-50 dark:bg-slate-700 py-1 px-3 text-sm focus:ring-primary focus:border-primary dark:text-white">
                    @foreach([5, 10, 50, 100] as $option)
                    <option value="{{ $option }}" {{ $perPage == $option ? 'selected' : '' }}>{{ $option }}</option>
                    @endforeach
                </select>
            </form>
        </div>
        
        <!-- Pagination Links -->
        @if($dataset->hasPages())
        <div class="flex items-center gap-1">
            {{-- Previous Page Link --}}
            @if ($dataset->onFirstPage())
                <span class="px-3 py-1 rounded-lg bg-slate-100 dark:bg-slate-700 text-slate-400 cursor-not-allowed">
                    <i data-lucide="chevron-left" class="w-4 h-4"></i>
                </span>
            @else
                <a href="{{ $dataset->previousPageUrl() }}" class="px-3 py-1 rounded-lg bg-slate-100 dark:bg-slate-700 text-slate-600 dark:text-slate-300 hover:bg-primary hover:text-white transition-colors">
                    <i data-lucide="chevron-left" class="w-4 h-4"></i>
                </a>
            @endif

            {{-- Page Numbers --}}
            @php
                $start = max($dataset->currentPage() - 2, 1);
                $end = min($start + 4, $dataset->lastPage());
                $start = max($end - 4, 1);
            @endphp

            @if($start > 1)
                <a href="{{ $dataset->url(1) }}" class="px-3 py-1 rounded-lg bg-slate-100 dark:bg-slate-700 text-slate-600 dark:text-slate-300 hover:bg-primary hover:text-white transition-colors">1</a>
                @if($start > 2)
                    <span class="px-2 text-slate-400">...</span>
                @endif
            @endif

            @for ($i = $start; $i <= $end; $i++)
                @if ($i == $dataset->currentPage())
                    <span class="px-3 py-1 rounded-lg bg-primary text-white font-medium">{{ $i }}</span>
                @else
                    <a href="{{ $dataset->url($i) }}" class="px-3 py-1 rounded-lg bg-slate-100 dark:bg-slate-700 text-slate-600 dark:text-slate-300 hover:bg-primary hover:text-white transition-colors">{{ $i }}</a>
                @endif
            @endfor

            @if($end < $dataset->lastPage())
                @if($end < $dataset->lastPage() - 1)
                    <span class="px-2 text-slate-400">...</span>
                @endif
                <a href="{{ $dataset->url($dataset->lastPage()) }}" class="px-3 py-1 rounded-lg bg-slate-100 dark:bg-slate-700 text-slate-600 dark:text-slate-300 hover:bg-primary hover:text-white transition-colors">{{ $dataset->lastPage() }}</a>
            @endif

            {{-- Next Page Link --}}
            @if ($dataset->hasMorePages())
                <a href="{{ $dataset->nextPageUrl() }}" class="px-3 py-1 rounded-lg bg-slate-100 dark:bg-slate-700 text-slate-600 dark:text-slate-300 hover:bg-primary hover:text-white transition-colors">
                    <i data-lucide="chevron-right" class="w-4 h-4"></i>
                </a>
            @else
                <span class="px-3 py-1 rounded-lg bg-slate-100 dark:bg-slate-700 text-slate-400 cursor-not-allowed">
                    <i data-lucide="chevron-right" class="w-4 h-4"></i>
                </span>
            @endif
        </div>
        @endif
    </div>
</div>

<!-- Import Modal -->
<div id="importModal" class="hidden fixed inset-0 bg-black/50 z-50 flex items-center justify-center p-4">
    <div class="bg-white dark:bg-darkCard rounded-xl max-w-lg w-full p-6">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-lg font-bold text-slate-800 dark:text-white">Import Data dari Excel/CSV</h3>
            <button onclick="document.getElementById('importModal').classList.add('hidden')" class="text-slate-400 hover:text-slate-600">
                <i data-lucide="x" class="w-5 h-5"></i>
            </button>
        </div>
        <form action="{{ route('dataset.import') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf
            <!-- Dropzone Area -->
            <div id="dropzone" class="border-2 border-dashed border-slate-300 dark:border-slate-600 rounded-xl p-8 text-center hover:border-emerald-500 transition-colors cursor-pointer" onclick="document.getElementById('fileInput').click()">
                <div class="flex flex-col items-center">
                    <div class="w-16 h-16 bg-emerald-100 dark:bg-emerald-900/30 rounded-full flex items-center justify-center mb-4">
                        <i data-lucide="file-spreadsheet" class="w-8 h-8 text-emerald-600 dark:text-emerald-400"></i>
                    </div>
                    <p class="text-slate-700 dark:text-slate-300 font-medium mb-1" id="filenameDisplay">Klik untuk pilih file atau drag & drop</p>
                    <p class="text-sm text-slate-500 dark:text-slate-400">Format: CSV, XLSX, XLS (Maks. 10MB)</p>
                </div>
                <input type="file" name="file" id="fileInput" class="hidden" accept=".csv,.xlsx,.xls" onchange="updateFilename(this)">
            </div>
            
            <!-- Template Info -->
            <div class="bg-blue-50 dark:bg-blue-900/20 rounded-lg p-4">
                <div class="flex items-start gap-3">
                    <i data-lucide="info" class="w-5 h-5 text-blue-600 dark:text-blue-400 flex-shrink-0 mt-0.5"></i>
                    <div class="text-sm">
                        <p class="font-medium text-blue-700 dark:text-blue-400 mb-1">Format Template:</p>
                        <p class="text-blue-600 dark:text-blue-300">File harus memiliki kolom: <strong>nama</strong>, <strong>kondisi</strong> (1-5), <strong>jumlah</strong>, <strong>tahun</strong></p>
                        <p class="text-blue-600 dark:text-blue-300 mt-1">Status akan dihitung otomatis berdasarkan nilai kondisi.</p>
                    </div>
                </div>
            </div>
            
            <div class="flex gap-2 pt-2">
                <button type="button" onclick="document.getElementById('importModal').classList.add('hidden')" class="flex-1 px-4 py-2 border border-slate-300 dark:border-slate-600 rounded-lg text-sm font-medium hover:bg-slate-50 dark:hover:bg-slate-700 dark:text-slate-300">
                    Batal
                </button>
                <button type="submit" class="flex-1 px-4 py-2 bg-emerald-600 hover:bg-emerald-700 text-white rounded-lg text-sm font-medium flex items-center justify-center">
                    <i data-lucide="upload" class="w-4 h-4 mr-2"></i> Import
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Add Modal -->
<div id="addModal" class="hidden fixed inset-0 bg-black/50 z-50 flex items-center justify-center p-4">
    <div class="bg-white dark:bg-darkCard rounded-xl max-w-md w-full p-6">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-lg font-bold text-slate-800 dark:text-white">Tambah Data Inventaris</h3>
            <button onclick="document.getElementById('addModal').classList.add('hidden')" class="text-slate-400 hover:text-slate-600">
                <i data-lucide="x" class="w-5 h-5"></i>
            </button>
        </div>
        <form action="{{ route('dataset.store') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Nama Sarana</label>
                <input type="text" name="nama" required class="w-full rounded-lg border-slate-300 dark:border-slate-600 bg-slate-50 dark:bg-slate-700 py-2 px-3 text-sm focus:ring-primary focus:border-primary dark:text-white">
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Kondisi (1-5)</label>
                    <select name="kondisi" required class="w-full rounded-lg border-slate-300 dark:border-slate-600 bg-slate-50 dark:bg-slate-700 py-2 px-3 text-sm focus:ring-primary focus:border-primary dark:text-white">
                        <option value="5">5 - Sangat Baik</option>
                        <option value="4">4 - Baik</option>
                        <option value="3">3 - Cukup</option>
                        <option value="2">2 - Buruk</option>
                        <option value="1">1 - Rusak Berat</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Jumlah</label>
                    <input type="number" name="jumlah" min="1" required class="w-full rounded-lg border-slate-300 dark:border-slate-600 bg-slate-50 dark:bg-slate-700 py-2 px-3 text-sm focus:ring-primary focus:border-primary dark:text-white">
                </div>
            </div>
            <div>
                <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Tahun</label>
                <input type="number" name="tahun" min="1900" max="{{ date('Y') + 1 }}" required class="w-full rounded-lg border-slate-300 dark:border-slate-600 bg-slate-50 dark:bg-slate-700 py-2 px-3 text-sm focus:ring-primary focus:border-primary dark:text-white">
            </div>
            <div class="flex gap-2 pt-2">
                <button type="button" onclick="document.getElementById('addModal').classList.add('hidden')" class="flex-1 px-4 py-2 border border-slate-300 dark:border-slate-600 rounded-lg text-sm font-medium hover:bg-slate-50 dark:hover:bg-slate-700 dark:text-slate-300">
                    Batal
                </button>
                <button type="submit" class="flex-1 px-4 py-2 bg-primary hover:bg-primaryHover text-white rounded-lg text-sm font-medium">
                    Simpan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
    lucide.createIcons();
    
    // Update filename display
    function updateFilename(input) {
        const display = document.getElementById('filenameDisplay');
        if (input.files.length > 0) {
            display.textContent = input.files[0].name;
            display.classList.add('text-emerald-600', 'dark:text-emerald-400');
        } else {
            display.textContent = 'Klik untuk pilih file atau drag & drop';
            display.classList.remove('text-emerald-600', 'dark:text-emerald-400');
        }
    }
    
    // Drag and drop support
    const dropzone = document.getElementById('dropzone');
    const fileInput = document.getElementById('fileInput');
    
    dropzone.addEventListener('dragover', (e) => {
        e.preventDefault();
        dropzone.classList.add('border-emerald-500', 'bg-emerald-50', 'dark:bg-emerald-900/10');
    });
    
    dropzone.addEventListener('dragleave', (e) => {
        e.preventDefault();
        dropzone.classList.remove('border-emerald-500', 'bg-emerald-50', 'dark:bg-emerald-900/10');
    });
    
    dropzone.addEventListener('drop', (e) => {
        e.preventDefault();
        dropzone.classList.remove('border-emerald-500', 'bg-emerald-50', 'dark:bg-emerald-900/10');
        
        const files = e.dataTransfer.files;
        if (files.length > 0) {
            const file = files[0];
            const validExtensions = ['csv', 'xlsx', 'xls'];
            const extension = file.name.split('.').pop().toLowerCase();
            
            if (validExtensions.includes(extension)) {
                fileInput.files = files;
                updateFilename(fileInput);
            } else {
                alert('Format file tidak valid. Silakan gunakan file CSV, XLSX, atau XLS.');
            }
        }
    });
</script>
@endpush