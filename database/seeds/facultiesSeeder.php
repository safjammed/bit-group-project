<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\Faculty;
use App\User;

class facultiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $faker = Faker::create();

        //get the marketing CO
        $mcos = User::role('marketing coordinator')->get();
        $faculties = ["science","arts","history","business"];

        foreach( $mcos as $index => $mco)
        {
            Faculty::create([
                "name"=> $faculties[$index],
                "user_id" => $mco->id
            ]);
        }
    }
}
