<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
//         $this->call(UsersTableSeeder::class);
         $this->call(RolesAndPermissionsSeeder::class);
         $this->call(UsersTableSeeder::class);
         $this->call(facultiesSeeder::class);
         $this->call(closureSeeder::class);

         $this->call(submissionSeeder::class);

         $this->call(facultyStudentSeeder::class);
    }
}
