@php
$user = Auth::user();
@endphp
<div class="vertical-menu">

    <div data-simplebar class="h-100">
        <!-- User details -->
        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li><a href="{{ route('dashboard') }}"><i class="fas fa-columns"></i> Dashboard</a></li>

                <li class="menu-title">{{ $user->type }} Menu</li>

                @if ($user->type == 'manager')
                    <li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <i class="fas fa-user"></i>
                            <span>Manage User</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            <li><a href="{{ route('all.user') }}">All Users</a></li>
                        </ul>
                    </li>
                @endif

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="fas fa-books"></i>
                        <span>Manage Book</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('all.book') }}">Book List</a></li>
                        <li><a href="{{ route('add.book') }}">Add Book</a></li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="fas fa-book-user"></i>
                        <span>Manage Author</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('all.author') }}">Author List</a></li>
                        <li><a href="{{ route('add.author') }}">Add Author</a></li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="fab fa-readme"></i>
                        <span>Manage Genres</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('all.genre') }}">Genres List</a></li>
                        <li><a href="{{ route('add.genre') }}">Add Genre</a></li>
                    </ul>
                </li>
            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
