@extends('layouts.main')

@section('content')
    <div class="container">
        {{-- <h2>Vogelringen kopen</h2> --}}
        <h2><b>Standaard aluminium ringen</b></h2>
        <!-- Button to trigger the modal -->
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#columnModal">
            Bekijk de kleuren per jaar
        </button>
        <!-- Modal -->
        <div class="modal fade" id="columnModal" tabindex="-1" role="dialog" aria-labelledby="columnModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="columnModalLabel">Jaren Kolom</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <table>
                            <thead>
                                <tr>
                                    <th>Jaren</th>
                                    <th>Kleur</th>
                                    <th>Code</th>
                                    <th>Teint</th>
                                </tr>
                            </thead>
                            <tbody>
                                @for ($year = 2014; $year <= 2025; $year++)
                                    <tr>
                                        <td>{{ $year }}</td>
                                    </tr>
                                @endfor
                                <tr>
                                    <td>Zwart</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- weergave van de kleurringen -->

        <table class="table">
            <thead>
                <tr>
                    <th>Foto</th>
                    <th>Type</th>
                    <th>Maat (diameter in mm)</th>
                    <th>Prijs/stuk (€)</th>
                    <th>Aantal</th>
                </tr>
            </thead>
            <div>
                @foreach ($kleurVogelringen as $vogelring)
                    <tr>
                        <td><img src="" alt="Afbeelding {{$vogelring->id}}" ></td>
                        <td>{{ $vogelring->type->name }}</td>
                        <td>{{ $vogelring->diameter }}</td>
                        <td>{{ $vogelring->price }}</td>
                        <td>
                            <form method="post">
                                @csrf
                                <input type="number" name="aantal[]" min="10" step="5" value="0" class="form-control aantal-input" data-prijs="{{ $vogelring->price }}" data-naam="{{ $vogelring->name }}">
                        
                            <input type="hidden" name="vogelring" value="{{$vogelring->id}}">
                            <button type="submit" class="btn btn-primary">voeg toe</button>
                        </form>
                        </td>
                    </tr>
                @endforeach
            </div>
        </table>

        <!-- weergave van de inoxringen -->
        <h2><b>Standaard RVS ringen</b></h2>
        <table class="table">
            <thead>
                <tr>
                    <th>Foto</th>
                    <th>Type</th>
                    <th>Maat (diameter in mm)</th>
                    <th>Prijs/stuk (€)</th>
                    <th>Aantal</th>
                </tr>
            </thead>
            <div>
                @foreach ($inoxVogelringen as $vogelring)
                    <tr>
                        <td><img src="" alt="Afbeelding {{$vogelring->id}}" ></td>
                        <td>{{ $vogelring->type->name }}</td>
                        <td>{{ $vogelring->diameter }}</td>
                        <td>{{ $vogelring->price }}</td>
                        <td>
                            <form method="post">
                                @csrf
                                <input type="number" name="aantal[]" min="1" value="0" class="form-control aantal-input" data-prijs="{{ $vogelring->price }}" data-naam="{{ $vogelring->name }}">
                        
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
