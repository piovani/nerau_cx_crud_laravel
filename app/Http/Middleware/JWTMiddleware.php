<?php

namespace App\Http\Middleware;

use Closure;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Http\Middleware\BaseMiddleware;
use Tymon\JWTAuth\JWTAuth;

class JWTMiddleware extends BaseMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (empty($accessToken = $request->bearerToken())) {
            return response()->json([
                'message' => 'Bearer token missing',
                'status' => 401,
            ], 401);
        }

        try {
//            $user = JWTAuth::parseToken()->authenticate();
        } catch (TokenInvalidException $exception) {
            return response()->json(['error' => 'invalid-token'], 401);
        } catch (TokenExpiredException $exception) {
            return response()->json(['error' => 'token-expired'], 401);
        } catch (Exception $exception) {
            return response()->json(['error' => 'error-service'], 500);
        }

        return $next($request);
    }
}

