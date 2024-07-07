<?php

// namespace App\Http\Controllers;

// use Illuminate\Http\Request;
// use App\Models\Ticket;
// use Illuminate\Support\Facades\Mail;
// use App\Mail\TicketPurchased;

// class TicketController extends Controller
// {
//     public function index()
//     {
//         $tickets = Ticket::all();
//         return view('products.ticketlist', compact('tickets'));
//     }

//     public function show($id)
//     {
//         $ticket = Ticket::findOrFail($id);
//         return view('tickets.show', compact('ticket'));
//     }

//     public function store(Request $request)
//     {
//         $request->validate([
//             'title' => 'required',
//             'description' => 'required',
//             'price' => 'required|numeric',
//             'user_email' => 'required|email',
//         ]);

//         $ticket = Ticket::create($request->all());
//         $ticketCode = 'pG97tFiy'; // Generate or assign a unique code here
//         $ticket->update(['code' => $ticketCode]);

//         // Send email to user
//         Mail::to($request->user_email)->send(new TicketPurchased($ticket));

//         return redirect()->route('ticketslist');
//     }

//     public function destroy($id)
//     {
//         $ticket = Ticket::findOrFail($id);
//         $ticket->delete();
//         return redirect()->route('ticketslist');
//     }

//     public function search(Request $request)
//     {
//         $searchTerm = $request->input('search');
//         $tickets = Ticket::where('code', $searchTerm)->get();
//         return view('ticketlist', compact('tickets'));
//     }
// }

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ticket;
use Illuminate\Support\Facades\Mail;
use App\Mail\TicketPurchased;

class TicketController extends Controller
{
    public function index()
    {
        $tickets = Ticket::all();
        return response()->json(['tickets' => $tickets]);
    }

    public function show($id)
    {
        $ticket = Ticket::findOrFail($id);
        return response()->json(['ticket' => $ticket]);
    }

    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'title' => 'required',
    //         'description' => 'required',
    //         'total_price' => 'required|numeric',
    //         'user_email' => 'required|email',
    //     ]);

    //     $ticket = Ticket::create($request->all());
    //     $ticketCode = 'pG97tFiy'; // Generate or assign a unique code here
    //     $ticket->update(['code' => $ticketCode]);

    //     // Send email to user (optional)
    //     Mail::to($request->user_email)->send(new TicketPurchased($ticket));

    //     return response()->json(['ticket' => $ticket], 201); // Return created ticket with HTTP status 201
    // }

    public function destroy($id)
    {
        $ticket = Ticket::findOrFail($id);
        $ticket->delete();
        return response()->json(['message' => 'Ticket deleted successfully']);
    }

    public function search(Request $request)
    {
        $searchTerm = $request->input('search');
        $tickets = Ticket::where('code', $searchTerm)->get();
        return response()->json(['tickets' => $tickets]);
    }
}

