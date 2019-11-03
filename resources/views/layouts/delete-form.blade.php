@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h2>{{$form_title}}</h2>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">

                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-10">
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <p>Veuillez corriger les erreur !</p>

                                    </div>
                                @endif
                                <?php
                                echo Form::open(['route' => $route, 'method' => $method]);
                                echo Form::hidden('id', $client->id);
                                ?>
                                <p>
                                    Vous confirmez la suppression ?
                                    <br/>
                                    <?php echo $model_infos?>
                                </p>
                                <?php
                                echo Form::submit('Supprimer', ['class' => 'btn btn-danger']);
                                ?>
                                <a href="{{$route_cxl}}"
                                   class="btn btn-primary">
                                    Annuler
                                </a>

                                <?
                                echo Form::close();
                                ?>
                            </div>
                        </div>

                    </div>

                </div>

            </div>

        </div>
    </div>
@endsection
