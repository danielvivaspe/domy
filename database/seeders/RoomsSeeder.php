<?php

namespace Database\Seeders;

use App\Models\Room;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoomsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $home = User::where('email', 'domy@domy.com')->first()->homes[0];

        Room::create([
            'name' => 'Salón',
            'home_id' => $home->id,
        ]);

        Room::create([
            'name' => 'Cocina',
            'home_id' => $home->id,
        ]);
    }
}
