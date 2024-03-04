@extends('layouts.admin')

@section('content')

<div class="card">
  <div class="card-header">
<h1>Manage Invoices</h1>
  </div>
  <div class="card-body">
    <div class="form-group">
      <label for="data_filter">Filter By Date</label>
      <form action="" method="get">
        <div class="input-group">
          <select class="form-select" name="data-filter">
            <option value="">All dates</option>
            <option value="today">Today</option>
            <option value="yesterday">Yesterday</option>
            <option value="this_week">This Week</option>
          </select>
          <button type="submit" class="btn btn-primary">Filter</button>
        </div>
      </form>
    </div>
   

    <table class="table">
  <thead>
    <tr>
      <th scope="col">Invoice Number</th>
      <th scope="col">Customer</th>
      <th scope="col">Email</th>
      <th scope="col">File</th>
      <th scope="col">Option</th>
     
    </tr>
  </thead>
  <tbody>
    @foreach ($formdetails as $data)
    <tr>
      <td>{{ $data->order_id }}</td>
      <td>{{$data->firstname}} {{$data->lastname}}</td>
      <td>{{$data->email}}</td>
    
   <td>
      @if($data->pdf_file)
      <a href="{{ Storage::url($data->pdf_file) }}" target="_blank"><img src="../assets/img/pdf.png" alt="logo pdf" width="25px" height="25px">pdf</a>
  @else
      No PDF available
  @endif                            
    </td>
      <td>
       <button type="button" class="btn btn-info">View</button>
       <button type="button" class="btn btn-secondary">Edit</button>
       <button type="button" class="btn btn-danger">Delete</button>

      </td>
 
    
    </tr>
     @endforeach
   
  </tbody>

</table>

  </div>
</div>


@endsection