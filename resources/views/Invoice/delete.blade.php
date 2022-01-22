<?php
/*
 * delete an invoice
 */
$user = auth()->user();
?>
@extends('layouts.app')
@section('content')
    <div class="container">
        <header class="row mb-5">
            <h1>Souhaitez-vous supprimer cette facture ?</h1>
        </header>

        <section class="row mb-5">
            <h2 class="w-100">Detail de la facture</h2>
            <h3>Facture: {{$invoice->reference}}
                du {{\Carbon\Carbon::parse($invoice->updated_at)->format('d-m-y')}} </h3>

        </section>

        <section class="row mb-5">
            <h2 class="w-100">Detail du client</h2>
            <h3>
                {{$invoice->client->company}}<br/>
                {{$invoice->client->lastname}} {{$invoice->client->firstname}}
            </h3>
        </section>

        <section class="row mb-5">
            <h2>Apercu</h2>
            <ul>
                @foreach($invoice->items as $item)
                    <li>{{$item->description}}</li>
                @endforeach
            </ul>
        </section>

        <section class="row mb-5²">
            <div class="col-md-12 text-center">
                <form action="{{route('invoice_remove')}}" method="post">
                    @csrf
                    <input type="hidden" name="_id" value="{{$invoice->id}}"/>
                    <input type="submit" name="_accept" value="Oui" class="btn btn-success mr-5"/>
                    <input type="submit" name="_decline" value="Non" class="btn btn-danger mr-5"/>
                </form>
            </div>
        </section>

        <aside class="row mt-5">
            <h3>Attention, la facture n'apparaîtra plus mais sera conservée en base de données</h3>
        </aside>
    </div>
@endsection