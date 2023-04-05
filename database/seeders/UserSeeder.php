<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
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
        $user = DB::table('users')->insert([
            'name' => 'Daniel',
            'surname' => 'Vivas',
            'email' => 'domy@domy.com',
            'password' => Hash::make('domydomy'),
            'phone' => '123456789',
            'active' => 0
        ]);
    }
}
