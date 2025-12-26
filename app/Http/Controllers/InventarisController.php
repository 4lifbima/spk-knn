<?php

namespace App\Http\Controllers;

use App\Models\Inventaris;
use App\Imports\InventarisImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class InventarisController extends Controller
{
    public function index(Request $request)
    {
        $query = Inventaris::query();
        
        // Search functionality
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                  ->orWhere('tahun', 'like', "%{$search}%")
                  ->orWhere('kondisi', 'like', "%{$search}%")
                  ->orWhere('tingkat_pemanfaatan', 'like', "%{$search}%")
                  ->orWhere('tingkat_kebutuhan', 'like', "%{$search}%")
                  ->orWhere('status', 'like', "%{$search}%");
            });
        }
        
        // Get per page value from request or default to 10
        $perPage = $request->get('per_page', 10);
        
        $dataset = $query->orderBy('created_at', 'desc')->paginate($perPage)->appends($request->query());
        
        return view('dashboard.dataset', compact('dataset', 'perPage'));
    }
    
    public function edit(Inventaris $inventaris)
    {
        return view('dashboard.dataset-edit', compact('inventaris'));
    }
    
    public function update(Request $request, Inventaris $inventaris)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'tahun' => 'required|integer|min:1900|max:' . (date('Y') + 1),
            'kondisi' => 'required|in:Baik,Rusak Ringan,Rusak Berat',
            'tingkat_pemanfaatan' => 'required|in:Sering Digunakan,Kadang Digunakan,Tidak Digunakan',
            'tingkat_kebutuhan' => 'required|in:Sangat Dibutuhkan,Dibutuhkan,Sangat Tidak Dibutuhkan',
        ]);

        // Calculate status from 3 variables
        $statusData = Inventaris::calculateStatus(
            $validated['kondisi'],
            $validated['tingkat_pemanfaatan'],
            $validated['tingkat_kebutuhan']
        );

        $inventaris->update([
            'nama' => $validated['nama'],
            'tahun' => $validated['tahun'],
            'kondisi' => $validated['kondisi'],
            'tingkat_pemanfaatan' => $validated['tingkat_pemanfaatan'],
            'tingkat_kebutuhan' => $validated['tingkat_kebutuhan'],
            'status' => $statusData['status'],
            'status_val' => $statusData['status_val'],
        ]);

        return redirect()->route('dataset.index')->with('success', 'Data inventaris berhasil diperbarui');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'tahun' => 'required|integer|min:1900|max:' . (date('Y') + 1),
            'kondisi' => 'required|in:Baik,Rusak Ringan,Rusak Berat',
            'tingkat_pemanfaatan' => 'required|in:Sering Digunakan,Kadang Digunakan,Tidak Digunakan',
            'tingkat_kebutuhan' => 'required|in:Sangat Dibutuhkan,Dibutuhkan,Sangat Tidak Dibutuhkan',
        ]);

        // Calculate status from 3 variables
        $statusData = Inventaris::calculateStatus(
            $validated['kondisi'],
            $validated['tingkat_pemanfaatan'],
            $validated['tingkat_kebutuhan']
        );

        Inventaris::create([
            'nama' => $validated['nama'],
            'tahun' => $validated['tahun'],
            'kondisi' => $validated['kondisi'],
            'tingkat_pemanfaatan' => $validated['tingkat_pemanfaatan'],
            'tingkat_kebutuhan' => $validated['tingkat_kebutuhan'],
            'status' => $statusData['status'],
            'status_val' => $statusData['status_val'],
        ]);

        return redirect()->route('dataset.index')->with('success', 'Data inventaris berhasil ditambahkan');
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:csv,xlsx,xls|max:10240', // Max 10MB
        ], [
            'file.required' => 'Silakan pilih file untuk diimport',
            'file.mimes' => 'Format file harus CSV, XLSX, atau XLS',
            'file.max' => 'Ukuran file maksimal 10MB',
        ]);

        try {
            Excel::import(new InventarisImport, $request->file('file'));
            return redirect()->route('dataset.index')->with('success', 'Data berhasil diimport dari file Excel/CSV');
        } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
            $failures = $e->failures();
            $errorMessages = [];
            foreach ($failures as $failure) {
                $errorMessages[] = 'Baris ' . $failure->row() . ': ' . implode(', ', $failure->errors());
            }
            return redirect()->route('dataset.index')->with('error', implode(' | ', array_slice($errorMessages, 0, 3)));
        } catch (\Exception $e) {
            return redirect()->route('dataset.index')->with('error', 'Gagal mengimport data: ' . $e->getMessage());
        }
    }

    public function destroy(Inventaris $inventaris)
    {
        $inventaris->delete();
        return redirect()->route('dataset.index')->with('success', 'Data inventaris berhasil dihapus');
    }
}