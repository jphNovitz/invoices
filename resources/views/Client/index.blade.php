<?php
/*
 * list of clients
 */
?>

@extends('layouts.app')

@section('content')
    <section class="card w-full  mb-10 border p-12px border-slate-200">
        <div class="card-header bg-slate-500 text-slate-50">
            Liste de vos clients
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
                <span class="button-text ">
                    <a href="{{route('clients_search_create')}}">
                        <span class="icon success">
                            <i class="fas fa-search-plus"></i>
                        </span>
                        <span class="label">
                            {{__('btn.Search/Add')}}
                        </span>
                    </a>
                </span>
            </div>
            <div class="list py-4 ">
                @foreach($clients as $client )
                    <article
                            class="odd:bg-white even:bg-slate-100 overflow-hidden w-full my-6  px-3 flex flex-col justify-between">
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
                                <div class="button-text">
                                    <a href="{{route('client_show', ["client"=>$client->id])}}">
                                        <span class="flex m-auto w-7 h-7 items-center justify-center rounded-full info ">
                                            <i class="fas fa-search-plus"></i>
                                        </span>
                                        <span class="hidden flex md:flex flex-col text-sm">{{__('btn.Details')}}</span>
                                    </a>
                                </div>
                                <span class="button-text ">
                                    <a href="{{route('client_update', ["client"=>$client->id])}}">
                                        <span class="icon success">
                                             <i class="fas fa-edit"></i>
                                        </span>
                                        <span class="label">
                                            {{__('btn.Update')}}
                                        </span>
                                    </a>
                                </span>
                                <span class="button-text">
                                    <a href="{{route('client_delete', ["client"=>$client->id])}}">
                                        <span class="icon danger">
                                            <i class="fas fa-trash-alt"></i>
                                        </span>
                                        <span class="label">
                                            {{__('btn.Remove')}}
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
                    {{--                    {{dd($client)}}--}}
                @endforeach
            </div>
        </div>
        <div class="card-footer bg-slate-200 text-slate-700 flex flex-row justify-center">
            {{ $clients->links('pagination::tailwind') }}

        </div>
    </section>

@endsection




{{--
@extends('layouts.list', [
    "items"=> $clients,
    "model"=> 'client'
    ])
--}}

{{--
@extends('layouts.app')

@section('content')
    @if(Session::has('message'))
        <p class="alert alert-info">{{ Session::get('message') }}</p>
    @endif
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h2>Clients</h2>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <a href="{{route('client_create')}}" class="btn btn-primary">
                                    {{__('btn.New_client')}}
                                </a>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <h3>Liste des clients</h3>
                            </div>
                        </div>
                        @foreach($clients as $client)
                            <div class="row">
                                <div class="col-md-12 grid">
                                    <div class="client-list-group">
                                        <div class="row trigger-part">
                                            --}}
{{--<div class="col sm-6  d-none d-md-block d-xl-none">a</div>--}}{{--

                                            <div class="col-12 col-md-4">{{$client->company}}</div>
                                            <div class="col-12 col-md-4">{{$client->vat}}</div>
                                            <div class="col-12 col-md-4">{{$client->email}}</div>
                                        </div>
                                        <div class="hidden-part">
                                            <div class="row">
                                                <div class="col-12 col-md-4">{{$client->firstname}}</div>
                                                <div class="col-12 col-md-4">{{$client->lastname}}</div>
                                                <div class="col-12 col-md-4">{{$client->phone}}</div>
                                            </div>
                                            <div class="row client-actions">
                                                <a href="{{route('client_show', ['client'=>$client->id])}}"
                                                   class="btn btn-sm btn-primary">
                                                    <i class="fas fa-info"></i>
                                                    {{__('Detail')}}
                                                </a>
                                                <a href="{{ route('client_create', ['new_client' => $client->id]) }}"
                                                   class="btn btn-sm btn-primary">
                                                    <i class="fas fa-info"></i>
                                                    {{__('btn.New_client')}}
                                                </a>
                                                @if(Auth::user() && Auth::user()->role == 'admin')
                                                    <a href="{{route('client_update', ['client' => $client->id])}}"
                                                       class="btn btn-sm btn-success">
                                                        <i class="fas fa-edit"></i>
                                                        {{__('Update')}}
                                                    </a>
                                                    <a href="{{route('client_delete', ['client' => $client->id])}}"
                                                       class="btn btn-sm btn-danger">
                                                        <i class="fas fa-trash"></i>
                                                        {{__('Remove')}}
                                                    </a>
                                                @endif

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
--}}
{{--                        <div class="row">--}}{{--

--}}
{{--                            <div class="col-md-12">--}}{{--


--}}
{{--                                <h3>Liste des clients</h3>--}}{{--


--}}
{{--                                <table class="table">--}}{{--

--}}
{{--                                    <thead>--}}{{--

--}}
{{--                                    <tr>--}}{{--

--}}
{{--                                        <th scope="col">#</th>--}}{{--

--}}
{{--                                        <th scope="col">Entreprise</th>--}}{{--

--}}
{{--                                        <th scope="col">Prénom</th>--}}{{--

--}}
{{--                                        <th scope="col">Nom</th>--}}{{--

--}}
{{--                                        <th scope="col">Télephone</th>--}}{{--

--}}
{{--                                        <th scope="col">email</th>--}}{{--

--}}
{{--                                        <th scope="col"></th>--}}{{--

--}}
{{--                                    </tr>--}}{{--

--}}
{{--                                    </thead>--}}{{--

--}}
{{--                                    <tbody>--}}{{--

--}}
{{--                                    @foreach($clients as $client)--}}{{--

--}}
{{--                                        <tr>--}}{{--

--}}
{{--                                            <th scope="row">{{$client->id}}</th>--}}{{--

--}}
{{--                                            <td>{{$client->company}}</td>--}}{{--

--}}
{{--                                            <td>{{$client->firstname}}</td>--}}{{--

--}}
{{--                                            <td>{{$client->lastname}}</td>--}}{{--

--}}
{{--                                            <td>{{$client->phone}}</td>--}}{{--

--}}
{{--                                            <td>{{$client->email}}</td>--}}{{--

--}}
{{--                                            <td>--}}{{--

--}}
{{--                                                <a href="{{route('client_card', ['client'=>$client->id])}}"--}}{{--

--}}
{{--                                                   class="btn btn-sm btn-primary">--}}{{--

--}}
{{--                                                    <i class="fas fa-info"></i>--}}{{--

--}}
{{--                                                    Détail--}}{{--

--}}
{{--                                                </a>--}}{{--

--}}
{{--                                                <a href="{{route('client_update', ['client' => $client->id])}}"--}}{{--

--}}
{{--                                                   class="btn btn-sm btn-success">--}}{{--

--}}
{{--                                                    <i class="fas fa-edit"></i>--}}{{--

--}}
{{--                                                    Modifier--}}{{--

--}}
{{--                                                </a>--}}{{--

--}}
{{--                                                <a href="{{route('client_delete', ['client' => $client->id])}}"--}}{{--

--}}
{{--                                                   class="btn btn-sm btn-danger">--}}{{--

--}}
{{--                                                    <i class="fas fa-trash"></i>--}}{{--

--}}
{{--                                                    Supprimer--}}{{--

--}}
{{--                                                </a>--}}{{--



--}}
{{--                                            </td>--}}{{--

--}}
{{--                                        </tr>--}}{{--

--}}
{{--                                    @endforeach--}}{{--

--}}
{{--                                    </tbody>--}}{{--

--}}
{{--                                </table>--}}{{--

--}}
{{--                            </div>--}}{{--

--}}
{{--                        </div>--}}{{--


                    </div>
                    <div class="col-md-12  pt-5">
                        {{$clients->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script type="javascript">
        alert();

    </script>
@endpush
--}}
