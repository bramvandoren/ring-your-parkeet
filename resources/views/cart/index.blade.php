@extends('layouts.main')

@section('content')
    <div class="container">
        <h1>Winkelwagen</h1>
        <div class="container">
            <form action="{{ route('cart.update') }}" method="POST">
                @csrf
                <ul class="list-group">
                    @foreach ($cart->getContent() as $item)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <div class="d-flex flex-column">
                                <p>image</p>
                            </div>
                            <div class="d-flex flex-column">
                                <p>{{ $item->name->name }}</p>
                                <p>{{ $item->name->type_id }}</p>
                                <p>Aantal:
                                    <input type="number" min="1" name="aantal[]" value="{{ $item->quantity }}" >
                                    <input type="hidden" name="item_id[]" value="{{ $item->id }}">
                                </p>
                                <a href="{{ route('cart.remove', ['id' => $item->id]) }}">Item verwijderen</a>
                            </div>
                            <div class="d-flex align-items-center">
                                <h3>€ {{ $item->price }}</h3>
                            </div>
                        </li>
                    @endforeach
                    <h2>Totaal: €{{ $cart->getTotal() }}</h2>                </ul>
            </form>
        </div>
        <div>
            <h2>We accepteren</h2>
            <ul class="payment-icons">
                <li><i class="fab fa-cc-visa"></i></li>
                <li><i class="fab fa-cc-mastercard"></i></li>
                <li><i class="fab fa-cc-paypal"></i></li>
                <li><i class="fab fa-cc-amex"></i></li>
            </ul>
        </div>
        <div class="text-right">
            <a href="{{ route('cart.checkout') }}" class="btn btn-primary">Afrekenen</a>
        </div>
    </div>
@endsection
