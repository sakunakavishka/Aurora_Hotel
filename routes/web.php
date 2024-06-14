<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

route::get('/',[AdminController::class,'home']);//user home 

route::get('/home',[AdminController::class,'index'])->name('home'); //admin page

route::get('/create_room',[AdminController::class,'create_room'])->middleware(['auth','admin']);

route::post('/add_room',[AdminController::class,'add_room'])->middleware(['auth','admin']);

route::get('/view_room',[AdminController::class,'view_room'])->middleware(['auth','admin']);

route::get('/room_delete/{id}',[AdminController::class,'room_delete']);

route::get('/room_update/{id}',[AdminController::class,'room_update']);

route::post('/edit_room/{id}',[AdminController::class,'edit_room']);

route::get('/room_details/{id}',[HomeController::class,'room_details']);

route::post('/add_booking/{id}',[HomeController::class,'add_booking']);

route::get('/bookings',[AdminController::class,'bookings'])->middleware(['auth','admin']);

route::get('/today_bookings',[AdminController::class,'today_bookings']);//today booking

route::get('/delete_booking/{id}',[AdminController::class,'delete_booking']);

route::get('/approve_book/{id}',[AdminController::class,'approve_book']);

route::get('/reject_book/{id}',[AdminController::class,'reject_book']);

route::get('/view_gallary',[AdminController::class,'view_gallary'])->middleware(['auth','admin']);

route::Post('/upload_gallary',[AdminController::class,'upload_gallary']);

route::get('/delete_gallary/{id}',[AdminController::class,'delete_gallary']);

route::Post('/contact',[HomeController::class,'contact']);  	

route::get('/all_messages',[AdminController::class,'all_messages'])->middleware(['auth','admin']);

route::get('/message_delete/{id}',[AdminController::class,'message_delete']);

route::get('/send_mail/{id}',[AdminController::class,'send_mail']);

route::Post('/mail/{id}',[AdminController::class,'mail']); 



route::get('/view_users',[AdminController::class,'view_users'])->middleware(['auth','admin']);

route::get('/user_delete/{id}',[AdminController::class,'user_delete']);

Route::get('send_email_form/{id}', [AdminController::class, 'sendEmailForm'])->name('send_email_form');

Route::post('send_email/{id}', [AdminController::class, 'sendEmail'])->name('send_email');

route::get('/our_rooms',[homeController::class,'our_rooms']);

route::get('/hotel_gallary',[homeController::class,'hotel_gallary']);

route::get('/contact_us',[homeController::class,'contact_us']);

route::get('/aboutus',[homeController::class,'aboutus']);