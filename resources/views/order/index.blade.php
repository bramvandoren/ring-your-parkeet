@extends('layouts.main')

@section('content')
    <div class="container">
        <h2>Vogelringen kopen, online</h2>
        <p>Eenvoudig online uw vogelringen kopen. Vul het gewenste aantal in per afmeting.</p>
        <table class="table">
            <thead>
                <tr>
                    <th>Type</th>
                    <th>Maat (diameter)</th>
                    <th>Prijs/stuk (€)</th>
                    <th>Aantal</th>
                </tr>
            </thead>
            <div>
                @foreach ($vogelringen as $vogelring)
                    <tr>
                        <td>{{ $vogelring->type->name }}</td>
                        <td>{{ $vogelring->diameter }}</td>
                        <td>{{ $vogelring->price }}</td>
                        <td>
                            <form method="post">
                                @csrf
                            <input type="number" name="aantal[]" min="0" value="0" class="form-control aantal-input" data-prijs="{{ $vogelring->price }}" data-naam="{{ $vogelring->name }}">
                        
                            <input type="hidden" name="vogelring" value="{{$vogelring->id}}">
                            <button type="submit" class="btn btn-primary">voeg toe</button>
                        </form>
                        </td>
                    </tr>
                @endforeach
            </div>
        </table>
    </div>
@endsection
