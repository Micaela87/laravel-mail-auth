<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Providers\RouteServiceProvider;

use App\Models\User;


class ApiLoginController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request)
    {
        try {

            $request->validate([
                'email' => 'email|required',
                'password' => 'required'
            ]);

            $credentials = request(['email', 'password']);

            if (!Auth::attempt($credentials)) {
                return response()->json([
                    'status_code' => 500,
                    'message' => 'Unauthorized'
                ]);
            }

            $user = User::where('email', $request->email)->first();

            if ( ! Hash::check($request->password, $user->password, [])) {
                throw new \Exception('Error in Login');
            }

            // $tokenResult = $request->$user->createToken('authToken')->plainTextToken;

            // // dd($tokenResult);

            // $response = [
            //     // 'status_code' => 200,
            //     'Content-Type' => 'application/json',
            //     'Access-Token' => $tokenResult,
            //     'Token-Type' => 'Bearer'];

            return $user->createToken($request->device_name)->plainTextToken;
            
        } catch (Exception $error) {

            return response()->json([
                'status_code' => 500,
                'message' => 'Error in Login',
                'error' => $error,
            ]);
        }
    }
}
