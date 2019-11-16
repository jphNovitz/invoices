<?php
/*
 * list of invoices of a Client
 */
?>
@extends('layouts.app')

@section('content')

    @foreach($invoice->items as $item)
        {{$item->id}} -  {{$item->description}} - {{$item->price}} - {{$item->qty}} - {{$item->discount}} <br />
    @endforeach
@endsection


