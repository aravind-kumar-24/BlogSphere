<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\ChangePasswordRequest;
use App\Http\Requests\UpdateProfileRequest;
use App\Mail\ForgotPasswordMail;
use App\Models\Bloggers;
use App\Services\AssetsService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Exception;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Str;

class ProfileController extends Controller
{
    
    public function profile_page($type, AssetsService $assets){

        try{
            $blogger = Auth::user();

            $states = $assets->states();
            $cities = $assets->cities();

            return view('MyProfilePage', compact('blogger', 'type', 'states', 'cities'));

        }catch(Exception $e){
            return Response::json([
                'status' => false,
                'message' => 'Something went wrong',
                'error' => $e->getMessage()
            ],500);
        }

    }

    public function update_profile(UpdateProfileRequest $request){

        try{

            $blogger = Auth::user();

            $data = $request->all();

            $existing_check = Bloggers::where('id', $blogger->id)->where('user_id', $blogger->user_id)->first();

            if(!$existing_check){
                return Response::json([
                    'status' => false,
                    'message' => "Blogger not found!",
                ],404);
            }

            if($existing_check->status == 'rejected' && $existing_check->deleted_at != null){
                return Response::json([
                    'status' => false,
                    'message' => "Blogger already deleted! Contact the Admin",
                ],404);
            }

            $profile_picture_file_path = null;

            if($request->hasFile('profile_pic')){

                if($blogger->profile_pic && file_exists(public_path($blogger->profile_pic))){
                    unlink(public_path($blogger->profile_pic));
                }

                $profile_picture = $request->file('profile_pic');
                $profile_picture_file_name = time().'_'.uniqid().'.'.$profile_picture->extension();

                $directory = public_path('profile_images');

                if(!is_dir($directory)){
                    mkdir($directory, 0755, true);
                }

                $profile_picture->move($directory, $profile_picture_file_name);
                $profile_picture_file_path = 'profile_images/'.$profile_picture_file_name;
            };

            $existing_check->first_name =  $data['first_name'];
            $existing_check->last_name = $data['last_name'];
            $existing_check->profession = $data['profession'];
            $existing_check->state_id = $data['state'];
            $existing_check->city_id = $data['city'];
            $existing_check->gender = $data['gender'];
            $existing_check->date_of_birth = $data['date_of_birth'];
            $existing_check->address = $data['address'];

            if($profile_picture_file_path  != null){
                $existing_check->profile_pic = $profile_picture_file_path;
            }

            $existing_check->save();

            return response()->json([
                'status' => true,
                'message' => 'Profile updated successfully!',
                'redirect_url' => url('/blogsphere/my-profile/view')
            ]);

            
        }catch(Exception $e){
            return Response::json([
                'status' => false,
                'message' => 'Something went wrong',
                'error' => $e->getMessage()
            ],500);
        }
    }

    public function change_password(){
        return view('ChangePasswordPage');
    }

    public function update_password(ChangePasswordRequest $request){
        try{

            $blogger = Auth::user();

            $data = $request->all();

            $blogger_existing_check = Bloggers::where('user_id', $blogger->user_id)->where('id', $blogger->id)->first();

            if(!$blogger_existing_check){
                return Response::json([
                    'status' => false,
                    'message' => "Blogger not found!",
                ],404);
            }

            if($blogger_existing_check->status == 'rejected' && $blogger_existing_check->deleted_at != null){
                return Response::json([
                    'status' => false,
                    'message' => "Blogger already deleted! Contact the Admin",
                ],404);
            }

            if(!Hash::check($data['old_password'], $blogger->password)){
                return Response::json([
                    'status' => false,
                    'message' => "Old Password doesn't match!",
                ],400);
            }

            if(Hash::check($data['new_password'], $blogger->password)){
                return Response::json([
                    'status' => false,
                    'message' => "New Password cannot be a Old Password",
                ],400);
            }

            $blogger_existing_check->password = Hash::make($data['new_password']);
            $blogger_existing_check->save();

            Auth::logout();

            return response()->json([
                'status' => true,
                'message' => 'Password changed successfully! Kindly log in...',
                'redirect_url' => url('/blogger-login')
            ]);

        }catch(Exception $e){
            return Response::json([
                'status' => false,
                'message' => 'Something went wrong',
                'error' => $e->getMessage()
            ],500);
        }
    }

    public function forgot_password(){
        return view('ForgotPasswordPage');
    }

    public function forgot_password_mail(Request $request){

        try{
            $request->validate([
                'email_id' => 'required|email'
            ], [
                'email_id.required' => 'Email ID is required',
                'email_id.email' => 'Please enter a valid Email Address'
            ]);

            $email_id = $request->input('email_id');

            $blogger_existing_check = Bloggers::where('email_id', $email_id)->first();

            if(!$blogger_existing_check){
                return Response::json([
                    'status' => false,
                    'message' => "Blogger not found!",
                ],404);
            }

            if($blogger_existing_check->status == 'rejected' && $blogger_existing_check->deleted_at != null){
                return Response::json([
                    'status' => false,
                    'message' => "Blogger already deleted! Contact the Admin",
                ],404);
            }

            $new_password = 'Blogger@'.substr($blogger_existing_check->id, -2).Str::random(4);
            $blogger_email_id = $blogger_existing_check->email_id;
            $blogger_name = $blogger_existing_check->first_name . ' ' . $blogger_existing_check->last_name;

            $blogger_existing_check->password = Hash::make($new_password);
            $blogger_existing_check->save();

            try{
                Mail::to($blogger_email_id)->send(new ForgotPasswordMail($blogger_name, $new_password));
            }catch(\Exception $e){
                Log::error("Failed to send forgot password mail: " . $e->getMessage());
            }

            return response()->json([
                'status' => true,
                'message' => 'Password generated successfully! Kindly check your email',
                'redirect_url' => url('/blogger-login')
            ]);

        }catch(Exception $e){
            return Response::json([
                'status' => false,
                'message' => 'Something went wrong',
                'error' => $e->getMessage()
            ],500);
        }

    }
}
