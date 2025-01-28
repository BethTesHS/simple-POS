<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Models\SaleDetail;
use Illuminate\Http\Request;

class SaleDetailController extends Controller
{

    public function showSaleDetail(Request $request)
    {
        $saleDetails = SaleDetail::where('sale_id', $request->sale_id)->get();
        return response()->json($saleDetails);
    }

}