<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Booking extends Model
{
    use HasFactory;
    use Notifiable;

    protected $fillable = [
        'room_id',
        'name',
        'email',
        'phone',
        'status',
        'room_count',
        'start_date',
        'end_date'
    ];
    public function room()
    {
        return $this->belongsTo(Room::class);
        //return $this->hasOne('App\Models\Room','id','room_id');
        // id eka room table eka and roomid eka booking table eka
    }
    public function routeNotificationForMail($notification)
    {
        // Return the email address where you want to send the notification
        return $this->email;
    }
}
