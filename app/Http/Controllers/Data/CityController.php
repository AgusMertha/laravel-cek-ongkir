<?php

namespace App\Http\Controllers\Data;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use DataTables;
use DB;
use App\Province;
use App\City;

class CityController extends Controller
{
    public function getProvince()
    {
        $data = Province::all();

        return $data;
    }
    
    public function getCityByProvinceResource($provinceId)
    {
        $RAJAONGKIR_APP_KEY = env('RAJAONGKIR_APP_KEY');

        $response = Http::withHeaders([
            "key" => $RAJAONGKIR_APP_KEY
        ])->get("https://pro.rajaongkir.com/api/city", [
            "province" => $provinceId
        ]);

        $results = $response->json();

        return $results['rajaongkir']['results'];
    }

    public function getAllCity()
    {
        $dataCity = DB::table("provinces")->join("cities", "provinces.province_id", "=", "cities.province_id")->get(['city_name', "name", "city_id", "type"]);
    
        return DataTables::of($dataCity)
        ->addColumn('action', function($dataCity){
            $button = <<<EOT
            <div class="btn-group">
                <button class="delete btn btn-sm btn-primary" id="$dataCity->city_id">
                    Delete data
                </button>
            </div>
            EOT;
            return $button;
        })->rawColumns(['action'])->make(true);
    }

    public function storeCity(Request $request)
    {
        $RAJAONGKIR_APP_KEY = env('RAJAONGKIR_APP_KEY');

        $response = Http::withHeaders([
            "key" => $RAJAONGKIR_APP_KEY
        ])->get("https://pro.rajaongkir.com/api/city",[
            "id" => $request->get("city"),
            "province" => $request->get("province"),
        ]);

        $results = $response->json();

        $data = $results['rajaongkir']['results'];

        $city = new City();
        $city->city_id = $data['city_id'];
        $city->province_id = $data['province_id'];
        $city->type = $data['type'];
        $city->city_name = $data['city_name'];
        $city->save();

        return response()->json([
            "status" => "success",
            "message" => "Data berhasil disimpan"
        ]);
    }
}
