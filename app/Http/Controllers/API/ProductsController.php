<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Products;

class ProductsController extends Controller
{
    public function order(Request $request)
    {
      $getProduct = Products::findOrFail($request->product_id);
      $totalQ = $getProduct->available_stocks;
      $deductQ = $totalQ - $request->quantity;
      $getProduct->update([
        'name' => 'qweqwe',
        'available_stocks' =>$deductQ,

      ]);
      return $getProduct;
    }
}
