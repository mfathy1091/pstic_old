<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Individual;
use App\Models\Gender;
use App\Models\Nationality;
use App\Models\Relationship;


class IndividualController extends Controller
{
    public function getIndividuals(Request $request)
    {
        $data = Individual::where('name', 'LIKE','%'.$request->keyword.'%')->get();

        $file_number = $request->keyword;

        $individuals = Individual::query();

        $data = $individuals->with('file')->whereHas('file', function($q) use ($file_number){
            return $q->where('number', 'like', "%$file_number%");
        })->get();


        return response()->json($data); 
    }

    public function getGenders()
    {
        $data = Gender::all();

        return response()->json($data); 
    }

    public function getNationalities()
    {
        $data = Nationality::all();

        return response()->json($data); 
    }

    public function getRelationships()
    {
        $data = Relationship::all();

        return response()->json($data); 
    }


    public function addIndividual(Request $request)
    {
        $individual = Individual::create([
            'passport_number' => $request->passport_number,
            'name' => $request->name,
            'age' => $request->age,
            'is_registered' => $request->is_registered,
            'file_id' => $request->file_id,
            'individual_id' => $request->individual_id,
            'gender_id' => $request->gender_id,
            'nationality_id' => $request->nationality_id,
            'relationship_id' => $request->pa_relationship_id,
            'current_phone_number' => $request->current_phone_number,
        ]);

        return response()->json([
            'message'=>'Added Successfully!!',
            'individual'=>$individual
        ]);
    }
    
}

