<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Client;
use Hash;
use Validator;
use Auth;

class LoginController extends Controller
{
    /**
     * Write code on Method
     *
     * @return response()
     */

    public function userRegister(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed'
        ]);

        $data['password'] = bcrypt($request->password);

        $user = User::create($data);

        $token = $user->createToken('API Token')->accessToken;

        return response([ 'user' => $user, 'token' => $token]);
    }

    public function userDashboard()
    {
        $users = User::all();
        $success =  $users;

        return response()->json($success, 200);
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function clientDashboard()
    {
        $users = Client::all();
        $success =  $users;

        return response()->json($success, 200);
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function userLogin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if($validator->fails()){
            return response()->json(['error' => $validator->errors()->all()]);
        }

        if(auth()->guard('user')->attempt(['email' => request('email'), 'password' => request('password')])){

            config(['auth.guards.api.provider' => 'user']);

            $user = User::select('users.*')->find(auth()->guard('user')->user()->id);
            $success =  $user;
            $success['token'] =  $user->createToken('MyApp',['user'])->accessToken;

            return response()->json($success, 200);
        }else{
            return response()->json(['error' => ['Email and Password are Wrong.']], 200);
        }
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function clientLogin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if($validator->fails()){
            return response()->json(['error' => $validator->errors()->all()]);
        }

        if(auth()->guard('client')->attempt(['email' => request('email'), 'password' => request('password')])){

            config(['auth.guards.api.provider' => 'client']);

            $client = client::select('clients.*')->find(auth()->guard('client')->user()->id);
            $success =  $client;
            $success['token'] =  $client->createToken('MyApp',['client'])->accessToken;

            return response()->json($success, 200);
        }else{
            return response()->json(['error' => ['Email and Password are Wrong.']], 200);
        }
    }
    public function clientRegister(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed',
            'phone' => 'required'
        ]);

        $data['password'] = bcrypt($request->password);

        $client = Client::create($data);

        $token = $client->createToken('API Token')->accessToken;

        return response([ 'client' => $client, 'token' => $token]);
    }
}
