<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('backend.dashboard') }}" class="brand-link">
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
                    <a href="{{ route('backend.dashboard') }}" class="nav-link {{ request()->routeIs('backend.dashboard') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>{{ __('messages.dashboard') }}</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('backend.grades.index') }}" class="nav-link {{ request()->routeIs('backend.grades.index') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-school"></i>
                        <p>{{ __('messages.grades') }}</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('backend.classrooms.index') }}" class="nav-link {{ request()->routeIs('backend.classrooms.index') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-chalkboard"></i>
                        <p>{{ __('messages.classrooms') }}</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('backend.sections.index') }}" class="nav-link {{ request()->routeIs('backend.sections.index') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-puzzle-piece"></i>
                        <p>{{ __('messages.sections') }}</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('backend.students.index') }}" class="nav-link {{ request()->routeIs('backend.students.index') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-user-graduate"></i>
                        <p>{{ __('messages.students') }}</p>
                    </a>
                </li>

                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-graduation-cap"></i>
                        <p>
                            {{ __('messages.promotions') }}
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('backend.promotions.create') }}" class="nav-link {{ request()->routeIs('backend.promotions.create') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>{{ __('messages.add_promotion') }}</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('backend.promotions.manage') }}" class="nav-link {{ request()->routeIs('backend.promotions.manage') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>{{ __('messages.manage_promotions') }}</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item">
                    <a href="{{ route('backend.teachers.index') }}" class="nav-link {{ request()->routeIs('backend.teachers.index') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-chalkboard-teacher"></i>
                        <p>{{ __('messages.teachers') }}</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('backend.specializations.index') }}" class="nav-link {{ request()->routeIs('backend.specializations.index') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-book-reader"></i>
                        <p>{{ __('messages.specializations') }}</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('backend.parents.index') }}" class="nav-link {{ request()->routeIs('backend.parents.index') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-users"></i>
                        <p>{{ __('messages.parents') }}</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('backend.profile.edit') }}" class="nav-link {{ request()->routeIs('backend.profile.edit') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-user"></i>
                        <p>{{ __('messages.profile') }}</p>
                    </a>
                </li>

                <li class="nav-item">
                    <form method="POST" action="{{ route('backend.logout') }}" style="margin: 0;">
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