<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
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
}
