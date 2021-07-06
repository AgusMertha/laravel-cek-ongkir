<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

class WayBillController extends Controller
{
    public function getWayBill(Request $request){
        $rules = [
            "waybill" => "required",
            "courier" => "required"
        ];

        $messages = [
            "waybill.required" => "Field tidak boleh kosong",
            "courier.required" => "Field tidak boleh kosong"
        ];

        $error = Validator::make($request->all(), $rules, $messages);
        if($error->fails())
        {
            return response()->json(['errors' => $error->getMessageBag()->toArray()]);
        }
    
        $RAJAONGKIR_APP_KEY = env('RAJAONGKIR_APP_KEY');
        $response = Http::withHeaders([
            "key" => $RAJAONGKIR_APP_KEY
        ])->post("https://pro.rajaongkir.com/api/waybill", [
            "waybill" => $request->get("waybill"),
            "courier" => $request->get("courier")
        ]);

        $results = $response->json();
        
        return response()->json([
            "status" => $results['rajaongkir']['status'],
            "data" => $results['rajaongkir']['result']
        ]);
    }
}
