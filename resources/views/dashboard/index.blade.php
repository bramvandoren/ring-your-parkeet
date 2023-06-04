@extends('layouts.main')

@section('content')
<div class="container d-flex flex-column">
    <div class="container">
        <!-- Lidgeld betalen -->
        <h3>Lidgeld betalen</h3>
        <p>Jaarlijks lidgeld: € {{ $lidgeld }}</p>
        <form method="POST" action="{{ route('dashboard.betalingLidgeld') }}">
            @csrf
            <button type="submit" class="btn btn-primary">Betaal lidgeld</button>
        </form>
    </div>
    <div class="container">
    <h3>Ringen Bestellen</h3>
    @if ($lidgeldBetaald)
        <a href="{{ route('order.store') }}"  class="btn btn-primary">Maak bestelling</a>
    @else
        <p>Plaats van bestellingen is alleen mogelijk na betaling van het <b>lidgeld.</b></p>
    @endif
    </div>
</div>
    <div class="container w-100 p-3">
        <h3>Bestelhistorie</h3>
        @if ($bestellingen->count() > 0)
            <table class="container w-100 p-3">
                <thead>
                    <tr>
                        <th>Bestelling ID</th>
                        <th>Bestelstatus</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($bestellingen as $bestelling)
                        <tr>
                            <td>{{ $bestelling->id }}</td>
                            <td>{{ $bestelling->status }}</td>
                            <td>
                                <form method="POST" action="{{ route('dashboard.annuleer-bestelling', $bestelling->id) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Annuleren</button>
                                </form>
                            </td>
                            {{-- <td>
                                <form action="{{ route('bestellingen.verwijderen', $bestelling) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-outline-danger" type="submit">Verwijder</button>
                                </form>
                            </td> --}}
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p>Geen bestellingen gevonden.</p>
        @endif
    </div>
@endsection

