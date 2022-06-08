@extends('layouts.app')
@section('content')
    <section class="card w-full  mb-10 border p-12px border-slate-200">
        <div class="card-header bg-slate-500 text-slate-50">
            {{__('app.User_delete')}}: {{$user->company}}
        </div>
        <div class="card-body w-full">
            <div class="flex flex-row items-left">
                <span class="button-text ">
                    <a href="{{route('user_update')}}">
                        <span class="icon info">
                            <i class="fas fa-user-edit"></i>
                        </span>
                        <span class="label">
                            {{__('btn.Update')}}
                        </span>
                    </a>
                </span>

            </div>

            <div class="">
                <ul class="p-5 my-6">
                    <li>{{__('app.Created_at')}}: {{$user->created_at}}
                    <li>{{__('app.Updated_at')}}: {{$user->updated_at}}</li>
                </ul>
            </div>
            <div class="relative">
                <div class="w-full flex flex-row my-12">
                       <div class="card w-max  mt-12">
                        <div class="card-body ">
                            <p class="font-bold border border-slate-300 p-6">
                                {{$user->company}}</strong> <br/>
                                {{__('auth.Vat')}}: {{$user->tva}} <br/>
                                {{$user->lastname}} {{$user->firstname}}<br/>
                                {{$user->street}} {{$user->nr}} <br/>
                                {{$user->city->code}} {{$user->city->city}}<br/>
                                {{$user->email}}<br/>
                                {{$user->phone}}

                            </p>
                        </div>
                    </div>
                </div>

                <div class="absolute bg-opacity-60 bg-slate-900 top-0 left-0 w-full h-full flex justify-center items-center ">
                    <form action="{{route('user_remove', $user->id)}}" method="post"
                          class="w-1/2 bg-opacity-60 bg-slate-50 p-12 border border-black border-4">
                        @csrf
                        @method('delete')
                        <p class="font-black">
                            {{__('app.Confirm_delete_user')}}
                        </p>
                        <div class="flex justify-evenly my-6 ">
                            <input type="hidden" name="_id" value="{{$user->id}}"/>
                            <input type="submit" name="_accept" value="Oui"
                                   class="success py-2 px-5 rounded-lg w-1/3  "/>
                            <input type="submit" name="_decline" value="Non"
                                   class="danger py-2 px-5 rounded-lg w-1/3"/>
                        </div>
                        <aside class="font-black mt-5">

                        </aside>
                    </form>
                </div>
            </div>
        </div>

@endsection

