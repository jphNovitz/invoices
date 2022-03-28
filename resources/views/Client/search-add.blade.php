@extends('layouts.app')

@section('content')
    <section class="card w-full  mb-10 border p-12px border-slate-200">
        <div class="card-header bg-slate-500 text-slate-50">
            {{__('app.Find_client_add')}}
        </div>

        <div class="card-body w-full">
            <div class="flex flex-row items-left">
                <span class="button-text ">
                    <a href="{{route('client_create')}}">
                        <span class="icon info">
                            <i class="fas fa-plus"></i>
                        </span>
                        <span class="label">
                            {{__('btn.New_client')}}
                        </span>
                    </a>
                </span>
            </div>
            <div class="list py-4 ">
                @foreach($clients as $client)
                    <article
                            class="even:bg-white odd:bg-slate-100 overflow-hidden w-full my-6  px-3 flex flex-col justify-between">
                        <div class="w-full flex flex-row justify-between">
                            <div class="font-black flex flex-col">
                                {{$client->company}}
                                <span>
                                    <strong>{{$client->lastname}}</strong>
                                    <strong>{{$client->firstname}}</strong>
                                </span>
                            </div>
                            <div class="actions flex flex-row justify-end items-center my-auto">
                                <span class="button-text self-start action-toggle transition-transform ease-in duration-400">
                                   <span class="icon primary ">
                                        <i class="fas fa-chevron-down"></i>
                                   </span>
                               </span>
                                <span class="button-text">
                                    <a href="{{route('client_add', ['id'=>$client->id])}}">
                                        <span class="flex m-auto w-7 h-7 items-center justify-center rounded-full success ">
                                            <i class="fas fa-plus"></i>
                                        </span>
                                        <span class="hidden flex md:flex flex-col text-sm">
                                            {{__('btn.Create_this_client')}}
                                        </span>
                                    </a>
                                </span>

                            </div>
                        </div>

                        <ul class="infos flex flex-col h-0 transition-height ease-in duration-600">
                            <li>{{__('auth.Lastname')}}: <strong>{{$client->lastname}}</strong></li>
                            <li>{{__('auth.Firstname')}}: <strong>{{$client->firstname}}</strong></li>
                            <li>{{__('auth.Vat')}}: <strong>T{{$client->vat}}</strong></li>
                            <li>{{__('auth.Email')}}: <strong>{{$client->email}}</strong></li>
                            <li>{{__('auth.Street')}}:
                                <strong>{{$client->street}} {{$client->nr}}</strong></li>
                        </ul>
                    </article>
                @endforeach
            </div>
        </div>
        <div class="card-footer bg-slate-200 text-slate-700 flex flex-row justify-center">
            {{ $clients->links('pagination::tailwind') }}

        </div>
    </section>
@endsection

