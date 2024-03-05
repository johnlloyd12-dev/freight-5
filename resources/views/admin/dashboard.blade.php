@extends('layouts.admin')

@section('content')

        <main>
            <div class="header">
                <div class="left">
                  @if(session('message'))
                  <h2 class="alert alert-success">{{session('message')}},</h2>
                  @endif
                    <h1>Dashboard</h1>
                    
                </div>
            </div>

            <!-- Insights -->
            <ul class="insights">
                <li>
                    <i class='bx bx-calendar-check'></i>
                    <span class="info">
                        <h3>
                            {{ $data }}
                        </h3>
                        <p>Total Invoices</p>
                    </span>
                </li>
                <li><i class='bx bx-money'></i>
                    <span class="info">
                        <h3>
                           {{$data2}}
                        </h3>
                        <p>Total Expenses</p>
                    </span>
                </li>
               
            </ul>
            <!-- End of Insights -->

            <div class="bottom-data">
                <div class="orders">
                    <div class="header">
                        <i class='bx bx-receipt'></i>
                        <h3>Recent Invoices</h3>
                    </div>
                    <table>
                        <thead>
                            <tr>
                                <th>Customer</th>
                                <th>Date</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($formdetails as $data)
                            <tr>
                                <td>
                                    <img src="images/profile-1.jpg">
                                    <p>{{$data->firstname}} {{$data->lastname}}</p>
                                </td>
                                <td>{{$data->created_at}}</td>
                                <td><span class="status completed">Completed</span></td>
                            </tr>
                    
                           
                            @endforeach
                        </tbody>
                    </table>
                </div> 
            </div>
        </main>
@endsection
