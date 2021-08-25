<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\EmergencyType;

class EmergencyTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'name' => 'PSS',
            ],
            [
                'name' => 'Protection',
            ],
            [
                'name' => 'Housing',
            ],
            [
                'name' => 'Child Protection',
            ],
            [
                'name' => 'Community Violence',
            ],

        ];

        foreach ($data as $n){
            EmergencyType::create($n);
        }
    }
}
