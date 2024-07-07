<?php
// namespace App\Http\Controllers;

// use App\Http\Requests\ProfileUpdateRequest;
// use Illuminate\Http\RedirectResponse;
// use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Auth;
// use Illuminate\Support\Facades\Redirect;
// use Illuminate\View\View;

// class ProfileController extends Controller
// {
//     /**
//      * Display the user's profile information.
//      */
//     public function show(Request $request): View
//     {
//         return view('profile.show', [
//             'user' => $request->user(),
//         ]);
//     }

//     /**
//      * Display the user's profile form.
//      */
//     public function edit(Request $request): View
//     {
//         return view('profile.edit', [
//             'user' => $request->user(),
//         ]);
//     }

//     /**
//      * Update the user's profile information.
//      */
//     public function update(ProfileUpdateRequest $request): RedirectResponse
//     {
//         $user = $request->user();
//         $user->fill($request->validated());

//         if ($request->hasFile('image')) {
//             $fileName = time() . '.' . $request->image->extension();
//             $request->image->move(public_path('profile_images'), $fileName);
//             $user->image = $fileName;
//         }

//         if ($user->isDirty('email')) {
//             $user->email_verified_at = null;
//         }

//         $user->save();

//         return Redirect::route('profile.edit')->with('status', 'profile-updated');
//     }

//     /**
//      * Delete the user's account.
//      */
//     public function destroy(Request $request): RedirectResponse
//     {
//         $request->validateWithBag('userDeletion', [
//             'password' => ['required', 'current_password'],
//         ]);

//         $user = $request->user();

//         Auth::logout();

//         $user->delete();

//         $request->session()->invalidate();
//         $request->session()->regenerateToken();

//         return Redirect::to('/');
//     }
// }


namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\ProfileUpdateRequest;
use App\Models\User;

class ProfileController extends Controller
{
    /**
     * Display the user's profile information.
     */
    public function show(Request $request): JsonResponse
    {
        $user = $request->user();

        if (!$user) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return response()->json(['user' => $user]);
    }
    
        /**
     * Display the user's profile form.
     */
    public function edit(Request $request): JsonResponse
    {
        $user = $request->user();

        if (!$user) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return response()->json(['user' => $user]);
    }
    /**
 * Update the user's profile information.
 */
    public function update(ProfileUpdateRequest $request): JsonResponse
    {
        $user = $request->user();

        if (!$user) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $user->fill($request->validated());

        if ($request->hasFile('image')) {
            $fileName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('profile_images'), $fileName);
            $user->image = $fileName;
        }

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        $user->save();

        return response()->json(['message' => 'Profile updated successfully']);
    }
    /**
 * Delete the user's account.
 */
public function destroy(Request $request): JsonResponse
{
    $user = $request->user();

    if (!$user) {
        return response()->json(['error' => 'Unauthorized'], 401);
    }

    $request->validate([
        'password' => ['required', 'current_password'],
    ]);

    Auth::logout();

    $user->delete();

    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return response()->json(['message' => 'Account deleted successfully']);
}


}
