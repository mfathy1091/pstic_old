<?php

namespace App\Http\Controllers\Psw;

use App\Http\Controllers\Controller;
use App\Repositories\PsCaseRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use App\Models\Gender;

use App\Models\Nationality;
use Illuminate\Http\Request;
use App\Models\Referral;
use App\Models\PssCase;
use App\Models\ReferralSource;
use App\Models\File;
use App\Models\Reason;
use App\Models\PsCaseActivity;
use App\Models\Status;
use App\Models\Month;
use App\Models\Team;
use App\Models\Employee;
use App\Models\JobTitle;

class PssCaseController extends Controller
{

    public function index(Request $request)
    {        
        $pssCases = PssCase::where('assigned_psw_id',  Auth::user()->id)
            ->get();

        $tabs = array();
        $statuses = Status::where('type', 'Psychosocial')->get();

        $tabs[0] = ['name' => 'All', 'cases' => $pssCases];
        
        $currentMonth = Month::where('code', date("Y-m"))->firstOrFail();
        $i = 1;
        foreach($statuses as $status){
            $cases = PssCase::whereHas('records', function($query) use($status, $currentMonth) {
                return $query->where('status_id', $status->id)->where('month_id', $currentMonth->id);
            })->get();
            $tabs[$i] = ['name' => $status->name, 'cases' => $cases];
            $i++;
        }

		return view('psw.pss_cases.index', compact('tabs'));
    }




/*     public function store(Request $request)
    {
        //dd($request);
        $this->psCaseRepo->storePsCase($request);

        toastr()->success('Added Successfuly');
        return redirect()->route('pscases.index');

    
       try {
 

        }
        
        catch (\Exception $e){
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        } 
    } */


}