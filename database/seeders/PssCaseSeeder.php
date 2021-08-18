<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Referral;
use App\Models\PssCase;
use App\Models\Beneficiary;
use App\Models\ReferralReason;

class PssCaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // PSS Cases
        $pssCases = [
            [   
                'direct_individual_id' => '1',
                'assigned_psw_id' => '4',
                'current_status_id' => '2',
            ],
            [   
                'direct_individual_id' => '2',
                'assigned_psw_id' => '4',
                'current_status_id' => '1',
            ],

        
            [   
                'direct_individual_id' => '2',
                'assigned_psw_id' => '3',
                'current_status_id' => '1',
            ],

        ];


        foreach ($pssCases as $n) {
            PssCase::create($n);
        }




    }
}
