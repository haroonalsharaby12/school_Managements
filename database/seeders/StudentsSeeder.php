<?php

namespace Database\Seeders;

use App\Models\Blood;
use App\Models\classroom;
use App\Models\Gender;
use App\Models\Grade;
use App\Models\Nationalities;
use App\Models\parents;
use App\Models\Section;
use App\Models\student;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class StudentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 
        
        DB::table('students')->delete();
        $students = new student();
        $students->name = ['ar' => 'احمد ابراهيم', 'en' => 'Basheer Abdu'];
        $students->email = 'basheer@yahoo.com';
        $students->password = Hash::make('12345678');
        $students->gender_id = Gender::all()->unique()->random()->id;
        $students->nationalitie_id = Nationalities::all()->unique()->random()->id;
        $students->blood_id =Blood::all()->unique()->random()->id;
        $students->Date_Birth = date('1995-01-01');
        $students->Grade_id = Grade::all()->unique()->random()->id;
        $students->Classroom_id =classroom::all()->unique()->random()->id;
        $students->section_id = Section::all()->unique()->random()->id;
        $students->parent_id = parents::all()->unique()->random()->id;
        $students->academic_year ='2021';
        $students->save();
    }
}
