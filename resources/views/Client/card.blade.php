@extends('layouts.app')

@section('content')

    <section class="card w-full  mb-10 border p-12px border-slate-200">
        <div class="card-header bg-slate-500 text-slate-50">
            {{__('app.Client_details')}}: {{$client->company}}
        </div>
        <div class="card-body w-full flex  flex-col-reverse md:flex-row my-12">
            {{--Client HEADER--}}
            @component('component.ClientHeader', [
                'client' => $client])
            @endcomponent
            {{--END Invoice HEADER--}}

        </div>
        <div class="card-body w-full">
            <h2 class="text-slate-900 px-6 py-2 my-3 font-bold text-xl">Liste des factures</h2>
            <div class="px-6">
                <table class="table-fixed w-full">
                    <thead class=" hidden md:table-header-group  bg-slate-300 p-6">
                    <tr class="justify-between">
                        <th class="text-left">Référence</th>
                        <th class="text-left  w-full md:w-32">Créé</th>
                        <th class="text-left  w-full md:w-32">Montant</th>
                        <th class="text-right  w-full md:w-32"></th>
                    </tr>
                    </thead>
                    <tbody>

                    @forelse($client->invoices as $invoice)
                        <tr class="flex flex-col md:table-row">
                            <td class="w-full md:w-70 text-left before:font-bold before:block before:content-['Référence'] md:before:content-['']">
                                {{$invoice->reference}}
                            </td>
                            <td class=" text-left before:font-bold before:block before:content-['Créé le'] md:before:content-['']">
                                {{ date("d M 'y", strtotime($invoice->created_at)) }}

                            </td>
                            <td class=" text-left w-full md:w-30 before:font-bold before:block before:content-['Montant'] md:before:content-['']">
                                {{$invoice->total}}
                            </td>
                            <td class="flex flex-row justify-around  w-32">
                                <a href="{{route('invoice_show', ['id'=>$invoice->id])}}"
                                   class="button info">
                                    <i class="fas fa-search-plus"></i>
                                </a>

                                <a href="{{route('invoice_edit', ['id'=>$invoice->id])}}"
                                   class="button success">
                                    <i class="fas fa-edit"></i>
                                </a>

                                <a href="{{route('invoice_delete', ['id'=>$invoice->id])}}"
                                   class="button danger">
                                    <i class="fas fa-minus"></i>
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr class="flex flex-col md:table-row">
                            <td class="" colspan="4" >
                                @include('_parts._empty_list_message')
                            </td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </section>

@endsection
