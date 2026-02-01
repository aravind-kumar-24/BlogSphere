<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class BloggerMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        $user_details = Auth::user();

        $user_type = $user_details->user_type;

        if($user_type != '2'){
            return redirect('unauthenticated-access');
        }

        return $next($request);
    }
}
