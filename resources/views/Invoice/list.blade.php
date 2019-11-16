<?php
/*
 * list of invoices of a Client
 */
?>
@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h2>Clients {{$client->name}}</h2>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <a href="{{route('client_invoice_create')}}" class="btn btn-primary">Créer une
                                    facture</a>
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
                                                    {{--<div class="col sm-6  d-none d-md-block d-xl-none">a</div>--}}
                                                    <div class="col-12 col-md-4">{{$invoice->created_at->format('d/m/Y')}}</div>
                                                    <div class="col-12 col-md-4">
                                                        Référence: {{$invoice->reference}}</div>
                                                    {{--<div class="col-12 col-md-4">{{$invoice->email}}</div>--}}
                                                </div>
                                                <div class="hidden-part">
                                                    <div class="row">
                                                        <div class="col-12 col-md-4">{{$invoice->firstname}}</div>
                                                        <div class="col-12 col-md-4">{{$invoice->lastname}}</div>
                                                        <div class="col-12 col-md-4">{{$invoice->phone}}</div>
                                                    </div>
                                                    <div class="row invoice-actions">
                                                        <a href="{{route('client_invoices_card', [
                                                    'client'=>$client,
                                                    'invoice' => $invoice->id
                                                    ])}}"
                                                           class="btn btn-sm btn-primary">
                                                            <i class="fas fa-info"></i>
                                                            Détails
                                                        </a>

                                                        <a href="{{route('client_invoices_card', [
                                                    'client'=>$client,
                                                    'invoice' => $invoice->id
                                                    ])}}"
                                                           class="btn btn-sm btn-danger">
                                                            <i class="fas fa-trash"></i>
                                                            Supprimer
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                                {{--<table class="table">--}}
                                {{--<thead>--}}
                                {{--<tr>--}}
                                {{--<th scope="col">#</th>--}}
                                {{--<th scope="col">Référence</th>--}}
                                {{--<th scope="col"></th>--}}
                                {{--</tr>--}}
                                {{--</thead>--}}
                                {{--<tbody>--}}
                                {{--@foreach($invoices as $invoice)--}}
                                {{--<tr>--}}
                                {{--<th scope="row">{{$invoice->id}}</th>--}}
                                {{--<td>{{$invoice->reference}}</td>--}}
                                {{--<td>--}}
                                {{--<a href="{{route('client_invoices_card', [--}}
                                {{--'client'=>$client,--}}
                                {{--'invoice'=>$invoice->id--}}
                                {{--])}}" class="btn btn-sm btn-primary">--}}
                                {{--<i class="fas fa-info"></i>--}}
                                {{--Détail--}}
                                {{--</a>--}}
                                {{--<a href="{{route('client_update', ['client' => $client->id])}}" class="btn btn-sm btn-success">--}}
                                {{--<i class="fas fa-edit"></i>--}}
                                {{--Modifier--}}
                                {{--</a>--}}
                                {{--<a href="{{route('client_invoices_card', [--}}
                                {{--'client'=>$client,--}}
                                {{--'invoice' => $invoice->id--}}
                                {{--])}}"--}}
                                {{--class="btn btn-sm btn-danger">--}}
                                {{--<i class="fas fa-trash"></i>--}}
                                {{--Supprimer--}}
                                {{--</a>--}}
                                {{--</td>--}}
                                {{--</tr>--}}
                                {{--@endforeach--}}
                                {{--</tbody>--}}
                                {{--</table>--}}
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection


