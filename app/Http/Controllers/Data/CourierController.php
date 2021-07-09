<?php

namespace App\Http\Controllers\Data;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Courier;
use DataTables;

class CourierController extends Controller
{
    public function storeCourier(Request $request)
    {
      $isDatExists = Courier::where("courier_code", $request->get("courier_code"))->exists();

      if($isDatExists)
      {
        return response()->json([
          "status" => "error",
          "message" => "Data sudah ada"
        ]);
      }

      $courier = new Courier();
      $courier->courier_code = $request->get("courier_code");
      $courier->courier_name = $request->get("courier_name");
      $courier->save();
      
      return response()->json([
        "status" => "success",
        "message" => "Data berhasil disimpan"
      ]);
    }

    public function getAllCourier()
    {
      $dataCourier = Courier::all();

      return DataTables::of($dataCourier)
      ->addColumn('action', function($dataCourier){
        $button = <<<EOT
        <div class="btn-group">
            <button class="delete btn btn-sm btn-primary" id="$dataCourier->id">
                Delete data
            </button>
        </div>
        EOT;
        return $button;
      })->rawColumns(['action'])->make(true);
    }

    public function deleteCourier($id)
    {
      $courier = Courier::findOrFail($id);
      $courier->delete();
 
      return response()->json([
        "status" => "success",
        "message" => "Data berhasil dihapus"
      ]);
    }
}
