<?php

namespace App\Http\Controllers\Client;

use App\client;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;

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
        $clients = \App\Client::all();
        return view('Client.index', ['clients' => $clients]);
    }

    public function show(client $client)
    {
        return view('Client.card', ['client' => $client]);
    }

    public function create()
    {
        $client = new \App\client();
        return view('Client.create', ['client' => $client]);
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
        ]);

        $client = $request->all();
        $result = Client::create($client);
        $client = client::find($result->id);
        $user = auth()->user();
        $client->users()->attach($user);
        return redirect(route('clients_home'));
    }

    public function update(Client $client)
    {
        if (!$client){
            return redirect()->route('client_home')->with('error', 'Client inconnu !');
        }
        return view('Client.client-update', ['client'=>$client]);
    }

    public function save(Request $request)
    {
        $client = client::find($request->input('id'));
        $validatedData = $request->validate([
            'company' => ['required', 'max:255'],
            'firstname' => ['required', 'max:255'],
            'lastname' => ['required', 'max:255'],
            'vat' => ['required', 'max:255'],
            'street' => ['required', 'max:255'],
            'nr' => ['required', 'max:255'],
            'phone' => ['required', 'max:255'],
            'email' => ['required', 'max:255'],
        ]);

        $client->company = $request->input('company');
        $client->firstname = $request->input('firstname');
        $client->lastname = $request->input('lastname');
        $client->vat = $request->input('vat');
        $client->street = $request->input('street');
        $client->nr = $request->input('nr');
        $client->phone = $request->input('phone');
        $client->email = $request->input('email');
        $client->save();

        return redirect(route('clients_home'));
    }

    public function delete(Request $request, Client $client)
    {
        if (!$client){
            return redirect()->route('clients_home')->with('error', 'Client inconnu !');
        }

        try {
            $client->delete();

            $request->session()->flash('alert-success', 'Client supprimé ! ');
            return redirect()->route('clients_home');

        } catch (\Exception $e){
            return redirect()->route('clients_home')->with('error', 'Client inconnu !');

        }
    }
}