<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware("auth");
    }

    public function index()
    {
        return view("home");
    }
    
    public function province()
    {
        return view("admin.province");
    }
    
    public function city()
    {
        return view("admin.city");
    }
    
    public function subdistrict()
    {
        return view("admin.subdistrict");
    }

    public function courier()
    {
        return view("admin.courier");
    }
}
