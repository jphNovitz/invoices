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
            @if(null !== $client->created_at)
                <ul class="flex flex-col justify-start w-full">
                    <li>
                        {{__('app.Created_at')}}: <strong>{{$client->created_at->isoFormat('DD/MM/YYYY HH:mm')}}</strong>
                    </li>
                    <li>
                        {{__('app.Updated_at')}}: <strong>{{$client->updated_at->isoFormat('DD/MM/YYYY HH:mm')}}</strong>
                    </li>
                </ul>
           @endif
            <div class="flex flex-col md:flex-row w-full my-12 md:justify-center">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <p>Veuillez corriger les erreur !</p>

                    </div>
                @endif
                    <form action="{{route($route)}}" class="w-1/2 md:p-6 md:rounded-b-md md:border border-slate-300 shadow-sm " >
                        @csrf

                        <input type="hidden" id="id" name="id" value="{{$client->id}}">
                <div class="form-row">
                    <label for="company">{{__('auth.Company')}}</label>
                    <input type="text" name="company" id="company" value="{{$client->company}}" />
                       @error('company')
                        <span class="alert-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                </div>

                <div class="form-row">
                    <label for="firstname">{{__('auth.firstname')}}</label>
                    <input type="text" name="firstname" id="firstname" value="{{$client->firstname}}" />
                        @error('firstname')
                        <span class="alert-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                </div>

                <div class="form-row">
                    <label for="company">{{__('auth.lastname')}}</label>
                    <input type="text" name="lastname" id="lastname" value="{{$client->lastname}}" />

                    @error('lastname')
                    <span class="alert-danger" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="form-row">

                    <label for="company">{{__('auth.Vat')}}</label>
                    <input type="text" name="Vat" id="Vat" value="{{$client->Vat}}" />

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
                ?>
            </form>

            </div>
        </div>
    </section>
@endsection
