<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Room;
use App\Models\Booking;
use App\Models\Contact;
use App\Models\Gallary;

class HomeController extends Controller
{
    public function room_details($id)
    {
       
        $room = Room::find($id);
        return view('home.room_details',compact('room'));
    }


    public function add_booking(Request $request, $id)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'phone' => 'required|numeric',
        'room_count' => 'required|integer|min:1',
        'startDate' => 'required|date',
        'endDate' => 'required|date|after:startDate',
    ]);

    $requestedRoomCount = $request->room_count;

    // Fetch the room details
    $room = Room::find($id);

    if (!$room) {
        return redirect()->back()->with('message', 'Room not found');
    }

    if ($requestedRoomCount > $room->room_count) {
        return redirect()->back()->with('message', 'Requested room count exceeds available rooms');
    }

    // Check room availability
    $startDate = $request->startDate;
    $endDate = $request->endDate;

    // Calculate already booked rooms for the given date range
    $bookedRoomsCount = Booking::where('room_id', $id)
        ->where(function ($query) use ($startDate, $endDate) {
            $query->whereBetween('start_date', [$startDate, $endDate])
                  ->orWhereBetween('end_date', [$startDate, $endDate])
                  ->orWhere(function ($query) use ($startDate, $endDate) {
                      $query->where('start_date', '<=', $startDate)
                            ->where('end_date', '>=', $endDate);
                  });
        })
        ->sum('room_count');

    $availableRooms = $room->room_count - $bookedRoomsCount;

    if ($requestedRoomCount > $availableRooms) {
        return redirect()->back()->with('message', 'Not enough rooms available for the selected dates');
    }

    // Save the booking
    $data = new Booking();
    $data->room_id = $id;
    $data->name = $request->name;
    $data->email = $request->email;
    $data->phone = $request->phone;
    $data->room_count = $requestedRoomCount;
    $data->start_date = $startDate;
    $data->end_date = $endDate;
    $data->save();

    return redirect()->back()->with('message', 'Room booked successfully');
}


    public function contact(Request $request)
    {
        $contact = new Contact;
        $contact->name = $request->name;
        $contact->email = $request->email;
        $contact->phone = $request->phone;
        $contact->message = $request->message;

        $contact->save();

        return redirect()->back()->with('message','message send successfully');
    }
    public function our_rooms()
    {
        $room =Room::all();
        return view('home.our_rooms',compact('room'));
    }
    public function hotel_gallary()
    {
        $gallary =Gallary::all();
        return view('home.hotel_gallary',compact('gallary'));
    }
    public function contact_us()
    {
        
        return view('home.contact_us');
    }
    public function aboutus()
    {
        
        return view('home.aboutus');
    }
    
}
