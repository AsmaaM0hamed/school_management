<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('dashboard') }}" class="brand-link">
        <img src="{{ asset('dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">{{ __('messages.dashboard') }}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{ auth()->user()->name ?? 'Guest' }}</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>{{ __('messages.dashboard') }}</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('grades.index') }}" class="nav-link {{ request()->routeIs('grades.index') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-school"></i>
                        <p>{{ __('messages.grades') }}</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('classrooms.index') }}" class="nav-link {{ request()->routeIs('classrooms.index') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-chalkboard"></i>
                        <p>{{ __('messages.classrooms') }}</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('sections.index') }}" class="nav-link {{ request()->routeIs('sections.index') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-puzzle-piece"></i>
                        <p>{{ __('messages.sections') }}</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('students.index') }}" class="nav-link {{ request()->routeIs('students.index') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-user-graduate"></i>
                        <p>{{ __('messages.students') }}</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('teachers.index') }}" class="nav-link {{ request()->routeIs('teachers.index') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-chalkboard-teacher"></i>
                        <p>{{ __('messages.teachers') }}</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('specializations.index') }}" class="nav-link {{ request()->routeIs('specializations.index') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-book-reader"></i>
                        <p>{{ __('messages.specializations') }}</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('parents.index') }}" class="nav-link {{ request()->routeIs('parents.index') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-users"></i>
                        <p>{{ __('messages.parents') }}</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('profile.edit') }}" class="nav-link {{ request()->routeIs('profile.edit') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-user"></i>
                        <p>{{ __('messages.profile') }}</p>
                    </a>
                </li>

                <li class="nav-item">
                    <form method="POST" action="{{ route('logout') }}" style="margin: 0;">
                        @csrf
                        <a href="#" class="nav-link" onclick="event.preventDefault(); this.closest('form').submit();">
                            <i class="nav-icon fas fa-sign-out-alt"></i>
                            <p>{{ __('messages.logout') }}</p>
                        </a>
                    </form>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>