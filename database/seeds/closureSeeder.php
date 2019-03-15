<?php

use Illuminate\Database\Seeder;

class closureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (range(1,4) as $faculty_id){
            \App\Models\Closure::create([
                "academic_year" => 2019,
                "closure" => "2019-03-20",
                "final_closure" => "2019-04-30",
                "faculty_id" => $faculty_id
            ]);
        }

        foreach (range(1,4) as $faculty_id){
            \App\Models\Closure::create([
                "academic_year" => 2018,
                "closure" => "2018-03-20",
                "final_closure" => "2018-04-30",
                "faculty_id" => $faculty_id
            ]);
        }

    }
}
