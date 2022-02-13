<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\User;
use Validator;
use App\Http\Controllers\Api\ApiresponseController;
use Tymon\JWTAuth\Exceptions\JWTException;

class AuthController extends Controller
{
    public function __construct(){}

    //register new user
    public function signup(Request $request)
    {
        $rules = [
        	'name' => 'required',
        	'email'  => 'required|email|unique:users,email',
            'password' => 'required|min:6'
        ];
    	$validator = Validator::make($request->all(),$rules);
        if (@$validator->fails()) {
            return ApiresponseController::apiresponse(0,$validator->errors()->first());
        } else {
            try{
                $data = $request->only(['email','name','password']);
                if (User::create($data)) {
                    return ApiresponseController::apiresponse(1,'User registered successfully.');
                }
                else{
                    return ApiresponseController::apiresponse(0,'Error in process. Try again!');
                }
            }catch(\Exception $e){
                return ApiresponseController::apiresponse(0,$e->getMessage());
            }
        }
    }

    //login user
    public function login(Request $request)
    {
        $rules = [
        	'email'  => 'required',
            'password' => 'required'
    	];
    	$validator = Validator::make($request->all(),$rules);
        if (@$validator->fails()) {
            return ApiresponseController::apiresponse(0,$validator->errors()->first());
        } else {
            try{
                $credentials = $request->only('email', 'password');
                //set auth token
                if($token = $this->guard()->attempt($credentials)) {
                    if(isset($this->guard()->user()->id)){
                        $user = User::where('id',$this->guard()->user()->id)->first();
                        if(isset($user)){
                            $user->token = $token;
                            return ApiresponseController::apiresponse(1,'Logged in successfully.',ApiresponseController::mergeWithKey($user->toArray()));
                        }
                    }
                    return ApiresponseController::apiresponse(0,'Error in process. Try again!');
                }
                else{
                    return ApiresponseController::apiresponse(0,'Invalid credentials, Please check email or password and try again.');
                }
            }catch(\Exception $e){
                return ApiresponseController::apiresponse(0,$e->getMessage());
            }
        }
    }

    //logout user with token
    public function logout(Request $request)
    {
        try {
            \JWTAuth::invalidate($request->header('Authorization'));
            return ApiresponseController::apiresponse(1,'You have successfully logged out.');
        } catch (JWTException $e) {
            return ApiresponseController::apiresponse(0,'Failed to logout, please try again.');
        }
    }

    //get api guard
    public function guard()
    {
        return Auth::guard('api');
    }

}
