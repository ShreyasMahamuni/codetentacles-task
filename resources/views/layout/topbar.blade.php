<div class="navbar navbar-expand navbar-light shadow-lg bg-light">
    <div class="container-fluid">
        <h5>{{ Auth::user()->name }}</h5>
        <ul class="navbar-nav ms-auto"> <!-- Align items to the right -->
            <li class="nav-item dropdown">
                <small>{{ Auth::user()->email }}</small>
                <div>
                    <a class="nav-link " data-bs-toggle="tooltip" data-bs-title="{{ Auth::user()->name }}"
                        href="{{ url('/logout') }}">
                        <small class="text-danger">Logout</small>
                    </a>
                </div>
            </li>
        </ul>
    </div>
</div>
