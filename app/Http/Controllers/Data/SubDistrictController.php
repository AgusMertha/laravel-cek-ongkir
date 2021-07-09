<?php

namespace App\Http\Controllers\Data;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use App\Subdistrict;
use DB;

class SubDistrictController extends Controller
{
    public function getCity()
    {
        $data = DB::table("provinces")->join("cities", "provinces.province_id", "=", "cities.province_id")->select("provinces.province_id", "provinces.name", "cities.city_id", "cities.city_name")->get();

        $data2 = $data->groupBy("province_id");
        $group_index = 0;
        $data2 =  $data2->groupBy(function($item, $key) use ($group_index){
            return $group_index++;
        });

        return $data2[0];
    }

    public function getSubdistrictByCityResource($cityId)
    {
        $RAJAONGKIR_APP_KEY = env('RAJAONGKIR_APP_KEY');

        $response = Http::withHeaders([
            "key" => $RAJAONGKIR_APP_KEY
        ])->get("https://pro.rajaongkir.com/api/subdistrict", [
            "city" => $cityId
        ]);

        $results = $response->json();

        return $results['rajaongkir']['results'];
    }

    public function getAllSubdistrict()
    {
        $data = DB::table("cities")->join("subdistricts", "cities.city_id", "subdistricts.city_id")->get();
    }

    public function storeSubdistrict(Request $request)
    {
        $RAJAONGKIR_APP_KEY = env('RAJAONGKIR_APP_KEY');

        $response = Http::withHeaders([
            "key" => $RAJAONGKIR_APP_KEY
        ])->get("https://pro.rajaongkir.com/api/subdistrict",[
            "city" => $request->get("city"),
            "id" => $request->get("subdistrict"),
        ]);

        $results = $response->json();

        $data = $results['rajaongkir']['results'];

        $subdistrict = new Subdistrict();
        $subdistrict->subdistrict_id = $data['subdistrict_id'];
        $subdistrict->city_id = $data['city_id'];
        $subdistrict->subdistrict_name = $data['subdistrict_name'];
        $subdistrict->save();

        return response()->json([
            "status" => "success",
            "message" => "Data berhasil disimpan"
        ]);
    }

    public function deleteSubdistrict($id)
    {
        $city = City::findOrFail($id);
        $city->delete();

        return response()->json([
            "status" => "success",
            "message" => "Data berhasil dihapus"
        ]);
    }
}
