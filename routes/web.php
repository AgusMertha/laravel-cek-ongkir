<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();


Route::prefix('admin')->group(function () {
    Route::get("/", "AdminController@index")->name("admin.index");
    Route::get("province", "AdminController@province")->name("admin.province");
    Route::get("city", "AdminController@city")->name("admin.city");
    Route::get("subdistrict", "AdminController@subdistrict")->name("admin.subdistrict");
});

Route::get('/home', 'HomeController@index')->name('home');

Route::post("way-bill", "WayBillController@getWayBill")->name("waybill");

Route::prefix('province')->group(function () {
    Route::get("get-province-source", "Data\ProvinceController@getProvinceResource");
    Route::get("get-province", "Data\ProvinceController@showAllData");
    Route::post("store-province", "Data\ProvinceController@storeProvince")->name("province.store");
    Route::post("delete-province/{id}", "Data\ProvinceController@deleteProvince")->name("province.delete"); 
});

Route::prefix('city')->group(function () {
    Route::get("get-province-data", "Data\CityController@getProvince");
    Route::get("get-city-source/{provinceId}", "Data\CityController@getCityByProvinceResource");
    Route::get("get-city", "Data\CityController@getAllCity");
    Route::post("store-city", "Data\CityController@storeCity");
    Route::post("delete-city/{id}", "Data\CityController@deleteCity");
});

Route::prefix('subdistrict')->group(function () {
    Route::get("get-city-data", "Data\SubDistrictController@getCity");
    Route::get("get-subdistrict-source/{cityId}", "Data\SubDistrictController@getSubdistrictByCityResource");
    Route::post("store-subdistrict", "Data\SubDistrictController@storeSubdistrict");
});
