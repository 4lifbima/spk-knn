<?php

namespace App\Imports;

use App\Models\Inventaris;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class InventarisImport implements ToModel, WithHeadingRow, WithValidation
{
    /**
     * Normalize string - trim and remove multiple spaces
     */
    private function normalizeString(?string $value): ?string
    {
        if ($value === null) {
            return null;
        }
        // Trim whitespace and replace multiple spaces with single space
        return preg_replace('/\s+/', ' ', trim($value));
    }

    /**
     * Map Excel column names to our expected format
     */
    private function getColumnValue(array $row, array $possibleNames, $default = null)
    {
        foreach ($possibleNames as $name) {
            $key = strtolower(str_replace(' ', '_', $name));
            if (isset($row[$key]) && $row[$key] !== null && $row[$key] !== '') {
                return $this->normalizeString((string) $row[$key]);
            }
        }
        return $default;
    }

    /**
     * @param array $row
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        // Get values from Excel with flexible column names (already normalized)
        $nama = $this->getColumnValue($row, ['nama_sarana', 'nama', 'name']);
        $tahun = $this->getColumnValue($row, ['tahun_pengadaan', 'tahun', 'year']);
        $kondisi = $this->getColumnValue($row, ['kondisi_sarana', 'kondisi', 'condition']);
        $pemanfaatan = $this->getColumnValue($row, ['tingkat_pemanfaatan', 'pemanfaatan', 'utilization']);
        $kebutuhan = $this->getColumnValue($row, ['tingkat_kebutuhan', 'kebutuhan', 'need']);

        // Calculate status from 3 variables
        $statusData = Inventaris::calculateStatus($kondisi, $pemanfaatan, $kebutuhan);

        return new Inventaris([
            'nama' => $nama,
            'tahun' => (int) $tahun,
            'kondisi' => $kondisi,
            'tingkat_pemanfaatan' => $pemanfaatan,
            'tingkat_kebutuhan' => $kebutuhan,
            'status' => $statusData['status'],
            'status_val' => $statusData['status_val'],
        ]);
    }

    /**
     * Prepare data before validation - normalize all string values
     */
    public function prepareForValidation(array $data): array
    {
        // Normalize all string values in the row
        foreach ($data as $key => $value) {
            if (is_string($value)) {
                $data[$key] = preg_replace('/\s+/', ' ', trim($value));
            }
        }
        return $data;
    }

    /**
     * Validation rules for import
     */
    public function rules(): array
    {
        return [
            '*.nama_sarana' => 'nullable|string|max:255',
            '*.nama' => 'nullable|string|max:255',
            '*.tahun_pengadaan' => 'nullable',
            '*.tahun' => 'nullable',
            '*.kondisi_sarana' => 'nullable|in:Baik,Rusak Ringan,Rusak Berat',
            '*.kondisi' => 'nullable|in:Baik,Rusak Ringan,Rusak Berat',
            '*.tingkat_pemanfaatan' => 'nullable|in:Sering Digunakan,Kadang Digunakan,Tidak Digunakan',
            '*.tingkat_kebutuhan' => 'nullable|in:Sangat Dibutuhkan,Dibutuhkan,Sangat Tidak Dibutuhkan',
        ];
    }

    /**
     * Custom validation messages
     */
    public function customValidationMessages(): array
    {
        return [
            '*.kondisi_sarana.in' => 'Kondisi harus Baik, Rusak Ringan, atau Rusak Berat',
            '*.kondisi.in' => 'Kondisi harus Baik, Rusak Ringan, atau Rusak Berat',
            '*.tingkat_pemanfaatan.in' => 'Tingkat Pemanfaatan harus Sering Digunakan, Kadang Digunakan, atau Tidak Digunakan',
            '*.tingkat_kebutuhan.in' => 'Tingkat Kebutuhan harus Sangat Dibutuhkan, Dibutuhkan, atau Sangat Tidak Dibutuhkan',
        ];
    }
}
