<?php
/** Create Invoice
 *
 */

use Carbon\Carbon;

$user = auth()->user();
//$clients = $user->clients;
$vat_all = \App\Models\Vat::all();
$date = Carbon::now('Europe/Zurich')
?>
@extends('layouts.app')

@section('content')
    <section class="card w-full  mb-10 border p-12px border-slate-200">
        <div class="card-header bg-slate-500 text-slate-50">
            {{__('app.Invoice_update')}}: {{$invoice->reference}}
        </div>
        <div class="card-body  w-full  my-12">
            <div class="flex flex-row justify-start w-full">
                     <span class="button-text ">
                    <a href="{{route('invoices_list')}}">
                        <span class="icon primary">
                            <i class="fas fa-list"></i>
                        </span>
                        <span class="label">
                            {{__('btn.List')}}
                        </span>
                    </a>
                </span>
            </div>
            {{--Invoice HEADER--}}
            @component('component.InvoiceHeader', [
                'invoice' => $invoice,
                'user'=> $user,
                'client'=> $invoice->client])

            @endcomponent
            {{--END Invoice HEADER--}}

            <div class="table-data-wrapper">
                <div class="table-data-header">
                    <div class="w-1/3">
                        Description
                    </div>
                    <div class="middle">
                        <div class="w-16">
                            Prix
                        </div>
                        <div class="w-16">
                            Qty
                        </div>
                        <div class="w-16">
                            TVA
                        </div>
                    </div>
                    <div class="right ">
                        <div class="w-26">
                            Reduc
                        </div>
                        <div class="w-24">

                        </div>
                    </div>
                </div>
                <?php
                echo Form::open(['route' => 'invoice_update', 'method' => 'PUT']); ?>
                <input type="hidden" name="id" value="{{$invoice->id}}"/>
                <?php $id_loop = 0 ?>
                <div id="items" class="flex flex-col  w-full ">
                    @foreach ($invoice->items as $item)
                        <div class="table-data-row">
                            <input type="hidden"
                                   name="items[{{ $id_loop }}][id]"
                                   value="{{$item->id}}"/>
                            <div class="form-row w-full md:w-1/3">
                                <input type="text" id="description[]"
                                       name='items[{{ $id_loop }}][description]'
                                       class="form-control flex flex-wrap"
                                       value="{{$item->description}}"
                                />
                            </div>
                            <div class="middle">
                                <div class="form-row w-16 md:w-16">
                                    <input type="text"
                                           name="items[{{ $id_loop }}][price]"
                                           class="form-control text-slate-900"
                                           value="{{$item->price}}"
                                    />
                                </div>
                                <div class="form-row w-16 md:w-16">
                                    {{--<label for="qty[]">Qty</label>--}}
                                    <input type="number"
                                           name="items[{{ $id_loop }}][qty]"
                                           class="form-control"
                                           min="0" step="1"
                                           value="{{$item->qty}}"
                                    />
                                </div>
                                <div class="form-row w-16">
                                    <select class="custom-select"
                                            name="items[{{ $id_loop }}][vat_id]">
                                        @foreach($vat_all as $vat_one)
                                            <option value="{{$vat_one->id}}"
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
                            <div class="right">
                                <div class="form-row w-16">
                                    {{--<label for="discount[]" class="control-label">Reduc</label>--}}
                                    <input name="items[{{ $id_loop }}][discount]"
                                           type="text"
                                           value="{{$item->discount}}"
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
                    @endforeach

                </div>
                {!! csrf_field() !!}
                <input type="submit" class="info p-2 rounded-md" value="{{__('btn.Update')}}"/>
                <?php
                echo Form::close();
                ?>

            </div>
    </section>
@endsection

