<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Address;
class checkAddress
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
        $addresses = Address::where('user_id', auth()->user()->id)
        ->where('deleted_at', null)
        ->get();

        if ($addresses->count() > 0 ) {
            return $next($request);
        } else {
            return redirect('/myAddresses');
        }
    }
}
