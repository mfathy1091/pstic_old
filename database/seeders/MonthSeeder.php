<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Month;
use App\Models\MonthReferral;

class MonthSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('months')->delete();
        $data = [
            [
                'code' => '2021-01',
                'name' => 'January 2021',
            ],
            [
                'code' => '2021-02',
                'name' => 'February 2021',
            ],
            [
                'code' => '2021-03',
                'name' => 'March 2021',
            ],
            [
                'code' => '2021-04',
                'name' => 'April 2021',
            ],
            [
                'code' => '2021-05',
                'name' => 'May 2021',
            ],
            [
                'code' => '2021-06',
                'name' => 'June 2021',
            ],
            [
                'code' => '2021-07',
                'name' => 'July 2021',
            ],
            [
                'code' => '2021-08',
                'name' => 'August 2021',
            ],
            [
                'code' => '2021-09',
                'name' => 'September 2021',
            ],
            [
                'code' => '2021-10',
                'name' => 'October 2021',
            ],
            [
                'code' => '2021-11',
                'name' => 'November 2021',
            ],
            [
                'code' => '2021-12',
                'name' => 'December 2021',
            ],
        ];

        foreach ($data as $n) {
            Month::create($n);
        }
    }


}
