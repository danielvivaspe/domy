<?php

namespace Database\Seeders;

use App\Models\Home;
use App\Models\User;
use Illuminate\Database\Seeder;

class HomeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $home = Home::create([
            'name' => 'Almaden'
        ]);

        $user = User::where('email', 'domy@domy.com')->first()->id;

        $home->users()->attach($user, ['owner' => true]);
    }
}
