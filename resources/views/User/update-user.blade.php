@extends('layouts.app')
<?php

?>
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{$user->name}} ({{$user->company}}) - TVA: {{$user->tva}}
                    - Modifiez votre profil -
                    </div>

                    <div class="card-body">
                        <?php
                        echo Form::open(['route' => 'user_store', 'method' => 'POST']) ;
                        ?>
                            <div class="form-group row">
                                <?php
                                    echo Form::label('firstname', __('firstname'), ['class' => 'col-md-4 col-form-label text-md-right']) ;
                                ?>

                                <div class="col-md-6">
                                    <?php
                                        echo Form::text('firstname', $user->firstname, ['class' => 'form-control']) ;
                                    ?>
                                        @error('firstname')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <?php
                                    echo Form::label('lastname', __('lastname'), ['class' => 'col-md-4 col-form-label text-md-right']) ;
                                ?>

                                <div class="col-md-6">
                                    <?php
                                        echo Form::text('lastname', $user->lastname, ['class' => 'form-control']) ;
                                    ?>
                                        @error('lastname')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <?php
                                    echo Form::label('name', __('name'), ['class' => 'col-md-4 col-form-label text-md-right']) ;
                                ?>

                                <div class="col-md-6">
                                    <?php
                                        echo Form::text('name', $user->name, ['class' => 'form-control']) ;
                                    ?>
                                        @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <?php
                                    echo Form::label('company', __('company'), ['class' => 'col-md-4 col-form-label text-md-right']) ;
                                ?>

                                <div class="col-md-6">
                                    <?php
                                        echo Form::text('company', $user->name, ['class' => 'form-control']) ;
                                    ?>
                                        @error('company')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <?php
                                    echo Form::label('street', __('street'), ['class' => 'col-md-4 col-form-label text-md-right']) ;
                                ?>

                                <div class="col-md-6">
                                    <?php
                                        echo Form::text('street', $user->street, ['class' => 'form-control']) ;
                                    ?>
                                        @error('street')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <?php
                                    echo Form::label('nr', __('nr'), ['class' => 'col-md-4 col-form-label text-md-right']) ;
                                ?>

                                <div class="col-md-2">
                                    <?php
                                        echo Form::text('nr', $user->nr, ['class' => 'form-control']) ;
                                    ?>
                                        @error('nr')
                                    <span class="invalid-feedback" role="alert">
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
                                    <?php
//                                     echo $cities['id'];
//                                        echo  Form::select('city', $cities->id , $user->city , ['class' => 'form-control']);
                                    ?>
                                        @error('city')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <?php
                                    echo Form::label('tva', __('vat'), ['class' => 'col-md-4 col-form-label text-md-right']) ;
                                ?>

                                <div class="col-md-6">
                                    <?php
                                        echo Form::text('tva', $user->tva, ['class' => 'form-control']) ;
                                    ?>
                                        @error('tva')
                                    <span class="invalid-feedback" role="alert">
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
                                        echo Form::text('phone', $user->phone, ['class' => 'form-control']) ;
                                    ?>
                                        @error('phone')
                                    <span class="invalid-feedback" role="alert">
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
                                        echo Form::text('email', $user->email, ['class' => 'form-control']) ;
                                    ?>
                                        @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <?php echo Form::submit('Modifier', ['class' => 'btn btn-success']) ?>

                        <?php
                            echo Form::close();
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
