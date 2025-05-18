<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Car;
use App\Models\User;
use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Rental;

class PageController extends Controller
{
    public function HomePage() {
        $cars=Car::all();
        return Inertia::render("Home", ["cars"=>$cars]);
    }

    public function AdminDashBoardPage() {
        $totalcars=Car::count();
        $availablecars=Car::where('availability','1')->count();
        $rentals=Rental::count();
        $reveneu=Rental::where('status','completed')->sum('total_cost');
        return Inertia::render('Admin/AdminDashboard', ['totalcars'=>$totalcars, 'availablecars'=>$availablecars,'rentals'=>$rentals,'reveneu'=>$reveneu,]);
    }

    public function AdminCustomers() {
        $customers=User::where('role', 'customer')->paginate(5);
        return Inertia::render('Admin/AdminCustomers', ['customers'=>$customers]);
    }

    public function AddCustomerPage() {
        return Inertia::render('Admin/AdminAddCustomerPage');
    }

    public function EditCustomerPage(User $id) {
        return Inertia::render('Admin/AdminEditCustomerPage', ['customer'=>$id]);
    }

    public function ShowCustomer($id) {
        $user = User::findOrFail($id);
        $rentals=Rental::with('car')->where('user_id',$id)->latest()->get();
        return Inertia::render('Admin/AdminShowCustomerPage', ['user'=>$user, 'rentals'=>$rentals]);
    }

    public function AddCarPage() {
        return Inertia::render('Admin/AdminAddCarPage');
    }

    public function ShowCarPage(Car $id) {
        return Inertia::render("Admin/AdminShowCarPage", ['car'=>$id]);
    }

    public function EditCarPage(Car $id) {
        return Inertia::render('Admin/AdminEditCarPage', ['car'=>$id]);
    }

    public function AddRentalPage() {
        $customers=User::where('role', 'customer')->get();
        $cars=Car::where('availability', '1')->get();
        return Inertia::render('Admin/AdminAddRentalPage', ['customers'=>$customers, 'cars'=>$cars]);
    }

    public function AdminRentalPage() {
        $rentals = Rental::with('user','car')->orderBy('updated_at', 'desc')->paginate(5);
        // dd($rentals);
        return Inertia::render('Admin/AdminRentals', ['rentals'=>$rentals]);
    }

    public function EditRentalPage($id) {
        $rental=Rental::with('car', 'user')->find($id);
        $customers=User::where('role', 'customer')->get();
        $cars=Car::where('availability', '1')->get();
        // dd($rental);
        return Inertia::render('Admin/AdminEditRentalPage', ['rental'=>$rental,'customers'=>$customers, 'cars'=>$cars]);
    }

    // Customer Pages
    public function CustomerDashboardPage() {
        $user=auth()->user();
        // if (!$user) {
        //     return redirect('/login');
        // }
        $rentals=$user->rentals()->count();
        return Inertia::render('Customer/CustomerDashboard',['rentals'=>$rentals]);
    }

    public function CustomerRentalPage() {
        return Inertia::render('Customer/CustomerRentals');
    }

    public function CustomerRentalHistoryPage() {
        return Inertia::render('Customer/CustomerRentalHistory');
    }

    public function CarView(Car $id) {
        return Inertia::render('CarView', ['car'=>$id]);
    }

    public function CustomerRentals() {
            $user = auth()->user();

    $rentals = $user->rentals()
        ->with('car')
        ->whereIn('status', ['pending', 'ongoing'])
        ->latest()
        ->get();

    return Inertia::render('Customer/CustomerRentals', [
        'rentals' => $rentals,
    ]);
    }

    public function CustomerRentalsHistory() {
            $user = auth()->user();

    $rentals = $user->rentals()
        ->with('car')
        ->whereIn('status', ['completed', 'canceled'])
        ->latest()
        ->get();
        // dd($rentals);
    return Inertia::render('Customer/CustomerRentalHistory', [
        'rentals' => $rentals,
    ]);
    }
}
