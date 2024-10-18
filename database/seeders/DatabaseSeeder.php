<?php

namespace Database\Seeders;

use App\Models\Target;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $targets = [
            ["nama" => "Adinda", "kode" => "GUOQSAMD"],
            ["nama" => "Alia", "kode" => "HEIPRZRW"],
            ["nama" => "Arsyad", "kode" => "JPTOUVMR"],
            ["nama" => "Dhea", "kode" => "OXQIYRNL"],
            ["nama" => "Fakhri", "kode" => "TMBLYYLD"],
            ["nama" => "Felinda", "kode" => "LZBJALPY"],
            ["nama" => "Nesti", "kode" => "LTAIAHIO"],
            ["nama" => "Prima", "kode" => "WAENAPWH"],
            ["nama" => "Rania", "kode" => "SJLEBRBB"],
            ["nama" => "Syifa", "kode" => "RLXWDEIK"],
        ];
        
        foreach($targets as $target){
            Target::create($target);
        }
    }
}
