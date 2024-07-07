<?php

// namespace App\Http\Controllers;

// use Illuminate\Http\Request;
// use Illuminate\Support\Facades\DB;
// use Illuminate\Support\Facades\Mail;
// use Illuminate\Support\Facades\Log;

// class ContactController extends Controller
// {
//     public function index()
//     {
//         Log::info('Contact form accessed.');
//         // Assuming this method is used for rendering a form in a web application
//         return view('contact');
//     }

//     public function send(Request $request)
//     {
//         Log::info('Contact form submission received.', $request->all());

//         $request->validate([
//             'name' => 'required|string|max:255',
//             'email' => 'required|email|max:255',
//             'message' => 'required|string|max:255',
//         ]);

//         try {
//             // Insert the message into the database
//             DB::table('message')->insert([
//                 'name' => $request->name,
//                 'email' => $request->email,
//                 'message' => $request->message,
//                 'created_at' => now(),
//                 'updated_at' => now(),
//             ]);

//             Log::info('Message saved to database.', [
//                 'name' => $request->name,
//                 'email' => $request->email,
//                 'message' => $request->message,
//             ]);
//         } catch (\Exception $e) {
//             Log::error('Failed to save message to database: ' . $e->getMessage());
//             return redirect()->route('contact.index')->with('error', 'Failed to send your message. Please try again later.');
//         }

//         // Send the email
//         try {
//             Mail::send('emails.mail', [
//                 'name' => $request->name,
//                 'email' => $request->email,
//                 'message' => $request->message,
//             ], function ($mail) use ($request) {
//                 $mail->from($request->email, $request->name);
//                 $mail->to('support@example.com')->subject('Contact Form Submission');
//             });

//             Log::info('Email sent to support@example.com.');
//         } catch (\Exception $e) {
//             Log::error('Failed to send email: ' . $e->getMessage());
//             return redirect()->route('contact.index')->with('error', 'Failed to send your message. Please try again later.');
//         }

//         // Return a JSON response indicating success
//         return response()->json(['message' => 'Your message has been sent successfully!']);
//     }

//     public function getMail()
//     {
//         Log::info('Retrieving messages from database.');
//         $messages = DB::table('message')->get();
//         return view('emails.mail', compact('messages'));
//     }
// }


// namespace App\Http\Controllers;

// use Illuminate\Http\Request;
// use Illuminate\Support\Facades\DB;
// use Illuminate\Support\Facades\Mail;
// use Illuminate\Support\Facades\Log;

// class ContactController extends Controller
// {
//     public function index()
//     {
//         return view('contact'); // Adjust this based on your actual view name
//     }
//     public function send(Request $request)
//     {
//         Log::info('Contact form submission received.', $request->all());

//         $request->validate([
//             'name' => 'required|string|max:255',
//             'email' => 'required|email|max:255',
//             'message' => 'required|string|max:255',
//         ]);

//         try {
//             // Insert the message into the database
//             DB::table('message')->insert([
//                 'name' => $request->name,
//                 'email' => $request->email,
//                 'message' => $request->message,
//                 'created_at' => now(),
//                 'updated_at' => now(),
//             ]);

//             Log::info('Message saved to database.', [
//                 'name' => $request->name,
//                 'email' => $request->email,
//                 'message' => $request->message,
//             ]);
//          }
//         catch (\Exception $e) {
//             Log::error('Failed to save message to database: ' . $e->getMessage());
//             return response()->json(['error' => 'Failed to save your message. Please try again later.'], 500);
//         }

//         // Send the email
//         // try {
//         //     Mail::send('emails.mail', [
//         //         'name' => $request->name,
//         //         'email' => $request->email,
//         //         'message' => $request->message,
//         //     ], function ($mail) use ($request) {
//         //         $mail->from($request->email, $request->name);
//         //         $mail->to('support@example.com')->subject('Contact Form Submission');
//         //     });
        
//         //     Log::info('Email sent to support@example.com.');
//         // } catch (\Exception $e) {
//         //     Log::error('Failed to send email: ' . $e->getMessage());
//         //     // Return a response indicating failure
//         //     return response()->json(['error' => 'Failed to send your message. Please try again later.'], 500);
//         // }
        

//         // Return success message
//         return response()->json(['message' => 'Your message has been sent successfully!']);
//     }

//     public function getMail()
//     {
//         Log::info('Retrieving messages from database.');
//         $messages = DB::table('message')->get();
//         return response()->json($messages);
//     }
// }

// namespace App\Http\Controllers;

// use App\Models\Contact;
// use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Log;
// use Illuminate\Support\Facades\DB;
// use Illuminate\Support\Facades\Mail;


// class ContactController extends Controller
// {
//     public function index()
//     {
//         return view('contact'); // Adjust this based on your actual view name
//     }

//     public function send(Request $request)
//     {
//         Log::info('Contact form submission received.', $request->all());

//         $request->validate([
//             'name' => 'required|string|max:255',
//             'email' => 'required|email|max:255',
//             'subject' => 'required|string|max:255',
//             'role' => 'required|string|max:255',
//             'message' => 'required|string|max:255',
//         ]);

//         try {
//             // Insert the message into the database using the Contact model
//             Contact::create([
//                 'name' => $request->name,
//                 'email' => $request->email,
//                 'subject' => $request->subject,
//                 'role' => $request->role,
//                 'message' => $request->message,
//             ]);

//             Log::info('Message saved to database.', [
//                 'name' => $request->name,
//                 'email' => $request->email,
//                 'subject' => $request->subject,
//                 'role' => $request->role,
//                 'message' => $request->message,
//             ]);
//         } catch (\Exception $e) {
//             Log::error('Failed to save message to database: ' . $e->getMessage());
//             return response()->json(['error' => 'Failed to save your message. Please try again later.'], 500);
//         }

//         // Uncomment and adjust the following lines if email sending is needed
//         // try {
//         //     Mail::send('emails.mail', [
//         //         'name' => $request->name,
//         //         'email' => $request->email,
//         //         'message' => $request->message,
//         //     ], function ($mail) use ($request) {
//         //         $mail->from($request->email, $request->name);
//         //         $mail->to('support@example.com')->subject('Contact Form Submission');
//         //     });
        
//         //     Log::info('Email sent to support@example.com.');
//         // } catch (\Exception $e) {
//         //     Log::error('Failed to send email: ' . $e->getMessage());
//         //     return response()->json(['error' => 'Failed to send your message. Please try again later.'], 500);
//         // }

//         return response()->json(['message' => 'Your message has been sent successfully!']);
//     }

//     public function getMail()
//     {
//         Log::info('Retrieving messages from database.');
//         $messages = Contact::all();
//         return response()->json($messages);
//     }
// }
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;

class ContactController extends Controller
{
    public function index()
    {
        $contacts = Contact::all();
        return response()->json(['contacts' => $contacts]);
    }

    public function destroy($id)
    {
        $contact = Contact::findOrFail($id);
        $contact->delete();
        return response()->json(['message' => 'Contact deleted successfully.']);
    }
}
