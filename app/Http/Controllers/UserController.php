<?php

// namespace App\Http\Controllers;

// use App\Models\User;
// use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Auth;

// class UserController extends Controller
// {
//     public function customers()
//     {
//         if (Auth::user()->role == 'admin') {
//             $customers = User::where('role', 'customer')->paginate(10);
//             return view('users.customers', compact('customers'));
//         } else {
//             return redirect()->route('index')->with('error', 'Access denied');
//         }
//     }

//     public function hosts()
//     {
//         if (Auth::user()->role == 'admin') {
//             $hosts = User::where('role', 'host')->paginate(10);
//             return view('users.hosts', compact('hosts'));
//         } else {
//             return redirect()->route('index')->with('error', 'Access denied');
//         }
//     }

//     public function createCustomer()
//     {
//         if (Auth::user()->role == 'admin') {
//             $roles = ['customer' => 'Customer', 'host' => 'Host'];
//             return view('users.create', ['action' => route('customers.store'), 'roles' => $roles, 'defaultRole' => 'customer']);
//         } else {
//             return redirect()->route('index')->with('error', 'Access denied');
//         }
//     }

//     public function createHost()
//     {
//         if (Auth::user()->role == 'admin') {
//             $roles = ['customer' => 'Customer', 'host' => 'Host'];
//             return view('users.create', ['action' => route('hosts.store'), 'roles' => $roles, 'defaultRole' => 'host']);
//         } else {
//             return redirect()->route('index')->with('error', 'Access denied');
//         }
//     }

//     public function store(Request $request)
//     {
//         if (Auth::user()->role == 'admin') {
//             $request->validate([
//                 'name' => 'required',
//                 'email' => 'required|email|unique:users',
//                 'password' => 'required|min:6',
//                 'role' => 'required|in:customer,host', // role is required
//             ]);

//             User::create([
//                 'name' => $request->name,
//                 'email' => $request->email,
//                 'password' => bcrypt($request->password),
//                 'role' => $request->role, // Assign the role
//             ]);

//             $redirectRoute = $request->role == 'customer' ? 'customers.index' : 'hosts.index';

//             return redirect()->route($redirectRoute)->with('success', 'User created successfully.');
//         } else {
//             return redirect()->route('index')->with('error', 'Access denied');
//         }
//     }

//     public function edit(User $user)
//     {
//         if (Auth::user()->role == 'admin') {
//             $roles = ['customer' => 'Customer', 'host' => 'Host'];
//             $action = $user->role == 'customer' ? route('customers.update', $user->id) : route('hosts.update', $user->id);
//             return view('users.edit', compact('user', 'roles', 'action'));
//         } else {
//             return redirect()->route('index')->with('error', 'Access denied');
//         }
//     }

//     public function update(Request $request, User $user)
//     {
//         if (Auth::user()->role == 'admin') {
//             $request->validate([
//                 'name' => 'required',
//                 'email' => 'required|email|unique:users,email,' . $user->id,
//                 'role' => 'required|in:customer,host', // role is required
//             ]);

//             $user->update($request->all());

//             $redirectRoute = $user->role == 'customer' ? 'customers.index' : 'hosts.index';

//             return redirect()->route($redirectRoute)->with('success', 'User updated successfully.');
//         } else {
//             return redirect()->route('index')->with('error', 'Access denied');
//         }
//     }

//     public function destroy(User $user)
//     {
//         if (Auth::user()->role == 'admin') {
//             $role = $user->role;
//             $user->delete();

//             $redirectRoute = $role == 'customer' ? 'customers.index' : 'hosts.index';

//             return redirect()->route($redirectRoute)->with('success', 'User deleted successfully.');
//         } else {
//             return redirect()->route('index')->with('error', 'Access denied');
//         }
//     }
// }


namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;

class UserController extends Controller
{
    public function showUsersByRole()
    {
        if (Auth::user()->role != 'admin') {
            return response()->json(['error' => 'Access denied'], 403);
        }

        $customers = User::where('role', 'customer')->get();
        $hosts = User::where('role', 'host')->get();

        return response()->json([
            'customers' => $customers,
            'hosts' => $hosts,
        ]);
    }
    public function customers()
    {
        if (Auth::user()->role == 'admin') {
            $customers = User::where('role', 'customer')->paginate(10);
            return response()->json(['customers' => $customers], 200);
        } else {
            return response()->json(['error' => 'Access denied'], 403);
        }
    }

    public function hosts()
    {
        if (Auth::user()->role == 'admin') {
            $hosts = User::where('role', 'host')->paginate(10);
            return response()->json(['hosts' => $hosts], 200);
        } else {
            return response()->json(['error' => 'Access denied'], 403);
        }
    }

    public function createCustomer(Request $request)
    {
        if (Auth::user()->role == 'admin') {
            $request->validate([
                'name' => 'required',
                'email' => 'required|email|unique:users',
                'password' => 'required|min:6',
                'role' => 'required|in:customer,host',
            ]);

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'role' => $request->role,
            ]);

            return response()->json(['user' => $user], 201);
        } else {
            return response()->json(['error' => 'Access denied'], 403);
        }
    }

    public function createHost(Request $request)
    {
        if (Auth::user()->role == 'admin') {
            $request->validate([
                'name' => 'required',
                'email' => 'required|email|unique:users',
                'password' => 'required|min:6',
                'role' => 'required|in:customer,host',
            ]);

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'role' => $request->role,
            ]);

            return response()->json(['user' => $user], 201);
        } else {
            return response()->json(['error' => 'Access denied'], 403);
        }
    }

    public function update(Request $request, User $user)
    {
        if (Auth::user()->role == 'admin') {
            $request->validate([
                'name' => 'required',
                'email' => 'required|email|unique:users,email,' . $user->id,
                'role' => 'required|in:customer,host',
            ]);

            $user->update($request->all());

            return response()->json(['user' => $user], 200);
        } else {
            return response()->json(['error' => 'Access denied'], 403);
        }
    }

    public function destroy(User $user)
    {
        if (Auth::user()->role == 'admin') {
            $user->delete();

            return response()->json(['message' => 'User deleted successfully'], 200);
        } else {
            return response()->json(['error' => 'Access denied'], 403);
        }
    }
}
