<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Service;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ServicesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::where('email', 'domy@domy.com')->first();
        $home = $user->homes[0];

        $service = Service::create([
            'name' => 'Philips HUE',
            'description' => 'Philips Hue is a line of color-changing LED lamps and white bulbs which can be controlled wirelessly',
            'field' => 'Lighting',
        ]);
        $home->services()->attach($service);

        $service = Service::create([
            'name' => 'Sonos',
            'description' => 'Sonos is an American developer and manufacturer of audio products best known for its multi-room audio products',
            'field' => 'Sound systems',
        ]);
        $home->services()->attach($service);
    }
}
