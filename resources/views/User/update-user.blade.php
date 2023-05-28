@extends('layouts.app')
<?php
$cities = \App\Models\City::all();
?>
@section('content')
    <section class="card w-full  mb-10 border p-12px border-slate-200">
        <div class="card-header bg-slate-500 text-slate-50">
            {{ $user->company }}: {{__('app.Profile_update')}}
        </div>

        <div class="card-body  w-full  my-12">
            <div class="flex flex-row justify-start w-full">
                     <span class="button-text ">
                    <a href="{{route('user_delete')}}">
                        <span class="icon danger">
                            <i class="fas fa-trash"></i>
                        </span>
                        <span class="label">
                            {{__('btn.Delete')}}
                        </span>
                    </a>
                </span>
            </div>
            @if(null !== $user->created_at)
                <ul class="flex flex-col justify-start w-full">
                    <li>
                        {{__('app.Created_at')}}:
                        <strong>{{$user->created_at->isoFormat('DD/MM/YYYY HH:mm')}}</strong>
                    </li>
                    <li>
                        {{__('app.Updated_at')}}:
                        <strong>{{$user->updated_at->isoFormat('DD/MM/YYYY HH:mm')}}</strong>
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
                <form action="{{route('user_store')}}" method="POST"
                      class="w-1/2 md:p-6 md:rounded-b-md md:border border-slate-300 shadow-sm ">
                    @csrf
                    @method('put')
                    <input type="hidden" id="id" name="id" value="{{$user->id}}">

                    <div class="form-row">
                        <label for="firstname">{{__('auth.Firstname')}}</label>
                        <input type="text" name="firstname" id="firstname" value="{{$user->firstname}}"/>
                        @error('firstname')
                        <span class="text-red-800 before:content-['*']" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="form-row">
                        <label for="lastname">{{__('auth.Lastname')}}</label>
                        <input type="text" name="lastname" id="lastname" value="{{$user->lastname}}"/>
                        @error('lastname')
                        <span class="text-red-800 before:content-['*']" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="form-row">
                        <label for="name">{{__('auth.Name')}}</label>
                        <input type="text" name="name" id="name" value="{{$user->name}}"/>
                        @error('name')
                        <span class="text-red-800 before:content-['*']" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="form-row">
                        <label for="company">{{__('auth.Company')}}</label>
                        <input type="text" name="company" id="company" value="{{$user->company}}"/>
                        @error('company')
                        <span class="text-red-800 before:content-['*']" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="form-row">
                        <label for="street">{{__('auth.Street')}}</label>
                        <input type="text" name="street" id="street" value="{{$user->street}}"/>
                        @error('street')
                        <span class="text-red-800 before:content-['*']" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="form-row">
                        <label for="nr">{{__('auth.Nr')}}</label>
                        <input type="text" name="nr" id="nr" value="{{$user->nr}}"/>
                        @error('nr')
                        <span class="text-red-800 before:content-['*']" role="alert">
                            <strong>{{ $nr }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="form-row">
                        <label for="city">{{__('auth.City')}}</label>
                        <select id="city_id"
                                name="city_id"
                                class="form-control h-12 rounded-lg p-3 @error('city_id') is-invalid @enderror">
                            @foreach($cities as $city)
                                <option value="{{$city->id}}">{{$city->city}}</option>
                            @endforeach
                        </select>
                        @error('city')
                        <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-row">
                        <label for="vat">{{ __('auth.Vat') }}</label>
                        <input id="vat" type="text"
                               class="form-control @error('vat') is-invalid @enderror"
                               name="vat" value="{{ $user->tva }}" required autocomplete="vat"
                               autofocus>

                        @error('vat')
                        <span class="text-red-700 font-bold " role="alert">
                                {{__('errors.'.$message) }}
                            </span>
                        @enderror
                    </div>

                    <div class="form-row">
                        <label for="phone">{{__('auth.Phone')}}</label>
                        <input type="text" name="phone" id="phone" value="{{$user->phone}}"/>
                        @error('phone')
                        <span class="text-red-800 before:content-['*']" role="alert">
                            <strong>{{ $phone }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="form-row">
                        <label for="email">{{__('auth.Email')}}</label>
                        <input type="text" name="email" id="email" value="{{$user->email}}"/>
                        @error('email')
                        <span class="text-red-800 before:content-['*']" role="alert">
                            <strong>{{ $messagel }}</strong>
                        </span>
                        @enderror
                    </div>

                    <input type="submit"
                           value="{{__('Update')}}"
                           class="py-3 px-4 bg-slate-400 text-slate-50 rounded-lg focus:shadow-md cursor-pointer">

                </form>
            </div>
        </div>
    </section>
@endsection
