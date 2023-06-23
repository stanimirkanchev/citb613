<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Image;
use App\Models\Reservation;
use Carbon\CarbonInterval;
use Carbon\Carbon;

class Room extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'description',
        'price',
        'level',
        'city',
        'address',
        'capacity_min',
        'capacity_max',
        'time_slot_min',
        'time_slot_max',
        'duration',
    ];

    public function images()
    {
        return $this->hasMany(Image::class, 'room_id');
    }

    public function reservations()
    {
        return $this->hasMany(Resrvation::class, 'room_id');
    }

    public function getMainImage($id)
    {
        $image = Image::where('room_id', $id)->where('main_image', true)->first();
        if (!$image) {
            $storage = '/images/rooms/default.jpg';
        } else {
            $storage = '/images/rooms/' . $image->image_path;
        }

        return $storage;
    }

    public function getGalleryItems()
    {
        return $this->images->where("main_image", false)->all();
    }

    public function setPrice($price)
    {
        return $price * 100;
    }

    public function getPrice()
    {
        return number_format($this->price / 100, 2);
    }

    public function getIntervals()
    {
        $intervals = CarbonInterval::minutes($this->duration)
            ->toPeriod($this->time_slot_min, $this->time_slot_max);
        $arr = [];
        
        foreach ($intervals as $date) {
            array_push($arr, $date->format('H:i'));
        }
        
        return $arr;
    }

    public function checkAvailability($day, $time)
    {
        $timeArr = explode(':', $time);
        $currentSlot = Carbon::create($day)
            ->setHours($timeArr[0])
            ->setMinutes($timeArr[1])
            ->setSeconds(0);

        $reservations = Reservation::where('reservation_at', '=', $currentSlot)->get();
        return boolval(!count($reservations));
    }
}
