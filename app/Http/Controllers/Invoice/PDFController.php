<?php

namespace App\Http\Controllers\Invoice;



use App\Invoice;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;



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

}