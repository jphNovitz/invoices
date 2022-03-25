<?php

namespace App\Http\Controllers\Invoice;



use App\Invoice;
use App\Mail\InvoiceMail;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;


class PDFController extends Controller

{
    public function __construct()
    {
        $this->middleware('auth');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function generatePDF($id)
    {
        $user = \Auth::user();
        $invoice = Invoice::where('id', $id)->first();
        $pdf = PDF::loadView('Invoice.pdf', compact('invoice', 'user'));

        return $pdf->download(str_replace(" ", "_",$invoice->client->company.$invoice->created_at.'.pdf'));

//        return view('Invoice.pdf', compact('invoice', 'user'));
    }

    public function sendPDF($id){


        $invoice = Invoice::where('id', $id)->first();

        try {
            Mail::to($invoice->client->email)
                ->send(new InvoiceMail($invoice));
            return redirect()->route('invoice_show', ['id' => $invoice->id])->with('message', 'Invoice_sent');
        }catch (\Exception $e){
            return redirect()->route('invoice_show', ['id' => $invoice->id])->with('message', 'Error');
        }
    }

}