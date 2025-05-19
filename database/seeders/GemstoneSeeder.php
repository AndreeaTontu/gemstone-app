<?php

namespace Database\Seeders;

use App\Models\Grade;
use App\Models\Gemstone;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GemstoneSeeder extends Seeder
{
    /**
     * Run the database seeds using run() method. 
     */
    public function run()
    {
        $gemstones = [
            [
                'name' => 'Turqoise' ,
                'location' => 'USA, China, Egypt' , 
                'colour' => 'Blue-green vibrant' , 
                'association' =>'Throat Chakra' , 
                'meaning' => 'Balance, Protection',
                'grades'=>[1,2,3],
            ],
            [
                'name' => 'Rose Quartz' ,
                'location' => 'Brazil, Madagascar, India' , 
                'colour' => 'Pink' , 
                'association' =>'Heart Chakra' , 
                'meaning' => 'Unconditional love, Heealing, Compassion',
                'grades'=>[2,3]
                ],
            [
                'name' => 'Amethyst' ,
                'location' => 'Uruguay, Brazil' , 
                'colour' => 'Purple' , 
                'association' =>'Crown Chakra' , 
                'meaning' => 'Clarity, Spiritual protection',
                'grades'=>[4,5]
            ],
            [
                'name' => 'Citrine' ,
                'location' => 'Brazil, Spain' , 
                'colour' => 'Yellow' , 
                'association' =>'Solar Plexus Chakra' , 
                'meaning' => 'Positivity,  Self-confidence',
                'grades'=>[3,4]
            ],
            [
                'name' => 'Sapphire' ,
                'location' => 'Thailand, Sri Lanka' , 
                'colour' => 'Blue' , 
                'association' =>'Third Eye Chakra' , 
                'meaning' => 'Integriy, Wisdom',
                'grades'=>[2,3]
            ],
            [
                'name' => 'Emerald' ,
                'location' => 'Brazil, Colombia' , 
                'colour' => 'Green' , 
                'association' =>'Heart Chakra' , 
                'meaning' => 'Growth, Patience',
                'grades'=>[2,3,4]],
        [
                'name' => 'Garnet' ,
                'location' => 'Sri Lanka, India' , 
                'colour' => 'Red, Green' , 
                'association' =>'Root Chakra' , 
                'meaning' => 'Passion, Vitality',
                'grades'=>[4,5]],
            [
                'name' => "Tiger's Eye" ,
                'location' => 'Western Australia, South Africa' , 
                'colour' => 'Golden-brown' , 
                'association' =>'Solar Plexus Chakra' , 
                'meaning' => 'Courage, Self-discipline',
                'grades'=>[1,2]],
            [
                'name' => 'Jade' ,
                'location' => 'Guatemala, China' , 
                'colour' => 'Green' , 
                'association' =>'Heart Chakra' , 
                'meaning' => 'Health, Prosperity',
                'grades'=>[3,4]],
            [
                'name' => 'Moonstone' ,
                'location' => 'Sri Lanka, India' , 
                'colour' => 'Blue Sheen, White' , 
                'association' =>'Crown Chakra' , 
                'meaning' => 'Balance, Intuition, New beginnings',
                'grades'=>[2,3,4]],
        ];
        

        // Loop through each gemstone and insert it
        foreach ($gemstones as $data) {
            // Use firstOrCreate to avoid duplicates
            $gemstone = Gemstone::firstOrCreate([
                'name' => $data['name'],
                'location' => $data['location'],
                'colour' => $data['colour'],
                'association' => $data['association'],
                'meaning' => $data['meaning'],
            ]);

            // Attach grades via pivot table
            $gemstone->grades()->attach($data['grades']);
        }
        
        }
}
