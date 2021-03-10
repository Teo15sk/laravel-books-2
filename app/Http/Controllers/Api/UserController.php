<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function token(Request $request)
    {
        // authentication attempt - using credentials from request
        if (Auth::attempt($request->all())) {

            // storing authenticated user into variable
            $user = Auth::user();

            // revoking all existing tokens
            $user->tokens()->delete();

            // create new auth token
            $token = $user->createToken('token-name');

            return [
                'message' => 'success',
                'user' => Auth::user(),
                'token' => $token->plainTextToken,
            ];
        }

        return [
            'message' => 'invalid'
        ];
    }

    public function user()
    {
        $user = Auth::user();

        return [
            'user' => $user
        ];

    }

    public function logout()
    {
        $user = Auth::user();

        $user->tokens()->delete();
    }
}