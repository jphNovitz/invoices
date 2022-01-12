<?php
/** Create Invoice
 *
 */

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

$new_client = \App\Client::where('id', $client_id)->first();
$user = auth()->user();
$date = Carbon::now('Europe/Zurich')
?>
@extends('layouts.app')

@section('content')
    <div class="container bg-white p-3">
        <div class="grid">
            <div class="row">
                <div class="col-md-12">
                    <h2>
                        Nouvelle facture
                    </h2>
                    <hr/>
                </div>
            </div>
            <div class="row justify-content-end">
                <div class="col-md-4">
                    <em>
                        Le {{$date->isoFormat('DD/MM/YYYY HH:mm')}}
                    </em>
                </div>
            </div>
            <div class="row justify-content-start">
                <div class="col-md-12 ">
                    <form action="{{route('client_invoice_store')}}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-4">

                                <h3 class="company">{{$user->company}}</h3>
                                <p>
                                    {{$user->firstname}} {{$user->lastname}} <br/>
                                    {{$user->street}} {{$user->nr}} <br/>
                                    {{$user->city}} <br/>
                                    Email: {{$user->email}} <br/>
                                    Téléphone: {{$user->phone}}
                                </p>
                                <p><strong>
                                        TVA N°: {{$user->tva}}
                                    </strong></p>
                            </div>
                            <div class="col-md-4" style="padding-top: 50px;">

                                <div class="form-group">
                                    <label for="select-client">Client</label>
                                    <select class="form-control" id="select-client" name="client_id">
                                        @if($new_client)
                                            <option value="{{$new_client->id}}" selected="selected">{{$new_client->vat}}
                                                - {{$new_client->company}}</option>
                                        @endif
                                        @foreach($clients as $client)
                                            <option value="{{$client->id}}">{{$client->vat}}
                                                - {{$client->company}}</option>
                                        @endforeach
                                    </select>
                                    <a href="{{Route('clients_home')}}"> Rechercher un client</a>
                                    <div id="show-client-infos">

                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div id="items">
                                    <div class="row item-row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <input type="text" id="description[]"
                                                       name="items[0]['description']"
                                                       class="form-control"
                                                       value=""
                                                />
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <input type="text"
                                                       name="items[0]['price']"
                                                       class="form-control"
                                                       value=""
                                                />
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <select class="custom-select"
                                                        name="item[]['vat']">
                                                    <option value="0.06">6 %</option>
                                                    <option value="0.12">12 %</option>
                                                    <option value="0.21">21 %</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-1">
                                            <div class="form-group">
                                                <input type="text"
                                                       name="item[]['qty']"
                                                       class="form-control"
                                                       value=""
                                                />
                                            </div>
                                        </div>
                                        <div class="col-md-1">
                                            <div class="form-group">
                                                <input name="item[]['discount']"
                                                       type="text"
                                                       value=""
                                                       class="form-control"
                                                />
                                            </div>
                                        </div>
                                        <div class="col-md-2" style="align-items: center">
                                            <button type="button"
                                                    class="btn btn-primary add-item">
                                                <i class="fa fa-plus" style="pointer-events:none"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button type="submit"> envoi</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection

