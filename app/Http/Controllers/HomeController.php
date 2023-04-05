<?php

namespace App\Http\Controllers;

use App\Models\Home;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class HomeController extends Controller
{
    /**
     * Retrieves all details for user home.
     *
     * @param  \App\Http\Requests\Auth\LoginRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function details(Request $request) {
        $home = Auth::user()->homes;
        $services = [];
        $rooms = [];

        foreach($home[0]->services as $service) {
            array_push($services, [
                'id' => $service->id,
                'name' => $service->name,
                'description' => $service->description,
                'field' => $service->field,
                'created' => $service->created,
            ]);
        }

        foreach($home[0]->rooms as $room) {
            # TODO: Create devices inside
            array_push($rooms, [
                'id' => $room->id,
                'name' => $room->name,
            ]);
        }

        return response()->json([
            "name" => $home[0]->name,
            "created" => $home[0]->created,
            "services" => $services,
            "rooms" => $rooms
        ]);
    }

}
