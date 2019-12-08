<?php
/** Create Invoice
 *
 */

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

$user = auth()->user();
//$clients = $user->clients;
$vat_all = \App\Vat::all();
$date = Carbon::now('Europe/Zurich')
?>
@extends('layouts.app')

@section('content')
    <div class="container bg-white p-3">
        <div class="grid">
            <div class="row">
                <div class="col-md-12">
                    <h2>
                        Modification facture
                    </h2>
                    <hr/>
                </div>
            </div>
            <div class="row justify-content-end">
                <div class="col-md-4">
                    <em>
                        Le {{$invoice->created_at->isoFormat('DD/MM/YYYY HH:mm')}}
                    </em>
                </div>
            </div>
            <div class="row justify-content-start">
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
                    <?php
                    echo Form::open(['route' => 'home', 'method' => 'POST']);?>
                    <div class="form-group">
                        {{--{!! Form::label('client', 'Client', ['class' => 'control-label']) !!}--}}
                        {{--<select class="form-control" id="select-client">--}}
                        {{--@foreach($clients as $client)--}}
                        {{--<option value="-1">------</option>--}}
                        {{--<option value="{{$client->id}}">{{$client->vat}} - {{$client->company}}</option>--}}
                        {{--@endforeach--}}
                        {{--</select>--}}
                        <?php $client = $invoice->client;?>
                        <div id="show-client-infos">
                            <p><strong>{{$client->company}}</strong>
                                <br/>{{$client->vat}}
                                <br/>{{$client->firstname}} {{$client->lastname}}
                                <br/>{{$client->street}} {{$client->nr}}
                                <br/>{{$client->city}}
                                <br/>{{$client->email}}
                                <br/>{{$client->phone}}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row item-row">
                <div class="col-md-4">
                    Description
                </div>
                <div class="col-md-2">
                    Prix
                </div>
                <div class="col-md-2">
                    TVA
                </div>
                <div class="col-md-1">
                    Qty
                </div>
                <div class="col-md-1">
                    Reduc
                </div>
            </div>
            <div id="items">
                @foreach ($invoice->items as $item)
                    <div class="row item-row">
                        <div class="col-md-4">
                            <div class="form-group">
                                {{--<label for="description[]">Description</label>--}}
                                <input type="text" id="description[]"
                                       name="description"
                                       class="form-control"
                                       value="{{$item->description}}"
                                />
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                {{--<label for="qty[]">Qty</label>--}}
                                <input type="text"
                                       name="price[]"
                                       class="form-control"
                                       value="{{$item->price}}"
                                />
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <select class="custom-select"
                                        name="vat[]">
                                    @foreach($vat_all as $vat_one)
                                        <option value="{{$vat_one->rate}}"
                                                @if ($vat_one->id == $item->vat->id)
                                                selected=selected
                                                @endif
                                        >
                                            {{$vat_one->name}}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-1">
                            <div class="form-group">
                                {{--<label for="qty[]">Qty</label>--}}
                                <input type="text"
                                       name="qty[]"
                                       class="form-control"
                                       value="{{$item->qty}}"
                                />
                            </div>
                        </div>
                        <div class="col-md-1">
                            <div class="form-group">
                                {{--<label for="discount[]" class="control-label">Reduc</label>--}}
                                <input name="discount[]"
                                       type="text"
                                       value="{{$item->qty}}"
                                       class="form-control"
                                />
                            </div>
                        </div>
                        <div class="col-md-2" style="align-items: center">
                            <button type="button"
                                    class="btn btn-danger remove-item">
                                <i class="fa fa-minus" style="pointer-events:none"></i>
                            </button>
                            <button type="button"
                                    class="btn btn-primary add-item">
                                <i class="fa fa-plus" style="pointer-events:none"></i>
                            </button>
                        </div>
                    </div>
                @endforeach
            </div>
            <?php
            echo Form::close();
            ?>
        </div>
    </div>
@endsection

