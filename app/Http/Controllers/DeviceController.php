<?php

namespace App\Http\Controllers;

use App\Http\Connections\PhilipsHue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DeviceController extends Controller
{
    public function get_by_room($room) {
        $home = Auth::user()->homes[0];
        $room = $home->rooms()->where('name', $room)->first();
        //$response = [];

        $connector = new PhilipsHue($home);

        foreach ($room->devices as $device) {
            $deviceInfo['id'] = $device->pivot->id;
            $deviceInfo['service_name'] = PhilipsHue::SERVICE_NAME;
            $deviceInfo['type'] = $device->type->type;
            $deviceInfo['name'] = $device->pivot->name;
            $deviceInfo['services'] = $connector->get_device_info($device->pivot->cust_id);
            $response[] = $deviceInfo;

        }
        //dd($room->devices[0]);
        return response()->json($response);

    }
}
