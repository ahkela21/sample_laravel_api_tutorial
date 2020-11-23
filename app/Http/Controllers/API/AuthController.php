<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\UserType;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login()
    {
        $user = UserType::where('ic',request('username'))->first();

        if($user->user_type == 'App\Models\User')
        {
            $tokenRequest = Request::create('/oauth/token', 'post', [
                'grant_type' => 'password',
                'client_id' => 2, // check the id after migrate: Error client authenticate failed
                'client_secret' => '234',
                'username' => request('username'),
                'password' => request('password'),
                'scope' => '*',
            ]);
        }
        else
        {
            $tokenRequest = Request::create('/oauth/token', 'post', [
                'grant_type' => 'password',
                'client_id' => 1, // check the id after migrate: Error client authenticate failed
                'client_secret' => '123',
                'username' => request('username'),
                'password' => request('password'),
                'scope' => '*',
            ]);
        }
        

        $response = app()->handle($tokenRequest);
        $responseJson = json_decode($response->getContent());
        if ($response->status() === 200) {
            return response()->json([
                'status' => 1,
                'message' => 'success',
                'access_token' => $responseJson->access_token,
                'refresh_token' => $responseJson->refresh_token,
                'user_type' => $user->user_type
            ]);
        } elseif ($responseJson->error === 'invalid_grant') {
            return response()->json([
                'status' => 0,
                'message' => 'Credential is invalid'
            ]);
        } elseif ($responseJson->error === 'invalid_request'){
            return response()->json([
                'status' => 0,
                'message' => 'Request is invalid'
            ]);
        } else {
            return response()->json([
               'status' => 0,
               'message' => $responseJson->message
            ]);
        }
    }

    public function refresh()
    {
        // $user = UserType::where('ic',request('username'))->first();
        $userType = 'App\Model\\'.request()->userType;

        if($userType == 'App\Model\User')
        {
            $tokenRequest = Request::create('/oauth/token', 'post', [
                'grant_type' => 'refresh_token',
                'client_id' => 2, // check the id after migrate: Error client authenticate failed
                'client_secret' => '234',
                'refresh_token' => request()->bearerToken(),
                'scope' => '*',
            ]);
        }
        else
        {
            $tokenRequest = Request::create('/oauth/token', 'post', [
                'grant_type' => 'refresh_token',
                'client_id' => 1, // check the id after migrate: Error client authenticate failed
                'client_secret' => '123',
                'refresh_token' => request()->bearerToken(),
                'scope' => '*',
            ]);
        }
        

        $response = app()->handle($tokenRequest);
        $responseJson = json_decode($response->getContent());
        if ($response->status() === 200) {
            return response()->json([
                'status' => 1,
                'message' => 'success',
                'access_token' => $responseJson->access_token,
                'refresh_token' => $responseJson->refresh_token,
                'user_type' => $userType
            ]);
        } elseif ($responseJson->error === 'invalid_grant') {
            return response()->json([
                'status' => 0,
                'message' => 'Credential is invalid'
            ]);
        } elseif ($responseJson->error === 'invalid_request'){
            return response()->json([
                'status' => 0,
                'message' => 'Request is invalid'
            ]);
        } else {
            return response()->json([
               'status' => 0,
               'message' => $responseJson->message
            ]);
        }
    }
}
