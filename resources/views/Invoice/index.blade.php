<?php
/*
 * list of invoices of a Client
 */
?>


@extends('layouts.app')

@section('content')
    @if(Session::has('message'))
        <p class="alert alert-info">{{ Session::get('message') }}</p>
    @endif
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h2>Factures</h2>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <a href="{{route('invoice_create')}}" class="btn btn-primary">
                                    {{__('btn.New_invoice')}}
                                </a>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">

                                <h3>Liste des factures</h3>
                                @foreach($invoices as $invoice)
                                    <div class="row">
                                        <div class="col-md-12 grid">
                                            <div class="invoice-list-group">
                                                <div class="row trigger-part">
                                                    <div class="col sm-6  d-none d-md-block d-xl-none">a</div>
                                                    <div class="col-12 col-md-2">{{$invoice->created_at->format('d/m/Y')}}</div>
                                                    <div class="col-12 col-md-4">
                                                        Réf: {{$invoice->reference}}</div>
                                                    <div class="col-12 col-md-4">{{$invoice->client->company}}</div>
                                                    <div class="col-12 col-md-2">
                                                        @if($invoice->total) {{$invoice->total}}
                                                        @else N/A
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="hidden-part">
                                                    <div class="row">
                                                        <div class="col-12 col-md-4">
                                                            TVA N° {{$invoice->client->vat}}
                                                        </div>
                                                        <div class="col-12 col-md-4">
                                                            {{$invoice->client->lastname}} {{$invoice->client->firstname}}
                                                        </div>
                                                        <div class="col-12 col-md-2">
                                                            <strong>HTVA: </strong>
                                                            @if($invoice->exvat)
                                                                {{$invoice->exvat}}
                                                            @else N/A
                                                            @endif
                                                        </div>
                                                        <div class="col-12 col-md-2">
                                                            <strong>TVA: </strong>
                                                            @if($invoice->vat)
                                                                {{$invoice->vat}}
                                                            @else N/A
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="row invoice-actions">

                                                        <a href="{{route('invoice_show', ['id'=>$invoice->id])}}"
                                                           class="btn btn-sm btn-primary">
                                                            <i class="fas fa-info"></i>
                                                            {{__('btn.Details')}}
                                                        </a>

                                                        <a href="{{route('invoice_edit', ['id'=>$invoice->id])}}"
                                                           class="btn btn-sm btn-primary">
                                                            <i class="fas fa-info"></i>
                                                            {{__('btn.Update')}}
                                                        </a>

                                                        <a href="{{route('invoice_delete', ['id'=>$invoice->id])}}"
                                                           class="btn btn-sm btn-danger">
                                                            <i class="fas fa-trash"></i>
                                                            {{__('btn.Remove')}}
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach

                            </div>
                            <div class="col-md-12  pt-5">
                            {{$invoices->links()}}
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection


