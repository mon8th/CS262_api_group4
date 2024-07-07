<?php

// namespace App\Http\Controllers;

// use Illuminate\Http\Request;

// class SearchController extends Controller
// {
//     public function search(Request $request)
//     {
//         $query = $request->input('query');

//         // Define your redirection logic based on the search query
//         switch (strtolower($query)) {
//             case 'contact':
//                 return redirect()->route('contact.index');
//             case 'profile':
//                 return redirect()->route('profile.edit');
//             // Add more cases as needed
//             default:
//                 return redirect()->route('dashboard')->with('error', 'No results found.');
//         }
//     }
// }
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Product;
use App\Models\Ticket;

class SearchController extends Controller
{
    public function searchUsers(Request $request)
    {
        $searchTerm = $request->input('query');

        $users = User::where(function ($query) use ($searchTerm) {
            $query->where('name', 'like', '%' . $searchTerm . '%')
                  ->orWhere('email', 'like', '%' . $searchTerm . '%')
                  ->orWhere('role', 'like', '%' . $searchTerm . '%'); // Assuming 'role' is a searchable field
        })->get();

        return response()->json(['users' => $users]);
    }

    public function searchProducts(Request $request)
    {
        $searchTerm = $request->input('query');

        $products = Product::where(function ($query) use ($searchTerm) {
            $query->where('name', 'like', '%' . $searchTerm . '%')
                  ->orWhere('category', 'like', '%' . $searchTerm . '%')
                  ->orWhere('price', 'like', '%' . $searchTerm . '%');
        })->get();

        return response()->json(['products' => $products]);
    }

    public function searchTickets(Request $request)
    {
        $searchTerm = $request->input('query');

        $tickets = Ticket::where(function ($query) use ($searchTerm) {
            $query->where('title', 'like', '%' . $searchTerm . '%')
                  ->orWhere('description', 'like', '%' . $searchTerm . '%');
            // Add more fields specific to your Ticket model as needed
        })->get();

        return response()->json(['tickets' => $tickets]);
    }
}



