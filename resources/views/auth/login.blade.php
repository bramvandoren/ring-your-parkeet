@extends('layouts.main')

@section('content')
    <div class="container">
        <h2>Inloggen</h2>

        <form method="POST" action="{{ route('login') }}">
          @csrf
          <div class="form-group">
              <label for="firstname">Gebruikersnaam:</label>
              <input type="text" name="firstname" id="firstname" class="form-control" required>
          </div>
          <div class="form-group">
              <label for="password">Wachtwoord:</label>
              <input type="password" name="password" id="password" class="form-control" required>
          </div>
          <button type="submit" class="btn btn-primary">Inloggen</button>
      </form>
    </div>
@endsection
