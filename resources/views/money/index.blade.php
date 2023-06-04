@extends('layouts.dashboard')

@section('content')
    <div class="row">
        <div class="col-12">
            <h1>Jij verdient van mij...</h1>    

            <form action="{{ route('rich.earn') }}" method="POST">
                @csrf
                <div>
                    <input class="form-control" name="name" type="text" value="" placeholder="Jouw naam">
                </div>
                <div>
                    <input class="form-control" name="amount" type="number" value="" placeholder="Jouw bedrag">
                </div>
                <div>
                    <button class="btn btn-primary" type="submit">Verstuur</button>
                </div>

            </form>
        </div>    
    </div>    
@endsection