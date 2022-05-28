@extends('layouts.app')
<?php
$cities = \App\City::all();
?>
@section('content')
    <section class="card w-full  mb-10 border p-12px border-slate-200">
        <div class="card-header bg-slate-500 text-slate-50">
            {{__('app.Client_update')}}: {{$client->company}}
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
                        {{__('app.Created_at')}}:
                        <strong>{{$client->created_at->isoFormat('DD/MM/YYYY HH:mm')}}</strong>
                    </li>
                    <li>
                        {{__('app.Updated_at')}}:
                        <strong>{{$client->updated_at->isoFormat('DD/MM/YYYY HH:mm')}}</strong>
                    </li>
                </ul>
            @endif
            <div class="flex flex-col <!--md:flex-row--> w-full my-12 md:items-center">
                @if ($errors->any())
                    <div class="bg-red-200 text-red-900 p-4 rouded-lg ">
                        <p>Veuillez corriger les erreur !</p>
                        @foreach($errors->all() as $error)
                            {{$error}}
                        @endforeach


                    </div>
                @endif
                <form action="{{route('client_save')}}" method="post"
                      class="w-1/2 md:p-6 md:rounded-b-md md:border border-slate-300 shadow-sm ">
                    @csrf
                    @method('put')
                    <input type="hidden" id="id" name="id" value="{{$client->id}}">
                    <div class="form-row">
                        <label for="company">{{__('auth.Company')}}</label>
                        <input type="text" name="company" id="company" value="{{$client->company}}"/>
                        @error('company')
                        <span class="alert-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="form-row">
                        <label for="firstname">{{__('auth.firstname')}}</label>
                        <input type="text" name="firstname" id="firstname" value="{{$client->firstname}}"/>
                        @error('firstname')
                        <span class="alert-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="form-row">
                        <label for="company">{{__('auth.lastname')}}</label>
                        <input type="text" name="lastname" id="lastname" value="{{$client->lastname}}"/>

                        @error('lastname')
                        <span class="alert-danger" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                        @enderror
                    </div>

                    <div class="form-row">
                        <label for="vat">{{__('auth.Vat')}}</label>
                        <input type="text" name="vat" id="vat" value="{{$client->vat}}"/>

                        @error('vat')
                        <span class="alert-danger" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                        @enderror
                    </div>

                    <div class="form-row">
                        <label for="street">{{__('auth.Street')}}</label>
                        <input type="text" name="street" id="street" value="{{$client->street}}"/>

                        @error('street')
                        <span class="alert-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="form-row">
                        <label for="nr">{{__('auth.Nr')}}</label>
                        <input type="text" name="nr" id="nr" value="{{$client->nr}}"/>

                        @error('nr')
                        <span class="alert-danger" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                        @enderror
                    </div>

                    <div class="form-row">
                        <label for="city_id">{{__('auth.city')}}</label>
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
                        <label for="phone">{{__('auth.Phone')}}</label>
                        <input type="text" name="phone" id="phone" value="{{$client->phone}}"/>

                        @error('phone')
                        <span class="alert-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="form-row">
                        <label for="email">{{__('auth.Email')}}</label>
                        <input type="text" name="email" id="email" value="{{$client->email}}"/>
                        @error('email')
                        <span class="alert-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <input type="submit" class="bg-blue-600 text-blue-50 rounded-lg my-3 px-6" value="{{__('btn.Submit')}}">

                </form>

            </div>
        </div>
    </section>
@endsection
