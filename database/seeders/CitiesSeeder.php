<?php

namespace Database\Seeders;

use App\Models\Cities;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CitiesSeeder extends Seeder
{
    
    public function run(): void
    {
        $cities = [
            [
                'city_name' => 'Chennai',
                'state_id' => 1
            ],
            [
                'city_name' => 'Coimbatore',
                'state_id' => 1
            ],
            [
                'city_name' => 'Tirunelveli',
                'state_id' => 1
            ],
            [
                'city_name' => 'Erode',
                'state_id' => 1
            ],
            [
                'city_name' => 'Vellore',
                'state_id' => 1
            ],
            [
                'city_name' => 'Trichy',
                'state_id' => 1
            ],
            [
                'city_name' => 'Virudhunagar',
                'state_id' => 1
            ],
            [
                'city_name' => 'Madurai',
                'state_id' => 1
            ],
            [
                'city_name' => 'Salem',
                'state_id' => 1
            ],
            [
                'city_name' => 'Bangalore',
                'state_id' => 2
            ],
            [
                'city_name' => 'Mysore',
                'state_id' => 2
            ],
            [
                'city_name' => 'Mangalore',
                'state_id' => 2
            ],
            [
                'city_name' => 'Chikkamagaluru',
                'state_id' => 2
            ],
            [
                'city_name' => 'Raichur',
                'state_id' => 2
            ],
            [
                'city_name' => 'Udupi',
                'state_id' => 2
            ],
            [
                'city_name' => 'Ballari',
                'state_id' => 2
            ],
            [
                'city_name' => 'Thiruvananthapuram',
                'state_id' => 3
            ],
            [
                'city_name' => 'Kochi',
                'state_id' => 3
            ],
            [
                'city_name' => 'Kozhikode',
                'state_id' => 3
            ],
            [
                'city_name' => 'Kollam',
                'state_id' => 3
            ],
            [
                'city_name' => 'Alappuzha',
                'state_id' => 3
            ],
            [
                'city_name' => 'Malappuram',
                'state_id' => 3
            ],
            [
                'city_name' => 'Kasaragod',
                'state_id' => 3
            ],
            [
                'city_name' => 'Idukki',
                'state_id' => 3
            ],
            [
                'city_name' => 'Visakhapatnam',
                'state_id' => 4
            ],
            [
                'city_name' => 'Vijayawada',
                'state_id' => 4
            ],
            [
                'city_name' => 'Guntur',
                'state_id' => 4
            ],
            [
                'city_name' => 'Tirupati',
                'state_id' => 4
            ],
            [
                'city_name' => 'Eluru',
                'state_id' => 4
            ],
            [
                'city_name' => 'Chittoor',
                'state_id' => 4
            ],
            [
                'city_name' => 'Kadapa',
                'state_id' => 4
            ],
            [
                'city_name' => 'Mumbai',
                'state_id' => 5
            ],
            [
                'city_name' => 'Pune',
                'state_id' => 5
            ],
            [
                'city_name' => 'Nagpur',
                'state_id' => 5
            ],
            [
                'city_name' => 'Thane',
                'state_id' => 5
            ],
            [
                'city_name' => 'Amravati',
                'state_id' => 5
            ],
            [
                'city_name' => 'Jalgaon',
                'state_id' => 5
            ],
            [
                'city_name' => 'Akola',
                'state_id' => 5
            ],
            [
                'city_name' => 'Nashik',
                'state_id' => 5
            ],
            [
                'city_name' => 'Lucknow',
                'state_id' => 6
            ],
            [
                'city_name' => 'Kanpur',
                'state_id' => 6
            ],
            [
                'city_name' => 'Ghaziabad',
                'state_id' => 6
            ],
            [
                'city_name' => 'Noida',
                'state_id' => 6
            ],
            [
                'city_name' => 'Agra',
                'state_id' => 6
            ],
            [
                'city_name' => 'Varanasi',
                'state_id' => 6
            ],
            [
                'city_name' => 'Meerut',
                'state_id' => 6
            ],
            [
                'city_name' => 'Dwarka',
                'state_id' => 7
            ],
            [
                'city_name' => 'Pitampura',
                'state_id' => 7
            ],
            [
                'city_name' => 'Saket',
                'state_id' => 7
            ],
            [
                'city_name' => 'Rohini',
                'state_id' => 7
            ],
            [
                'city_name' => 'Lajpat Nagar',
                'state_id' => 7
            ],
            [
                'city_name' => 'Karol Bagh',
                'state_id' => 7
            ],
            [
                'city_name' => 'Connaught Place',
                'state_id' => 7
            ],
            [
                'city_name' => 'Jaipur',
                'state_id' => 8
            ],
            [
                'city_name' => 'Jodhpur',
                'state_id' => 8
            ],
            [
                'city_name' => 'Udaipur',
                'state_id' => 8
            ],
            [
                'city_name' => 'Kota',
                'state_id' => 8
            ],
            [
                'city_name' => 'Bikaner',
                'state_id' => 8
            ],
            [
                'city_name' => 'Bhilwara',
                'state_id' => 8
            ],
            [
                'city_name' => 'Nagaur',
                'state_id' => 8
            ],
            [
                'city_name' => 'Howrah',
                'state_id' => 9
            ],
            [
                'city_name' => 'Durgapur',
                'state_id' => 9
            ],
            [
                'city_name' => 'Asansol',
                'state_id' => 9
            ],
            [
                'city_name' => 'Siliguri',
                'state_id' => 9
            ],
            [
                'city_name' => 'Kharagpur',
                'state_id' => 9
            ],
            [
                'city_name' => 'Haldia',
                'state_id' => 9
            ],
            [
                'city_name' => 'Gaya',
                'state_id' => 10
            ],
            [
                'city_name' => 'Begusarai',
                'state_id' => 10
            ],
            [
                'city_name' => 'Bettiah',
                'state_id' => 10
            ],
            [
                'city_name' => 'Bhagalpur',
                'state_id' => 10
            ],
            [
                'city_name' => 'Arrah',
                'state_id' => 10
            ],
            [
                'city_name' => 'Sasaram',
                'state_id' => 10
            ],
            [
                'city_name' => 'Bhopal',
                'state_id' => 11
            ],
            [
                'city_name' => 'Indore',
                'state_id' => 11
            ],
            [
                'city_name' => 'Jabalpur',
                'state_id' => 11
            ],
            [
                'city_name' => 'Gwalior',
                'state_id' => 11
            ],
            [
                'city_name' => 'Ujjain',
                'state_id' => 11
            ],
            [
                'city_name' => 'Sagar',
                'state_id' => 11
            ],
            [
                'city_name' => 'Ratlam',
                'state_id' => 11
            ],
            [
                'city_name' => 'Srinagar',
                'state_id' => 12
            ],
            [
                'city_name' => 'Pulwama',
                'state_id' => 12
            ],
            [
                'city_name' => 'Udhampur',
                'state_id' => 12
            ],
            [
                'city_name' => 'Anantnag',
                'state_id' => 12
            ],
            [
                'city_name' => 'Baramulla',
                'state_id' => 12
            ],
            [
                'city_name' => 'Kathua',
                'state_id' => 12
            ],
            [
                'city_name' => 'Poonch',
                'state_id' => 12
            ],
        ];

        foreach($cities as $city){
            Cities::create($city);
        }
    }
}
