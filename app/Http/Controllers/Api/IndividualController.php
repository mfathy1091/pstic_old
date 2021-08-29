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

        $file_number = $request->keyword;

        //$data = Individual::query();

        //$data = Individual::where('file_id', 'like', "%$file_number%")->get();





        $individuals = Individual::query();

        $data = $individuals->with('file')->whereHas('file', function($q) use ($file_number){
            return $q->where('number', 'like', "%$file_number%");
        })->get();


        return response()->json($data); 
    }
}
