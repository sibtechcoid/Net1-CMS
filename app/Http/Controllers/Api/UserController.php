<?php

namespace App\Http\Controllers\Api;

use App\User;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function index() 
    {
    	$response['users'] = User::all();
    	$response['code'] = 200;
    	return response()->json($response);
    }

    public function show(User $user) 
    {
    	$response['user'] = $user;
    	$response['code'] = 200;
    	return response()->json($response);
    }

    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required|min:3',
            'last_name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed|min:6',
            'picture' => 'image'
        ]);

        try{
            $user = new User;
            $user->email = $request->email;
            $user->password = $request->password;
            $user->first_name = $request->first_name;
            $user->last_name = $request->last_name;
            $path = $request->file('picture')->store('users/admin');
            $user->picture = $path;
            $user->save();
            $response['message'] = 'New User added.';
            $response['code'] = 200;
        }
        catch(\Exception $e) {
            echo $e;exit;
            $custom_error = ValidationException::withMessages([
                'internal_server' => ['Failed to add new User. Try again in a few moment.'],
            ]);
            $response['message'] = $custom_error->getMessage();
            $response['errors'] = $custom_error->errors();
            $response['code'] = 500;
        }
        return response()->json($response);
    }

    public function update(Request $request, User $user) 
    {
    	$request->validate([
            'username' => 'regex:/^[a-zA-Z]+$/u|min:3',
            'password' => 'min:6|nullable',
            'first_name' => 'regex:/^[a-zA-Z]+$/u|min:3',
            'last_name' => 'regex:/^[a-zA-Z]+$/u|min:3',
            'picture' => 'nullable|image|mimes:jpeg,png,jpg,svg|max:10240',
        ]);
        try {
            // Update the user
            $data = $request->except(['_token', 'id']); // get all request variable, empty value filtered
            if($request->hasAny('password') && ($data['password'] != null || $data['password'] != '')) {
            	$data['password'] = bcrypt($data['password']);
            }
            
            $filtered_data = array_filter($data);
            $user->fill($filtered_data);
            $user->save();

            $response['message'] = 'User is updated.';
            $response['code'] = 200;
        }
        catch (\Exception $e) {
            $custom_error = ValidationException::withMessages([
               'internal_server' => ['Failed to update user. Try again in a few moment.'],
            ]);
            $response['message'] = $custom_error->getMessage();
            $response['errors'] = $custom_error->errors();
            $response['code'] = 500;
        }
        return response()->json($response);
    }

    public function getCurrentUserSlightInfo() 
    {
    	$user_id = auth()->user()->token()->user_id;
    	$token_name = auth()->user()->token()->name;
    	if($token_name == 'authToken') {
    		$response['currentUser'] = \DB::table('users')->where('id', $user_id)->select(['id', 'first_name', 'last_name', 'email', 'picture'])->first();
    	}
    	else {
    		$response['currentUser'] = auth()->user();
    	}
    	$response['code'] = 200;
    	return response()->json($response);
    }
}
