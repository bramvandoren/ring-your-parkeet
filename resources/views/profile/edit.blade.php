@extends('layouts.main')

@section('content')
    <div class="container">
        <h2>Profiel bewerken</h2>

        <form method="POST" action="{{ route('profile.update') }}">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="firstname">Voornaam:</label>
                <input type="text" name="firstname" id="firstname" class="form-control" value="{{ $user->firstname }}" required>
            </div>
            <div class="form-group">
              <label for="lastname">Familienaam:</label>
              <input type="text" name="lastname" id="lastname" class="form-control" value="{{ $user->lastname }}">
          </div>
            <div class="form-group">
                <label for="email">E-mailadres:</label>
                <input type="email" name="email" id="email" class="form-control" value="{{ $user->email }}" required>
            </div>

            <div class="form-group">
                <label for="password">Wachtwoord:</label>
                <input type="password" name="password" id="password" class="form-control">
            </div>

            <div class="form-group">
                <label for="password_confirmation">Wachtwoord bevestigen:</label>
                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control">
            </div>

             <!-- Extra velden -->
             {{-- <div class="form-group">
                <label for="stamnr">Stamnummer:</label>
                <input type="text" name="stamnr" id="stamnr" class="form-control" value="{{ $user->stamnr }}">
            </div> --}}

            <div class="form-group">
                <label for="address_street">Straat:</label>
                <input type="text" name="address_street" id="address_street" class="form-control" value="{{ $user->address_street }}">
            </div>

            <div class="form-group">
                <label for="address_nr">Huisnummer:</label>
                <input type="text" name="address_nr" id="address_nr" class="form-control" value="{{ $user->address_nr }}">
            </div>

            <div class="form-group">
                <label for="address_zipcode">Postcode:</label>
                <input type="text" name="address_zipcode" id="address_zipcode" class="form-control" value="{{ $user->address_zipcode }}">
            </div>

            <div class="form-group">
                <label for="address_city">Woonplaats:</label>
                <input type="text" name="address_city" id="address_city" class="form-control" value="{{ $user->address_city }}">
            </div>

            <div class="form-group">
                <label for="birthdate">Geboortedatum:</label>
                <input type="date" name="birthdate" id="birthdate" class="form-control" value="{{ $user->birthdate }}">
            </div>

            <div class="form-group">
                <label for="phone">Telefoonnummer:</label>
                <input type="text" name="phone" id="phone" class="form-control" value="{{ $user->phone }}">
            </div>
            <!-- Einde extra velden -->

            <button type="submit" class="btn btn-primary">Opslaan</button>
        </form>
    </div>
@endsection
