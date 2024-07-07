<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Traits\CustomThrottlesLogins;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Log;

class AuthenticatedSessionController extends Controller
{
    use CustomThrottlesLogins;

    /**
     * Show the login form.
     */
    public function create()
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): JsonResponse
    {
        $this->ensureIsNotRateLimited($request);

        if (!Auth::attempt($request->only('email', 'password'))) {
            $this->incrementLoginAttempts($request);

            throw ValidationException::withMessages([
                'email' => __('auth.failed'),
            ]);
        }

        $this->clearLoginAttempts($request);

        $user = Auth::user();
        $token = $user->createToken('auth_token')->plainTextToken;

        Log::info('User logged in', ['user_id' => $user->id, 'token' => $token]);

        return response()->json([
            'message' => 'Login successful',
            'user' => $user,
            'token' => $token
        ]);
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): JsonResponse
    {
        $user = $request->user();
        Log::info('Attempting to logout', ['user' => $user]);

        if ($user) {
            Log::info('Authenticated user found', ['user_id' => $user->id]);

            // Delete all tokens for the user
            $user->tokens()->delete();
            Log::info('All tokens deleted for user', ['user_id' => $user->id]);

            // Invalidate the session
            // Auth::guard('web')->logout();
            // $request->session()->invalidate();
            // $request->session()->regenerateToken();
            Log::info('Session invalidated for user', ['user_id' => $user->id]);

            return response()->json([
                'message' => 'Logout successful'
            ]);
        } else {
            Log::warning('User not authenticated');
            return response()->json([
                'message' => 'User not authenticated'
            ], 401);
        }
    }


    // public function destroy(Request $request)
    //       {
    //           if (Auth::user()) {
    //               $request->user()->token()->revoke();
  
    //               return response()->json([
    //                   'success' => true,
    //                   'message' => 'Logged out successfully',
    //               ], 200);
    //           } else {
    //               return response()->json([
    //                   'success' => false,
    //                   'message' => 'Logged out failed',
    //               ], 401);
    //           }
    //       }

}
