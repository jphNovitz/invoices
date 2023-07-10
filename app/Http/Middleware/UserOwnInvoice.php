<?php

namespace App\Http\Middleware;

use App\Models\Invoice;
use Closure;

class UserOwnInvoice
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
//      dd($id = filter_var($request->getRequestUri(), FILTER_SANITIZE_NUMBER_INT));
        if (
            (null === $id = filter_var($request->getRequestUri(), FILTER_SANITIZE_NUMBER_INT)) ||
            (Invoice::where('id', $id)->first() === null ) ||
            (Invoice::where('id', $id)->first()->user->id !== auth()->user()->id)
        ) return redirect()->back()->withErrors('errors.Error with invoice');

        return $next($request);
    }

}
