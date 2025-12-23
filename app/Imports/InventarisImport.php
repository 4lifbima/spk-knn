<?php

namespace App\Imports;

use App\Models\Inventaris;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class InventarisImport implements ToModel, WithHeadingRow, WithValidation
{
    /**
     * @param array $row
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        // Get kondisi value
        $kondisi = (int) $row['kondisi'];
        
        // Determine status based on kondisi
        if ($kondisi >= 4) {
            $status = 'Layak';
            $statusVal = 1;
        } elseif ($kondisi == 3) {
            $status = 'Perawatan';
            $statusVal = 0.5;
        } else {
            $status = 'Perlu Diganti';
            $statusVal = 0;
        }

        return new Inventaris([
            'nama'       => $row['nama'] ?? $row['nama_sarana'] ?? '',
            'kondisi'    => $kondisi,
            'jumlah'     => (int) $row['jumlah'],
            'tahun'      => (int) $row['tahun'],
            'status'     => $status,
            'status_val' => $statusVal,
        ]);
    }

    /**
     * Validation rules for import
     */
    public function rules(): array
    {
        return [
            'nama' => 'required_without:nama_sarana|string|max:255',
            'nama_sarana' => 'required_without:nama|string|max:255',
            'kondisi' => 'required|integer|min:1|max:5',
            'jumlah' => 'required|integer|min:1',
            'tahun' => 'required|integer|min:1900|max:' . (date('Y') + 1),
        ];
    }

    /**
     * Custom validation messages
     */
    public function customValidationMessages(): array
    {
        return [
            'nama.required_without' => 'Kolom Nama Sarana wajib diisi',
            'nama_sarana.required_without' => 'Kolom Nama Sarana wajib diisi',
            'kondisi.required' => 'Kolom Kondisi wajib diisi',
            'kondisi.min' => 'Kondisi harus bernilai 1-5',
            'kondisi.max' => 'Kondisi harus bernilai 1-5',
            'jumlah.required' => 'Kolom Jumlah wajib diisi',
            'jumlah.min' => 'Jumlah minimal 1',
            'tahun.required' => 'Kolom Tahun wajib diisi',
        ];
    }
}
