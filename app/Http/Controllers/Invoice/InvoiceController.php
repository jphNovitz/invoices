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

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $invoices = invoice::where('user_id', \Auth::user()->id)
            ->orderBy('created_at', 'DESC')
            ->get();

        return view('Invoice.index', [
            'invoices' => $invoices
        ]);
    }

    public function show($id)
    {
        $invoice = invoice::with('Client')
            ->where('id', $id)
            ->first();

        return view('Invoice.show', ['invoice' => $invoice]);
    }

    public function edit($id)
    {
        $invoice = invoice::with('Client')
            ->where('id', $id)
            ->first();

        return view('Invoice.update', ['invoice' => $invoice]);
    }

    public function update()
    {
        die('ok');
    }


    public function create($new_client = null)
    {
        return view('Invoice.create', [
            'clients' => \Auth::user()->clients->unique(),
            'client_id' => $new_client
        ]);
    }


    public function store(Request $request)
    {
        // get the user
        $user = auth()->user();
        $clients = Client::all();
        $client = $clients->find($request->client_id);

        if (null === $user->clients()->find($client->id)) $user->clients()->attach($client);

        // The invoice
        $invoice_datas['reference'] = 'toto';
        $invoice_datas['client_id'] = $client->id;
        $invoice_datas['user_id'] = $user->id;

        $invoice = new invoice();
        $last_added = $invoice->create($invoice_datas);
        $last_id = $last_added->id;

        // The items
        $htva = 0;
        $tva = 0;
        $total = 0;
        foreach ($request->all()['items'] as $item) {
            $items_to_add[] = $item;
            $htva_temp = $item->price * $item->qty - $item->discount;
            $tva_temp = $item->tva;
            $htva += $htva_temp;
            $tva += $tva_temp;
            $total = $htva_temp + $tva_temp;
        }

        $last_added->items()->createMany($items_to_add);

        return redirect(route('invoices_list'))->with('success', 'invoice created');
    }


    public function delete($id = null)
    {
//        if (!$id) return;

        return view('Invoice.delete', [
            'invoice' => invoice::where('id', $id)->first()
        ]);
    }

    public function remove(Request $request)
    {
        if ($request->_decline)  return redirect(route('invoices_list'))->with('message', 'invoice created');
        $invoice = invoice::where('id', $request->_id)->first();
        dd($invoice->id);
    }
}
