@php
$user = Auth::user();
$users = App\Models\User::orderByRaw('last_login_at DESC nulls last')->get();
@endphp
@extends('home.dashboard')
@section('admin')
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Welcome, {{ $user->name }}</h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                @if ($user->type == 'manager')
                    <div class="col-xl-3 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex">
                                    <div class="flex-grow-1">
                                        <h4 class="mb-2 text-info">Manage User</h4>
                                        <p class="text-muted mb-0"><a href="{{ route('all.user') }}" class="underline">All
                                                User</a></p>
                                    </div>
                                    <div class="avatar-sm">
                                        <span class="avatar-title bg-light text-primary rounded-3">
                                            <i class="ri-user-3-line font-size-24"></i>
                                        </span>
                                    </div>
                                </div>
                            </div><!-- end cardbody -->
                        </div><!-- end card -->
                    </div><!-- end col -->
                @endif

                <div class="col-xl-3 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex">
                                <div class="flex-grow-1">
                                    <h4 class="mb-2 text-info">Manage Book</h4>
                                    <p class="text-muted mb-0"><a href="{{ route('all.book') }}" class="underline">
                                            Book List</a></p>
                                    <p class="text-muted mb-0"><a href="{{ route('add.book') }}" class="underline">Add
                                            Book</a></p>
                                </div>
                                <div class="avatar-sm">
                                    <span class="avatar-title bg-light text-success rounded-3">
                                        <i class="fas fa-books font-size-24"></i>
                                    </span>
                                </div>
                            </div>
                        </div><!-- end cardbody -->
                    </div><!-- end card -->
                </div><!-- end col -->
                <div class="col-xl-3 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex">
                                <div class="flex-grow-1">
                                    <h4 class="mb-2 text-info">Manage Author</h4>
                                    <p class="text-muted mb-0"><a href="{{ route('all.author') }}" class="underline">
                                            Author List</a></p>
                                    <p class="text-muted mb-0"><a href="{{ route('add.author') }}" class="underline">Add
                                            Author</a></p>
                                </div>
                                <div class="avatar-sm">
                                    <span class="avatar-title bg-light text-primary rounded-3">
                                        <i class="fas fa-book-user font-size-24"></i>
                                    </span>
                                </div>
                            </div>
                        </div><!-- end cardbody -->
                    </div><!-- end card -->
                </div><!-- end col -->
                <div class="col-xl-3 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex">
                                <div class="flex-grow-1">
                                    <h4 class="mb-2 text-info">Manage Genres</h4>
                                    <p class="text-muted mb-0"><a href="{{ route('all.genre') }}" class="underline">
                                            Genres List</a></p>
                                    <p class="text-muted mb-0"><a href="{{ route('add.genre') }}" class="underline">Add
                                            Genre</a></p>
                                </div>
                                <div class="avatar-sm">
                                    <span class="avatar-title bg-light text-success rounded-3">
                                        <i class="fab fa-readme font-size-24"></i>
                                    </span>
                                </div>
                            </div>
                        </div><!-- end cardbody -->
                    </div><!-- end card -->
                </div><!-- end col -->
            </div><!-- end row -->
            <!-- end row -->

            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="dropdown float-end">
                                <a href="#" class="dropdown-toggle arrow-none card-drop" data-bs-toggle="dropdown"
                                    aria-expanded="false">
                                    <i class="mdi mdi-dots-vertical"></i>
                                </a>
                            </div>

                            <h4 class="card-title mb-4">Latest Logged User</h4>

                            <div class="table-responsive">
                                <table class="table table-centered mb-0 align-middle table-hover table-nowrap">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Last login</th>
                                            <th>Login Ip</th>
                                        </tr>
                                    </thead><!-- end thead -->
                                    <tbody>
                                        @foreach ($users as $item)
                                            <tr>
                                                <td>
                                                    <h6 class="mb-0">{{ $item->name }}</h6>
                                                </td>
                                                <td>{{ $item->email }}</td>
                                                <td>
                                                    <div class="font-size-13"><i
                                                            class="ri-checkbox-blank-circle-fill font-size-10 text-success align-middle me-2"></i>
                                                        {{ $item->last_login_at ? Carbon\Carbon::parse($item->last_login_at)->diffForHumans() : '' }}
                                                    </div>
                                                </td>
                                                <td>{{ $item->last_login_ip }}
                                                </td>
                                            </tr>
                                        @endforeach
                                        <!-- end -->
                                    </tbody><!-- end tbody -->
                                </table> <!-- end table -->
                            </div>
                        </div><!-- end card -->
                    </div><!-- end card -->
                </div>
                <!-- end col -->
            </div>
            <!-- end row -->
        </div>

    </div>
@endsection
