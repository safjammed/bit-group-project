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
            'two_factor' => true
        ])->assignRole('super-admin');
        User::create([
            'name' => "Super Admin",
            'email' => "super-admin@gmail.com",
            'password' => Hash::make('demo'),
        ])->assignRole('super-admin');
        User::create([
            'name' => "Administrator",
            'email' => "administrator@gmail.com",
            'password' => Hash::make('demo'),
        ])->assignRole('administrator');
        User::create([
            'name' => "student",
            'email' => "student@gmail.com",
            'password' => Hash::make('demo'),
        ])->assignRole('student');
        User::create([
            'name' => "Marketing CO",
            'email' => "marketing-co@gmail.com",
            'password' => Hash::make('demo'),
        ])->assignRole('marketing CO');
        User::create([
            'name' => "Project Manager",
            'email' => "projectmanager@gmail.com",
            'password' => Hash::make('demo'),
        ])->assignRole('project manager');

        User::create([
            'name' => "Director",
            'email' => "director@gmail.com",
            'password' => Hash::make('demo'),
        ])->assignRole('director');

        $faker = Faker::create();

        foreach (range(1,10) as $index) {
            User::create([
                'name' => $faker->name,
                'email' => $faker->email,
                'password' => Hash::make('demo'),
            ])->assignRole('student');
        }




    }
}
