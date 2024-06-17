<?php

namespace App\Http\Middleware;

use App\Models\Organization;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class VerifyOrganizationToken
{
    /**
     * Handle an incoming request.
     *
     * @param Closure(Request): (Response) $next
     */
    public function handle(Request $request, Closure $next)
    {
        $token = $request->header('X-Organization-Token');

        if (!$token) {
            return response()->json(['error' => 'Token not provided'], Response::HTTP_UNAUTHORIZED);
        }

        $organization = Organization::where('token', $token)->first();

        if (!$organization) {
            return response()->json(['error' => 'Invalid token'], Response::HTTP_UNAUTHORIZED);
        }

        $request->attributes->set('organization', $organization);

        return $next($request);
    }
}
