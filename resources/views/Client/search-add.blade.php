@extends('layouts.app')

@section('content')
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
                                <a href="{{route('client_create')}}" class="">
                                    {{__('btn.Not_found_create')}}
                                </a>
                                <input type="search" />
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <h3>Rechercher un client à ajouter</h3>
                            </div>
                        </div>
                        @foreach($clients as $client)
                            <div class="row">
                                <div class="col-md-12 grid">
                                    <div class="invoice-list-group">
                                        <div class="row trigger-part">
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
                                            <div class="row invoice-actions">
                                                <a href="{{route('client_add', ['id'=>$client->id])}}"
                                                   class="btn btn-lg btn-primary">
                                                    <i class="fas fa-info"></i>
                                                    {{__('btn.Create_this_client')}}
                                                </a>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        <div class="col-md-12  pt-5">
                            {{$clients->links()}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

