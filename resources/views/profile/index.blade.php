@extends('layouts.main')

@section('content')
    <div class="container">
        <h2>Profielgegevens</h2>

        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Voornaam: {{ $user->firstname }}</h5>
                <h5 class="card-title">Familienaam: {{ $user->lastname }} </h5>
                <p class="card-text">E-mail: {{ $user->email }}</p>
                <p class="card-text">Adres: {{ $user->address_street }} {{ $user->address_nr }} {{ $user->address_zipcode }} {{ $user->address_city }}</p>
                <p class="card-text">Geboortedatum: {{ $user->birthdate }}</p>
                <p class="card-text">E-mail: {{ $user->phone }}</p>

            </div>
        </div>

        <a href="{{ route('profile.edit') }}" class="btn btn-primary mt-3">Profiel bewerken</a>
        <a href="{{ route('logout') }}" class="btn btn-primary mt-3">Uitloggen</a>
    </div>
@endsection
