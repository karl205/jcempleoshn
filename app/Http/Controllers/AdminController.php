<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function catalogos()
{
    return view('admin.catalogos');
}
}
