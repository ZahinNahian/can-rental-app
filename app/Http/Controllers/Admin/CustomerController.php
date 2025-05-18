<?php

namespace App\Http\Controllers\Admin;

use App\Models\Car;
use App\Models\User;
use App\Models\Rental;
use Illuminate\Http\Request;
use App\Mail\RentalCreatedMail;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class CustomerController extends Controller
{
    public function AddCustomer(Request $request) {
        $incomingdata=$request->validate([
            'name'=>'required|string|max:255',
            'email'=>'required|email|unique:users,email',
            'password'=>'required|string|confirmed',
            'role'=>'required|in:admin,customer'
        ]);
        $incomingdata['password']=Hash::make($incomingdata['password']);
        User::create($incomingdata);
        return redirect('admin/customers');
    }

    public function DeleteCustomer(User $id) {
        if ($id->role==="admin") {
            return response()->json([
                "statue"=>"failed",
                "message"=>"You can not delete admins",
            ]);
        }
        $id->delete();
        return redirect('admin/customers');
    }    
    
    public function EditCustomer(Request $request, User $id) {
        $incomingdata=$request->validate([
            'name'=>'required|string|max:255',
            'email'=>'required|email|unique:users,email,'.$id->id,
            'password'=>'nullable|string|confirmed',
            'role'=>'required|in:admin,customer'
        ]);
        if (!$request->filled('password')) {
            unset($incomingdata['password']);
        }

        $id->update($incomingdata);
        return redirect('admin/customers');
    } // End Method

    public function CustomerCarRent(Request $request) {
    $validated = $request->validate([
        'car_id'     => 'required|exists:cars,id',
        'start_date' => 'required|date|after_or_equal:today',
        'end_date'   => 'required|date|after_or_equal:start_date',
    ]);

    $user = auth()->user();

    $overlap = Rental::where('car_id', $validated['car_id'])
        ->where('status', '!=', 'canceled')
        ->where(function ($query) use ($validated) {
            $query->where('start_date', '<=', $validated['end_date'])
                  ->where('end_date', '>=', $validated['start_date']);
        })
        ->exists();

    if ($overlap) {
        return back()->with([
            'status' => false,
            'message' => 'This car is already booked during the selected period.'
        ]);
    }

    $start = \Carbon\Carbon::parse($validated['start_date']);
    $end = \Carbon\Carbon::parse($validated['end_date']);
    $days = $start->diffInDays($end) + 1;

    $car = Car::findOrFail($validated['car_id']);

    $rental = Rental::create([
        'user_id'    => $user->id,
        'car_id'     => $validated['car_id'],
        'start_date' => $validated['start_date'],
        'end_date'   => $validated['end_date'],
        'total_cost' => $car->daily_rent_price * $days,
        'status'     => 'pending',
    ]);

    // Send mail
    $mailsubject = "Car Rental Booking Request";
    $heading = "Rental Booking Notification";

    Mail::to($user->email)->send(new RentalCreatedMail($rental, $car, $user, $days, $mailsubject, $heading));
    Mail::to('admin@gmail.com')->send(new RentalCreatedMail($rental, $car, $user, $days, $mailsubject, $heading));

    return redirect('customer/rentals')->with(['status' => true, 'message' => 'Rental booked successfully!']);
}

public function CustomerCancelRent($id) {
        $rental = Rental::where('id', $id)
        ->where('user_id', auth()->id())
        ->where('status', 'pending')
        ->firstOrFail();

    $rental->status = 'canceled';
    $rental->save();

    return redirect('customer/rentals')->with('message', 'Rental canceled successfully!');
}
}
