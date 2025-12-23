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
            'kondisi' => 'required|integer|min:1|max:5',
            'jumlah' => 'required|integer|min:1',
        ]);

        $kValue = $validated['k_value'];
        $inputKondisi = $validated['kondisi'];
        $inputJumlah = $validated['jumlah'];

        // Normalize input
        $normKondisi = ($inputKondisi - 1) / 4;
        $normJumlah = $inputJumlah / 100;

        // Get all dataset
        $dataset = Inventaris::all();

        // Calculate distances
        $distances = $dataset->map(function ($data) use ($normKondisi, $normJumlah) {
            $dNormKondisi = ($data->kondisi - 1) / 4;
            $dNormJumlah = $data->jumlah / 100;

            $distance = sqrt(
                pow($normKondisi - $dNormKondisi, 2) + 
                pow($normJumlah - $dNormJumlah, 2)
            );

            return [
                'id' => $data->id,
                'nama' => $data->nama,
                'kondisi' => $data->kondisi,
                'jumlah' => $data->jumlah,
                'status' => $data->status,
                'distance' => $distance,
            ];
        })->sortBy('distance')->take($kValue)->values();

        // Vote
        $voteLayak = $distances->filter(fn($n) => $n['status'] === 'Layak')->count();
        $voteGanti = $distances->filter(fn($n) => $n['status'] === 'Perlu Diganti')->count();
        
        $finalStatus = $voteLayak >= $voteGanti ? 'Layak Digunakan' : 'Perlu Diganti';
        $confidence = (max($voteLayak, $voteGanti) / $kValue) * 100;

        // Save to history
        HistoryKnn::create([
            'user_id' => auth()->id(),
            'k_value' => $kValue,
            'input_kondisi' => $inputKondisi,
            'input_jumlah' => $inputJumlah,
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
        ]);
    }

    public function preprocessing()
    {
        return view('dashboard.preprocessing');
    }
}