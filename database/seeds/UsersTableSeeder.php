<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\User;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => "Safayat Jamil",
            'email' => "safayatjamil27@gmail.com",
            'password' => Hash::make('demo'),
            'country_code' => '+880',
            'phone' => '1718780072',
            'two_factor' => false
        ])->assignRole('super-admin');
        User::create([
            'name' => "Super Admin",
            'email' => "super-admin@gmail.com",
            'password' => Hash::make('demo'),
        ])->assignRole('super-admin');
        User::create([
            'name' => "Administrator name",
            'email' => "administrator@gmail.com",
            'password' => Hash::make('demo'),
        ])->assignRole('administrator');


        User::create([
            'name' => "student name",
            'email' => "student@gmail.com",
            'password' => Hash::make('demo'),
        ])->assignRole('student');





        User::create([
            'name' => "Marketing CO name",
            'email' => "marketing-co@gmail.com",
            'password' => Hash::make('demo'),
        ])->assignRole('marketing coordinator');







        User::create([
            'name' => "marketing manager",
            'email' => "marketingmanager@gmail.com",
            'password' => Hash::make('demo'),
        ])->assignRole('marketing manager');




        $faker = Faker::create();

        foreach (range(1,10) as $index) {
            User::create([
                'name' => $faker->name,
                'email' => $faker->email,
                'password' => Hash::make('demo'),
            ])->assignRole('student');
        }

        User::create([
            'name' => "Nazrana Haque",
            'email' => "staff2@staff.com",
            'password' => Hash::make('staff'),
        ])->assignRole('marketing manager');
        User::create([
            'name' => "Siplu Sinha",
            'email' => "1000418@daffodil.ac",
            'password' => Hash::make('staff'),
        ])->assignRole('marketing coordinator');
        User::create([
            'name' => "Md. Shahinur Alam",
            'email' => "naumulshadhin@gmail.com",
            'password' => Hash::make('student'),
        ])->assignRole('student');
        User::create([
            'name' => "Minhaz Abedin",
            'email' => "nadimminhaz@gmail.com",
            'password' => Hash::make('student'),
        ])->assignRole('student');
        User::create([
            'name' => "Afroza Akter Sonia",
            'email' => "afrojaaktersonia@gmail.com",
            'password' => Hash::make('student'),
        ])->assignRole('student');
        User::create([
            'name' => "Rafiqul Islam",
            'email' => "rafiqdiit@gmail.com",
            'password' => Hash::make('student'),
        ])->assignRole('student');
        User::create([
            'name' => "Fourth Staff",
            'email' => "staff4@staff.com",
            'password' => Hash::make('staff'),
        ])->assignRole('marketing coordinator');
        User::create([
            'name' => "Fifth Staff",
            'email' => "staff5@staff.com",
            'password' => Hash::make('staff'),
        ])->assignRole('marketing coordinator');
        User::create([
            'name' => "Romyee",
            'email' => "staff1@staff.com",
            'password' => Hash::make('staff'),
        ])->assignRole('administrator');

        \Illuminate\Support\Facades\DB::table("users")->update(["email_verified_at" => "2019-04-28 17:54:08"]);



    }
}
