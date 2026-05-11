<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SecurityHeaders
{
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        $response->headers->set('X-Content-Type-Options', 'nosniff');
        $response->headers->set('X-Frame-Options', 'SAMEORIGIN');
        $response->headers->set('X-XSS-Protection', '1; mode=block');
        $response->headers->set('Referrer-Policy', 'strict-origin-when-cross-origin');

        // Content Security Policy
        $csp = "default-src 'self'; " .
               "script-src 'self' 'unsafe-inline' 'unsafe-eval' https://www.google.com https://maps.googleapis.com https://cdn.jsdelivr.net https://code.jquery.com https://cdn.tiny.cloud; " .
               "style-src 'self' 'unsafe-inline' https://fonts.googleapis.com https://cdn.jsdelivr.net; " .
               "font-src 'self' data: https://fonts.gstatic.com https://cdn.jsdelivr.net; " .
               "img-src 'self' data: https:; " .
               "frame-src 'self' https://www.google.com https://maps.google.com; " .
               "connect-src 'self' https://maps.googleapis.com https://cdn.tiny.cloud https://cdn.jsdelivr.net https://code.jquery.com;";
        $response->headers->set('Content-Security-Policy', $csp);

        return $response;
    }
}

