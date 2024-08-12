<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Jihad Hamdan',
            'email' => 'jhamdan2021@gmail.com',
            'password' => Hash::make('jhamdan2021'),
            'phone_number' => '0598077787',
        ]);
    }
}
