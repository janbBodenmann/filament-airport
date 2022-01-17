<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Airport;
use Illuminate\Http\Request;

class AirportController extends Controller
{
    public function index(Request $request){
        if($request->short_name){
            return Airport::where('short_name',$request->short_name)->get()->map->only(['name','short_name'])->all();
        }
        return Airport::get()->map->only(['name','short_name'])->all();
    }
}
