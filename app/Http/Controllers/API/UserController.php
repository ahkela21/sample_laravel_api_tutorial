<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\API\Collection\BaseCollection;
use App\Http\Resources\API\UserResource;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return new BaseCollection(User::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return new UserResource(User::find($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function forgetPassword(Request $request)
    {
        $request->validate([
            'new_password' => 'required',
        ]);

        try {
            $hashPassword = Hash::make($request->new_password);
            User::where('name', $request->name)->update(array('password' => $hashPassword));
            return new BaseCollection(User::where('name', $request->name)->get());
        } catch (\Exception $ex) {
            return response()->json([
                'status' => 0,
                'message' =>  $ex->getMessage()
            ]);
        }
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'oldPassword' => 'required|string',
            'newPassword' => 'required|string',
        ]);

        try {
            $oldPassword = $request->oldPassword;
            $user = $request->user();

            $isValid = Hash::check($oldPassword, $user->password);

            if ($isValid) {
                $user->password = Hash::make($request->newPassword);
                $user->save();
                return new UserResource($user);
            } else {
                return response()->json([
                    'status' => 0,
                    'message' => 'Invalid old password'
                ]);
            }
        } catch (\Exception $e) {
            return response()->json([
                'status' => 0,
                'message' => $e->getMessage()
            ]);
        }
    }
}
