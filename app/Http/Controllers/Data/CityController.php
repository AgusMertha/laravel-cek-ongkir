<?php

namespace App\Http\Controllers\Data;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

class CityController extends Controller
{
    public function getCityResource()
    {
        $RAJAONGKIR_APP_KEY = env('RAJAONGKIR_APP_KEY');

        $response = Http::withHeaders([
            "key" => $RAJAONGKIR_APP_KEY
        ])->get("https://pro.rajaongkir.com/api/city");

        $results = $response->json();

        return $results['rajaongkir']['results'];
    }
    
    public function getCityByProvinceResource(Request $request)
    {
        $RAJAONGKIR_APP_KEY = env('RAJAONGKIR_APP_KEY');

        $response = Http::withHeaders([
            "key" => $RAJAONGKIR_APP_KEY
        ])->get("https://pro.rajaongkir.com/api/city", [
            "province" => $request->get("province_id")
        ]);

        $results = $response->json();

        return $results['rajaongkir']['results'];
    }
}
