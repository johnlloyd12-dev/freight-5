 <!-- Sidebar -->
    <div class="sidebar">
        <a href="#" class="logo">
            <img src='../assets/img/kargada-logo.png' alt="">
            <div class="logo-name"><span>Kar</span>gada</div>
        </a>
        <ul class="side-menu">
            <li><a href=" {{ url('/admin/dashboard') }}"><i class='bx bxs-dashboard'></i>Dashboard</a></li>
            <li><a href="#"><i class='bx bx-store-alt'></i>Invoices</a></li>
            <li><a  id="subMenu" style="opacity: 1" href=" {{ url('/admin/invoices') }}"></i>Orders</a></li>
            <li><a  id="subMenu" style="opacity: 1" href=" {{ url('/admin/manage') }}"></i>Manage Invoices</a></li>
            <li><a  id="subMenu" style="opacity: 1" href=" {{ url('/admin/paymentshistory') }}"></i>Payment History</a></li>
            <li><a href="#"><i class='bx bx-message-square-dots'></i>Audits</a></li>
            <li><a  id="subMenu" style="opacity: "></i>Shipping Rate</a></li>
            <li><a  id="subMenu" style="opacity:" href=" {{ url('/admin/expenses') }}"></i>Expenses</a></li>
            <li><a href="#"><i class='bx bx-group'></i>{{ Auth::user()->name }}</a></li>
        </ul>
       
                </a>
                <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        <i class='bx bx-log-out-circle'></i>{{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
            </li>
        </ul>
    </div>
    <!-- End of Sidebar -->