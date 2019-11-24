<?php
/*
 * list of invoices of a Client
 */
$user = auth()->user();
?>
@extends('layouts.app')
@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <h2>{{$user->company}}</h2>
                <p>{{$user->lastname}} {{$user->firstname}}
                    <br/>{{$user->street}} {{$user->nr}}
                    <br/>{{$user->city->code}} {{$user->city->city}}</p>

                <p>
                    Email: {{$user->email}}
                    <br/> Téléphone: {{$user->phone}}
                    <br/> TVA N°: {{$user->tva}}
                </p>
            </div>
            <div class="col-md-4">
                <h2>Facture {{$invoice->reference}}</h2>
                <p>Date encodage: {{$invoice->created_at}} <br/>
                    Date modification: {{$invoice->updated_at}} </p>

            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
            </div>
            <div class="col-md-6">
                <p> {{$invoice->client->company}}
                    <br/>{{$invoice->client->lastname}} {{$invoice->client->firstname}}
                    <br/>{{$invoice->client->street}} {{$invoice->client->nr}}
                </p>

                <p>{{$invoice->client->vat}}
                    <br/>{{$invoice->client->email}}
                </p>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>Description</th>
                        <th>HTVA</th>
                        <th>Taux</th>
                        <th>Quantité</th>
                        <th>Remise</th>
                        <th>Total</th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach($invoice->items as $item)
                        <tr>
                            <td> {{$item->description}}

                            </td>
                            <td> {{$item->price}}</td>
                            <td> <?php
                                $vat = \App\Vat::find($item->vat_id);
                                echo $vat->name; ?></td>
                            <td> {{$item->qty}} </td>
                            <td> {{$item->discount}} </td>
                            <td> <?php echo $item->qty * ($item->price + ($item->price * $vat->rate) - $item->discount)?> </td>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection


