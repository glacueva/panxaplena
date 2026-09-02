<?php

namespace App\Http\Controllers;

use App\Services\CurrentMenuData;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use Illuminate\Http\Request;

class DownloadShoppingListController extends Controller
{
    public function handle(Request $request)
    {
        $data = [
            'list' => collect(CurrentMenuData::shoppingRows())->groupBy('category'),
        ];

        if($request->header('Content-Type') === 'application/json') {
            return response()->json($data);
        }

        return response()->view('pdfs.shopping-list', $data);
    }
}
