<?php

namespace App\Http\Controllers;

use App\Models\Inventaris;
use App\Models\HistoryKnn;
use Illuminate\Http\Request;

class KnnController extends Controller
{
    public function index()
    {
        return view('dashboard.process');
    }

    public function calculate(Request $request)
    {
        $validated = $request->validate([
            'k_value' => 'required|integer|min:1|max:7',
            'kondisi' => 'required|in:Baik,Rusak Ringan,Rusak Berat',
            'pemanfaatan' => 'required|in:Sering Digunakan,Kadang Digunakan,Tidak Digunakan',
            'kebutuhan' => 'required|in:Sangat Dibutuhkan,Dibutuhkan,Sangat Tidak Dibutuhkan',
        ]);

        $kValue = $validated['k_value'];
        
        // Encode input values to numeric
        $inputKondisi = Inventaris::encodeKondisi($validated['kondisi']);
        $inputPemanfaatan = Inventaris::encodePemanfaatan($validated['pemanfaatan']);
        $inputKebutuhan = Inventaris::encodeKebutuhan($validated['kebutuhan']);

        // Normalize input (values are 1-3, so min=1, max=3)
        $normKondisi = ($inputKondisi - 1) / 2;
        $normPemanfaatan = ($inputPemanfaatan - 1) / 2;
        $normKebutuhan = ($inputKebutuhan - 1) / 2;

        // Get all dataset
        $dataset = Inventaris::all();

        // Calculate distances
        $distances = $dataset->map(function ($data) use ($normKondisi, $normPemanfaatan, $normKebutuhan) {
            // Encode dataset values
            $dKondisi = Inventaris::encodeKondisi($data->kondisi);
            $dPemanfaatan = Inventaris::encodePemanfaatan($data->tingkat_pemanfaatan);
            $dKebutuhan = Inventaris::encodeKebutuhan($data->tingkat_kebutuhan);

            // Normalize dataset values
            $dNormKondisi = ($dKondisi - 1) / 2;
            $dNormPemanfaatan = ($dPemanfaatan - 1) / 2;
            $dNormKebutuhan = ($dKebutuhan - 1) / 2;

            // Calculate Euclidean distance
            $distance = sqrt(
                pow($normKondisi - $dNormKondisi, 2) + 
                pow($normPemanfaatan - $dNormPemanfaatan, 2) +
                pow($normKebutuhan - $dNormKebutuhan, 2)
            );

            return [
                'id' => $data->id,
                'nama' => $data->nama,
                'kondisi' => $data->kondisi,
                'pemanfaatan' => $data->tingkat_pemanfaatan,
                'kebutuhan' => $data->tingkat_kebutuhan,
                'status' => $data->status,
                'distance' => $distance,
            ];
        })->sortBy('distance')->take($kValue)->values();

        // Vote
        $voteLayak = $distances->filter(fn($n) => $n['status'] === 'Layak')->count();
        $voteGanti = $distances->filter(fn($n) => $n['status'] === 'Perlu Diganti')->count();
        $votePerawatan = $distances->filter(fn($n) => $n['status'] === 'Perawatan')->count();
        
        // Determine final status
        $maxVote = max($voteLayak, $voteGanti, $votePerawatan);
        if ($voteLayak == $maxVote) {
            $finalStatus = 'Layak Digunakan';
        } elseif ($votePerawatan == $maxVote) {
            $finalStatus = 'Perlu Perawatan';
        } else {
            $finalStatus = 'Perlu Diganti';
        }
        
        $confidence = ($maxVote / $kValue) * 100;

        // Save to history
        HistoryKnn::create([
            'user_id' => auth()->id(),
            'k_value' => $kValue,
            'input_kondisi' => $validated['kondisi'],
            'input_pemanfaatan' => $validated['pemanfaatan'],
            'input_kebutuhan' => $validated['kebutuhan'],
            'result' => $finalStatus,
            'confidence' => $confidence,
            'neighbors' => $distances->toArray(),
        ]);

        return response()->json([
            'success' => true,
            'result' => $finalStatus,
            'confidence' => round($confidence, 1),
            'neighbors' => $distances,
            'k_value' => $kValue,
            'votes' => [
                'layak' => $voteLayak,
                'perawatan' => $votePerawatan,
                'ganti' => $voteGanti,
            ],
        ]);
    }

    public function preprocessing()
    {
        // Get all data from inventaris
        $dataset = Inventaris::all();
        
        if ($dataset->isEmpty()) {
            return view('dashboard.preprocessing', [
                'dataset' => collect([]),
                'stats' => null,
                'normalized' => collect([]),
            ]);
        }
        
        // For categorical variables encoded 1-3, min=1, max=3 for all
        $stats = [
            'kondisi' => ['min' => 1, 'max' => 3, 'range' => 2],
            'pemanfaatan' => ['min' => 1, 'max' => 3, 'range' => 2],
            'kebutuhan' => ['min' => 1, 'max' => 3, 'range' => 2],
        ];
        
        // Apply Min-Max Normalization: x' = (x - min) / (max - min)
        $normalized = $dataset->map(function ($item) {
            // Get encoded values
            $kondisi = Inventaris::encodeKondisi($item->kondisi);
            $pemanfaatan = Inventaris::encodePemanfaatan($item->tingkat_pemanfaatan);
            $kebutuhan = Inventaris::encodeKebutuhan($item->tingkat_kebutuhan);
            
            return [
                'id' => $item->id,
                'nama' => $item->nama,
                'tahun' => $item->tahun,
                'kondisi_raw' => $item->kondisi,
                'kondisi_encoded' => $kondisi,
                'kondisi_norm' => round(($kondisi - 1) / 2, 4),
                'pemanfaatan_raw' => $item->tingkat_pemanfaatan,
                'pemanfaatan_encoded' => $pemanfaatan,
                'pemanfaatan_norm' => round(($pemanfaatan - 1) / 2, 4),
                'kebutuhan_raw' => $item->tingkat_kebutuhan,
                'kebutuhan_encoded' => $kebutuhan,
                'kebutuhan_norm' => round(($kebutuhan - 1) / 2, 4),
                'status' => $item->status,
            ];
        });
        
        return view('dashboard.preprocessing', compact('dataset', 'stats', 'normalized'));
    }
}