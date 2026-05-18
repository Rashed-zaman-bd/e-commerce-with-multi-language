@extends('layouts.app')

@section('title', 'Home Page')

@section('content')

    <x-herobanner :heroes="$heroes"/>

    <x-imageMenu :items="$items" />

    <x-offerproduct :products="$products"/>

    <div class="mt-10">
        <h1 class="text-3xl font-bold text-blue-600">
            Home Page
        </h1>

        <p class="mt-4">
            Welcome to Laravel Blade Layout System.
        </p>
    </div>

@endsection