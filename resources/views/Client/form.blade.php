@extends('layouts.app')
<?php
$cities = \App\City::all();
?>
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
                                <div class="form-group row">
                                    <?php
                                    echo Form::label('company', __('Company'), ['class' => 'col-md-4 col-form-label text-md-right']);
                                    ?>

                                    <div class="col-md-6">
                                        <?php
                                        echo Form::text('company', $client->company, ['class' => 'form-control']);
                                        ?>
                                        @error('company')
                                        <span class="alert-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <?php
                                    echo Form::label('firstname', __('Firstname'), ['class' => 'col-md-4 col-form-label text-md-right']);
                                    ?>

                                    <div class="col-md-6">
                                        <?php
                                        echo Form::text('firstname', $client->firstname, ['class' => 'form-control']);
                                        ?>
                                        @error('firstname')
                                        <span class="alert-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <?php
                                    echo Form::label('lastname', __('Lastname'), ['class' => 'col-md-4 col-form-label text-md-right']);
                                    ?>

                                    <div class="col-md-6">
                                        <?php
                                        echo Form::text('lastname', $client->lastname, ['class' => 'form-control']);
                                        ?>
                                        @error('lastname')
                                        <span class="alert-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <?php
                                    echo Form::label('vat', __('Vat'), ['class' => 'col-md-4 col-form-label text-md-right']);
                                    ?>

                                    <div class="col-md-6">
                                        <?php
                                        echo Form::text('vat', $client->vat, ['class' => 'form-control']);
                                        ?>
                                        @error('vat')
                                        <span class="alert-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <?php
                                    echo Form::label('street', __('Street'), ['class' => 'col-md-4 col-form-label text-md-right']);
                                    ?>

                                    <div class="col-md-6">
                                        <?php
                                        echo Form::text('street', $client->street, ['class' => 'form-control']);
                                        ?>
                                        @error('street')
                                        <span class="alert-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <?php
                                    echo Form::label('nr', __('Nr'), ['class' => 'col-md-4 col-form-label text-md-right']);
                                    ?>

                                    <div class="col-md-6">
                                        <?php
                                        echo Form::text('nr', $client->nr, ['class' => 'form-control']);
                                        ?>
                                        @error('nr')
                                            <span class="alert-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <?php
                                    echo Form::label('city', __('city'), ['class' => 'col-md-4 col-form-label text-md-right']) ;
                                    ?>

                                    <div class="col-md-6">
                                        <select id="city_id"
                                                name="city_id"
                                                class="form-control @error('city_id') is-invalid @enderror">
                                            @foreach($cities as $city)
                                                <option value="{{$city->id}}">{{$city->city}}</option>
                                            @endforeach
                                        </select>
                                        @error('city')
                                        <span class="alert-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <?php
                                    echo Form::label('phone', __('phone'), ['class' => 'col-md-4 col-form-label text-md-right']) ;
                                    ?>

                                    <div class="col-md-6">
                                        <?php
                                        echo Form::text('phone', $client->phone, ['class' => 'form-control']) ;
                                        ?>
                                        @error('phone')
                                        <span class="alert-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <?php
                                    echo Form::label('email', __('email'), ['class' => 'col-md-4 col-form-label text-md-right']) ;
                                    ?>

                                    <div class="col-md-6">
                                        <?php
                                        echo Form::text('email', $client->email, ['class' => 'form-control']) ;
                                        ?>
                                        @error('email')
                                        <span class="alert-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <?php echo Form::submit($submit, ['class' => 'btn btn-success']);
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
