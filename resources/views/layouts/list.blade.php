<?php
/*
 * LIST LAYOUT
 */
?>


@extends('layouts.app')

@section('content')
    <section class="card w-full  mb-10 border p-12px border-slate-200">
        <div class="card-header bg-slate-500 text-slate-50">
            Liste de vos blabla
        </div>

        <div class="card-body w-full">
            <div class="list py-4 ">
        <span class="button secondary p-3 mx-1 w-40">
            <a href="{{route($model.'_create')}}">
                <i class="fas fa-plus"></i>
            </a>
        </span>
                @foreach($itemss as $item )
                    <article
                            class="odd:bg-white even:bg-slate-100 overflow-hidden w-full my-6  px-3 flex flex-col justify-between">
                        <div class="w-full flex flex-row justify-between">
                            <div class="font-black flex flex-col">
                                {{$item->client->company}} ({{$item->total }} eur)
{{--                                <span>Ref: {{$item->reference}}</span></div>--}}
{{--                            <div class="actions flex flex-row justify-end items-center my-auto">--}}
{{--                               <span class="button-text self-start action-toggle transition-transform ease-in duration-400">--}}
{{--                                   <span class="icon primary ">--}}
{{--                                        <i class="fas fa-chevron-down"></i>--}}
{{--                                   </span>--}}
{{--                                   <span class="label ">&nbsp; </span>--}}
{{--                               </span>--}}
{{--                                <div class="button-text">--}}
{{--                                    <a href="{{route('invoice_show', ["id"=>$item->id])}}">--}}
{{--                                        <span class="flex m-auto w-7 h-7 items-center justify-center rounded-full info ">--}}
{{--                                            <i class="fas fa-search-plus"></i>--}}
{{--                                        </span>--}}
{{--                                        <span class="hidden flex md:flex flex-col text-sm">{{__('btn.Details')}}</span>--}}
{{--                                    </a>--}}
{{--                                </div>--}}
{{--                                <span class="button-text p-3">--}}
{{--                                    <a href="{{route('invoice_show', ["id"=>$item->id])}}">--}}
{{--                                        <span class="icon success">--}}
{{--                                             <i class="fas fa-edit"></i>--}}
{{--                                        </span>--}}
{{--                                        <span class="label">--}}
{{--                                            {{__('btn.Update')}}--}}
{{--                                        </span>--}}
{{--                                    </a>--}}
{{--                                </span>--}}
{{--                                <span class="button-text">--}}
{{--                                    <a href="{{route('invoice_show', ["id"=>$item->id])}}">--}}
{{--                                        <span class="icon danger">--}}
{{--                                            <i class="fas fa-trash-alt"></i>--}}
{{--                                        </span>--}}
{{--                                        <span class="label">--}}
{{--                                            {{__('btn.Remove')}}--}}
{{--                                        </span>--}}
{{--                                    </a>--}}
{{--                                </span>--}}

{{--                            </div>--}}
{{--                        </div>--}}

{{--                        <ul class="infos flex flex-col h-0 transition-height ease-in duration-600">--}}
{{--                            <li>{{__('auth.Lastname')}}: <strong>{{$item->client->lastname}}</strong></li>--}}
{{--                            <li>{{__('auth.Firstname')}}: <strong>{{$item->client->firstname}}</strong></li>--}}
{{--                            <li>{{__('auth.Vat')}}: <strong>T{{$item->client->vat}}</strong></li>--}}
{{--                            <li>{{__('auth.Email')}}: <strong>{{$item->client->email}}</strong></li>--}}
{{--                            <li>{{__('auth.Street')}}:--}}
{{--                                <strong>{{$item->client->street}} {{$item->client->nr}}</strong></li>--}}
{{--                        </ul>--}}
{{--                    </article>--}}
{{--                    --}}{{--                    {{dd($client)}}--}}
{{--                @endforeach--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <div class="card-footer bg-slate-200 text-slate-700 flex flex-row justify-center">--}}
{{--            {{ $items->links('pagination::tailwind') }}--}}

{{--        </div>--}}
{{--    </section>--}}

@endsection


