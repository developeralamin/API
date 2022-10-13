<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Show all data
     */
    public function index()
    {
        return User::all();
    }

    /**
     * Create a user
     */
    public function create(Request $request)
    {
        $user =  User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
        ]);
        return response()->json([
            'success' => true,
            'message' => 'User List',
            'data'    => $user
        ]);
    }
}
