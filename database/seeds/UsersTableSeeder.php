<?php

use App\User;
use Illuminate\Database\Seeder;
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
        $user = User::where('email', 'tchalko@gmail.com')->first(); //use first since we know email is unique
        if (!$user){
            User::create([
                'name' => 'Tricia Fish',
                'email' => 'tchalko@gmail.com',
                'role' => 'admin',
                'password' => Hash::make('password'),
            ]);
        }
    }
}
