<?php

// get the value of is_emergency checkbox
if( $request->has('is_emergency')){
    $psCase->is_emergency = $request->is_emergency;
}else{
    $psCase->is_emergency = "";
}



// save the current case status according to referral date
$referralDate = $request->referral_date;
$ConvertedReferralDate = strtotime($referralDate);
$referralMonth = date("m", $ConvertedReferralDate);

if(date("m") == $referralMonth){
    $psCase->case_status_id = '1';  // new
}
elseif(date("m") > $referralMonth){
    $psCase->case_status_id = '2';  // inctive
} 

$psCase->save();


// try and catch for store method
try {
    toastr()->success('Added Successfuly');
}
catch (Exception $e)
{
    return redirect()->back()->withErrors(['error' => $e->getMessage()]);
}



