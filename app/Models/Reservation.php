<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Room;
use App\Models\User;

class Reservation extends Model
{
    use HasFactory;
    
     /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'room_id',
        'people',
        'reservation_at'
    ];

    protected $casts = [
        'reservation_at' => 'datetime',
    ];

    public function room()
    {
        return $this->belongsTo(Room::class, 'room_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function getTotalPrice()
    {
        $price = $this->room->price;
        $calculatedPrice = $price * $this->people;

        return number_format($calculatedPrice / 100, 2);

    }
}
