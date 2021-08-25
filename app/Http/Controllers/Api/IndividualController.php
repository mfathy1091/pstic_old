<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Individual;

class IndividualController extends Controller
{
    public function getIndividuals(Request $request)
    {
        $data = Individual::where('name', 'LIKE','%'.$request->keyword.'%')->get();
        return response()->json($data); 
    }
}
