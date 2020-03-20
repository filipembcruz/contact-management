@extends('layouts.app')

@section('content')

@php
$items = [
    [
        'icon' => 'mdi-account',
        'label' => 'Name',
        'value' => $collection->name
    ],
    [
        'icon' => 'mdi-contacts',
        'label' => 'Contact',
        'value' => $collection->contact
    ],
    [
        'icon' => 'mdi-email-check',
        'label' => 'Email',
        'value' => $collection->email
    ],
];
@endphp

<v-container fluid>
    <v-row align="center" justify="center">
        <v-col cols="12" md="8">
            <h2>Add new contact</h2>

            <v-divider class="mt-2 pb-4"></v-divider>
            @foreach ($items as $item)
            <v-list-item>
                <v-list-item-avatar>
                    <v-icon color="#32b4e4" large>{{ $item['icon'] }}</v-icon>
                </v-list-item-avatar>

                <v-list-item-content>
                    <v-list-item-title><b>{{ $item['label'] }}</b></v-list-item-title>
                    <v-list-item-subtitle>{{ $item['value'] }}</v-list-item-subtitle>
                </v-list-item-content>
            </v-list-item>
            @endforeach
            <v-btn href="{{ route('home') }}" color="default" class="mr-4 mt-5" text>
                Cancel
            </v-btn>
        </v-col>
    </v-row>
</v-container>

@endsection