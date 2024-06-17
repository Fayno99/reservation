<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class IfNonManager
{
    /**
     * Handle an incoming request.
     *
     * @param Closure(Request): (Response) $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();
        if  ($user &&  (Auth::user()->isAdmin == User::ROLE_ADMIN || Auth::user()->isAdmin == User::ROLE_MANAGER)) {

            return $next($request);
        }

        return redirect('/index');
    }


}
