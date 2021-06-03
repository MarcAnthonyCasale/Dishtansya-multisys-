<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Products;

class ProductsController extends Controller
{
    public function orderindex()
    {
        $getdata = Products::all();
        return view('order',['products' => $getdata]);
    }
    public function order(Request $request)
    {
      $getProduct = Products::findOrFail($request->product_id);
      $totalQ = $getProduct->available_stocks;
      $deductQ = $totalQ - $request->quantity;
      if($deductQ <= 0)
      {
        $message = ['message'=>'Failed to order this product due to unavailability of the stock'];
        return response( $message, 400);
      }
      $getProduct->update([
        'available_stocks' =>$deductQ,

      ]);
      $message = ['message'=>'You have successfully ordered this product.'];
      return response( $message, 201);
    }
}
