<?php

namespace App\Http\Controllers;
use App\Models\Room;
use Carbon\CarbonInterval;

class RoomsController extends Controller
{
    public function index() {
        $rooms = Room::all();

        return view('rooms')->with([
            'rooms' => $rooms,
        ]);
    }
    public function show(Room $room)
    {
        $daysOfWeek = [];
        $intervals = CarbonInterval::days(1)
            ->toPeriod(now(), now()->addWeek());
        foreach ($intervals as $date) {
            array_push($daysOfWeek, $date);
        }

        return view('room')->with([
            'room' => $room,
            'daysOfWeek' => $daysOfWeek
        ]);
    }
}
