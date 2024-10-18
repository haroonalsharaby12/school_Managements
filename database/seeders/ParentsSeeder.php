<?php

namespace Database\Seeders;

use App\Models\Blood;
use App\Models\Nationalities;
use App\Models\parents;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ParentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        DB::table('parents')->delete();
        $my_parents = new parents();
        $my_parents->email = 'samir.gamal77@yahoo.com';
        $my_parents->password = Hash::make('12345678');
        $my_parents->Name_Father = ['en' => 'samirgamal', 'ar' => ' عبده سعيد'];
        $my_parents->National_ID_Father = '1234567810';
        $my_parents->Passport_ID_Father = '1234567810';
        $my_parents->Phone_Father = '1234567810';
        $my_parents->Job_Father = ['en' => 'programmer', 'ar' => 'مبرمج'];
        $my_parents->Nationality_Father_id = Nationalities::all()->unique()->random()->id;
        $my_parents->Blood_Type_Father_id =Blood::all()->unique()->random()->id;
        $my_parents->Address_Father ='تعز';
        $my_parents->Name_Mother = ['en' => 'SS', 'ar' => 'سس'];
        $my_parents->National_ID_Mother = '1234567810';
        $my_parents->Passport_ID_Mother = '1234567810';
        $my_parents->Phone_Mother = '1234567810';
        $my_parents->Job_Mother = ['en' => 'Teacher', 'ar' => 'ربة بيت'];
        $my_parents->Nationality_Mother_id = Nationalities::all()->unique()->random()->id;
        $my_parents->Blood_Type_Mother_id =Blood::all()->unique()->random()->id;
        $my_parents->Address_Mother ='تعز';
        $my_parents->save();
    }
}
