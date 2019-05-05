<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\vehicle;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $vehicles = Vehicle::all();
        
        return view('index', ['vehicles' => $vehicles]);
    }
}
