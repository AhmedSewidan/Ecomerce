<?php

namespace App\Http\Controllers\ApiControllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Resources\ApiResources\ClientResource;
use App\Mail\SendOTP;
use App\Models\Client;
use App\Models\Code;
use Carbon\Carbon;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends ApiController
{
    // User data
    public function me()
    {
        $user   = new ClientResource( JWTAuth::user() );
        return $this->response([ 'user' => $user ]);
    }

    // Register
    public function register( RegisterRequest $request )
    {
        try{
            $user = Client::create([
                'name'      => $request->name,
                'email'     => $request->email,
                'password'  => Hash::make( $request->password ),
            ]);
        } catch ( QueryException  $e){

            if ($e->errorInfo[1] == 1062) {
                return $this->errorMessage('This email is already used.');
            }

            return $this->errorMessage('An error occurred: ' . $e->getMessage());
        }

        $token = JWTAuth::fromUser( $user );

        return $this->response([
            'token'     => $token
        ]);
    }
    
    // Login
    public function login( LoginRequest $request )
    {
        $credentials     = $request->only('email', 'password');

        if( !$token = JWTAuth::attempt( $credentials ) ){
            return $this->errorMessage('Error in email or password');
        }

        return $this->response([
            'token'     => $token
        ]);
    }
    
    // Refresh
    public function refresh()
    {
        $token      = JWTAuth::getToken();

        $new_token  = JWTAuth::refresh( $token );

        return $this->response(['token' => $new_token], 'Token refreshed successfully');
    }

    // Logout
    public function logout()
    {
        $token = JWTAuth::getToken();

        JWTAuth::invalidate( $token );

        return $this->successMessage('Logged out successfully');
    }

    // Update
    public function update( Request $request, $id )
    {
        $validate = $request->validate([
            'name'      => 'sometimes|string|max:50',
            'email'     => 'sometimes|string|email|max:250',
            'password'  => 'nullable|string|max:255|min:8|confirmed',
        ]);

        $user    = Client::findOrFail($id);
        $user->update($validate);

        if( $request->has('password') ){
            $user->password   = Hash::make($request->password);
            $user->save();
        }

        return $this->me();
    }

    // Create Code
    public function sendOTP( Request $request )
    {
        $request->validate([
            'email'     => 'required|string|email|max:250',
        ]);
        
        $user = Client::where('email', $request->email)->first();

        if( !$user ){
            return $this->errorMessage('User not found');
        }
        
        Client::find( $user->id )->codes()->delete();

        $code = Code::create([
            'client_id'   => $user->id,
            'code'        => mt_rand(1000, 9999),
            'expires_at'  => now()->addMinutes(3)
        ]); 

        $data = [
            'otp'         => $code->code,
            'username'    => $user->name,
            'expireTime'  => $code->expires_at->format('H:i:s')
        ];

        try{
            Mail::to($user)->send(new SendOTP($data));
        } catch ( \Exception $e ){
            return $this->errorMessage( $e->getMessage() );
        }
        
        return $this->successMessage('OTP sent successfully');
    }

    // Check code and make token
    public function checkOTP( Request $request )
    {
        $request->validate([
            'email'     => 'required|string|email|max:250',
            'code'      => 'required|digits:4|string'
        ]);
        
        $user     = Client::where( 'email', $request->email )->first();

        if( !$user ){
            return $this->errorMessage('User not found');
        }

        $lastCode = $user->codes()->latest()->first();

        if( $lastCode->expires_at < now() ){
            return $this->errorMessage('Code is expired try again');
        }
        
        if( $lastCode->code != $request->code ){
            return $this->errorMessage('OTP is incorrect');
        }

        $user->codes()->delete();

        $token = JWTAuth::fromUser( $user );

        return $this->response( [ 
            'token' => $token 
        ], 'Vreified successfully' );
    }

    // Reset password 
    public function resetPassword( Request $request )
    {
        $request->validate([
            'password'  => 'required|string|max:200|min:8|confirmed',
        ]);

        $user = JWTAuth::user();
        $user->update([ 'password' => Hash::make( $request->password ) ]);
        
        return $this->successMessage('Password reseted successfully');
    }

}
