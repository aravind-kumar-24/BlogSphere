<?php

namespace Database\Seeders;

use App\Models\States;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StatesSeeder extends Seeder
{
    
    public function run(): void
    {
        $states = [
            [
                'state_name' => 'Tamil Nadu'
            ],
            [
                'state_name' => 'Karnataka'
            ],
            [
                'state_name' => 'Kerala'
            ],
            [
                'state_name' => 'Andhra Pradesh'
            ],
            [
                'state_name' => 'Maharashtra'
            ],
            [
                'state_name' => 'Uttar Pradesh'
            ],
            [
                'state_name' => 'New Delhi'
            ],
            [
                'state_name' => 'Rajasthan'
            ],
            [
                'state_name' => 'Kolkatta'
            ],
            [
                'state_name' => 'Bihar'
            ],
            [
                'state_name' => 'Madhya Pradesh'
            ],
            [
                'state_name' => 'Jammu & Kashmir'
            ],
        ];

        foreach($states as $state){
            States::create($state);
        }
    }
}
