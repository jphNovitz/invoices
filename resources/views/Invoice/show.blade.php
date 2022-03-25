<?php
/*
 * Invoice Details
 */
$user = auth()->user();
?>
@extends('layouts.app')
@section('content')

    <section class="card w-full  mb-10 border p-12px border-slate-200">
        <div class="card-header bg-slate-500 text-slate-50">
            {{__('app.Invoice_details')}}: {{$invoice->reference}}
        </div>
        <div class="card-body w-full">
            <div class="flex flex-row items-left">
                <span class="button-text ">
                    <a href="{{route('client_create')}}">
                        <span class="icon info">
                            <i class="fas fa-plus"></i>
                        </span>
                        <span class="label">
                            {{__('btn.New')}}
                        </span>
                    </a>
                </span>
                <span class="button-text ">
                    <a href="{{route('clients_search_create')}}">
                        <span class="icon success">
                            <i class="fas fa-search-plus"></i>
                        </span>
                        <span class="label">
                            {{__('btn.Search')}}
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

            <div class="">

                <ul class="p-5 my-6">
                    <li>Date encodage: {{$invoice->created_at}} </li>
                    <li>Date modification: {{$invoice->updated_at}}</li>
                </ul>
            </div>
            <div class="w-full flex flex-row my-12">
                <div class="card w-1/2 ">
                    <div class="card-body p-6">
                        <p class="text-lg font-black">
                            <em>{{$user->company}}</em> <br/>
                            {{$user->tva}} <br/>
                            {{$user->lastname}} {{$user->firstname}}<br/>
                            {{$user->street}} {{$user->nr}} <br/>
                            {{$user->city->code}} {{$user->city->city}} <br/>
                            {{$user->email}}{{$user->phone}}
                        </p>
                    </div>
                </div>
                <div class="card w-max  mt-12">
                    <div class="card-body ">
                        <p class="font-bold border border-slate-300 p-6">
                            {{$invoice->client->company}}</strong> <br/>
                            {{__('auth.Vat')}}: {{$invoice->client->tva}} <br/>
                            {{$invoice->client->lastname}} {{$invoice->client->firstname}}<br/>
                            {{$invoice->client->street}} {{$invoice->client->nr}} <br/>
                            {{$invoice->client->city->code}} {{$invoice->client->city->city}}<br/>
                            {{$invoice->client->email}}<br/>
                            {{$invoice->client->phone}}

                        </p>
                    </div>
                </div>
            </div>
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
                            $vat = \App\Vat::find($item->vat_id);
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
                            <?php echo $item->qty * ($item->price + ($item->price * $vat->rate) - $item->discount)?>
                        </div>
                    </article>
                @endforeach
            </div>
        </div>
    </section>

@endsection


