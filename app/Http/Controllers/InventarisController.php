<?php

namespace App\Http\Controllers;

use App\Models\Inventaris;
use App\Imports\InventarisImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class InventarisController extends Controller
{
    public function index()
    {
        $dataset = Inventaris::orderBy('created_at', 'desc')->get();
        return view('dashboard.dataset', compact('dataset'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'kondisi' => 'required|integer|min:1|max:5',
            'jumlah' => 'required|integer|min:1',
            'tahun' => 'required|integer|min:1900|max:' . (date('Y') + 1),
        ]);

        // Determine status based on kondisi
        if ($validated['kondisi'] >= 4) {
            $status = 'Layak';
            $statusVal = 1;
        } elseif ($validated['kondisi'] == 3) {
            $status = 'Perawatan';
            $statusVal = 0.5;
        } else {
            $status = 'Perlu Diganti';
            $statusVal = 0;
        }

        Inventaris::create([
            'nama' => $validated['nama'],
            'kondisi' => $validated['kondisi'],
            'jumlah' => $validated['jumlah'],
            'tahun' => $validated['tahun'],
            'status' => $status,
            'status_val' => $statusVal,
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