<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Mail\RegistrationCompletedMail;
use App\Models\Bloggers;
use App\Models\Cities;
use App\Services\AssetsService;
use Exception;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Str;

use function Symfony\Component\Clock\now;

class RegisterController extends Controller
{
    public function index(AssetsService $assets){
        $states = $assets->states();
        return view('RegistrationPage', compact('states'));
    }

    public function get_cities($state_id){
        $cities = Cities::where('state_id', $state_id)->where('status','active')->whereNull('deleted_at')->get();
        return $cities;
    }

    public function register(RegisterRequest $request){
        try{
            $data = $request->all();

            $user_id = 'BLOG'.strtoupper(substr(Str::uuid()->toString(), 0, 8));

            if($request->hasFile('profile_pic')){
                $profile_picture = $request->file('profile_pic');
                $profile_picture_file_name = time().'_'.uniqid().'.'.$profile_picture->extension();

                $directory = public_path('profile_images');

                if(!is_dir($directory)){
                    mkdir($directory, 0755, true);
                }

                $profile_picture->move($directory, $profile_picture_file_name);
                $profile_picture_file_path = 'profile_images/'.$profile_picture_file_name;
            };

            $hashed_password = Hash::make($request->input('password'));

            $blogger = new Bloggers();
            $blogger->user_id = $user_id;
            $blogger->first_name = $data['first_name'];
            $blogger->last_name = $data['last_name'];
            $blogger->user_name = $data['user_name'];
            $blogger->profession = $data['profession'];
            $blogger->email_id = $data['email_id'];
            $blogger->contact_number = $data['contact_number'];
            $blogger->contact_verified_at = now();
            $blogger->state_id = $data['state'];
            $blogger->city_id = $data['city'];
            $blogger->gender = $data['gender'];
            $blogger->date_of_birth = $data['date_of_birth'];
            $blogger->address = $data['address'];
            $blogger->status = 'inactive';
            $blogger->profile_pic = $profile_picture_file_path;
            $blogger->password = $hashed_password;
            $blogger->save();

            $full_name = $blogger->first_name.' '.$blogger->last_name;
            $encrypted_user_id = Crypt::encryptString($blogger->user_id);
            $url = url('email-verification/'.$encrypted_user_id);

            //Only for testing
            $blogger->email_id = 'aravindmpkas@gmail.com';

            try{
                Mail::to($blogger->email_id)->send(new RegistrationCompletedMail($full_name, $url));
            }catch(\Exception $e){
                Log::error("Failed to send registration completed mail: " . $e->getMessage());
            }

            return response()->json([
                'status' => true,
                'message' => 'Registration completed successfully!',
                'redirect_url' => url('/blogger-login')
            ]);

        }catch(\Exception $e){
            return Response::json([
                'status' => false,
                'message' => 'Something went wrong',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function email_verification($user_id){

        try{
            $decrypted_user_id = Crypt::decryptString($user_id);

            $blogger = Bloggers::where('user_id', $decrypted_user_id)->first();

            if(!$blogger){
                abort(404);
            }

            if($blogger->email_verified_at !== null){
                return view('email_templates.EmailAlreadyVerified');
            }

            $blogger->email_verified_at = now();
            $blogger->status = 'active';
            $blogger->save();

            return view('email_templates.EmailVerificationCompleted');
        }catch(DecryptException $e){
            abort(404);
        }catch(\Exception $e){
            abort(500);
        }
    }
}
