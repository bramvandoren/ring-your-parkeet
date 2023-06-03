@extends('layouts.main')

@section('content')
    <div class="container">
        <h2>Dashboard</h2>

        <!-- Lidgeld betalen -->
        <h3>Lidgeld betalen</h3>
        <p>Jaarlijks lidgeld: ${{ $lidgeld }}</p>
        <form method="POST" action="{{ route('dashboard.betalingLidgeld') }}">
            @csrf
            <button type="submit" class="btn btn-primary">Betaal lidgeld</button>
        </form>

        <!-- Bestellingen -->
        <h3>Bestelhistorie</h3>
        @if ($bestellingen->count() > 0)
            <table>
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
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p>Geen bestellingen gevonden.</p>
        @endif

        <h3>Ringen Bestellen</h3>
        <a href="{{ route('order.store') }}"  class="btn btn-primary">Maak bestelling</a>
        {{-- <form method="POST" action="{{ route('dashboard.bestellen-ringen') }}">
            @csrf
            <button type="submit" class="btn btn-primary">Bestelling Toevoegen</button>
        </form> --}}
    </div>
@endsection

