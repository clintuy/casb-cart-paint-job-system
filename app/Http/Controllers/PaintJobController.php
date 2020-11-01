<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\NewPaintJob;

class PaintJobController extends Controller
{
    public function index()
    {
        
        $count = NewPaintJob::count();

        $total_count_completed = NewPaintJob::where('completed', 1)->count();

        $blue_count_completed = NewPaintJob::where('completed', 1)
            ->where('target_color', 'Blue')->count();

        $red_count_completed = NewPaintJob::where('completed', 1)
            ->where('target_color', 'Red')->count();

        $green_count_completed = NewPaintJob::where('completed', 1)
            ->where('target_color', 'Green')->count();


        $skip = 5;
        $limit = $count - $skip; // the limit

        $progress_jobs = NewPaintJob::where('completed', '=', '0')->limit(5)->get();

        if($count >= $skip) {
            $queued_paint_jobs = NewPaintJob::skip($skip)->take($limit)
            ->where('completed', '=', '0')->get();

        }


        return view('pages.paint-jobs', compact(
            'progress_jobs',
            'queued_paint_jobs',
            'total_count_completed',
            'blue_count_completed',
            'red_count_completed',
            'green_count_completed'
        ));
    }

    public function update(Request $request)
    {
        $expense_category = NewPaintJob::where('id', $request->id)
            ->update([
            'completed' => 1
        ]);

        return response()->json([
            'message' => "Car paint job is finished"
        ]);
    }
}
