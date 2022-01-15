<?php

namespace App\Http\Controllers\Invoice;

use App\Client;
use App\Http\Controllers\Client\ClientController;
use App\Invoice;
use App\Item;
use App\Vat;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class InvoiceController extends Controller
{
    private $user_id;

    public function __construct()
    {
//       $this->user_id =   \Auth::user()->id;
    }

    public function index()
    {
        $invoices = invoice::where('user_id', \Auth::user()->id)->orderBy('created_at', 'DESC')->get();
        dd($invoices);
        return view('Invoice.list', [
            'invoices' => $invoices
        ]);
    }
//    public function index(client $client){
//        $invoices = invoice::where('client_id', $client->id)->orderBy('created_at', 'DESC')->get();
//        return view('Invoice.list', [
//            'client'=>$client,
//            'invoices' => $invoices
//        ]);
//    }

    public function card(client $client, invoice $invoice)
    {

        return view('Invoice.card', ['client' => $client, 'invoice' => $invoice]);
    }

    /* idem au dessus choisir un ou voir differences */
    public function show($id)
    {

        $invoice = invoice::with('Client')->where('id', $id)->first();
        $total = 0;
        foreach ($invoice->items as $item):
            $total += ((int)$item->price * (float)$item->vat['rate'] + (int)$item->price) * (int)$item->qty - (int)$item->discount;
        endforeach;
        return view('Invoice.show', ['invoice' => $invoice, 'total' => $total]);
    }

    public function edit($id)
    {
        $invoice = invoice::with('Client')->where('id', $id)->first();
        return view('Invoice.update', ['invoice' => $invoice]);
    }

    public function update()
    {
        die('ok');
    }

    public function delete(client $client, invoice $invoice)
    {
        dump($client);
        dump($invoice);
        die();
    }


    public function create($new_client = null)
    {

        return view('Invoice.create', [
            'clients' => \Auth::user()->clients,
            'client_id' => $new_client
        ]);
    }


    public function store(Request $request)
    {
//        dd($request->client_id);
//        dd($request->all());
        $user = auth()->user();
        $client = Client::where('id', '=', $request->client_id)->first();
//        dd($client);
        $invoice = new invoice();
       /* $invoice->client = $client;
        $invoice->user = $user;*/

        $user = auth()->user();
//        $client->users()->save($user);
        $user->clients()->save($client);

        // The invoice
        $invoice_datas['reference'] = 'toto';
        $invoice_datas['client_id'] =  $client->id;
        $invoice_datas['user_id'] =  $user->id;

        $last_added = $invoice->create($invoice_datas);
        $last_id= $last_added->id;

        // The items
        foreach ($request->all()['items'] as $item) {
//            $item['invoice_id'] = $last_id;
            $items_to_add[] = $item;
        }
//        $invoice->items()->createMany($items_to_add);
//$last_added->items()->sync($request->all()['items']);
        $last_added->items()->createMany($items_to_add);
        die;
        return redirect(route('clients_home'));
    }
}
