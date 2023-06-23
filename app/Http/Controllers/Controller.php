<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Models\Room;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function index()
    {
        $rooms = Room::all();
        return view('home')->with('rooms', $rooms);
    }
    public function questions()
    {
        return view('questions');
    }
    public function contacts()
    {
        return view('contacts');
    }
}
