<?php
/*
 * delete a client
 */
//$user = auth()->user();
?>
@extends('layouts.app')
@section('content')
    <section class="card w-full  mb-10 border p-12px border-slate-200">
        <div class="card-header bg-slate-500 text-slate-50">
            {{__('app.Client_delete')}}: {{$client->company}}
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

            </div>
            <div class="relative">
                <div class="card w-full md:w-1/2">
                    <div class="card-body p-6">
                        <ul class="text-lg ">
                            <li>{{__('auth.Company')}}: <strong>{{$client->company}}</strong></li>
                            <li>{{__('auth.Vat')}}: <strong>{{$client->vat}}</strong></li>
                            <li>{{__('auth.Lastname')}}: <strong>{{$client->lastname}}</strong></li>
                            <li>{{__('auth.Firstname')}} : <strong>{{$client->firstname}}</strong></li>
                            <li>{{__('auth.Street')}}: <strong>{{$client->street}} {{$client->nr}}</strong></li>
                            <li>{{__('auth.Post_code')}}: <strong>{{$client->city->code}}</strong></li>
                            <li>{{__('auth.City')}}: <strong>{{$client->city->city}}</strong></li>
                            <li>{{__('auth.Email')}}: <strong>{{$client->email}}</strong></li>
                            <li>{{__('auth.Phone')}}: <strong>{{$client->phone}}</strong></li>
                        </ul>
                    </div>
                </div>
                @component('component.DeleteConfirm', [
                           'route' => 'client_remove',
                           'confirm_message' => 'app.Confirm_delete_client',
                           'id' => $client->id,
                           'params' => ['client' => $client->id]
                           ])
                @endcomponent
            </div>
        </div>
        </section>
@endsection

