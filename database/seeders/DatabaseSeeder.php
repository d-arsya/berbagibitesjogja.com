<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $users = [
            ['name' => 'Bu Ika', 'role' => 'Founder', 'division' => 'Founder', 'phone' => '6281806995869', 'code' => 'QWYZPL'],
            ['name' => 'Rania', 'role' => 'Operational Manager', 'division' => 'Operational Manager', 'phone' => '6285740297985', 'code' => 'KLTZQN'],
            ['name' => 'Fakhri', 'role' => 'Koordinator', 'division' => 'Friend', 'phone' => '62895422491729', 'code' => 'DHJAHF'],
            ['name' => 'Prima', 'role' => 'Wakil Koordinator', 'division' => 'Friend', 'phone' => '6285876700892', 'code' => 'FHATDY'],
            ['name' => 'Syifa', 'role' => 'Koordinator', 'division' => 'Fund', 'phone' => '6285877335878', 'code' => 'JGKRTE'],
            ['name' => 'Felinda', 'role' => 'Wakil Koordinator', 'division' => 'Fund', 'phone' => '62895391326470', 'code' => 'VBGYWF'],
            ['name' => 'Nesti', 'role' => 'Koordinator', 'division' => 'Food', 'phone' => '6285801245337', 'code' => 'JKAUOS'],
            ['name' => 'Dhea', 'role' => 'Wakil Koordinator', 'division' => 'Food', 'phone' => '6289524197300', 'code' => 'XPDRMQ'],
            ['name' => 'Alia', 'role' => 'Koordinator', 'division' => 'Medinfo', 'phone' => '6287858161650', 'code' => 'NCUFHE'],
            ['name' => 'Arsyad', 'role' => 'Wakil Koordinator', 'division' => 'Medinfo', 'phone' => '6289636055420', 'code' => 'ZRYJKT'],
            ['name' => 'Bakhtiar', 'role' => 'Staff', 'division' => 'Friend', 'phone' => '6281511042939', 'code' => 'XGHLPT'],
            ['name' => 'Nasya', 'role' => 'Staff', 'division' => 'Medinfo', 'phone' => '6282226418588', 'code' => 'LQBDFJ'],
            ['name' => 'Aufa', 'role' => 'Staff', 'division' => 'Medinfo', 'phone' => '62895383155437', 'code' => 'AKZRWT'],
            ['name' => 'Mutjel', 'role' => 'Staff', 'division' => 'Medinfo', 'phone' => '6281217039443', 'code' => 'GATGFJ'],
            ['name' => 'Salma', 'role' => 'Staff', 'division' => 'Medinfo', 'phone' => '6287834455759', 'code' => 'WLQXND'],
            ['name' => 'Annisa', 'role' => 'Staff', 'division' => 'Medinfo', 'phone' => '6285801620544', 'code' => 'KHFZTP'],
            ['name' => 'Cahaya', 'role' => 'Staff', 'division' => 'Medinfo', 'phone' => '6282124040631', 'code' => 'FRMGYP'],
            ['name' => 'Azizah', 'role' => 'Staff', 'division' => 'Medinfo', 'phone' => '6289697107843', 'code' => 'ADCHUI'],
            ['name' => 'Dalila', 'role' => 'Staff', 'division' => 'Medinfo', 'phone' => '6285641729212', 'code' => 'KLHJIS'],
            ['name' => 'Angel', 'role' => 'Staff', 'division' => 'Medinfo', 'phone' => '6287761237450', 'code' => 'KLAHIU'],
            ['name' => 'Tania', 'role' => 'Staff', 'division' => 'Food', 'phone' => '6285175490728', 'code' => 'RMPTZK'],
            ['name' => 'Barya', 'role' => 'Staff', 'division' => 'Food', 'phone' => '6281266414139', 'code' => 'GHVQYP'],
            ['name' => 'Novi', 'role' => 'Staff', 'division' => 'Food', 'phone' => '6282226387810', 'code' => 'DBNLKF'],
            ['name' => 'Cladis', 'role' => 'Staff', 'division' => 'Food', 'phone' => '6287776587566', 'code' => 'YKMPTD'],
            ['name' => 'Vivi', 'role' => 'Staff', 'division' => 'Fund', 'phone' => '6282144435542', 'code' => 'TRGWKL'],
            ['name' => 'Firza', 'role' => 'Staff', 'division' => 'Fund', 'phone' => '6285845453524', 'code' => 'GJSGYI'],
            ['name' => 'El', 'role' => 'Staff', 'division' => 'Fund', 'phone' => '6288992849924', 'code' => 'JGYIAU'],
        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
}
