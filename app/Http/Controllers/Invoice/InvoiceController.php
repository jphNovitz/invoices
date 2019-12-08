<?php

namespace App\Http\Controllers\Invoice;

use App\client;
use App\Http\Controllers\Client\ClientController;
use App\invoice;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class InvoiceController extends Controller
{
    public function index(client $client){
        $invoices = invoice::where('client_id', $client->id)->orderBy('created_at', 'DESC')->get();
        return view('Invoice.list', [
            'client'=>$client,
            'invoices' => $invoices
        ]);
    }

    public function card(client $client, invoice $invoice){

        return view('Invoice.card', ['client'=>$client, 'invoice'=> $invoice]);
    }
    /* idem au dessus choisir un ou voir differences */
    public function show($id){

        $invoice = invoice::with('Client')->where('id', $id)->first();
        $total = 0;
        foreach ($invoice->items as $item):
            $total  += ((int)$item->price*(float)$item->vat['rate'] + (int)$item->price ) *(int)$item->qty - (int)$item->discount;
        endforeach;
        return view('Invoice.show', ['invoice'=> $invoice, 'total' => $total]);
    }

    public function edit($id){
        $invoice = invoice::with('Client')->where('id', $id)->first();
        return view('Invoice.update', ['invoice'=>$invoice]);
    }
    public function update(){
        die('ok');
    }

    public function delete(client $client, invoice $invoice){
        dump($client);
        dump($invoice);
        die();
    }



    public function create(){
        return view('Invoice.create');
    }
}
