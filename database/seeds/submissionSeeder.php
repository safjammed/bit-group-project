<?php

use Illuminate\Database\Seeder;
use App\Models\Submission;
use App\Models\Comment;

class submissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //waiting
        Submission::create([
            "name" => "waiting.docx",
            "type" => "document",
            "user_id" => 4,
            'closure_id' => 1,
            'faculty_id' => 1
        ]);
        Submission::create([
            "name" => "waiting.png",
            "type" => "picture",
            "user_id" => 4,
            'closure_id' => 1,
            'faculty_id' => 1
        ]);
        //commented
        Submission::create([
            "name" => "commented.docx",
            "type" => "document",
            "user_id" => 7,
            'closure_id' => 2,
            'faculty_id' => 2,
            'commented_at' => '2019-04-28 15:29:38'
        ]);
        Comment::create([
           'content' => "commented",
            "user_id" => 18,
            "submission_id" => 3
        ]);
        Submission::create([
            "name" => "commented.jpg",
            "type" => "document",
            "user_id" => 8,
            'closure_id' => 3,
            'faculty_id' => 3,
            'commented_at' => '2019-04-28 15:30:38'
        ]);
        Comment::create([
            'content' => "commented",
            "user_id" => 23,
            "submission_id" => 4
        ]);
        //expired
        Submission::create([
            "name" => "expired.docx",
            "type" => "document",
            "user_id" => 7,
            'closure_id' => 2,
            'faculty_id' => 2,
            'created_at' => '2019-01-28 15:29:38'
        ]);
        Submission::create([
            "name" => "expired.jpg",
            "type" => "document",
            "user_id" => 8,
            'closure_id' => 3,
            'faculty_id' => 3,
            'created_at' => '2019-01-28 15:29:38'
        ]);

        //selected
        //commented
        Submission::create([
            "name" => "selected.docx",
            "type" => "document",
            "user_id" => 7,
            'closure_id' => 2,
            'faculty_id' => 2,
            'commented_at' => '2019-04-28 15:29:38',
            "selected" => 1
        ]);
        Comment::create([
            'content' => "commented and selected",
            "user_id" => 18,
            "submission_id" => 7
        ]);
        Submission::create([
            "name" => "selected.jpg",
            "type" => "document",
            "user_id" => 8,
            'closure_id' => 3,
            'faculty_id' => 3,
            'commented_at' => '2019-04-28 15:30:38',
            "selected" => 1
        ]);
        Comment::create([
            'content' => "commented and selected",
            "user_id" => 23,
            "submission_id" => 8
        ]);


    }
}
