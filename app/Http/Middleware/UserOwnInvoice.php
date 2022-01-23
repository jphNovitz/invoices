<?php

namespace App\Http\Middleware;

use App\Invoice;
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
        if (
            (null === $id = filter_var($request->getRequestUri(), FILTER_SANITIZE_NUMBER_INT)) ||
            (null === $invoice = Invoice::where('id', $id)->first()) ||
            ($invoice->user->id !== auth()->user()->id)
        ) return redirect()->route('invoice_create')->with("message", "Création d'une facture");

        return $next($request);
    }

}
