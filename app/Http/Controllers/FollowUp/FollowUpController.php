<?php

namespace App\Http\Controllers\FollowUp;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FollowUp;

class FollowUpController extends Controller
{

    
    public function store(Request $request)
    {
        $data = request()->validate([
            'beneficiary_id' => 'required',
            'pss_case_id' => 'required',
            'record_id' => 'required',
            'follow_up_date' => 'required',
            'comment' => 'required',
        ]);
            
        //dd($request);
            
        $followUp = FollowUp::create($data);
            
        return redirect()->back();
    }
    
    

    public function destroy($id)
    {
        $emergency = FollowUp::findOrFail($id);
        $record = $emergency->record;
        
        $emergency->delete();

        // make the record inactive if it has no activities
        if(($record->emergencies)->isEmpty())
        {
            $record->status_id = 2;
            $record->save();
        }

        return redirect()->back();
    }
}
