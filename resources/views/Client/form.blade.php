@extends('layouts.app')
<?php
$cities = \App\City::all();
?>
@section('content')
    <section class="card w-full  mb-10 border p-12px border-slate-200">
        <div class="card-header bg-slate-500 text-slate-50">
            {{__($form_title)}}: {{$client->company}}
        </div>
        <div class="card-body  w-full  my-12">
            <div class="flex flex-row justify-start w-full">
                     <span class="button-text ">
                    <a href="{{route('clients_list')}}">
                        <span class="icon primary">
                            <i class="fas fa-list"></i>
                        </span>
                        <span class="label">
                            {{__('btn.List')}}
                        </span>
                    </a>
                </span>
            </div>
            <ul class="flex flex-col justify-start w-full">
                <li>
                    {{__('Created_at')}}: <strong>{{$client->created_at->isoFormat('DD/MM/YYYY HH:mm')}}</strong>
                </li>
                <li>
                    {{__('Updated_at')}}: <strong>{{$client->updated_at->isoFormat('DD/MM/YYYY HH:mm')}}</strong>
                </li>
            </ul>
            <div class="flex flex-col md:flex-row w-full my-12">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <p>Veuillez corriger les erreur !</p>

                    </div>
                @endif
                <?php
                echo Form::open(['route' => $route, 'method' => $method, 'class' => 'w-1/2']);
                echo Form::hidden('id', $client->id);
                ?>
                <div class="form-row">
                    <?php
                    echo Form::label('company', __('auth.Company'), ['class' => '']);
                    echo Form::text('company', $client->company, ['class' => 'form-control']);
                        ?>
                        @error('company')
                        <span class="alert-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                </div>

                <div class="form-row">
                    <?php
                    echo Form::label('firstname', __('auth.Firstname'), ['class' => '']);
                    echo Form::text('firstname', $client->firstname, ['class' => 'form-control']);
                        ?>
                        @error('firstname')
                        <span class="alert-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                </div>

                <div class="form-row">
                    <?php
                    echo Form::label('lastname', __('auth.Lastname'), ['class' => '']);
                    echo Form::text('lastname', $client->lastname, ['class' => 'form-control']);
                    ?>
                    @error('lastname')
                    <span class="alert-danger" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="form-row">
                    <?php
                    echo Form::label('vat', __('auth.Vat'), ['class' => '']);
                    echo Form::text('vat', $client->vat, ['class' => 'form-control']);
                    ?>
                    @error('vat')
                    <span class="alert-danger" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="form-row">
                    <?php
                    echo Form::label('street', __('auth.Street'), ['class' => '']);
                    echo Form::text('street', $client->street, ['class' => 'form-control']);
                        ?>
                        @error('street')
                        <span class="alert-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                </div>

                <div class="form-row">
                    <?php
                    echo Form::label('nr', __('auth.Nr'), ['class' => '']);
                    echo Form::text('nr', $client->nr, ['class' => 'form-control']);
                    ?>
                    @error('nr')
                    <span class="alert-danger" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="form-row">
                    <?php
                    echo Form::label('city', __('auth.city'), ['class' => '']);
                    ?>
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

                <div class="form-row">
                    <?php
                        echo Form::label('phone', __('phone'), ['class' => '']);
                        echo Form::text('phone', $client->phone, ['class' => 'form-control']);
                    ?>
                        @error('phone')
                        <span class="alert-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                </div>

                <div class="form-row">
                    <?php
                        echo Form::label('email', __('email'), ['class' => '']);
                        echo Form::text('email', $client->email, ['class' => 'form-control']);
                        ?>
                        @error('email')
                            <span class="alert-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                </div>
                <?php echo Form::submit($submit, ['class' => 'info rounded-md p-3']);
                echo Form::close();
                ?>
            </div>
        </div>
    </section>
@endsection
