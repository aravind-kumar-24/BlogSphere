<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Services\AssetsService;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function index(AssetsService $assets){
        $states = $assets->states();
        $cities = $assets->cities();
        return view('RegistrationPage', compact('states', 'cities'));
    }

    public function register(Request $request){
        
    }
}
