@extends('layouts.app')

@section('content')

    <section class="card w-full  mb-10 border p-12px border-slate-200">
        <div class="card-header bg-slate-500 text-slate-50">
            {{__('app.Client_details')}}: {{$client->company}}
        </div>
        <div class="card-body w-full">
            <div class="flex flex-row items-left">
                <span class="button-text ">
                    <a href="{{route('clients_list')}}">
                        <span class="icon primary">
                            <i class="fas fa-list"></i>
                        </span>
                        <span class="label">
                            {{__('btn.list')}}
                        </span>
                    </a>
                </span>
                <span class="button-text ">
                    <a href="{{route('client_update', ['client' => $client])}}">
                        <span class="icon success">
                            <i class="fas fa-edit"></i>
                        </span>
                        <span class="label">
                            {{__('btn.update')}}
                        </span>
                    </a>
                </span>
                <span class="button-text ">
                    <a href="{{route('client_delete', ['client' => $client])}}">
                        <span class="icon danger">
                            <i class="fas fa-minus"></i>
                        </span>
                        <span class="label">
                            {{__('btn.delete')}}
                        </span>
                    </a>
                </span>

            </div>
            <div class="">


            </div>
            <div class="w-full flex flex-row my-12">
                <div class="card w-1/2 ">
                    <div class="card-body p-6">
                        <ul class="text-lg ">
                            <li>{{__('Company')}}: <strong>{{$client->company}}</strong> </li>
                            <li>{{__('Vat')}}: <strong>{{$client->vat}}</strong> </li>
                            <li>{{__('Lastname')}}: <strong>{{$client->lastname}}</strong></li>
                            <li>{{__('Firstname')}} :  <strong>{{$client->firstname}}</strong> </li>
                            <li>{{__('Rue')}}: <strong>{{$client->street}} {{$client->nr}}</strong> </li>
                            <li>{{__('Post_code')}}: <strong>{{$client->city->code}}</strong></li>
                            <li>{{__('City')}}: <strong>{{$client->city->city}}</strong> </li>
                            <li>{{__('Email')}}: <strong>{{$client->email}}</strong></li>
                            <li>{{__('Phone')}}: <strong>{{$client->phone}}</strong></li>
                        </ul>
                    </div>
                </div>
                <div class="card w-1/2 ">
                    <div class="card-body p-6">
                        <ul class="p-5 my-6">
                            <li>Date encodage: {{$client->created_at}} </li>
                            <li>Date modification: {{$client->updated_at}}</li>
                        </ul>
                    </div>
                </div>
            </div>
            <h2>Liste des factures</h2>
            {{--        <thead class=" hidden md:table  bg-slate-300 p-6">--}}
            <table class="table-fixed w-full">
                <thead class=" hidden md:table-header-group  bg-slate-300 p-6">
                <tr class="justify-between">
                    <th class="text-left">Référence</th>
                    <th class="text-left">Créé</th>
                    <th class="text-left">Montant</th>
                    <th class="text-left"></th>
                </tr>
                </thead>
                <tbody>

                @foreach($client->invoices as $invoice)
                    <tr class="flex flex-col">
                        <td class=" text-left before:font-bold before:block before:content-['Référence'] md:before:content-['']">{{$invoice->reference}}</td>
                        <td class=" text-left before:font-bold before:block before:content-['Référence'] md:before:content-['']">{{$invoice->created_at}}</td>
                        <td class=" text-left before:font-bold before:block before:content-['Référence'] md:before:content-['']">{{$invoice->total}}</td>
                        <td class=" text-left">
                            <a href="{{route('invoice_show', ['id'=>$invoice->id])}}"
                               class="btn btn-sm btn-primary">
                                <i class="fas fa-info"></i>
                                {{__('btn.Details')}}
                            </a>

                            <a href="{{route('invoice_edit', ['id'=>$invoice->id])}}"
                               class="btn btn-sm btn-primary">
                                <i class="fas fa-info"></i>
                                {{__('btn.Update')}}
                            </a>

                            <a href="{{route('invoice_delete', ['id'=>$invoice->id])}}"
                               class="btn btn-sm btn-danger">
                                <i class="fas fa-trash"></i>
                                {{__('btn.Remove')}}
                            </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </section>




@endsection
