<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Models\Cities;
use App\Services\AssetsService;
use Illuminate\Http\Request;

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
        return $request->all();
    }
}
