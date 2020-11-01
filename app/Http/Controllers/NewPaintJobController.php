<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\NewPaintJob;

class NewPaintJobController extends Controller
{
    public function index()
    {
        return view('pages.new-paint-jobs');
    }

    public function store(Request $request)
    {
        $validator = $request->validate([
            'plate_no' => 'required|alpha_dash',
            'current_color' => 'required',
            'target_color' => 'required'
        ]);

        $expense = NewPaintJob::create([
            'plate_no' => $request->plate_no,
            'current_color' => $request->current_color,
            'target_color' => $request->target_color,
        ]);

        return response()->json([
            'message' => "Car paint job request is successfully added to queue"
        ]);
    }
}
