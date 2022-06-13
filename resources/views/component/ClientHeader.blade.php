<div class="card w-full md:w-1/2">
    <div class="card-body p-6">
        <ul class="text-lg ">
            <li>{{__('auth.Company')}}: <strong>{{$client->company}}</strong></li>
            <li>{{__('auth.Vat')}}: <strong>{{$client->vat}}</strong></li>
            <li>{{__('auth.Lastname')}}: <strong>{{$client->lastname}}</strong></li>
            <li>{{__('auth.Firstname')}} : <strong>{{$client->firstname}}</strong></li>
            <li>{{__('auth.Street')}}: <strong>{{$client->street}} {{$client->nr}}</strong></li>
            <li>{{__('auth.Post_code')}}: <strong>{{$client->city->code}}</strong></li>
            <li>{{__('auth.City')}}: <strong>{{$client->city->city}}</strong></li>
            <li>{{__('auth.Email')}}: <strong>{{$client->email}}</strong></li>
            <li>{{__('auth.Phone')}}: <strong>{{$client->phone}}</strong></li>
        </ul>
    </div>
</div>
<div class="card w-full md:w-1/2">
    <div class="card-body p-6">
        <div class="flex flex-row items-left md:pl-5">
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
            <span class="button-text ">
                    <a href="{{route('client_update', ['client' => $client])}}">
                        <span class="icon success">
                            <i class="fas fa-edit"></i>
                        </span>
                        <span class="label">
                            {{__('btn.Update')}}
                        </span>
                    </a>
                </span>
            <span class="button-text ">
                    <a href="{{route('client_delete', ['client' => $client])}}">
                        <span class="icon danger">
                            <i class="fas fa-minus"></i>
                        </span>
                        <span class="label">
                            {{__('btn.Delete')}}
                        </span>
                    </a>
                </span>

        </div>
        <ul class="md:p-5 my-6">
            <li>Date encodage: {{\Carbon\Carbon::parse($client->created_at)->format('d/m/Y')}} </li>
            <li>Date modification: {{\Carbon\Carbon::parse($client->updated_at)->format('d/m/Y')}}</li>
        </ul>
    </div>
</div>