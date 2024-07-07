<?php

// namespace App\Http\Controllers;

// use Illuminate\Http\Request;
// use App\Models\User;
// use App\Models\Product;
// use App\Models\Ticket;

// class DashboardController extends Controller
// {
//     public function index()
//     {
//         $totalUsers = User::count();
//         $totalOrders = Ticket::count();
//         $totalSales = Ticket::sum('price');

//         $salesData = Ticket::selectRaw('DATE(created_at) as date, SUM(price) as total')
//             ->groupBy('date')
//             ->orderBy('date', 'asc')
//             ->get();

//         $deals = Product::all();

//         return view('index', compact('totalUsers', 'totalOrders', 'totalSales', 'salesData', 'deals'));
//     }
// }


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Product;
use App\Models\Ticket;

class DashboardController extends Controller

{

    public function dashboard()
    {
        $totalUsers = User::count();
        $totalOrders = Ticket::count();
        $totalSales = Ticket::sum('total_price');

        $salesData = Ticket::selectRaw('DATE(created_at) as date, SUM(total_price) as total')
            ->groupBy('date')
            ->orderBy('date', 'asc')
            ->get();

        $deals = Product::all();

        // Prepare the data as an array
        $data = [
            'totalUsers' => $totalUsers,
            'totalOrders' => $totalOrders,
            'totalSales' => $totalSales,
            'salesData' => $salesData,
            'deals' => $deals,
        ];

        // Return the data as JSON response
        return response()->json($data);
    }
}
