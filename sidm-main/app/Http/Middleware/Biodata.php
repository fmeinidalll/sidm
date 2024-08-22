<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Biodata
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if ($request->user()->patient == null && $request->user()->level == 'patient') {
            return redirect()->route('biodata.index');
        }
        return $next($request);
    }
}
