@extends('layouts.app', ['class' => "bg-login", 'menu' => 'login'])

@section('content')
<v-container class="fill-height" fluid>
    <v-row align="center" justify="center">
        <v-card style="background: white" class="elevation-3 pa-0" min-width="360">
            <div class="col-12 py-0" align="center" justify="center">
                <v-avatar class="mt-n12 mb-4 elevation-3" size="120" color="#0250c5">
                    <v-icon size="80" dark>mdi-account</v-icon>
                </v-avatar>
                <h1>Register</h1>
            </div>
            <div class="pa-5 pt-0">
                <v-form class="mt-5" method="POST" action="{{ route('register') }}">
                    @csrf

                    <v-text-field outlined class="@error('name') error--text @enderror" type="name"
                        label="{{ __('Name') }}" name="name" required autocomplete="name" value="{{ old('name') }}"
                        autofocus>
                    </v-text-field>

                    <v-text-field outlined class="@error('email') error--text @enderror" type="email"
                        label="{{ __('E-Mail Address') }}" name="email" required autocomplete="email"
                        value="{{ old('email') }}" autofocus>
                    </v-text-field>
                    @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror

                    <v-text-field outlined class="@error('password')  error--text @enderror" type="password"
                        label="{{ __('Password') }}" name="password" required autocomplete="new-password">
                    </v-text-field>
                    @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror

                    <v-text-field outlined type="password" label="{{ __('Confirm Password') }}" name="password_confirmation"
                        required autocomplete="new-password">
                    </v-text-field>

                    <v-btn color="#0250c5" class="mr-4" type="submit" block dark>
                        {{ __('Register') }}
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