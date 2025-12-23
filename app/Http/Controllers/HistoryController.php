<?php

namespace App\Http\Controllers;

use App\Models\HistoryKnn;
use Illuminate\Http\Request;

class HistoryController extends Controller
{
    public function index()
    {
        $history = HistoryKnn::where('user_id', auth()->id())
            ->orderBy('created_at', 'desc')
            ->get();
            
        return view('dashboard.history', compact('history'));
    }

    public function show(HistoryKnn $history)
    {
        // Make sure user can only see their own history
        if ($history->user_id !== auth()->id()) {
            abort(403);
        }

        return response()->json($history);
    }
}