@extends('layouts.main')

@section('content')
    <div class="container">
        <h2>Inloggen</h2>

        <form method="POST" action="{{ route('login') }}">
            @csrf
            {{-- <div class="form-group">
                <label for="firstname">Gebruikersnaam:</label>
                <input type="text" name="firstname" id="firstname" class="form-control" required>
                @error('firstname')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div> --}}
            <div class="form-group">
                <label for="email">E-mail:</label>
                <input type="email" name="email" id="firstname" class="form-control" required>
                @error('email')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="password">Wachtwoord:</label>
                <input type="password" name="password" id="password" class="form-control" required>
                @error('password')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Inloggen</button>
        </form>
        <p class=".md-3">- OF -</p>
        <div>
            <a href="{{ url('admin/login') }}" class="btn btn-outline-primary">Ik ben admin gebruiker</a>
        </div>
    </div>
@endsection
