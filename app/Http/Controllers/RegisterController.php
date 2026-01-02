<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Services\AssetsService;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function index(AssetsService $assets){
        $states = $assets->states();
        // $cities = $assets->cities();
        return view('RegistrationPage', compact('states'));
    }

    public function register(Request $request){

        $request->validate([
            'first_name' => 'required|string|max:50',
            'last_name' => 'required|string|max:50',
            'user_name' => 'required|string|max:50',
            'profession' => 'required|string|max:50',
            'email_id' => 'required|email|max:100',
            'contact_number'=> 'required',
            'state' => 'required',
            'city' => 'required',
            'gender' => 'required|in:Male,Female,Others',
            'date_of_birth' => 'required|date',
            'address' => 'required|string|max:255',
            'password' => 'required|min:10',
            'confirm_password' => 'required|min:10',
            'terms_and_conditions' => 'required'
        ]);

    }
}
