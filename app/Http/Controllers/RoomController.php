<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoomController extends Controller
{
    public function list(Request $request) {
        $home = Auth::user()->homes[0];
        $rooms = [];

        foreach ($home->rooms as $room) {
            array_push($rooms, [
                "id" => $room->id,
                "name" => $room->name
            ]);
        }

        return response()->json($rooms);

    }
}
