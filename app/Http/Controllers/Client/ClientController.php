<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\Invoice;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ClientController extends Controller
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
        $clients = \Auth::user()->clients()
            ->orderBy('created_at', 'DESC')
            ->paginate(25);

        return view('Client.index', ['clients' => $clients]);
    }

    public function show(client $client)
    {
        return view('Client.card', ['client' => $client]);
    }

    public function findClientToAdd()
    {
        $clients = Client::whereNotIn('id', \Auth::user()->clients->modelKeys())->paginate(25);;

        return view('Client.search-add', ['clients' => $clients]);
    }

    public function add($id = null)
    {
        try {
            $client = Client::findOrFail($id);
            \Auth::user()->clients()->attach($client);
            $message = 'Client_Added';
            $alert = 'alert-success';
        }
        catch (\Exception $e) {
            return redirect()->back()->withErrors('errors.Error encountered');
        }

        return redirect(route('clients_list'))->with('message', $message);
    }

    public function create()
    {
        return view('Client.create', ['client' => new \App\Models\Client()]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'company' => ['required', 'max:255'],
            'firstname' => ['required', 'max:255'],
            'lastname' => ['required', 'max:255'],
            'vat' => ['required', 'max:255'],
            'street' => ['required', 'max:255'],
            'nr' => ['required', 'max:255'],
            'phone' => ['required', 'max:255'],
            'email' => ['required', 'max:255'],
            'city_id' => ['required', 'integer', 'max:255'],
        ]);

        $client = Client::create($validatedData);
        $user = auth()->user();
        $client->users()->attach($user);
        return redirect(route('clients_list'));
    }

    public function edit(Client $client = null)
    {
        if (!$client)
            return redirect()->back()->withErrors('errors.Missing parameter');

        return view('Client.client-update', ['client' => $client]);
    }


    public function update(Request $request)
    {
        $validatedData = $request->validate([
            'id' => ['required'],
            'company' => ['required', 'max:255'],
            'firstname' => ['required', 'max:255'],
            'lastname' => ['required', 'max:255'],
            'vat' => ['required', 'max:255'],
            'street' => ['required', 'max:255'],
            'nr' => ['required', 'max:255'],
            'phone' => ['required', 'max:255'],
            'email' => ['required', 'max:255'],
            'city_id' => ['required', 'integer', 'max:255'],
        ]);

        $client = client::find($validatedData['id']);
        $client->update($validatedData);

        return redirect(route('clients_list'));
    }

    public function delete(Request $request, Client $client = null)
    {
        if (!$client) return redirect()->back()->withErrors('Client not found');

        if (DB::table('invoice')->where('client_id', $client->id)->exists())
            return redirect()->back()->withErrors('errors.Invoices_exists');

        if (count($client->users) > 1)
            return redirect()->back()->withErrors('errors.Users_exists');

        return view('Client.client-delete', ['client' => $client]);
    }

    public function remove(Request $request, Client $client)
    {
        if ($request->_decline || !$client) return redirect(route('invoices_list'))->with('message', 'annulé');

            $client->delete();
            $message = 'app.Client_deleted';

        return redirect()->route('clients_list')->with('message', $message);
    }

}