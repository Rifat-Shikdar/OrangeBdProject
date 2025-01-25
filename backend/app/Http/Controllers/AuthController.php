<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Passport\Bridge\AccessToken;
use Laravel\Sanctum\Http\Middleware\AuthenticateSession;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:191',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'errors' => $validator->errors(),
            ], 422);
        }

        try {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            $token = $user->createToken('authToken')->accessToken;

            return response()->json([
                'status' => 201,
                'message' => 'User registered successfully.',
                'user' => $user,
                'token' => $token,
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 500,
                'message' => 'Something went wrong.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }


    public function login(Request $request)
    {
        // Validate the login request
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'errors' => $validator->errors(),
            ], 422);
        }

        // Attempt to log in the user
        if (Auth::attempt($request->only('email', 'password'))) {
            /** @var \App\Models\User $user */
            $user = Auth::user();

            // Generate token for Passport
            $token = $user->createToken('authToken')->accessToken;

            return response()->json([
                'status' => 200,
                'message' => 'Login successful.',
                'user' => $user,
                'token' => $token,
            ], 200);
        }

        // If login fails
        return response()->json([
            'status' => 401,
            'message' => 'Invalid email or password.',
        ], 401);
    }

    public function logout(Request $request)
    {
        try {
            // Ensure that a user is authenticated
            $user = Auth::user();

            if (!$user) {
                return response()->json([
                    'status' => 401,
                    'message' => 'Unauthorized: No authenticated user found.',
                ], 401);
            }

            // Get the current access token and delete it
            $user->tokens->each(function ($token) {
                $token->delete();
            });

            return response()->json([
                'status' => 200,
                'message' => 'Logged out successfully.',
            ], 200);

        } catch (\Exception $e) {
            // Catch any exception and return a meaningful error message
            return response()->json([
                'status' => 500,
                'message' => 'Something went wrong.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }


}
