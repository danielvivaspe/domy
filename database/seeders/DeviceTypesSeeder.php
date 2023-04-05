<?php

namespace Database\Seeders;

use App\Models\DeviceType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DeviceTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DeviceType::create([
            'type' => 'Plug',
        ]);

        DeviceType::create([
            'type' => 'Bulb',
        ]);

        DeviceType::create([
            'type' => 'Speaker',
        ]);

        DeviceType::create([
            'type' => 'Subwoofer',
        ]);

        DeviceType::create([
            'type' => 'Soundbar',
        ]);

        DeviceType::create([
            'type' => 'Presence and luminosity sensor',
        ]);
    }
}
