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
                            <th>ID</th>
                            <th>Customer</th>
                            <th>Email</th>
                            <th>Contact</th>
                            <th>Status</th>
                            <th>Date</th>
                            <th>Action</th>
                        </thead>
                        <tbody>
                          @foreach ($formdetails as $data)
                            <tr>
                              <td>{{$data->id}}</td>
                              <td>{{$data->firstname}} {{$data->lastname}}</td>
                              <td>{{$data->email}}</td>
                              <td>{{$data->contact}}</td>
                              <td><span class="badge bg-warning">{{$data->status}}</span></td>
                              <td>{{ $data->created_at->format('M d Y') }}</td>
                                <td>
                                    {{-- <a href="{{ route('invoice.view', ['id' => $data->id]) }}" class="btn btn-primary">View</a> --}}
                                    <a href="{{ route('generate.pdf', ['id' => $data->id]) }}" class="btn btn-success">Generate Invoice</a>
                                    <button type="button" class="btn btn-sm btn-primary view-order-btn" data-order-id="{{ $data->id }}">
                                        View
                                    </button> 
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


<div class="modal" id="myModal">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Details</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <div class="col-md-6">
                    <p id="id"></p>
                    <p id="date"></p>
                    <p id="email"></p>
                </div>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Function to populate modal content and open the modal
    function populateModal(response) {
    // Extract order data from the response
    var order = response.orderFind;

    // Format the date in the desired format
    var createdAtDate = new Date(order.created_at);
    var formattedDate = formatDate(createdAtDate);

    // Update modal content with the formatted date
    document.getElementById('id').innerText = 'ID: ' + order.order_id;
    document.getElementById('date').innerText = 'Date: ' + formattedDate;
    document.getElementById('email').innerText = 'Email: ' + order.email;
    // Add more fields as needed

    // Open the modal
    var modal = new bootstrap.Modal(document.getElementById('myModal'));
    modal.show();
}

// Function to format date in MMM DD, YYYY format
function formatDate(date) {
    var monthNames = ["Jan", "Feb", "Mar", "Apr", "May", "Jun",
                      "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];

    var day = date.getDate();
    var monthIndex = date.getMonth();
    var year = date.getFullYear();

    return monthNames[monthIndex] + ' ' + (day < 10 ? '0' : '') + day + ', ' + year;
}

    // Event listener for the button click
    document.querySelectorAll('.view-order-btn').forEach(function(button) {
        button.addEventListener('click', function() {
            // Retrieve the order ID from the button's data attribute
            var orderId = this.getAttribute('data-order-id');

            // Fetch order data from the API using the order ID
            fetch('http://127.0.0.1:8000/api/order/' + orderId)
            .then(response => {
                // Check if response is successful (status code 200-299)
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json(); // Parse JSON response
            })
            .then(response => {
                // Populate the modal with the fetched order data
                populateModal(response);
            })
            .catch(error => {
                console.error('Error fetching order data:', error);
            });
        });
    });
});

</script>
    

