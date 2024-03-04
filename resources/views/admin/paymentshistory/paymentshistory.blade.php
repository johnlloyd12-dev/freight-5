@extends('layouts.admin')

@section('content')
<div class="card">
    <div class="card-header">
  <h1>Payment Histrory</h1>
    </div>
    <div class="card-body">
      <table class="table">
    
        <thead>
            <th>Amount</th>
            <th>Payment Method</th>
            <th>Email</th>
            <th>Customer</th>
            <th>Date</th>
        </thead>
    <tbody>
        @foreach ($payments as $payments)
        <tr>
            <td>${{$payments->amount}}</td>
            <td>{{$payments->payment_method}}</td>
            <td>{{$payments->customer_email}}</td>
            <td>{{$payments->customer_name}}</td>
            <td>{{$payments->created_at}}</td>
        </tr>
        @endforeach
     
    </tbody>
  
  </table>
  
    </div>
  </div>
  

@endsection