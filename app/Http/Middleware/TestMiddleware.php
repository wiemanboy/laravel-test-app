<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

/*
 * A class that modifies a request before it reaches the controller.
 */

class TestMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response) $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $route = $request->route();
        $id = $route->parameter("id");

        $route->setParameter("id", $id + 1);

        return $next($request);
    }
}
