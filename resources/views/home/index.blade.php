@extends('layouts.main')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8">
            @guest
                <h2>Welkom bij de besteltool voor parkietringen!</h2>
                <p>Deze besteltool maakt het gemakkelijk voor parkietenliefhebbers om ringen te bestellen voor hun vogels. Met een eenvoudig proces kunnen leden de gewenste ringen bestellen.</p>
            @else
                <h2>Welkom, {{ Auth::user()->firstname }}!</h2>
                <p>Deze besteltool maakt het gemakkelijk voor jou om ringen te bestellen voor jouw vogels en het lidgeld online te betalen.</p>
                <a href="{{ route('dashboard.index') }}" class="btn btn-primary">Naar het dashboard</a>
            @endguest
            </div>
            <div class="col-md-4">
                @guest
                    <h2>Inloggen tot het club-dashboard</h2>
                    <p>Log in om toegang te krijgen tot het club-dashboard waar je het lidgeld kan betalen en bestellingen van ringen kan bekijken/maken.</p>
                    <a href="{{ route('login') }}" class="btn btn-primary">Inloggen</a>
                @else
                    <h2>Ringen bestellen</h2>
                    <p>Bestel hier snel je ringen</p>
                    @if ($lidgeldBetaald)
                        <a href="{{ route('order.store') }}"  class="btn btn-primary">Maak bestelling</a>
                    @else
                        <p>Plaatsen van bestellingen is alleen mogelijk na betaling van het <b>lidgeld.</b></p>
                    @endif
                @endguest
            </div>
        </div>
    </div>
@endsection


