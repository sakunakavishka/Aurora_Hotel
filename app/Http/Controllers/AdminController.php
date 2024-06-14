<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Room;
use App\Models\Booking;
use App\Models\Gallary; 
use App\Models\Contact;
use App\Notifications\SendEmailNotification;
use Illuminate\Support\Facades\Notification;

class AdminController extends Controller
{
    public function index()
    {
        if(Auth::id())
    {
        $usertype = Auth()->user()->usertype;

            if($usertype =='user')
        {
            $room = Room::all();
            $gallary = Gallary::all();
              return view ('home.index',compact('room','gallary'));
        }


        else if($usertype == 'admin')
            {
                return view('admin.index');
            }
            else
            {
            return redirect()->back();
                }
    }
    }
    public function home()
    {
        $room = Room::all();

        $gallary = Gallary::all();


        return view('home.index',compact('room','gallary'));
    }


    public function create_room()
    {
        return view('admin.create_room');
    }


    public function add_room(Request $request)
    {
        $data = new Room();
        $data->room_title = $request->title;
        $data->description = $request->description;
        $data->price = $request->price;
        $data->room_count = $request->room_count;
        $data->wifi = $request->wifi;
        $data->room_type = $request->type;

        $image=$request->image;//first declearing image variable and storinf image from create room
                                //if there is an image only come to if condition 
        if($image)              //if there is an image  then we modifi imagename using the time funtion
                                //since we are using time funtion image name will be always different
                                 //after we are moving the image to public folder ith certain name and thensorting image data base
                                //public eka room folder eka auto hadenawa
        {
            $imagename=time().'.'.$image->getClientOriginalExtension();
            $request->image->move('room',$imagename);
            $data->image=$imagename;
        }

        $data->save();

        return redirect()->back();
        
    }
    public function view_room()
    {
        $data = Room::all();
        return view('admin.view_room',compact('data'));
    }
    public function room_delete($id)
    {
        $data = Room::find($id);
        $data->delete();
        return redirect()->back();
    }

    public function room_update($id)
    {
        $data = Room::find($id);
        return view('admin.update_room',compact('data'));
    }

    public function edit_room(Request $request , $id)
    {
        $data = Room::find($id);
        
        $data->room_title = $request->title;
        $data->description = $request->description;
        $data->price = $request->price;
        $data->wifi = $request->wifi;
        $data->room_type = $request->type;
        $data->room_count = $request->room_count;
        $data->room_title = $request->title;

        $image=$request->image;
        if($image) 
        {
            $imagename=time().'.'.$image->getClientOriginalExtension();
            $request->image->move('room',$imagename);
            $data->image=$imagename;
        }

        $data->save();

        return redirect()->back();
    }
    
    public function bookings()
    {
        $data = Booking::all();
        return view ('admin.booking',compact('data'));
    }
    public function today_bookings()
    {
        $data = Booking::all();
        return view ('admin.today_bookings',compact('data'));

    }

    public function delete_booking($id)
    {
        $data = Booking::find($id);
        $data->delete();
        return redirect()->back();

    }

    public function approve_book($id)
    {
        $booking = Booking::find($id);
        $booking->status='approve';
        $booking->save();
        // Send notification
        $details = [
            'greeting' => 'Hello ' . $booking->name,
            'body' => 'Your booking has been approved.',
            'action_text' => 'View Booking',
            'action_url' => url('/booking/' . $booking->id),
            'endline' => 'Thank you for booking with us!',
        ];

        Notification::send($booking, new SendEmailNotification($details));
        return redirect()->back();
    }
    public function reject_book($id)
    {
        $booking = Booking::find($id);
        $booking->status='rejected';
        $booking->save();
         // Send notification
         $details = [
            'greeting' => 'Hello ' . $booking->name,
            'body' => 'Your booking has been rejected.',
            'action_text' => 'Contact Us',
            'action_url' => url('/contact'),
            'endline' => 'We apologize for the inconvenience.',
        ];

        Notification::send($booking, new SendEmailNotification($details));
        
        return redirect()->back();
    }

    public function view_gallary()
    {
        $gallary =Gallary::all();
        return view('admin.gallary',compact('gallary'));
    }
    public function upload_gallary(Request $request)
    {
        $data = New Gallary;
        
        $image = $request->image;
        if($image) 
        {
            $imagename=time().'.'.$image->getClientOriginalExtension();
            $request->image->move('gallary',$imagename);
            $data->image=$imagename;
            $data->save();
            return redirect()->back();
        }
        

    }
    public function delete_gallary($id)
    {
        $data = Gallary::find($id);
        $data->delete();
        return redirect()->back();
    }

    public function all_messages()
    {
        $data = Contact::all();
        return view('admin.all_messages',compact('data'));
    }

    public function message_delete($id)
    {
        $data = Contact::find($id);
        $data->delete();
        return redirect()->back();
    }

    public function send_mail ($id)
    {
        $data = Contact::find($id);
        return view('admin.send_mail',compact('data'));
    }
    public function mail(Request $request,$id)
    {
        $data = Contact::find($id);
        $details = [
            
            'greeting' => $request->greeting ,

            'body' => $request->body ,

            'action_text' => $request->action_text ,

            'action_url' => $request->action_url ,

            'endline' => $request->endline ,


        ];

        Notification::send($data,new SendEmailNotification($details));

        return redirect()->back();
    }



    public function view_users()
    {
        $data = User::all();
        return view('admin.view_users',compact('data'));
    }
    public function user_delete($id)
    {
        $data = User::find($id);
        $data->delete();
        return redirect()->back();
    }
   
   
    public function sendEmailForm($id)
{
    $booking = Booking::find($id);
    return view('admin.send_email', compact('booking'));
}

public function sendEmail(Request $request, $id)
{
    $booking = Booking::find($id);
    $details = [
        'greeting' => $request->greeting,
        'body' => $request->body,
        'action_text' => $request->action_text,
        'action_url' => $request->action_url,
        'endline' => $request->endline,
    ];

    Notification::send($booking, new SendEmailNotification($details));
    return redirect()->back()->with('message', 'Email sent successfully');
}

}


