@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{$user->name}} ({{$user->company}}) - TVA: {{$user->tva}}</div>

                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <p>{{$user->name}}: Voici votre profil</p>
                        <ul>
                            <li><strong>Prenom: </strong> {{$user->firstname}}</li>
                            <li><strong>Nom: </strong> {{$user->lastname}}</li>
                            <li><strong>Utilisateur: </strong> {{$user->name}}</li>
                            <li><strong>Entreprise: </strong> {{$user->company}}</li>
                            <li><strong>TVA: </strong> {{$user->tva}}</li>
                            <li><strong>Rue: </strong> {{$user->street}}, {{$user->nr}}</li>
                            <li><strong>Localité: </strong> {{$user->city->code}} {{$user->city->city}}</li>
                            <li><strong>Téléphone: </strong> {{$user->phone}}</li>
                            <li><strong>Email: </strong> {{$user->email}}</li>

                        </ul>
                    <a href="{{route('user_update')}}" class="btn btn-primary">Modifier</a>
                    <a href="" class="btn btn-danger">Supprimer</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
