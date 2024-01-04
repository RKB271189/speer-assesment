<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\UserCreateRequest;
use App\Services\UserService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function __construct(private UserService $userService)
    {
    }
    public function create(UserCreateRequest $request)
    {
        try {
            $params = $request->only(['name', 'email', 'password']);
            $params['password'] = Hash::make($params['password']);
            $user = $this->userService->createUser($params);
            if ($user) {
                $token = $user->createToken($user->email);
                return response()->json(['message' => 'User created successfully', 'token' => $token->plainTextToken], 200);
            } else {
                return response()->json(['message' => 'Invalid credentials'], 401);
            }
        } catch (Exception $ex) {
            //Write the logs here            
            return response()->json(['error' => 'Something went wrong. Please try again.'], 500);
        }
    }
    public function login(LoginRequest $request)
    {
        try {
            $params = $request->only(['email', 'password']);
            if (Auth::attempt($params)) {
                $user = Auth::user();
                $token = $user->createToken($user->email);                
                return response()->json(['message' => 'User verified successfully', 'token' => $token->plainTextToken], 200);
            } else {
                throw new Exception("Unable to verify user");
            }
        } catch (Exception $ex) {
            //Write the logs here
            return response()->json(['error' => 'Something went wrong. Please try again.'], 500);
        }
    }
}
