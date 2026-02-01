<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        $user_details = Auth::user();

        $user_type = $user_details->user_type;

        if($user_type != '1'){
            return redirect('unauthenticated-access');
        }

        return $next($request);
    }
}
