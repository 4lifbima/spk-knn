<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inventaris extends Model
{
    protected $table = 'inventaris';
    
    protected $fillable = [
        'nama',
        'tahun',
        'kondisi',
        'tingkat_pemanfaatan',
        'tingkat_kebutuhan',
        'status',
        'status_val',
    ];

    protected $casts = [
        'tahun' => 'integer',
        'status_val' => 'float',
    ];

    /**
     * Encoding untuk kondisi ke nilai numerik
     */
    public static function encodeKondisi(string $kondisi): int
    {
        return match ($kondisi) {
            'Baik' => 3,
            'Rusak Ringan' => 2,
            'Rusak Berat' => 1,
            default => 1,
        };
    }

    /**
     * Encoding untuk tingkat pemanfaatan ke nilai numerik
     */
    public static function encodePemanfaatan(string $pemanfaatan): int
    {
        return match ($pemanfaatan) {
            'Sering Digunakan' => 3,
            'Kadang Digunakan' => 2,
            'Tidak Digunakan' => 1,
            default => 1,
        };
    }

    /**
     * Encoding untuk tingkat kebutuhan ke nilai numerik
     */
    public static function encodeKebutuhan(string $kebutuhan): int
    {
        return match ($kebutuhan) {
            'Sangat Dibutuhkan' => 3,
            'Dibutuhkan' => 2,
            'Sangat Tidak Dibutuhkan' => 1,
            default => 1,
        };
    }

    /**
     * Hitung skor total dan tentukan status
     */
    public static function calculateStatus(string $kondisi, string $pemanfaatan, string $kebutuhan): array
    {
        $skorKondisi = self::encodeKondisi($kondisi);
        $skorPemanfaatan = self::encodePemanfaatan($pemanfaatan);
        $skorKebutuhan = self::encodeKebutuhan($kebutuhan);
        
        $totalSkor = $skorKondisi + $skorPemanfaatan + $skorKebutuhan;
        
        if ($totalSkor >= 7) {
            return ['status' => 'Layak', 'status_val' => 1];
        } elseif ($totalSkor >= 5) {
            return ['status' => 'Perawatan', 'status_val' => 0.5];
        } else {
            return ['status' => 'Perlu Diganti', 'status_val' => 0];
        }
    }

    /**
     * Get encoded values for KNN
     */
    public function getEncodedValues(): array
    {
        return [
            'kondisi' => self::encodeKondisi($this->kondisi),
            'pemanfaatan' => self::encodePemanfaatan($this->tingkat_pemanfaatan),
            'kebutuhan' => self::encodeKebutuhan($this->tingkat_kebutuhan),
        ];
    }
}