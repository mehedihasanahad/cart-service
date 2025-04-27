<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

/**
 * Class AuthController
 *
 * Handles user authentication: registration and login.
 */
class AuthController extends Controller
{
    /**
     * Register a new user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     *
     * Validates the incoming request and creates a new user.
     */
    public function register(Request $request)
    {
        // Validate incoming request data
        $data = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'role' => 'in:admin,customer'
        ]);

        // Create a new user with hashed password
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'role' => $data['role'] ?? 'customer',
        ]);

        return response()->json(['message' => 'User registered']);
    }

    /**
     * Login a user and issue a JWT token.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     *
     * Attempts authentication and returns a token if successful.
     */
    public function login(Request $request)
    {
        // Extract credentials
        $credentials = $request->only('email', 'password');

        // Attempt to authenticate and issue a token
        if (!$token = auth('api')->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->respondWithToken($token);
    }

    /**
     * Format and return the JWT token response.
     *
     * @param  string  $token
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
        ]);
    }
}
