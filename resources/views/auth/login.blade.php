@extends('layouts.auth')

@section('content')
    <section class="card rounded-lg bg-slate-50 ">
        <div class="card-header bg-slate-500 text-gray-50 p-2 text-xl font-black font-header ">
            {{ __('auth.Login') }}
        </div>
        <div class="card-body  text-slate-900 py-6 px-12">
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="form-row my-6 ">
                    <label for="email"
                           class="font-bold">
                        {{ __('auth.Email_address') }}
                    </label>

                    <div class="form-row my-6 ">
                        <input id="email" type="email"
                               class="bg-transparent border-b-2  border-slate-200 focus:outline-none focus-within:border-slate-600
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
                </div>

                <div class="form-row my-6 ">
                    <label for="password"
                           class="form-row my-6 font-bold">
                        {{ __('auth.Password') }}
                    </label>

                    <input id="password" type="password"
                           class="bg-transparent border-b-2  border-slate-200 focus:outline-none focus-within:border-slate-600
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

                <div class="form-row my-6 ">
                    <input class="form-check-input"
                           type="checkbox"
                           name="remember"
                           id="remember" {{ old('remember') ? 'checked' : '' }}>

                    <label class="form-check-label" for="remember">
                        {{ __('auth.Remember_me') }}
                    </label>
                </div>

                <div class="form-row my-6 ">
                    <button type="submit"
                            class="bg-slate-800 text-slate-50  p-3 rounded">
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
