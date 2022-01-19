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
            <h3>Facture: {{$invoice->reference}} du {{$invoice->updated_at}} </h3>

        </section>

        <section class="row mb-5">
            <h2>Detail du client</h2>
        </section>

        <aside class="row mt-5">
            <h3>Attention, la facture n'apparaîtra plus mais sera conservée en base de données</h3>
        </aside>
    </div>
@endsection