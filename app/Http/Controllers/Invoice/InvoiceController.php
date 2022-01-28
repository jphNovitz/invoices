<?php

namespace App\Http\Controllers\Invoice;

use App\Client;
use App\Http\Controllers\Client\ClientController;
use App\Invoice;
use App\Item;
use App\Vat;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

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
            ->paginate(25);

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

    public function update(Request $request)
    {
        $invoice = Invoice::where('id', $request->id)->first();

        // The items
        $htva = 0;
        $tva = 0;
        $total = 0;

        $items_ids = $invoice->items()->pluck('item_id')->toArray();
        $form_items_ids = array_map(function ($item) {
            if (isset($item['id'])) return $item['id'];
        }, $request->all()['items']);

        $to_remove = array_diff($items_ids, $form_items_ids);

        foreach ($to_remove as $remove) {
            $invoice->items()->detach($remove);
        }

        foreach ($request->all()['items'] as $item) {

            // update the related item
            if (isset($item['id'])) {
                $item_tmp = Item::where('id', $item['id'])->first();
                $item_tmp->fill($item);
                $item_tmp->update();
            } else {
                $item_tmp = Item::create($item);
                $invoice->items()->save($item_tmp);
            }

            // update the invoice totals
            $htva_temp = $item['price'] * $item['qty'] - $item['discount'];
            $vat_rate = Vat::where('id', $item['vat_id'])->first()->rate;
            $tva_temp = $item['price'] * $vat_rate;
            $htva += $htva_temp;
            $tva += $tva_temp;
            $total = $htva_temp + $tva_temp;
        }

        // The invoice

        $invoice_datas['vat'] = $tva;
        $invoice_datas['exvat'] = $htva;
        $invoice_datas['total'] = $total;

        try {
            $invoice->save($invoice_datas);
            return redirect(route('invoices_list'))->with('message', 'invoice updated');
        } catch (QueryException $queryException) {
            return redirect()->back()->with('message', 'Erreur');
        }
    }


    public function create($id = null)
    {
        return view('Invoice.create', [
            'clients' => \Auth::user()->clients->unique(),
            'client_id' => $id
        ]);
    }


    public function store(Request $request)
    {
        // get the user
        $user = auth()->user();
        $clients = Client::all();
        $client = $clients->find($request->client_id);

        if (null === $user->clients()->find($client->id)) $user->clients()->attach($client);

        // The items
        $htva = 0;
        $tva = 0;
        $total = 0;
        foreach ($request->all()['items'] as $item) {

            $items_to_add[] = $item;
            $htva_temp = $item['price'] * $item['qty'] - $item['discount'];
            $vat_rate = Vat::where('id', $item['vat_id'])->first()->rate;
            $tva_temp = $item['price'] * $vat_rate;
            $htva += $htva_temp;
            $tva += $tva_temp;
            $total = $htva_temp + $tva_temp;
        }

        // The invoice
        $last_reference = Invoice::where('user_id', $user->id)
            ->orderBy('id', 'desc')->first()->reference;

        if (!$last_reference) {
            $reference_parts[0] = $user->prefix;
            $reference_parts[1] = --$user->first_id;
        } else $reference_parts = explode('-', $last_reference);

        $invoice_datas['reference'] = $reference_parts[0] . '-' . ++$reference_parts[1];
        $invoice_datas['client_id'] = $client->id;
        $invoice_datas['user_id'] = $user->id;
        $invoice_datas['vat'] = $tva;
        $invoice_datas['exvat'] = $htva;
        $invoice_datas['total'] = $total;

        $invoice = new invoice();
        $last_added = $invoice->create($invoice_datas);
        $last_id = $last_added->id;


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
        if ($request->_decline) return redirect(route('invoices_list'))->with('message', 'invoice created');
        $invoice = invoice::where('id', $request->_id)->first();
        try {
            $invoice->delete();
            $message = 'Facture supprimée';
        } catch (\Exception $e) {
            $message = 'Erreur dans la suppression';
        }
        return redirect()->route('invoices_list')->with('message', 'facture supprimée');
    }
}
