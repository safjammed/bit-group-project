<?php

use Illuminate\Database\Seeder;
use App\Models\Submission;

class submissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Submission::create([
            "name" => "ewsd.docx",
            "type" => "document",
            "user_id" => 4
        ]);
        Submission::create([
            "name" => "city.png",
            "type" => "picture",
            "user_id" => 4
        ]);
    }
}
