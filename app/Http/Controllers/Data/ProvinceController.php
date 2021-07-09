<?php

namespace App\Http\Controllers\Data;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use DataTables;
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
        
        return DataTables::of($data)
        ->addColumn('action', function($data){
            $button = <<<EOT
            <div class="btn-group">
                <button class="delete btn btn-sm btn-primary" id="$data->province_id">
                    Delete data
                </button>
            </div>
            EOT;
            return $button;
        })->rawColumns(['action'])->make(true);
    }

    public function storeProvince(Request $request)
    {
        $isDataExists = Province::where("province_id", $request->get("province_id"))->exists();

        if($isDataExists){
            return response()->json([
                'status' => "error",
                "message" => "Data sudah ada"
            ]);
        }

        $province = new Province();
        $province->province_id = $request->get("province_id");
        $province->name = $request->get("province_name");
        $province->save();

        return response()->json([
            "status" => "success",
            "message" => "Data berhasil disimpan"
        ]);
    }

    public function deleteProvince($id)
    {
        $province = Province::findOrFail($id);
        $province->delete();

        return response()->json([
            "status" => "success",
            "message" => "Data berhasil dihapus"
        ]);
    }
}
