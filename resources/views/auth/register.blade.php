@extends('layouts.auth')

@section('content')
    <section class="card bg-slate-50">
        <div class="card-header bg-slate-500 text-gray-50">
            {{ __('auth.Register') }}
        </div>
        <div class="card-body text-slate-900">
            <form method="POST" action="{{ route('register') }}">
                @csrf
                <div class="flex flex-col md:flex-row">
                    <div class="form-group md:mx-12">
                        <div class="form-row">
                            <label for="firstname">
                                {{ __('auth.Firstname') }}
                            </label>
                            <input id="firstname" type="text"
                                   class="form-control
{{--                                   class="form-control bg-transparent border-slate-200 focus-within:border-slate-600--}}
                                   @error('firstname') is-invalid @enderror"
                                   name="firstname" value="{{ old('firstname') }}" required autocomplete="name"
                                   autofocus>
                            @error('firstname')
                            <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                            @enderror
                        </div>
                        <div class="form-row">
                            <label for="lastname">
                                {{ __('auth.Lastname') }}
                            </label>
                            <input id="lastname" type="text"
                                   class="form-control @error('lastname') is-invalid @enderror"
                                   name="lastname" value="{{ old('lastname') }}" required autocomplete="name"
                                   autofocus>

                            @error('lastname')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                        <div class="form-row">
                            <label for="name">
                                {{ __('auth.Name') }}
                            </label>
                            <input id="name" type="text"
                                   class="form-control @error('name') is-invalid @enderror" name="name"
                                   value="{{ old('name') }}" required autocomplete="name" autofocus>

                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                        <div class="form-row">
                            <label for="company">
                                {{ __('auth.Company') }}
                            </label>
                            <input id="company" type="text"
                                   class="form-control @error('company') is-invalid @enderror"
                                   name="company" value="{{ old('company') }}" required autocomplete="company"
                                   autofocus>

                            @error('company')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-row">
                            <label for="street">
                                {{ __('auth.Street') }}
                            </label>
                            <input id="street" type="text"
                                   class="form-control @error('street') is-invalid @enderror"
                                   name="street" value="{{ old('street') }}" required autocomplete="street"
                                   autofocus>

                            @error('street')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-row">
                            <label for="nr"> {{ __('auth.Nr') }} </label>
                            <input id="nkr" type="text"
                                   class="form-control @error('nr') is-invalid @enderror"
                                   name="nr" value="{{ old('nr') }}" required autocomplete="nr"
                                   autofocus/>
                            @error('nr')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-row">
                            <label for="city_id">{{ __('auth.City') }}</label>
                            <select id="city_id"
                                    name="city_id"
                                    class="form-control @error('city_id') is-invalid @enderror">
                                <option value="null">-&#45;&#45;</option>
                                @foreach($cities as $city)
                                    <option value="{{$city->id}}">{{$city->city}}</option>
                                @endforeach
                            </select>

                            @error('city_id')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                        <div class="form-row">
                            <label for="phone">{{ __('auth.Phone') }}</label>
                            <input id="phone" type="text"
                                   class="form-control @error('phone') is-invalid @enderror"
                                   name="phone" value="{{ old('phone') }}" required autocomplete="phone"
                                   autofocus>
                            @error('phone')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    <!--                        <div class="form-row">
                            <label for="email">{{ __('E-Mail Address') }}</label>
                            <input id="email" type="email"
                                   class="form-control @error('email') is-invalid @enderror" name="email"
                                   value="{{ old('email') }}" required autocomplete="email">

                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                            </div>-->
                    </div>
                    <div class="form-group md:mx-12">
                        <div class="form-row">
                            <label for="email">{{ __('auth.Email') }}</label>
                            <input id="email" type="text"
                                   class="form-control @error('email') is-invalid @enderror"
                                   name="phone" value="{{ old('email') }}" required autocomplete="email"
                                   autofocus>
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-row">
                            <label for="tva">{{ __('auth.Vat') }}</label>
                            <input id="tva" type="text"
                                   class="form-control @error('tva') is-invalid @enderror"
                                   name="tva" value="{{ old('tva') }}" required autocomplete="vat"
                                   autofocus>

                            @error('tva')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-row">
                            <label for="prefix">{{ __('Prefix') }}</label>
                            <input id="prefix" type="text"
                                   class="form-control @error('prefix') is-invalid @enderror"
                                   name="prefix" value="{{ old('prefix') }}"
                                   autofocus/>
                        </div>
                        <div class="form-row">
                            <label for="prefix">{{ __('auth.First Id') }}</label>
                            <input id="prefix" type="number"
                                   class="form-control @error('first_id') is-invalid @enderror"
                                   name="prefix" value="1" min="1" autofocus/>
                        </div>
                        <div class="form-row">
                            <label for="password">{{ __('auth.Password') }}</label>
                            <input id="password" type="password"
                                   class="form-control @error('password') is-invalid @enderror" name="password"
                                   required autocomplete="new-password">

                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-row">
                            <label for="password-confirm">{{ __('auth.Confirm Password') }}</label>
                            <input id="password-confirm" type="password" class="form-control"
                                   name="password_confirmation" required autocomplete="new-password">
                        </div>
                        <div class="form-row">
                                <button type="submit"
                                        class="mt-12 bg-slate-800 text-slate-50  p-3 rounded">
                                    {{ __('btn.Register') }}
                                </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
@endsection
