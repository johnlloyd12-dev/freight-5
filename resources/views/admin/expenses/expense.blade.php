@extends('layouts.admin')

@section('content')

<div class="card">
  <div class="card-header">
<h1>Expense Reports</h1>
  </div>
  <br></br>
 
    <table class="table">
  <thead>
    <tr>
      <th scope="col">Type</th>
      <th scope="col">Drivers Name</th>
      <th scope="col">Amount</th>
      <th scope="col">Truck Number</th>
      <th scope="col">Option</th>
     
    </tr>
  </thead>
  <tbody>

@if (count($data) > 0)

@foreach($data as $row)
    <tr>
      <th scope="row">{{ $row->type}}</th>
      <td>{{ $row->drivers_name}}</td>
      <td>{{ $row->amount}}</td>
      <td>{{ $row->truck_number}}</td>
      <td>
      <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
  View
</button>
      </td>
      <td>
        <!-- The Modal -->
<div class="modal" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Details</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <table>
          <thead>
            <tr>
              <th>
              Type:
              </th>
              <th>
                Drivers Name:
              </th>
              <th>
                Amount:
              </th>
              <th>
                Truck Number:
              </th>
       
            </tr>
          </thead>
          <tbody>
          @foreach($data as $row)
          
    <tr>
      <th scope="row">{{ $row->type}}</th>
      <td>{{ $row->drivers_name}}</td>
      <td>{{ $row->amount}}</td>
      <td>{{ $row->truck_number}}</td>
      <td>
      
      @endforeach()
          </tbody>
        </table>
    
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>

      </td>
  
      
     
     

    </tr>
      @endforeach()
@else
<tr>
  <td colspan="5" class="text-center">No Data Found</td>
</tr>
@endif
  
    </tr>
   
  </tbody>
</table>
{!! $data->links() !!}
  </div>
</div>



<!-- Modal
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">View Data</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <div class="card">
  <div class="card-body">
    <br>
    <h5 class="card-title">Details</h5>
    

          </div>
          </div>
          </div>
           <div class="modal-footer">
         <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
   
      </div>
    </div>
  </div>
</div> -->


@endsection


