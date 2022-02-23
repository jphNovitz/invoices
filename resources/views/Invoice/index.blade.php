<?php
/*
 * list of invoices of a Client
 */
?>


@extends('layouts.app')

@section('content')
    <section class="card w-full  mb-10 border p-12px border-slate-200">
        <div class="card-header bg-slate-500 text-slate-50">
            Liste de vos factures
        </div>

        <div class="card-body w-full">
            <div class="list py-4 ">
        <span class="button secondary p-3 mx-1 w-40">
            <a href="{{route('invoice_create')}}">
                <i class="fas fa-plus"></i>
            </a>
        </span>
                @foreach($invoices as $invoice )
                    <article
                            class="odd:bg-white even:bg-slate-100 overflow-hidden w-full my-6  px-3 flex flex-col justify-between">
                        <div class="w-full flex flex-row justify-between">
                            <div class="font-black flex flex-col">
                                {{$invoice->client->company}} ({{$invoice->total }} eur)
                                <span>Ref: {{$invoice->reference}}</span></div>
                            <div class="actions flex flex-row justify-end items-center my-auto">
                               <span class="button-text self-start action-toggle transition-transform ease-in duration-400">
                                   <span class="icon primary ">
                                        <i class="fas fa-chevron-down"></i>
                                   </span>
{{--                                   <span class="label ">&nbsp; </span>--}}
                               </span>
                                <div class="button-text">
                                    <a href="{{route('invoice_show', ["id"=>$invoice->id])}}">
                                        <span class="icon info ">
                                            <i class="fas fa-search-plus"></i>
                                        </span>
                                        <span class="label">{{__('btn.Details')}}</span>
                                    </a>
                                </div>
                                <span class="button-text p-3">
                                    <a href="{{route('invoice_show', ["id"=>$invoice->id])}}">
                                        <span class="icon success">
                                             <i class="fas fa-edit"></i>
                                        </span>
                                        <span class="label">
                                            {{__('btn.Update')}}
                                        </span>
                                    </a>
                                </span>
                                <span class="button-text">
                                    <a href="{{route('invoice_show', ["id"=>$invoice->id])}}">
                                        <span class="icon danger">
                                            <i class="fas fa-trash-alt"></i>
                                        </span>
                                        <span class="label">
                                            {{__('btn.Remove')}}
                                        </span>
                                    </a>
                                </span>

                            </div>
                        </div>

                        <ul class="infos flex flex-col h-0 transition-height ease-in duration-600">
                            <li>{{__('auth.Lastname')}}: <strong>{{$invoice->client->lastname}}</strong></li>
                            <li>{{__('auth.Firstname')}}: <strong>{{$invoice->client->firstname}}</strong></li>
                            <li>{{__('auth.Vat')}}: <strong>T{{$invoice->client->vat}}</strong></li>
                            <li>{{__('auth.Email')}}: <strong>{{$invoice->client->email}}</strong></li>
                            <li>{{__('auth.Street')}}:
                                <strong>{{$invoice->client->street}} {{$invoice->client->nr}}</strong></li>
                        </ul>
                    </article>
                    {{--                    {{dd($client)}}--}}
                @endforeach
            </div>
        </div>
        <div class="card-footer bg-slate-200 text-slate-700 flex flex-row justify-center">
            {{ $invoices->links('pagination::tailwind') }}

        </div>
    </section>

@endsection


