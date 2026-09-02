<?php

namespace App\Http\Controllers;

use App\Services\CurrentMenuData;
use Illuminate\Http\Request;

class DownloadMenuController extends Controller
{
    public function handle(Request $request)
    {
        $menuRows = collect(CurrentMenuData::menuRows());
        $data = [
            'menu' => $menuRows->groupBy(['day', 'meal']),
            'meal_types' => $menuRows->pluck('meal')->unique(),
            'days' => $menuRows->pluck('day')->unique(),
        ];

        if($request->header('Content-Type') === 'application/json') {
            return response()->json($data);
        }

        return response()->view('pdfs.menu', $data);
    }
}
