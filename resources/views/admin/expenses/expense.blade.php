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
                <th scope="col">ID</th>
                <th scope="col">Added By</th>
                <th>QTY</th>
                <th>Meter Reading</th>
                <th>Price</th>
                <th>Date</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($row as $data)
            <tr>
                <th scope="row">{{ $data->v_fuel_id }}</th>
                <td>{{ $data->v_fueladdedby }}</td>
                <td>{{ $data->v_fuel_quantity }}</td>
                <td>{{ $data->v_odometerreading }}</td>
                <td>{{ $data->v_fuelprice }}</td>
                <td>{{ $data->v_modified_date ? \Carbon\Carbon::parse($data->v_modified_date)->format('M d Y') : '' }}</td>
                <td>
                    <button type="button" class="btn btn-sm btn-primary view-fuel-btn" data-fuel-id="{{ $data->v_fuel_id }}">
                        View
                    </button>                                                                
                </td>
            </tr>
        @endforeach
        
        </tbody>
    </table>
    {{-- {!! $data->links() !!} --}}
</div>

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
                    <p id="v_fuel_id"></p>
                    <p id="v_fuel_added"></p>
                    <p id="v_fuelfilldate"></p>
                    <p id="v_fuelcomments"></p>
                </div>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
</div>

@endsection

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Function to populate modal content and open the modal
    function populateModal(response) {
        // Extract fuel data from the response
        var fuelData = response.fuel;

        // Update modal content with the fuel data
        document.getElementById('v_fuel_id').innerText = 'Fuel ID: ' + fuelData.v_fuel_id;
        document.getElementById('v_fuel_added').innerText = 'Added By: ' + fuelData.v_fueladdedby;
        document.getElementById('v_fuelfilldate').innerText = 'Date: ' + fuelData.v_fuelfilldate;
        document.getElementById('v_fuelcomments').innerText = 'Description: ' + fuelData.v_fuelcomments;

        // Open the modal
        var modal = new bootstrap.Modal(document.getElementById('myModal'));
        modal.show();
    }

    // Event listener for the button click
    document.querySelectorAll('.view-fuel-btn').forEach(function(button) {
        button.addEventListener('click', function() {
            // Retrieve the fuel ID from the button's data attribute
            var fuelId = this.getAttribute('data-fuel-id');

            // Fetch fuel data from the API using the fuel ID
            fetch('http://127.0.0.1:8000/api/fuel/' + fuelId)
            .then(response => {
                // Check if response is successful (status code 200-299)
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json(); // Parse JSON response
            })
            .then(response => {
                // Populate the modal with the fetched fuel data
                populateModal(response);
            })
            .catch(error => {
                console.error('Error fetching fuel data:', error);
            });
        });
    });
});

</script>
