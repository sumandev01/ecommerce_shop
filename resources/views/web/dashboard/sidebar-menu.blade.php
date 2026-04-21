<div class="wpo-dashboard-left">
    <ul class="user-dashboard-menu">
        <li class="py-2 {{ request()->routeIs('user.dashboard') ? 'active' : '' }}">
            <a href="{{ route('user.dashboard') }}">Dashboard</a>
        </li>
        <li class="py-2 {{ request()->routeIs('user.orders') ? 'active' : '' }}">
            <a href="{{ route('user.orders') }}">Orders</a>
        </li>
        <li class="py-2 {{ request()->routeIs('user.profile') ? 'active' : '' }}">
            <a href="{{ route('user.profile') }}">Profile</a>
        </li>
        <li class="py-2 {{ request()->routeIs('user.changePassword') ? 'active' : '' }}">
            <a href="{{ route('user.changePassword') }}">Change Password</a>
        </li>
        <li class="py-2">
            <a href="{{ route('logout') }}">Logout</a>
        </li>
    </ul>
</div>
@push('style')
    <style>
        .wpo-dashboard-left {
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 5px;
        }

        .wpo-dashboard-left ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .wpo-dashboard-left ul li a {
            color: #333;
            font-size: 16px;
            font-weight: 600;
            padding: 10px 30px;
            display: block;
        }

        .wpo-dashboard-left ul li a:hover {
            background-color: #fff8f0 !important;
            color: #f5a623 !important;
        }

        .wpo-dashboard-left ul li.active a {
            background-color: #fff8f0 !important;
            color: #f5a623 !important;
        }
    </style>
@endpush
