<?php

namespace App\Http\Controllers\Invoice;



use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;



class PDFController extends Controller

{

    /**

     * Display a listing of the resource.

     *

     * @return \Illuminate\Http\Response

     */

    public function generatePDF()

    {

        $data = [

            'title' => 'Welcome to invoce PDF TEST',

            'date' => date('m/d/Y')

        ];



        $pdf = PDF::loadView('Invoice.pdf', $data);



        return $pdf->download('test.pdf');

    }

}