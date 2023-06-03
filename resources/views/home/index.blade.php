@extends('layouts.main')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8">
            <h2>Welkom bij de besteltool voor parkietringen!</h2>
            <p>Deze besteltool maakt het gemakkelijk voor parkietenliefhebbers om ringen te bestellen voor hun vogels. Met een eenvoudig proces kunnen leden de gewenste ringen bestellen.</p>
            </div>
            <div class="col-md-4">
                @guest
                    <h2>Inloggen tot het club-dashboard</h2>
                    <p>Log in om toegang te krijgen tot het club-dashboard waar je het lidgeld kan betalen en bestellingen bekijken/maken.</p>
                    <a href="{{ route('login') }}" class="btn btn-primary">Inloggen</a>
                @else
                    <h2>Club-dashboard</h2>
                    <p>Welkom, {{ Auth::user()->firstname }}!</p>
                    <p>Hier heb je toegang tot het club-dashboard waar je het lidgeld kan betalen en bestellingen bekijken/maken.</p>
                    <a href="{{ route('dashboard.index') }}" class="btn btn-primary">Club-dashboard</a>
                @endguest
            </div>
        </div>
    </div>
@endsection


