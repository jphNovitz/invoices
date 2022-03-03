@extends('layouts.app')

@section('content')
    <section class="card w-full  mb-10 border p-12px border-slate-200">
        <div class="card-header bg-slate-500 text-slate-50">
            {{__('app.Hello')}} {{$user->firstname}}
        </div>
        <div class="card-body  w-full flex  flex-col-reverse md:flex-row my-12">
                <div class="card w-full md:w-1/2 ">
                    <div class="card-body p-6">
                        <ul class="text-lg ">
                            <li>{{__('auth.Company')}}: <strong>{{$user->company}}</strong></li>
                            <li>{{__('auth.Name')}}: <strong>{{$user->name}}</strong></li>
                            <li>{{__('auth.Vat')}}: <strong>{{$user->vat}}</strong></li>
                            <li>{{__('auth.Lastname')}}: <strong>{{$user->lastname}}</strong></li>
                            <li>{{__('auth.Firstname')}} : <strong>{{$user->firstname}}</strong></li>
                            <li>{{__('auth.Street')}}: <strong>{{$user->street}} {{$user->nr}}</strong></li>
                            <li>{{__('auth.Post_code')}}: <strong>{{$user->city->code}}</strong></li>
                            <li>{{__('auth.City')}}: <strong>{{$user->city->city}}</strong></li>
                            <li>{{__('auth.Email')}}: <strong>{{$user->email}}</strong></li>
                            <li>{{__('auth.Phone')}}: <strong>{{$user->phone}}</strong></li>
                        </ul>
                    </div>
                </div>
                <div class="card w-full md:w-1/2 ">
                    <div class="card-body p-6">
                        <div class="flex flex-row items-left md:pl-5">
                            <span class="button-text ">
                                <a href="{{route('user_update', ['user' => $user])}}">
                                    <span class="icon success">
                                        <i class="fas fa-edit"></i>
                                    </span>
                                    <span class="label">
                                        {{__('btn.Update')}}
                                    </span>
                                </a>
                            </span>
                            <span class="button-text ">
                                <a href="#{{--{{route('user_delete', ['user' => $user])}}--}}">
                                    <span class="icon danger">
                                        <i class="fas fa-minus"></i>
                                    </span>
                                    <span class="label">
                                        {{__('btn.Delete')}}
                                    </span>
                                </a>
                            </span>
                        </div>
                    </div>
                </div>
        </div>
    </section>

@endsection
