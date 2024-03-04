@extends('layouts.admin')

@section('content')
    <div class="container-fluid mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h2 class="mb-0">Orders</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-3">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <table class="table table-striped table=bordered">
                        <thead>
                            <th>Order ID</th>
                            <th>Customer</th>
                            <th>Item</th>
                            <th>Price</th>
                            <th>Date</th>
                          
                        </thead>
                        <tbody>
                          @foreach ($formdetails as $data)
                            <tr>
                              <td>{{$data->order_id}}</td>
                              <td>{{$data->firstname}} {{$data->lastname}}</td>
                              <td>{{$data->item}}
                              <td>{{$data->price}}</td>
                              <td>{{$data->created_at}}</td>
                                <td>
                                    <a href="{{ route('invoice.view', ['id' => $data->id]) }}" class="btn btn-primary float-lg-right">View</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
