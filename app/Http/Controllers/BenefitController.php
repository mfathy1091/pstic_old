<?php

namespace App\Http\Controllers;

use App\Models\Beneficiary;
use Illuminate\Http\Request;
use App\Models\Benefit;
use App\Models\Record;

class BenefitController extends Controller
{

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Benefit::all();


            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
   
                           $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editProduct">Edit</a>';
   
                           $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-danger btn-sm deleteProduct">Delete</a>';
    
                            return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
    
        return view('productAjax',compact('products'));
    }


    public function store(Request $request)
    {
        $recordId = $request->input('record_id');
        // $beneficiariesIds = $request->input('beneficiaries_ids');
        // $serviceId = $request->input('service_id');
        $servicseIds = $request->input('services_ids');

        foreach($servicseIds as $serviceId){
            Benefit::create([
                'record_id' => $recordId,
                'beneficiary_id' => $request->input('beneficiary_id'),
                'service_id' => $serviceId
            ]);
        }

        // foreach( $beneficiariesIds as $beneficiaryId){
        //     Benefit::create([
        //         'beneficiary_id' => $beneficiaryId,
        //         'record_id' => $recordId,
        //         'service_id' => $serviceId,
        //     ]);
        // }

        // make the record inactive if it has no activities
        $record = Record::find($recordId);
        $record->status_id = 1;
        $record->save();
        
            
        return redirect()->back();
    }



    public function destroy($id)
    {
        $benefit = Benefit::findOrFail($id);
        $record = $benefit->record;
        
        $benefit->delete();

        // make the record inactive if it has no activities
        if(($record->benefits)->isEmpty())
        {
            $record->status_id = 2;
            $record->save();
        }

        return redirect()->back();
    }


    public function delete(Request $request)
    {
        $benefit = Benefit::find($request->id);
        if(!$benefit){
            return redirect()->back()-with(['error' => 'Record does not exist']);
        }        
        $benefit->delete();

        // make the record inactive if it has no activities
        $record = $benefit->record;

        
        if(($record->benefits)->isEmpty())
        {
            $record->status_id = 2;
            $record->save();
            $is_empty = true;
        }
        else
        {
            $is_empty = false;
        }


        return response()->json(
            [
                'status' => true,
                'msg' => 'Deleted successfully',
                'is_empty' => $is_empty,
            ]);
    }

}
