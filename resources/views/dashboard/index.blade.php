@extends('layouts.main')

@section('content')
<div class="container d-flex flex-column">
    <div class="container">
        <!-- Lidgeld betalen -->
        <h3>Lidgeld betalen</h3>
        @if ($lidgeldBetaald)
            <p>Lidgeld betaald.</p>
            <button class="btn btn-primary" data-toggle="modal" data-target="#paymentDetailsModal">Bekijk betalingsdetails</button>
        @else
            <p>Jaarlijks lidgeld: € {{ $lidgeld }}</p>
            <form method="POST" action="{{ route('dashboard.betalingLidgeld') }}">
                @csrf
                {{-- <button type="submit" class="btn btn-primary">Betaal lidgeld</button> --}}
                <a href="{{ route('dashboard.betalingLidgeld') }}" class="btn btn-primary">Betaal lidgeld</a>
            </form>
        @endif
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
                                <a href="{{ route('bestelling.detail', $bestelling->id) }}" class="btn btn-outline-primary">Meer info</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p>Geen bestellingen gevonden.</p>
        @endif
    </div>

    <!-- Payment Details Modal -->
    <div class="modal fade" id="paymentDetailsModal" tabindex="-1" role="dialog" aria-labelledby="paymentDetailsModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="paymentDetailsModalLabel">Betalingsdetails</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Weergeven van details betaling -->
                    <p>Betalingsinformatie:</p>
                    <ul>
                        <li>Transactie ID: {{ $userStatus->id }}</li>
                        <li>Betaalinformatie: {{ $userStatus->payment_data }}</li>
                        <li>Bedrag: € {{ $userStatus->total_price }}</li>
                        <li>Datum: {{ $userStatus->date }}</li>
                    </ul>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Sluiten</button>
                </div>
            </div>
        </div>
    </div>
@endsection
