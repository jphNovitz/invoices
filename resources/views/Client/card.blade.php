@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h2>Client: {{$client->company}}</h2>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <p>
                                <a href="{{route('clients_create')}}" class="btn btn-primary">Ajouter</a>
                                <a href="{{route('clients_home')}}" class="btn btn-primary">Liste</a>
                                </p>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="card-title">
                                    <h3> {{$client->company}} </h3>
                                </div>
                                <div class="card-subtitle">
                                    <h3>TVA N°: <strong>{{$client->vat}}</strong> </h3>
                                </div>
                                <hr>
                                <div class="card-text">
                                    <p>
                                        <strong>Email:</strong> {{$client->email}} <br />
                                        <strong>Téléphone: </strong> {{$client->phone}}
                                    </p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                    <div class="card-text">
                                        <p>
                                            <strong>Nom: </strong> {{$client->lastname}} <br />
                                            <strong>Prénom: </strong>{{$client->firstname}}
                                        </p>
                                        <p>
                                            <strong>Rue: </strong> {{$client->street}} {{$client->nr}} <br />
                                            <strong>Localité: </strong> {{$client->city}}
                                        </p>
                                        <p>
                                        </p>
                                    </div>
                                </div>
                        </div>
                        <div class="row justify-content-center">
                            <div class="col-md-3">
                                <a href="{{route('client_update', ['client' => $client->id])}}" class="btn btn-primary">
                                    <i class="fas fa-edit"></i> Modifier</a>
                                <a href="{{route('client_delete', ['client' => $client->id])}}" class="btn btn-danger">
                                    <i class="fas fa-trash"></i> supprimer</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
