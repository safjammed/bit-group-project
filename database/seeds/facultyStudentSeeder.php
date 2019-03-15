<?php

use Illuminate\Database\Seeder;

class facultyStudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $students = \App\User::role('student')->get();

        foreach ($students as $index => $student){
            \App\Models\Faculty::find(rand(1,4))
                ->students()->attach($student->id);
        }
    }
}
