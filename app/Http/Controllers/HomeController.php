<?php

namespace App\Http\Controllers;

use App\Client;
use App\Invoice;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $clients_no_invoices = $clients = \Auth::user()
            ->clients()
            ->whereDoesntHave('invoices')
            ->orderBy('created_at', 'DESC')
            ->take(5)
            ->get();
        $clients_many_invoices = Client::withCount('invoices')
            ->orderBy(\DB::raw('invoices_count'), 'DESC')
            ->orderBy('created_at', 'DESC')
            ->take(5)->get();

        $invoices = Invoice::with('client')
            ->where('user_id', \Auth::user()->id)
            ->orderBy('created_at', 'DESC')
            ->take(10)
            ->get();


        $promote_clients = collect($clients_no_invoices)->merge($clients_many_invoices);

        return view('home', [
            'promote_clients' => $promote_clients,
            'invoices' => $invoices
        ]);
    }
}
