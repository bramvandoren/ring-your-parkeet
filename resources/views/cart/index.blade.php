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
                                {{-- <p>{{ $item->attributes }}</p> --}}
                                <p>{{ $item->name->type_id }}</p>
                                <p>Aantal:
                                    <input type="number" min="1" name="aantal[]" value="{{ $item->quantity }}" class="form-control">
                                    <input type="hidden" name="item_id[]" value="{{ $item->id }}">
                                </p>
                                <a href="{{ route('cart.remove', ['id' => $item->id]) }}" class="link-danger">Item verwijderen</a>
                            </div>
                            <div class="d-flex align-items-center">
                                <h3>€ {{ $item->price }}</h3>
                            </div>
                        </li>
                    @endforeach
                    <h2 class="mt-4">Totaal: €{{ $cart->getTotal() }}</h2>
                </ul>
                <div class="text-right mt-4">
                    <a href="{{ route('cart.checkout') }}" class="btn btn-primary">Afrekenen</a>
                </div>
            </form>
        </div>
        <div>
            <h2 class="mt-4">We accepteren</h2>
            <ul class="list-unstyled">
                <li><img src="../img/Bancontact.png" alt="bancontact" class="w-25 p-3"></li>
                <li><img src="../img/paypal.png" alt="paypal" class="w-25 p-3"></li>
            </ul>
        </div>
    </div>
@endsection
