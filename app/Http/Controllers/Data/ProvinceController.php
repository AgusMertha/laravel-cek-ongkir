<?php

namespace App\Http\Controllers\Data;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use App\Province;

class ProvinceController extends Controller
{
    public function getProvinceResource()
    {
        $RAJAONGKIR_APP_KEY = env('RAJAONGKIR_APP_KEY');

        $response = Http::withHeaders([
            "key" => $RAJAONGKIR_APP_KEY
        ])->get("https://pro.rajaongkir.com/api/province");

        $results = $response->json();

        return $results['rajaongkir']['results'];
    }

    public function showAllData()
    {
        $data = Province::all();
        
        return response()->json([
            "data" => $data
        ]);
    }

    public function insert(Request $request)
    {
        $province = new Province();
        $province->name = $request->get("province_name");
        $province->save();

        return response()->json([
            "status" => "success",
            "message" => "Data berhasil disimpan"
        ]);
    }

    public function delete($id)
    {
        $province = Province::findOrFail($id);
        $province->delete();
    }
}
