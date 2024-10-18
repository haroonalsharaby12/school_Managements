<?php

namespace Database\Seeders;

use App\Models\subjects;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class SubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        //
        DB::table('subjects')->delete();
        $subjects=[
            ['er'=>'قران' ,'en'=>'Quran'],
            ['er'=>'اسلامية' ,'en'=>'Islam'],
            ['er'=>'رياضيات' ,'en'=>'math'],
            ['er'=>'فيزياء' ,'en'=>'physical'],
            ['er'=>'كيمياء' ,'en'=>'chemistic'],
            ['er'=>'مجتمع' ,'en'=>'cutrual'],
            ['er'=>'تاريخ' ,'en'=>'date'],
            ['er'=>'احياء' ,'en'=>'biology'],
            ['er'=>'انجليزي' ,'en'=>'english'],
            ['er'=>'علوم' ,'en'=>'sciesitic'],
        ];
        foreach ($subjects as $subject) {
            subjects::create(
                ['Name'=>$subject]
            );
            # code...
        }
    }
}
