<?php
/*
 * delete an invoice
 */
$user = auth()->user();
?>
@extends('layouts.app')
@section('content')
    <section class="card w-full  mb-10 border p-12px border-slate-200">
        <div class="card-header bg-slate-500 text-slate-50">
            {{__('app.Invoice_delete')}}: {{$invoice->reference}}
        </div>
        <div class="card-body w-full">
            <div class="flex flex-row items-left">
                <span class="button-text ">
                    <a href="{{route('invoice_create', ['id'=>$invoice->client->id])}}">
                        <span class="icon info">
                            <i class="fas fa-plus"></i>
                        </span>
                        <span class="label">
                            {{__('btn.New')}}
                        </span>
                    </a>
                </span>
                <span class="button-text ">
                    <a href="{{route('invoice_generate_pdf', ["id"=>$invoice->id])}}">
                        <span class="icon bg-white text-red-600 border border-red-600">
                            <i class="fas fa-file-pdf"></i>
                        </span>
                        <span class="label">
                            {{__('btn.Download')}}
                        </span>
                    </a>
                </span>
                <span class="button-text ">
                    <a href="{{route('invoice_send_pdf', ["id"=>$invoice->id])}}">
                        <span class="icon bg-white text-blue-600 border border-blue-600">
                            <i class="fas fa-envelope"></i>
                        </span>
                        <span class="label">
                            {{__('btn.Send')}}
                        </span>
                    </a>
                </span>
            </div>

            <div class="relative">
                {{--Invoice HEADER--}}
                @component('component.InvoiceHeader', [
                    'invoice' => $invoice,
                    'user'=> $user,
                    'client'=> $invoice->client])
                    ])

                @endcomponent
                {{--END Invoice HEADER--}}
                <div class="list flex flex-col w-full">
                    <article class="w-full hidden md:flex md:flex-row justify-between bg-slate-300 p-6">
                        <div class="w-1/2 ">
                            {{__('app.Description')}}
                        </div>
                        <div class="w-12 mx-3">
                            {{__('app.Price')}}
                        </div>
                        <div class="w-12 mx-3">
                            {{__('app.Vat')}}
                        </div>
                        <div class="w-12 mx-3">
                            {{__('app.Quantity')}}
                        </div>
                        <div class="w-12 mx-3">
                            {{__('app.Discount')}}
                        </div>
                        <div class="w-12 mx-3">
                            {{__('app.Total')}}
                        </div>
                    </article>
                    @foreach($invoice->items as $item)
                        <article
                                class="w-full flex flex-col md:flex-row justify-between odd:bg-white even:bg-slate-100 md:even:bg-white md:odd:bg-slate-100 p-6">
                            <div class="w-full md:w-1/2 before:block before:content-['Description'] before:font-bold md:before:content-[''] ">
                                {{$item->description}}
                            </div>
                            <div class="w-12 md:mx-3  before:block before:content-['Prix'] before:font-bold md:before:content-[''] ">
                                {{$item->price}}
                            </div>
                            <div class="w-12 md:mx-3 before:block before:content-['Tva'] before:font-bold md:before:content-[''] ">
                                    <?php
                                    $vat = \App\Models\Vat::find($item->vat_id);
                                    echo $vat->name;
                                    ?>
                            </div>
                            <div class="w-12 md:mx-3 before:block before:content-['Quantité'] before:font-bold md:before:content-[''] ">
                                {{$item->qty}}
                            </div>
                            <div class="w-12 md:mx-3 before:block before:content-['Remise'] before:font-bold md:before:content-[''] ">
                                {{$item->discount}}
                            </div>
                            <div class="w-12 md:mx-3 before:block before:content-['Total'] before:font-bold md:before:content-[''] ">
                                    <?php echo $item->qty * ($item->price + ($item->price * $vat->rate) - $item->discount) ?>
                            </div>
                        </article>
                    @endforeach
                </div>

                @component('component.DeleteConfirm', [
                            'route' => 'invoice_remove',
                            'confirm_message' => 'app.Confirm_delete',
                            'id' => $invoice->id
                            ])
                @endcomponent

            </div>
        </div>

@endsection