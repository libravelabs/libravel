<?php

namespace App\Http\Middleware;

use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!Storage::disk('local')->exists('license.key')) {
            abort(403, 'License not found! Contact the developer.');
        }

        $encryptedLicense = Storage::disk('local')->get('license.key');

        try {
            $expirationDate = decrypt($encryptedLicense, false);
        } catch (\Exception $e) {
            abort(403, 'License is invalid! Contact the developer.');
        }

        if (Carbon::now()->timestamp > $expirationDate) {
            abort(403, 'License has expired! Please renew it.');
        }


        return $next($request);
    }
}
