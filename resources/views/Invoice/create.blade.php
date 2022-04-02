<?php
/** Create Invoice
 *
 */

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

$new_client = \App\Client::where('id', $client_id)->first();
$user = auth()->user();
$date = Carbon::now('Europe/Zurich');
$vat_all = \App\Vat::all();
?>
@extends('layouts.app')

@section('content')
    <section class="card w-full  mb-10 border p-12px border-slate-200">
        <div class="card-header bg-slate-500 text-slate-50">
            {{__('app.Invoice_create')}}
        </div>
        <div class="card-body  w-full  my-12">
            <div class="flex flex-row justify-start w-full">
                 <span class="button-text ">
                        <a id="showClient" href="
                        @if(isset($client))
                        {{route('client_show', ['client'=>$new_client->id])}}
                        @else{{route('client_show', ['client'=>$user->clients[0]])}}
                        @endif
                                ">

                        <span class="icon primary">
                        <i class="fas fa-user"></i>
                        </span>
                        <span class="label">
                            {{__('btn.Client')}}
                        </span>
                    </a>
                </span>
                <span class="button-text ">
                    <a href="{{route('clients_search_create')}}">
                        <span class="icon info">
                            <i class="fas fa-list"></i>
                        </span>
                        <span class="label">
                            {{__('btn.Search/Add')}}
                        </span>
                    </a>
                </span>
            </div>
            <form action="{{route('invoice_store')}}" method="POST">
                @csrf
                <div class="w-full flex flex-row">
                    <div class="hidden md:flex md:flex-col md:w-1/2">
                        <ul>
                            <li class="font-bold">{{$user->company}}</li>
                            <li> {{$user->firstname}} {{$user->lastname}}</li>
                            <li>{{$user->street}} {{$user->nr}} </li>
                            <li> {{$user->city}} </li>
                            <li>Email: {{$user->email}} </li>
                            <li>Téléphone: {{$user->phone}}</li>
                            <li>TVA N°: {{$user->tva}}</li>

                        </ul>
                    </div>
                    <div class="md:w-1/2 p-12 m-12 border border-slate-200">
                        <div class="form-row">
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
                            <div id="show-client-infos">
                                <i>ici les details clients</i>
                            </div>
                        </div>
                    </div>
                </div>
                <!--                        <div id="items">
                                            <div class="row item-row">
                                                    <div class="form-group">
                                                        <input type="text" id="description[]"
                                                               name='items[0][description]'
                                                               class="form-control"
                                                               value=""
                                                        />
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <input type="text"
                                                               name="items[0][price]"
                                                               class="form-control"
                                                               value=""
                                                        />
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <select class="custom-select"
                                                                name="items[0][vat_id]">
                                                            <option value="1">6 %</option>
                                                            <option value="2">12 %</option>
                                                            <option value="3">21 %</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-1">
                                                    <div class="form-group">
                                                        <input type="text"
                                                               name="items[0][qty]"
                                                               class="form-control"
                                                               value=""
                                                        />
                                                    </div>
                                                </div>
                                                <div class="col-md-1">
                                                    <div class="form-group">
                                                        <input name="items[0][discount]"
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

                                        </div>-->
                <?php   $id_loop = 0 ?>
                <div id="items" class="flex flex-col  w-full ">
                    <div class="table-data-row">
                        <input type="hidden"
                               name="items[{{ $id_loop }}][id]"
                               value=""/>
                        <div class="form-row w-full md:w-1/3">
                            <input type="text" id="description[]"
                                   name='items[{{ $id_loop }}][description]'
                                   class="form-control flex flex-wrap"
                                   value=""
                            />
                        </div>
                        <div class="middle">
                            <div class="form-row w-16 md:w-16">
                                <input type="text"
                                       name="items[{{ $id_loop }}][price]"
                                       class="form-control text-slate-900"
                                       value=""
                                />
                            </div>
                            <div class="form-row w-16 md:w-16">
                                <input type="number"
                                       name="items[{{ $id_loop }}][qty]"
                                       class="form-control"
                                       value=""
                                />
                            </div>
                            <div class="form-row w-16">
                                <select class="custom-select"
                                        name="items[{{ $id_loop }}][vat_id]">
                                    @foreach($vat_all as $vat_one)
                                        <option value="{{$vat_one->id}}"
                                                {{--                                                    @if ($vat_one->id == $item->vat->id)--}}
                                                {{--                                                    selected=selected--}}
                                                {{--                                                    @endif--}}
                                        >
                                            {{$vat_one->name}}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                        </div>
                        <div class="right">
                            <div class="form-row w-16">
                                {{--<label for="discount[]" class="control-label">Reduc</label>--}}
                                <input name="items[{{ $id_loop }}][discount]"
                                       type="text"
                                       value=""
                                       class="form-control"
                                />
                            </div>
                            <div class="form-row w-24 justify-between" style="flex-direction: row">
                                <button type="button"
                                        class="button danger  remove-item">
                                    <i class="fa fa-minus" style="pointer-events:none"></i>
                                </button>
                                <button type="button"
                                        class="button success add-item ">
                                    <i class="fa fa-plus" style="pointer-events:none"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <?php $id_loop++ ?>

                </div>
                <input type="submit" class="info p-2 rounded-md" value="{{__('btn.Update')}}"/>

            </form>


        </div>
    </section>

@endsection

