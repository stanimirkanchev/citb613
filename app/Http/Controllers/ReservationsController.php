<?php

namespace App\Http\Controllers;
use App\Models\User;
use Hash;
use App\Models\Room;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ReservationsController extends Controller
{
    public function createReservation(Request $request, $id)
    {
        if (!Auth::check()) {
            $validator = Validator::make($request->all(), [
                'first_name' => 'required',
                'last_name' => 'required',
                'email' => 'required|email|unique:users',
                'phone' => 'required',
                'password' => 'required|min:6|confirmed',
            ]);
            if ($validator->fails()) {
                return response()->json(['data' => $validator->messages()], 422);
            }
        }

        $room = Room::findOrFail($id);
        if (!$room->checkAvailability($request->day, $request->time)) {
            return response()->json([
                'taken' => 'Този час вече не е наличен!',
            ], 403);
        }
        $timeArr = explode(':', $request->time);
        $currentSlot = Carbon::create($request->day)
            ->setHours($timeArr[0])
            ->setMinutes($timeArr[1])
            ->setSeconds(0);
        $user = $this->createOrUpdateUser($request);
    
        $reservation = Reservation::create([
            'room_id' => $room->id,
            'user_id' => $user->id,
            'people' => $request->people,
            'reservation_at' => $currentSlot
        ]);

        return response()->json([
            'data' => [
                'message' => 'Резервацията ви е запазена успешно!',
                'reservation_id' => $reservation->id,
            ]
        ], 200);
    }

    public function success(Request $request, $id)
    {
        $reservation = Reservation::find($id);

        return view('reservation-success')->with([
            'reservation' => $reservation,
            'user' => $reservation->user,
            'room' => $reservation->room,
        ]);
    }

    private function createOrUpdateUser($request) {
        if (Auth::user()) {
            Auth::user()->update([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'phone' => $request->phone,
            ]);
            return Auth::user();
        } else {
            $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'phone' => $request->phone,
            'email' => $request->email,
            'password' => Hash::make($request->password)
            ]);
            $user->save();
            return $user;
        }
    }
}
