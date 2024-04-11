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
                        <th scope="col">ID#</th>
                        <th scope="col">Invoice#</th>
                        <th scope="col">Customer</th>
                        <th scope="col">Company</th>
                        <th scope="col">Date</th>
                        <th scope="col">Status</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($formdetails as $data)
                        <tr>
                            <td>{{ $data->id}}</td>
                            <td>{{ $data->invoice_number }}</td>
                            <td>{{ $data->customer_name }}</td>
                            <td>{{ $data->company_name }}</td>
                            {{-- <td>
                                @if ($data->pdf_file)
                                    <a href="{{ Storage::url($data->pdf_file) }}" target="_blank"><img
                                            src="../assets/img/pdf.png" alt="logo pdf" width="25px" height="25px">pdf</a>
                                @else
                                    No PDF available
                                @endif
                            </td> --}}
                            <td>{{ $data->created_at->format('M d Y') }}</td>
                            <td><span class="bg-success badge">{{ $data->status }}</span></td>
                            <td>
                                <a href="{{ route('download.pdf', ['id' => $data->id]) }}" class="btn btn-success">Download PDF</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
