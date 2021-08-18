<?php

namespace App\Http\Controllers\Individual;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Individual;


class SearchController extends Controller
{
//     public function index2(Request $request)
//     {
// /*         $data = request()->validate([
//             'file_number' => 'required',
//             'individual_number' => 'required',
//             'passport_number' => 'required',
//         ]); */

//         $request->validate([
//             'query' =>'required',
//         ]);

//         $query = $request->input('query');
//         //dd($query);
//         //$files = File::where('number', 'like', "%$query%")->get();
        
//         $individuals = Individual::with('file')->whereHas('file', function($q) use ($query){
//             return $q->where('number', 'like', "%$query%");
//         })->orWhere('individual_id', 'like', "%$query%")
//         ->orWhere('passport_number', 'like', "%$query%")
//         ->orWhere('name', 'like', "%$query%")
//         ->orWhere('native_name', 'like', "%$query%")
//         ->get();
//         //dd($individuals);
        
//         return view('individuals.search_results', compact('individuals'));
//     }

    // public function index(Request $request)
    // {
    //     //dd($request);

    //     $file_number = $request->input('file_number');
    //     $individual_id = $request->input('individual_id');
    //     $passport_number = $request->input('passport_number');
    //     $name = $request->input('name');


    //     $individuals = Individual::query();
    //     //dd($individuals);

    //     if($request->filled('file_number')){
    //         $individuals->with('file')->whereHas('file', function($q) use ($file_number){
    //             return $q->where('number', 'like', "%$file_number%");
    //         });
    //     }
    //     if($request->filled('individual_id')){
    //         $individuals->orWhere('individual_id', 'like', "%$individual_id%");
    //     }
    //     if($request->filled('passport_number')){
    //         $individuals->orWhere('passport_number', 'like', "%$passport_number%");
    //     }
    //     if($request->filled('name')){
    //         $individuals->orWhere('name', 'like', "%$name%")
    //         ->orWhere('native_name', 'like', "%$name%");
    //     }

    //     return view('home', ['individuals' => $individuals->get()]);
    // }

    public function index() {

        return view('individuals.search.index');
    }




    public function action(Request $request) {

        //dd($request);
        $file_number = $request->input('file_number');
        $individual_id = $request->input('individual_id');
        $passport_number = $request->input('passport_number');

        if($request->ajax())
        {
            if($file_number == '' && $individual_id == '' && $passport_number == '')
            {
                $output = '
                <tr>
                    <td align="center" colspan="11">No Data Found - You Searched For Nothing!</td>
                </tr>
            ';
                
                
                $total_records = 0;
                
                $data = array(
                    'record_rows' => $output,
                    'total_records' => 0,
                );
                
                echo json_encode($data);
            }
            else
            {
                $individuals = Individual::query();
                if($file_number != '')
                {
                    $individuals = $individuals->with('file')->whereHas('file', function($q) use ($file_number){
                        return $q->where('number', 'like', "%$file_number%");
                    });
                }
                if($individual_id != '')
                {
                    $individuals->orWhere('individual_id', 'like', "%$individual_id%");
                }
                if($passport_number != '')
                {
                    $individuals->orWhere('passport_number', 'like', "%$passport_number%");
                }

                $individuals = $individuals->get();

                $total_records = $individuals->count();
                $output = '';




                if($total_records > 0)
                {
                    foreach($individuals as $individual){
                        $address = '/individuals/' . $individual->id;
    
                        $output .= '
                            <tr>
                                <td>'. $individual->file->number. '</td>
                                <td>'. $individual->individual_id. '</td>
                                <td>'. $individual->passport_number. '</td>
                                <td>'. $individual->name. '</td>
                                <td>'. $individual->native_name. '</td>
                                <td>'. $individual->relationship->name. '</td>
                                <td>'. $individual->age. '</td>
                                <td>'. $individual->gender->name. '</td>
                                <td>'. $individual->nationality->name. '</td>
                                <td>'. $individual->current_phone_number. '</td>
                                <td>
                                    <a href="'. $address .'" class="btn btn-info btn-sm" role="button" aria-pressed="true">Show</a>
                                </td>
                            </tr>
    
                        ';
                    }
                }
                else
                {
                    $output = '
                    <tr>
                        <td align="center" colspan="11">No Data Found</td>
                    </tr>
                ';
                }
    
                $data = array(
                    'record_rows' => $output,
                    'total_records' => $total_records
                );
                
                echo json_encode($data);
            }


            

        }
    }



}
