@extends('layouts.admin')

@section('content')

<h2>Item : Cargo</h2>
<h3>Price: $5</h3>
<form action="{{ route('stripe')}}" method="post">
    @csrf
    <input type="hidden" name="price" value="5">
    <input type="hidden" name="product_name" value="Cargo">
    <input type="hidden" name="quantity" value="1">
    <button type="submit">Pay</button>
</form>
@endsection