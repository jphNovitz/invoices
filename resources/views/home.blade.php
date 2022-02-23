@extends('layouts.app')

@section('content')
    <div class="w-full flex flex-col md:flex-row ">
        <section class="card w-full md:w-1/2 mb-10 md:mb-0 md:mr-2 border p-12px border-slate-200">
            <div class="card-header bg-slate-500 text-slate-50">
                Vos dernières factures
            </div>

            <div class="card-body w-full">
                <div class="list py-4 ">
                    @foreach($invoices as $invoice )
                        <article class="overflow-hidden w-full my-6  flex flex-col justify-between">
                            <div class="w-full flex flex-row justify-between">
                                <div class="font-black flex flex-col ">
                                    {{$invoice->client->company}} ({{$invoice->total }} eur)
                                    <span>Ref: {{$invoice->reference}}</span></div>
                                <div class="actions flex flex-row justify-end">
                               <span class="button primary action-toggle transition-transform ease-in duration-400 p-3 mr-1 w-5 ">
                                <i class="fas fa-chevron-down"></i>
                               </span>
                                    <span class="button info p-3 mx-1 ">
                                    <a href="{{route('invoice_show', ["id"=>$invoice->id])}}">
                                        <i class="fas fa-search-plus"></i>
                                    </a>
                                </span>

                                </div>
                            </div>

                            <ul class="infos flex flex-col h-0 transition-height ease-in duration-600">
                                <li>{{__('auth.Lastname')}}: <strong>{{$invoice->client->lastname}}</strong></li>
                                <li>{{__('auth.Firstname')}}: <strong>{{$invoice->client->firstname}}</strong></li>
                                <li>{{__('auth.Vat')}}: <strong>T{{$invoice->client->vat}}</strong></li>
                                <li>{{__('auth.Email')}}: <strong>{{$invoice->client->email}}</strong></li>
                                <li>{{__('auth.Street')}}: <strong>{{$invoice->client->street}} {{$invoice->client->nr}}</strong></li>
                            </ul>
                        </article>
                        {{--                    {{dd($client)}}--}}
                    @endforeach
                </div>
            </div>
        </section>
        <section class="card w-full md:w-1/2 border p-12px border-slate-200">
            <div class="card-header bg-slate-500 text-slate-50">Proposition</div>

            <div class="card-body w-full">
                <p>Souhaitez vous envoyer créer une facture pour ces clients ?</p>
                <div class="list py-4 ">
                    @foreach($promote_clients as $client )
                        <article class="overflow-hidden w-full my-6  flex flex-col justify-between">
                            <div class="w-full flex flex-row justify-between">
                                <div class="font-black flex flex-col ">
                                    {{$client->company}}
                                    <span>TVA N° {{$client->vat}}</span></div>
                                <div class="actions flex flex-row justify-end">
                               <span class="button primary action-toggle transition-transform ease-in duration-400 p-3 mr-1 w-5 ">
                                <i class="fas fa-chevron-down"></i>
                               </span>
                                    <span class="button info p-3 mx-1 ">
                                    <a href="{{route('client_show', ["client"=>$client->id])}}">
                                        <i class="fas fa-search-plus"></i>
                                    </a>
                                </span>
                                    <span class="button success text-slate-50 p-3 ml-1 ">
                                    <a href="{{route('invoice_create', ["client"=>$client->id])}}">
                                        <i class="fas fa-plus"></i>
                                    </a>
                                </span>
                                </div>
                            </div>

                            <ul class="infos flex flex-col h-0 transition-height ease-in duration-600">
                                <li>{{__('auth.Lastname')}}: <strong>{{$client->lastname}}</strong></li>
                                <li>{{__('auth.Firstname')}}: <strong>{{$client->firstname}}</strong></li>
                                <li>{{__('auth.Email')}}: <strong>{{$client->email}}</strong></li>
                                <li>{{__('auth.Street')}}: <strong>{{$client->street}} {{$client->nr}}</strong></li>
                            </ul>
                        </article>
                        {{--                    {{dd($client)}}--}}
                    @endforeach
                </div>
                <div>

                </div>

            </div>

        </section>
    </div>
@endsection
