@extends('layouts.app', ['class' => "bg-login", 'menu' => 'login'])

@section('content')
<v-container class="fill-height" fluid>
    <v-row align="center" justify="center">
        <v-card style="background: white" class="elevation-3 pa-0" min-width="360">
            <div class="col-12 py-0" align="center" justify="center">
                <v-avatar class="mt-n12 mb-4 elevation-3" size="120" color="#0250c5">
                    <v-icon size="80" dark>mdi-account</v-icon>
                </v-avatar>
                <h1>Login</h1>
            </div>
            <div class="pa-5 pt-0">
                <v-form class="mt-5" method="POST" action="{{ route('login') }}">
                    @csrf

                    <v-text-field outlined class="@error('email') is-invalid @enderror" type="email"
                        label="{{ __('E-Mail Address') }}" name="email" required autocomplete="email"
                        value="{{ old('email') }}" autofocus>
                    </v-text-field>
                    @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror

                    <v-text-field outlined class="@error('password') is-invalid @enderror" type="password"
                        label="{{ __('Password') }}" name="password" required autocomplete="current-password">
                    </v-text-field>
                    @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror

                    <div class="d-inline-block more-info-login">
                        <v-checkbox label="{{ __('Remember Me') }}" class="body-2 mt-0" name="remember" required
                            {{ old('remember') ? 'checked' : '' }}>
                        </v-checkbox>
                        @if (Route::has('password.request'))
                        <a class="btn btn-link float-right body-2 pr-0" href="{{ route('password.request') }}" style=" line-height: 30px; text-decoration: none; ">
                            {{ __('Forgot Your Password?') }}
                        </a>
                        @endif
                    </div>

                    <v-btn color="#0250c5" class="mr-4" type="submit" block dark>
                        {{ __('Login') }}
                    </v-btn>

                </v-form>
            </div>
        </v-card>
    </v-row>
</v-container>
@endsection

<style>
    .more-info-login {
        width: 100%;
    }

    .more-info-login>div {
        display: inline-block;
    }

    .more-info-login label {
        margin-bottom: 0 !important;
    }

    .bg-login {
        background: #32b4e4 !important;
        position: relative;
        z-index: 1;
    }
</style>