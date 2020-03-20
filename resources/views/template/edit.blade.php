@extends('layouts.app')

@section('content')

<v-container fluid>
    <v-row align="center" justify="center">
        <v-col cols="12" md="8">
            <h2>Edit contact</h2>
            <v-divider class="mt-2 pb-4"></v-divider>

            <!-- Messages -->
            @if ($errors->any())
                @foreach ($errors->all() as $error)
                <v-alert dismissible type="warning" border="left" elevation="2">
                    {{ $error }}
                </v-alert>
                @endforeach
            @endif

            @if (isset($message))
                <v-alert dismissible type="success" border="left" elevation="2">
                    {{ $message }}
                </v-alert>
            @endif

            <form-header id="editForm" css="" action="{{ route('contacts.update', ['id' => $collection->id]) }}" method="put" enctype=""
                token="{{ csrf_token() }}">
                <custom-field cname="name" cvalue="{{ old('name', $collection->name) }}" :rules="[
                    v => !!v || 'Name is required',
                    v => (v && v.length >= 5) || 'The name must be at least 5 characters.']" clabel="Name" required>
                </custom-field>

                <custom-field cname="contact" cvalue="{{ old('contact', $collection->contact) }}" mask="#########"
                    :rules="[
                    v => !!v || 'Contact is required',
                    v => (v && v.length > 8) || 'Contact must be 9 digits',]" clabel="Contact" required></custom-field>

                <custom-field cname="email" cvalue="{{ old('email', $collection->email) }}" :rules="[
                    v => !!v || 'E-mail is required',
                    v => /.+@.+\..+/.test(v) || 'E-mail must be valid',]" clabel="E-mail" required></custom-field>

                <v-btn href="{{ route('home') }}" color="default" class="mr-4 mt-5" text>
                    Cancel
                </v-btn>
                <v-btn type="submit" color="success" class="mr-4 mt-5">
                    SAVE
                </v-btn>
            </form-header>
        </v-col>
    </v-row>
</v-container>

@endsection