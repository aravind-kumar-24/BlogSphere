<?php

namespace App\Services;

use App\Models\Cities;
use App\Models\States;

class AssetsService
{  
    public static function states(){
        $states = States::where('status','active')->whereNull('deleted_at')->get();
        return $states;
    }
}
