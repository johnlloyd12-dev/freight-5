@extends('layouts.admin')

@section('content')

<div class="container-fluid mt-5">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h2 class="mb-0">Order View</h2>
                    <a href="{{ route('generate.pdf', ['id' => $data->id]) }}" class="btn btn-success float-lg-right">Generate Invoice</a>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="row">
    <div class="col-md-12">
        <div class="card mt-3">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4 mt-3">
                        <div class="border p-2">
                            <label>Order ID: {{ $data->id }}</label>
                            <h6></h6>
                        </div>
                    </div>
                    <div class="col-md-4 mt-3">
                        <div class="border p-2">
                            <label>Customer Name:{{$data->firstname}} {{$data->lastname}}</label>
                            <h6></h6>
                        </div>
                    </div>
                    <div class="col-md-4 mt-3">
                        <div class="border p-2">
                            <label>Item: {{$data->item}}</label>
                            <h6></h6>
                        </div>
                    </div>
                    <div class="col-md-4 mt-3">
                        <div class="border p-2">
                            <label>Dimensions {{$data->dimensions}}</label>
                            <h6></h6>
                        </div>
                    </div>
                    <div class="col-md-4 mt-3">
                        <div class="border p-2">
                            <label>Price:{{$data->price}}</label>
                            <h6></h6>
                        </div>
                    </div>
                    
                    <div class="col-md-4 mt-3">
                        <div class="border p-2">
                            <label>Email: {{$data->email}}</label>
                            <h6></h6>
                        </div>
                    </div>
                    <div class="col-md-4 mt-3">
                        <div class="border p-2">
                            <label>Contact Number:{{$data->contact}}</label>
                            <h6></h6>
                        </div>
                    </div>
                    <div class="col-md-4 mt-3">
                        <div class="border p-2">
                            <label>Payment Mode:</label>
                            <h6></h6>
                        </div>
                    </div>
                    <div class="row">
        <div class="col-md-12">

            </div>
        </div>
    </div>
</div>

@endsection