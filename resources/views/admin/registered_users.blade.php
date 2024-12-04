<!DOCTYPE html>
<html lang="en">

<head>

    @include('admin.layouts.partials.header')

</head>

<body class="g-sidenav-show  bg-gray-100">

    <!-- Sidebar -->
    <aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3 " id="sidenav-main">

        @include('admin.layouts.partials.sidebar')

    </aside>
    <!-- End Sidebar -->

    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">

        <!-- Navbar -->
        <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" navbar-scroll="true">

            @include('admin.layouts.partials.navbar')

        </nav>
        <!-- End Navbar -->

        <!-- Content here -->
        <div class="container-sm">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">

                        @if (session('status'))
                        <h6 class="alert alert-success">{{ session('status') }}</h6>
                        @endif

                        <div class="card-header">
                            <h4>Lists of registered users
                                <a href="{{ route('admin.dashboard') }}" class="btn btn-primary float-end">Back</a>
                            </h4>
                        </div>
                        <div class="card-body">
                            <div class="text-bold">
                                <span>Total users: {{ $total_user }}</span>
                            </div>

                            <div class="responsive-table">
                                <table class="table table-dark table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th scope="col">ID</th>
                                            <th scope="col">Name</th>
                                            <th scope="col">Email Address</th>
                                            <th scope="col">Role</th>
                                            <th scope="col">Created at</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($user as $users)
                                        <tr>
                                            <td>{{ $users->id }}</td>
                                            <td>{{ $users->name }}</td>
                                            <td>{{ $users->email }}</td>
                                            <td>{{ $users->usertype }}</td>
                                            <td>{{ $users->created_at }}</td>

                                            <td>

                                                <form action="{{ url('posts/view-posts/'.$users->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-danger btn-sm" type="submit">Delete</button>
                                                    <a href="{{ url('edit-posts/'.$users->id) }}" class="btn btn-primary btn-sm">Edit</a>
                                                    <a href="{{ url('posts/view-posts/'.$users->id) }}" class="btn btn-warning btn-sm">View</a>
                                                </form>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>


        </div>

        @include('admin.layouts.partials.footer')

        </div>

    </main>

    @include('admin.layouts.partials.scripts')