<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use App\Models\Bloggers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Response;
use Exception;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index(){
        return View('LoginPage');
    }

    public function login(LoginRequest $request){
        try{

            $email_id = $request->input('email_id');
            $password = $request->input('password');

            $blogger = Bloggers::where('email_id', $email_id)->first();

            if(!$blogger){
                return Response::json([
                    'status' => false,
                    'message' => 'Blogger with this Email ID doesn\'t exist',
                ],404);
            }

            if($blogger->status == 'inactive'){
                return Response::json([
                    'status' => false,
                    'message' => 'Blogger is Inactive! Contact the Admin',
                ],403);
            }

            if($blogger->status == 'rejected' && $blogger->deleted_at != null){
                return Response::json([
                    'status' => false,
                    'message' => 'Blogger is Deleted! Contact the Admin',
                ],403);
            }

            if($blogger->contact_verified_at == null){
                return Response::json([
                    'status' => false,
                    'message' => 'Contact Number is not verified',
                ],401);
            }
                
            if($blogger->email_verified_at == null){
                return Response::json([
                    'status' => false,
                    'message' => 'Email ID is not verified',
                ],401);
            }

            if(Auth::attempt(['email_id' => $email_id, 'password' => $password ])){
                $request->session()->regenerate();
                return Response::json([
                    'status' => true,
                    'message' => 'Blogger successfully logged in!',
                    'redirect_url' => url('/blogsphere/blogs')
                ],200);
            }else{
                return Response::json([
                    'status' => false,
                    'message' => 'Invalid Credentials'
                ], 401);
            }
                
        }catch(\Exception $e){
            return Response::json([
                'status' => false,
                'message' => 'Something went wrong',
                'error' => $e->getMessage()
            ],500);
        }
    }

    public function logout(){
        try{

            Auth::logout();

            return Response::json([
                'status' => true,
                'message' => 'Blogger logged out successfully!',
                'redirect_url' => url('/blogger-login')
            ],200);

        }catch(Exception $e){
            return Response::json([
                'status' => false,
                'message' => 'Something went wrong',
                'error' => $e->getMessage()
            ],500);
        }
    }
}
