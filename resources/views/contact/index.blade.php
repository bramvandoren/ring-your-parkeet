@extends('layouts.main')

@section('content')
    <div class="container">
        <h1>Contacteer mij</h1>

        <div class="contact-info">
            <h3>Naam</h3>
            <p><b>Luc De Baecker</b></p>
            <h3>Adres</h3>
            <p>Vikingstraat 24</p>
            <p>8800 Roeselare</p>

            <h3>Email</h3>
            <p>bvp.ringendienst@gmail.com</p>
            <a href="mailto:bvp.ringendienst@gmail.com">Stuur een e-mail</a>


            <h3>GSM</h3>
            <p>0485/85 33 76</p>
        </div>

        {{-- <h2>Contact Form</h2>

        <form action="{{ route('contact.submit') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="name">Your Name</label>
                <input type="text" name="name" id="name" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="email">Your Email</label>
                <input type="email" name="email" id="email" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="message">Message</label>
                <textarea name="message" id="message" class="form-control" rows="5" required></textarea>
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form> --}}
    </div>
@endsection
