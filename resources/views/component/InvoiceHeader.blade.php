{{--Component
Display: invoice header --}}

<div class="">

    <ul class="p-5 my-6 text-sm md:text:base">
        <li>Date encodage: {{\Carbon\Carbon::parse($invoice->created_at)->format('d/m/Y')}} </li>
        <li>Date modification: {{\Carbon\Carbon::parse($invoice->updated_at)->format('d/m/Y')}}</li>
    </ul>
</div>

<div class="w-full flex flex-col md:flex-row my-4 md:my-12">
    <div class="card w-full md:w-1/2 ">
        <div class="card-body p-3 md:p-6">
            <ul class="text-sm md:text-lg font-black ">
                <li class="break-words"><em>{{$user->company}}</em> </li>
                <li class="break-words">{{$user->tva}} </li>
                <li class="break-words">{{$user->lastname}} {{$user->firstname}}</li>
                <li class="break-words">{{$user->street}} {{$user->nr}} </li>
                <li class="break-words">{{$user->city->code}} {{$user->city->city}} </li>
                <li class="break-words"><a href="mailto:{{$user->email}}">{{$user->email}}</a></li>
                <li>{{$user->phone}}</li>
            </ul>
        </div>
    </div>
    <div class="card w-full md:w-max ">
        <div class="card-body ">
            <ul class="text-sm md:text-lg font-bold border border-slate-300 p-3 md:p-6">
                <li class="break-words"><strong>{{$invoice->client->company}}</strong></li>
                <li class="break-words">{{__('auth.Vat')}}: {{$invoice->client->tva}}</li>
                <li class="break-words">{{$invoice->client->lastname}} {{$invoice->client->firstname}}</li>
                <li class="break-words">{{$invoice->client->street}} {{$invoice->client->nr}}</li>
                <li class="break-words">{{$invoice->client->city->code}} {{$invoice->client->city->city}}</li>
                <li class="break-words">{{$invoice->client->email}}</li>
                <li class="break-words">{{$invoice->client->phone}}</li>
            </ul>
        </div>
    </div>
</div>
