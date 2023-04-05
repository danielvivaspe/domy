<?php

namespace Database\Seeders;

use App\Models\DeviceType;
use App\Models\Room;
use App\Models\Service;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Device;

class DevicesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $salon = Room::where('name', 'Salón')->first();
        $cocina = Room::where('name', 'Cocina')->first();

        $device = Device::create([
            'name' => 'Bulb white and color',
            'type_id' => DeviceType::where('type', 'Bulb')->first()->id,
            'service_id' => Service::where('name', 'Philips HUE')->first()->id,
        ]);
        $salon->devices()->attach($device);

        $device = Device::create([
            'name' => 'Smart plug',
            'type_id' => DeviceType::where('type', 'Plug')->first()->id,
            'service_id' => Service::where('name', 'Philips HUE')->first()->id,
        ]);
        $cocina->devices()->attach($device);

        $device = Device::create([
            'name' => 'Sensor',
            'type_id' => DeviceType::where('type', 'Presence and luminosity sensor')->first()->id,
            'service_id' => Service::where('name', 'Philips HUE')->first()->id,
        ]);
        $salon->devices()->attach($device);

        $device = Device::create([
            'name' => 'Beam',
            'type_id' => DeviceType::where('type', 'Soundbar')->first()->id,
            'service_id' => Service::where('name', 'Sonos')->first()->id,
        ]);
        $salon->devices()->attach($device);

        $device = Device::create([
            'name' => 'One SL',
            'type_id' => DeviceType::where('type', 'Speaker')->first()->id,
            'service_id' => Service::where('name', 'Sonos')->first()->id,
        ]);
        $salon->devices()->attach($device);
        $salon->devices()->attach($device);

        $device = Device::create([
            'name' => 'Sub Gen 3',
            'type_id' => DeviceType::where('type', 'Subwoofer')->first()->id,
            'service_id' => Service::where('name', 'Sonos')->first()->id,
        ]);
        $salon->devices()->attach($device);
    }
}
