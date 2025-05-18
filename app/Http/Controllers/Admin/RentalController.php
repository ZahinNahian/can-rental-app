<?php

namespace App\Http\Controllers\Admin;

use App\Models\Car;
use App\Models\User;
use App\Models\Rental;
use Illuminate\Http\Request;
use App\Mail\RentalCreatedMail;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

class RentalController extends Controller
{
public function AddRental(Request $request)
{
    $validated = $request->validate([
        'user_id'     => 'required|exists:users,id',
        'car_id'      => 'required|exists:cars,id',
        'start_date'  => 'required|date|after_or_equal:start_date',
        'end_date'    => 'required|date|after_or_equal:start_date',
        'total_cost'  => 'required|numeric|min:0',
        'status'      => 'required|in:pending,ongoing,completed,canceled',
    ]);

    $overlap = Rental::where('car_id', $validated['car_id'])
        ->where('status', '!=', 'canceled')
        ->where(function ($query) use ($validated) {
            $query->where('start_date', '<=', $validated['end_date'])
                ->where('end_date', '>=', $validated['start_date']);
    })
    ->exists();


    if ($overlap) {
        // dd($overlap);
        $data = ['message'=>'This car is already booked during the selected period.','status'=>false,'error'=>''];
        return back()->with($data);
    }

        $rental = Rental::create($validated);
    $mailsubject="New Car Rental Confirmation";
    $heading="Rental Confirmation";
    $car = Car::find($validated['car_id']);
    $user = User::find($validated['user_id']);

    $start = new \Carbon\Carbon($validated['start_date']);
    $end = new \Carbon\Carbon($validated['end_date']);
    $days = $start->diffInDays($end) + 1;

    Mail::to($user->email)->send(new RentalCreatedMail( $rental, $car, $user, $days,$mailsubject, $heading ));

    Mail::to("admin@gmail.com")->send(new RentalCreatedMail( $rental, $car, $user, $days, $mailsubject, $heading ));

    // Rental::create($validated);
    $data = ['message'=>'Rental Added Successfully!.','status'=>true,'error'=>''];    
    return redirect('admin/rentals')->with($data);
}

public function EditRental(Request $request, $id)
{
    $validated = $request->validate([
        'user_id'     => 'required|exists:users,id',
        'car_id'      => 'required|exists:cars,id',
        'start_date'  => 'required|date|after_or_equal:start_date',
        'end_date'    => 'required|date|after_or_equal:start_date',
        'total_cost'  => 'required|numeric|min:0',
        'status'      => 'required|in:pending,ongoing,completed,canceled',
    ]);

    $rental = Rental::findOrFail($id);

    // Check overlapping rentals except the current one
    $overlap = Rental::where('car_id', $validated['car_id'])
        ->where('id', '!=', $rental->id)
        ->where('status', '!=', 'canceled')
        ->where(function ($query) use ($validated) {
            $query->where('start_date', '<=', $validated['end_date'])
                ->where('end_date', '>=', $validated['start_date']);
        })
        ->exists();

    if ($overlap) {
        return back()->with([
            'message' => 'This car is already booked during the selected period.',
            'status' => false,
            'error' => '',
        ]);
    }

    $rental->update($validated);

    $car = Car::find($validated['car_id']);
    $user = User::find($validated['user_id']);
    $mailsubject = "Rental Edit Confirmation";
    $heading = "Rental Details Updated";
    $start = new \Carbon\Carbon($validated['start_date']);
    $end = new \Carbon\Carbon($validated['end_date']);
    $days = $start->diffInDays($end) + 1;

    Mail::to($user->email)->send(new RentalCreatedMail($rental, $car, $user, $days, $mailsubject, $heading));
    Mail::to("admin@gmail.com")->send(new RentalCreatedMail($rental, $car, $user, $days, $mailsubject, $heading));

    return redirect('/admin/rentals')->with([
        'message' => 'Rental Updated Successfully!',
        'status' => true,
        'error' => '',
    ]);
}

public function DeleteRental(Rental $id) {
    $id->delete();
    $data = ['message'=>'Rental Deleted Successfully!.','status'=>true,'error'=>''];
    return redirect('admin/rentals')->with($data);
}

}
