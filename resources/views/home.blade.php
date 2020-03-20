@extends('layouts.app')


@section('content')

<v-container fluid>
    <v-row align="center" justify="center">
        <v-col cols="12" md="8">

        <!-- messages -->
        @if (isset($message))
            <v-alert dismissible type="success" border="left" elevation="2">
                {{ $message }}
            </v-alert>
        @endif

        <data-tables title="Contacts" :collection="{{ json_encode($collection) }}" url="{{ route('contacts.index')  }}" token="{{ csrf_token() }}" guest="{{ Auth::guest() }}" />
        </v-col>
    </v-row>
</v-container>

@endsection