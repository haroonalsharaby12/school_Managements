<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::where('name','harron')->delete();
        
        User::factory()->create([
            'name' => 'harron',
            'email' => 'haroon@gmail.com',
            'password'=>Hash::make('haroon')
        ]);
        $this->call(GradeSeeder::class);
        $this->call(ClassroomTableSeeder::class);
        $this->call(SectionsSeeder::class);
        $this->call(bloodSeeder::class);
        $this->call(nationalitiesSeeder::class);
        // $this->call(SubjectSeeder::class);
        $this->call(GenderSeeder::class);
        $this->call(ParentsSeeder::class);
        $this->call(StudentsSeeder::class);
        // User::factory(10)->create();


       
    }
}
