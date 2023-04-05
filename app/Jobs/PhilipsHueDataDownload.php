<?php

namespace App\Jobs;

use App\Http\Connections\PhilipsHue;
use App\Models\Device;
use App\Models\DeviceType;
use App\Models\Home;
use App\Models\Room;
use App\Models\Service;
use ErrorException;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class PhilipsHueDataDownload implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    var Home $home;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Home $home)
    {
        $this->home = $home;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $connection = new PhilipsHue($this->home);

        $roomsData = $connection->get_all_rooms();
        $rooms = [];
        $devicesData = $connection->get_all_devices();

        foreach ($roomsData as $roomData) {
            Room::firstOrCreate([
                'name' => $roomData['metadata']['name'],
                'home_id' => $this->home->id
            ]);
            foreach ($roomData['children'] as $device) {
                $rooms[$device['rid']] = $roomData['metadata']['name'];
            }
        }

        foreach ($devicesData as $deviceData) {
            $type = DeviceType::firstOrCreate([
                'type' => $deviceData['product_data']['product_archetype'],
            ]);
            $serviceId = Service::where('name', 'Philips HUE')->first()->id;
            $device = Device::firstOrCreate([
                'name' => $deviceData['product_data']['product_name'],
                'type_id' => $type->id,
                'service_id' => $serviceId
            ]);

            try {
                $room = $this->home->rooms()->where('name', $rooms[$deviceData['id']])->first();
            }
            catch (ErrorException) {
                $room = Room::firstOrCreate([
                    'name' => 'Unknown room',
                    'home_id' => $this->home->id
                ]);
            }

            $deviceLink = $room->devices()->where('cust_id', $deviceData['id'])->first();
            if(is_null($deviceLink)) {
                $room->devices()->attach($device->id, [
                    "cust_id" => $deviceData['id'],
                    "name" => $deviceData['metadata']['name']
                ]);
            }
        }
    }
}
