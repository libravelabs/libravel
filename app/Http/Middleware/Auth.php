<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Symfony\Component\HttpFoundation\Response;

class Auth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $licenseKey = env('APP_LICENSE_KEY');
        $serverUrl = "https://tes-saas.test/api/verify-license";

        $response = Http::post($serverUrl, ['license_key' => $licenseKey]);

        if ($response->failed()) {
            abort(403, "License invalid or expired.");
        }

        return $next($request);
    }
}
