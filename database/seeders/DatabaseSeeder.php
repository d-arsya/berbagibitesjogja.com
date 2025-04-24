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
            ['name' => 'Bu Ika', 'role' => 'Inti', 'division' => 'Founder', 'phone' => '6281806995869', 'code' => 'DL6YW2'],
            ['name' => 'Rania', 'role' => 'Inti', 'division' => 'Operational Manager', 'phone' => '6285740297985', 'code' => 'DLTYW3'],
            ['name' => 'Cia', 'role' => 'Inti', 'division' => 'Sekretaris', 'phone' => '6281293721955', 'code' => 'FYXKRM'],
            ['name' => 'Fakhri', 'role' => 'Inti', 'division' => 'PSDM', 'phone' => '62895422491729', 'code' => 'LQ7FUZ'],
            ['name' => 'Prima', 'role' => 'Inti', 'division' => 'PSDM', 'phone' => '62858767062892', 'code' => 'XZ5QKL'],
            ['name' => 'Tania', 'role' => 'Inti', 'division' => 'Food', 'phone' => '6285175490728', 'code' => 'MQ5UZB'],
            ['name' => 'Barya', 'role' => 'Inti', 'division' => 'Food', 'phone' => '6281266414139', 'code' => 'NYTD2P'],
            ['name' => 'Alia', 'role' => 'Inti', 'division' => 'Medinfo', 'phone' => '6287858161650', 'code' => 'NKALZ7'],
            ['name' => 'Arsyad', 'role' => 'Inti', 'division' => 'Medinfo', 'phone' => '6289636055420', 'code' => 'XPL7NK'],
            ['name' => 'Syifa', 'role' => 'Inti', 'division' => 'Fund', 'phone' => '6285877335878', 'code' => 'CZKQNM'],
            ['name' => 'Vivi', 'role' => 'Inti', 'division' => 'Fund', 'phone' => '6282144435542', 'code' => 'R4TXWB'],
            ['name' => 'Adit', 'role' => 'Staff', 'division' => 'Food', 'phone' => '6285893582717', 'code' => 'ZJ8RQL'],
            ['name' => 'Virgi', 'role' => 'Staff', 'division' => 'Food', 'phone' => '62838355862871', 'code' => 'W3TLMF'],
            ['name' => 'Luna', 'role' => 'Staff', 'division' => 'Food', 'phone' => '6281226705091', 'code' => 'AVR25K'],
            ['name' => 'Disa', 'role' => 'Staff', 'division' => 'Food', 'phone' => '6289627589645', 'code' => 'H29VQU'],
            ['name' => 'Gyan', 'role' => 'Staff', 'division' => 'Food', 'phone' => '6283849012298', 'code' => 'JFKD31'],
            ['name' => 'Annisa', 'role' => 'Staff', 'division' => 'Food', 'phone' => '62881027573659', 'code' => 'PQW89E'],
            ['name' => 'Dita', 'role' => 'Staff', 'division' => 'Fund', 'phone' => '6285643245648', 'code' => 'K7RZ9X'],
            ['name' => 'Darien', 'role' => 'Staff', 'division' => 'Fund', 'phone' => '6281389717001', 'code' => 'GZUVET'],
            ['name' => 'Ella', 'role' => 'Staff', 'division' => 'Fund', 'phone' => '6281322855670', 'code' => 'YB26QA'],
            ['name' => 'Nasywa', 'role' => 'Staff', 'division' => 'Fund', 'phone' => '6282132915068', 'code' => 'U8MRSV'],
            ['name' => 'Deyna', 'role' => 'Staff', 'division' => 'Medinfo', 'phone' => '6282223342145', 'code' => 'BMVR3Y'],
            ['name' => 'Cahaya', 'role' => 'Staff', 'division' => 'Medinfo', 'phone' => '6282124040631', 'code' => 'SVW8HD'],
            ['name' => 'Salma', 'role' => 'Staff', 'division' => 'Medinfo', 'phone' => '6287834455759', 'code' => 'JEQ59U'],
            ['name' => 'Nasya', 'role' => 'Staff', 'division' => 'Medinfo', 'phone' => '6282226418588', 'code' => 'RWZJ6L'],
            ['name' => 'Annisa', 'role' => 'Staff', 'division' => 'Medinfo', 'phone' => '6285801620544', 'code' => 'TVCEU9'],
            ['name' => 'Syafira', 'role' => 'Staff', 'division' => 'PSDM', 'phone' => '6285150730773', 'code' => 'HCRV85'],
            ['name' => 'Bakhtiar', 'role' => 'Staff', 'division' => 'PSDM', 'phone' => '6281511042939', 'code' => 'WPNFK2'],
            ['name' => 'Hasya', 'role' => 'Staff', 'division' => 'PSDM', 'phone' => '6282310547392', 'code' => 'BY2JTX'],
            ['name' => 'Neisha', 'role' => 'Staff', 'division' => 'PSDM', 'phone' => '6287882705421', 'code' => 'AMQ37C'],
        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
}
