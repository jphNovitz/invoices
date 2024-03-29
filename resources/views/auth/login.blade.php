@extends('layouts.auth')

@section('content')
    <section class="card bg-slate-50 w-full ">
        <div class="card-header bg-slate-500 text-gray-50">
            {{ __('auth.Login') }}
        </div>
        <div class="card-body text-slate-900">
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="form-row">
                    <label for="email"
                           class="font-bold">
                        {{ __('auth.Email_address') }}
                    </label>

                    <input id="email" type="email"
                           class="bg-transparent border-slate-200 focus-within:border-slate-600
                                        @error('email')
                                   is-invalid @enderror"
                           name="email"
                           value="{{ old('email') }}"
                           required autocomplete="email"
                           autofocus>

                    @error('email')
                    <span class="invalid-feedback"
                          role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                    @enderror
                </div>
                <div class="form-row">
                    <label for="password"
                           class="font-bold">
                        {{ __('auth.Password') }}
                    </label>

                    <input id="password" type="password"
                           class="bg-transparent border-slate-200 focus-within:border-slate-600
                                   @error('password') is-invalid @enderror"
                           name="password" required
                           autocomplete="current-password">

                    @error('password')
                    <span class="invalid-feedback"
                          role="alert">
                                  <strong>{{ $message }}</strong>
                            </span>
                    @enderror
                </div>

                <div class="form-row !flex-row">
                    <input class="form-check-input mr-6"
                           type="checkbox"
                           name="remember"
                           id="remember" {{ old('remember') ? 'checked' : '' }}>

                    <label class="form-check-label" for="remember">
                        {{ __('auth.Remember_me') }}
                    </label>
                </div>

                <div class="form-row">
                    <button type="submit"
                            class="bg-slate-700 text-slate-50  py-4 px-6 rounded-md max-w-fit">
                        {{ __('auth.Login') }}
                    </button>

                    @if (Route::has('password.request'))
                        <div class="w-full mt-5">
                            <a class="font-thin text-sm hover:font-bold"
                               href="{{ route('password.request') }}">
                                {{ __('auth.Forgot_your_password?') }}
                            </a>
                        </div>
                    @endif
                </div>
            </form>
        </div>
    </section>
@endsection
