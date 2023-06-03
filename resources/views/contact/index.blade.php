@extends('layouts.main')

@section('content')
    <div class="container">
        <h1>Contact Us</h1>

        <p>Feel free to get in touch with us using the contact information below:</p>

        <div class="contact-info">
            <h3>Address</h3>
            <p>123 Main Street</p>
            <p>City, Country</p>

            <h3>Email</h3>
            <p>info@example.com</p>

            <h3>Phone</h3>
            <p>+1 123-456-7890</p>
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
