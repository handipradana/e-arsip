<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="{{ route('home') }}" class="brand-link">
        <span class="brand-text font-weight-light">SEAMOLEC</span>
    </a>

    <div class="sidebar">
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="info">
                <a href="#" class="d-block">{{ Auth::user()->name }}</a>
            </div>
        </div>

        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                @if (Auth::user()->role === 'admin')
                    <li class="nav-item">
                        <a href="{{ route('users.index') }}" class="nav-link">
                            <i class="nav-icon fas fa-users"></i>
                            <p>Users</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('peminjaman.index') }}" class="nav-link">
                            <i class="nav-icon fas fa-book"></i>
                            <p>Peminjaman</p>
                        </a>
                    </li>
                @endif
                @if (Auth::user()->role === 'operator')
                    <li class="nav-item">
                        <a href="{{ route('peminjaman.index') }}" class="nav-link">
                            <i class="nav-icon fas fa-book"></i>
                            <p>Peminjaman</p>
                        </a>
                    </li>
                @endif
                @if (Auth::user()->role === 'admin' || Auth::user()->role === 'operator')
                    <li class="nav-item">
                        <a href="{{ route('barangs.index') }}" class="nav-link">
                            <i class="nav-icon fas fa-boxes"></i>
                            <p>Barangs</p>
                        </a>
                    </li>
                @endif
                @if (Auth::user()->role === 'staff')
                    <li class="nav-item">
                        <a href="{{ route('peminjaman.my') }}" class="nav-link">
                            <i class="nav-icon fas fa-book"></i>
                            <p>My Peminjaman</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('peminjaman.create') }}" class="nav-link">
                            <i class="nav-icon fas fa-plus"></i>
                            <p>Create Peminjaman</p>
                        </a>
                    </li>
                @endif
            </ul>
        </nav>
    </div>
</aside>
