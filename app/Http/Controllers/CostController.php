<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Subdistrict;
use App\Province;
use App\Courier;
use App\City;

class CostController extends Controller
{
    public function getCourier()
    {
        $dataCourier = Courier::orderBy("courier_code", "ASC")->get(['courier_code', 'courier_name']);
        return $dataCourier;
    }
    public function getProvince()
    {
        $dataProvince = Province::orderBy("province_id", "ASC")->get(['province_id', 'name']);
        return $dataProvince;
    }

    public function getCity($provinceId)
    {
        $dataCity = City::where("province_id", $provinceId)->orderBy("city_id", "ASC")->get(['city_id', 'city_name']);
        return $dataCity;
    }

    public function getSubdistrict($cityId)
    {
        $dataSubdistrict = Subdistrict::where("city_id", $cityId)->orderBy("subdistrict_id", "ASC")->get(['subdistrict_id', 'subdistrict_name']);
        return $dataSubdistrict;
    }

    public function countCost(Request $request)
    {
        $RAJAONGKIR_APP_KEY = env('RAJAONGKIR_APP_KEY');

        $response = Http::withHeaders([
            "key" => $RAJAONGKIR_APP_KEY
        ])->post("https://pro.rajaongkir.com/api/cost", [
            "origin" => $request->get("origin_subdistrict"),
            "originType" => "subdistrict",
            "destination" => $request->get("destination_subdistrict"),
            "destinationType" => "subdistrict",
            "courier" => $request->get("select_courier"),
            "weight" => $request->get("weight")
        ]);

        $results = $response->json();

        return $results['rajaongkir']['results'];
    }
}
