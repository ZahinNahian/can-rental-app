<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Car;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class CarController extends Controller
{
    public function AddCar(Request $request) {

        $incomingdata=$request->validate([
            'name' => 'required|string|max:255',
            'brand' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'year' => 'required|integer|digits:4|min:1900',
            'car_type' => 'required|string|max:255',
            'daily_rent_price' => 'required|numeric|min:0',
            'availability' => 'required|boolean',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $image=$request->file('image');
            $extension=$image->getClientOriginalExtension();
            $name=rand(999999,99999999999).'.'.$extension;
            $image->move(public_path("uploads"), $name);
            $incomingdata['image']="uploads/".$name;
        }

        Car::create($incomingdata);

        return redirect('/admin/cars');
    }

    public function DeleteCar(Car $id) {
        unlink(public_path($id->image));
        $id->delete();
        return redirect('/admin/cars');
    }
  
    public function EditCar(Request $request, Car $id) {
        $incomingdata=$request->validate([
            'name' => 'required|string|max:255',
            'brand' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'year' => 'required|integer|digits:4|min:1900',
            'car_type' => 'required|string|max:255',
            'daily_rent_price' => 'required|numeric|min:0',
            'availability' => 'required|boolean',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->hasFile('image')) {
            if ($id->image && file_exists(public_path($id->image))) {
                unlink(public_path($id->image));
            }
            $image=$request->file('image');
            $extension=$image->getClientOriginalExtension();
            $name=rand(999999,99999999999).'.'.$extension;
            $image->move(public_path("uploads"), $name);
            $incomingdata['image']="uploads/".$name;
        } else {
            $incomingdata['image'] = $id->image;
        }

        $id->update($incomingdata);

        return redirect('/admin/cars');
    }

    public function CarsTab() {
        $cars=Car::paginate(5);
        return Inertia::render('Admin/AdminCars', ['cars'=>$cars]);
    }

    
}
