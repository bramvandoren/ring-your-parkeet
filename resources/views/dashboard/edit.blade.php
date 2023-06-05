@extends('layouts.main')

@section('content')
    <div class="container">
        <a href="{{ url()->previous() }}" class="btn btn-primary">&#60; Terug</a>
    </div>
    <div class="container">
        <h3>Bestelling {{ $bestelling->id }}</h3>
        <p>Referentie: {{ $bestelling->reference }}</p>
        <p>Status: {{ $bestelling->status }}</p>
        <p>Prijs: <b> € {{ $bestelling->total_price }}</b></p>
        <p>Bestellingsinfo:{{ $bestelling->shipping_data }}</p>
        <p>Betalingsinfo:{{ $bestelling->payment_data }}</p>
        <p>Opmerkingen:{{ $bestelling->remarks }}</p>
        <p>Opmerkingen voor Admin: {{ $bestelling->admin_remarks }}</p>

        <h4>Order Items:</h4>
        <table>
            <thead>
                <tr>
                    <th>Item ID</th>
                    <th>Item Name</th>
                    <th>Ring Type</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($bestellingenDetail as $orderItem)
                    <tr>
                        <td>{{ $orderItem->id }}</td>
                        <td>{{ $orderItem->name }}</td>
                        <td>{{ $orderItem->ringType->name }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <p>
          <form method="POST" action="{{ route('dashboard.annuleer-bestelling', $bestelling->id) }}" onsubmit="return confirm('Weet je zeker dat je deze bestelling wilt annuleren?');">
              @csrf
              @method('DELETE')
              <button type="submit" class="btn btn-danger">Annuleren</button>
          </form>
      </p>
    </div>
@endsection
