<?php

namespace App\Http\Controllers;

use App\Http\Requests\LogineUserRequest;
use App\Http\Requests\StoreUserRequest;
use App\Models\User;
use App\Traits\HttpResponses;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    use HttpResponses;

    public function login(LogineUserRequest $request)
    {
        $request->validated($request->all());

        if (!Auth::attempt($request->only(['email', 'password']))) {
            return $this->error('', 'Credentials do not match', 401);
        };

        $user = User::where('email', $request->email)->first();
        return $this->success([
            'user' => $user,
            'token' => $user->createToken('API Token Of: ' . $user->name)->plainTextToken
        ]);
    }

    public function register(StoreUserRequest $request)
    {
        $request->validated($request->all());

        // Pass the faildes that we get from the $request 
        //  The key represent column names and the value 
        // Will be coming from the $request
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        return $this->success([
            'user' => $user,
            'token' => $user->createToken('API Token of: ' . $user->name)->plainTextToken // Create new Laravel Sanctum access token instance "Will be stored in the database"
        ]);
    }

    public function logout()
    {

        // Call the current logged in user and delete his Token
        Auth::user()->currentAccessToken()->delete();

        return $this->success([
            'message' => 'You have been successfully been logged out'
        ]);
    }
}
