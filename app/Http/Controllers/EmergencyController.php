<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Emergency;
use App\Models\Record;
use App\Models\Beneficiary;
use App\Models\EmergencyType;
use App\Models\Month;

class EmergencyController extends Controller
{

    public function index(Request $request)
    {        
        $emergencies = Emergency::all();
        $months = Month::all();
        $emergencyTypes = EmergencyType::all();

        // $beneficiaries = Beneficiary::whereHas('record', function($q){
        //     return $q->where('month_id', '8');
        // })->get();
        // })->orderBy('published_date', 'desc')->paginate(10);



        return view('emergencies.index', compact('emergencies', 'months', 'emergencyTypes'));
    }


    public function store(Request $request)
    {
        $beneficiariesIds = $request->input('beneficiaries_ids');
        $recordId = $request->input('record_id');
        $emergencyDate = $request->input('emergency_date');
        $comment = $request->input('comment');
        $emergencyTypeId = $request->input('emergency_type_id');
        
        // $serviceId = $request->input('service_id');

        // foreach($serviceIds as $serviceId){
        //     Benefit::create([
        //         'beneficiary_id' => $request->input('beneficiary_id'),
        //         'service_id' => $serviceId
        //     ]);
        // }

        // foreach( $beneficiariesIds as $beneficiaryId){
        //     Emergency::create([
        //         'beneficiary_id' => $beneficiaryId,
        //         'record_id' => $recordId,
        //         'emergency_date' => $emergencyDate,
        //     ]);
        // }

        $emergency = Emergency::create([
            'record_id' => $recordId,
            'emergency_date' => $emergencyDate,
            'comment' => $comment,
            'emergency_type_id' => $emergencyTypeId,
        ]);

        foreach($beneficiariesIds as $beneficiaryId)
        {
            $beneficiary = Beneficiary::find($beneficiaryId);
            $emergency->beneficiaries()->attach($beneficiary);
        }
        

        // make the record inactive if it has no activities
        $record = Record::find($recordId);
        $record->status_id = 1;
        $record->save();
        
            
        return redirect()->back();
    }

}
