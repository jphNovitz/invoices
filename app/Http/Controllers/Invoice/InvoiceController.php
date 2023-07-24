<?php

namespace App\Http\Controllers\Invoice;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\Invoice;
use App\Models\Item;
use App\Models\Vat;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

    public function show(Invoice $invoice)
    {
        return view('Invoice.show', ['invoice' => $invoice]);
    }

    public function edit(Invoice $invoice)
    {
        return view('Invoice.edit', ['invoice' => $invoice]);
    }

    public function update(Request $request, Invoice $invoice = null)
    {
        $validatedData = $request->validate([
            "items.*.id" => ['max:255'],
            "items.*.description" => ['required', 'max:255'],
            "items.*.price" => ['required', 'numeric'],
            "items.*.qty" => ['required', 'numeric'],
            "items.*.vat_id" => ['required', 'integer'],
            "items.*.discount" => ['required', 'numeric'],
        ]);

        // The items
        $htva = 0;
        $tva = 0;
        $total = 0;

        $items_ids = $invoice->items()->pluck('item_id')->toArray();

        $form_items_ids = array_map(function ($item) {
            if (isset($item['id'])) return $item['id'];
        }, $validatedData['items']);

        $to_remove = array_diff($items_ids, $form_items_ids);

        foreach ($to_remove as $remove) {
            $invoice->items()->detach($remove);
        }

        foreach ($validatedData['items'] as $item) {

            // update the related item
            if (isset($item['id']) && $item_tmp = Item::where('id', $item['id'])->first()) {
                $item_tmp->fill($item);
                $item_tmp->update();
            } else {
                $item_tmp = Item::create($item);
                $invoice->items()->save($item_tmp);
            }

            // update the invoice totals
            $htva_temp = $item['price'] * $item['qty'] - $item['discount'];
            $vat_rate = Vat::where('id', $item['vat_id'])->first()->rate;
            $tva_temp = $htva_temp * $vat_rate;
//            $tva_temp = $item['price'] * $vat_rate;
            $htva += $htva_temp;
            $tva += $tva_temp;
            $total += ($htva_temp + $tva_temp);

        }

        // The invoice

        $invoice_datas['vat'] = $tva;
        $invoice_datas['exvat'] = $htva;
        $invoice_datas['total'] = $total;

        $invoice->update($invoice_datas);
        return redirect(route('invoices_list'))->with('alert-success', 'invoice updated');
    }


    public function create()
    {
        return view('Invoice.create', [
            'clients' => \Auth::user()->clients->unique()
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
            $tva_temp = $htva_temp * $vat_rate;
//            $tva_temp = $item['price'] * $vat_rate;
            $htva += $htva_temp;
            $tva += $tva_temp;
            $total = $total + ($htva_temp + $tva_temp);

        }

        // The invoice
        $lastInvoice = Invoice::latest()->first();

        $refNumber = ($lastInvoice !== null) ? explode('-', $lastInvoice->reference)[1] : 1;
        $invoice_datas['reference'] = $user->prefix . '-' . ++$refNumber;
        $invoice_datas['client_id'] = $client->id;
        $invoice_datas['user_id'] = $user->id;
        $invoice_datas['vat'] = $tva;
        $invoice_datas['exvat'] = $htva;
        $invoice_datas['total'] = $total;

        $invoice = new invoice();
        $last_added = $invoice->create($invoice_datas);
        $last_id = $last_added->id;

        $last_added->items()->createMany($items_to_add);

        return redirect(route('invoices_list'))->with('alert-success', 'invoice created');
    }


    public function delete(Invoice $invoice = null)
    {
        return view('Invoice.delete', [
            'invoice' => $invoice
        ]);
    }

    public function remove(Request $request, Invoice $invoice)
    {
        if ($request->_decline) return redirect(route('invoices_list'))->with('alert-info', 'annulé');

        $invoice->delete();

        return redirect(route('invoices_list'))->with('alert-success', 'Facture supprimée');
    }
}
