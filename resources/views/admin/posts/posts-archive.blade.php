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
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">

                            <!-- Error and Success Messages -->
                            @if (session('status'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>{{ session('status') }}</strong>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">X</button>
                            </div>
                            @endif

                            @if (session('error'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <strong>{{ session('error') }}</strong>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">X</button>
                            </div>
                            @endif

                            <h4>Lists of deleted posts
                                <a href="{{ route('posts.index') }}" class="btn btn-primary float-end">Back</a>
                            </h4>
                        </div>
                        <div class="card-body">
                            <div class="text-bold">
                                <span>Total posts: {{ $total_posts_deleted }}</span>
                            </div>
                            <div class="responsive-table">
                                <table class="table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th scope="col">ID</th>
                                            <th scope="col">Title</th>
                                            <th scope="col">Sub Title</th>
                                            <th scope="col">Details</th>
                                            <th scope="col">Image</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($posts as $posted)
                                        <tr>
                                            <td>{{ $posted->id }}</td>
                                            <td>{{ $posted->posts_title }}</td>
                                            <td>{{ $posted->posts_subtitle }}</td>
                                            <td>
                                                <details>
                                                    <textarea name="" id="">{{ $posted->posts_descriptions }}</textarea>
                                                </details>
                                            </td>
                                            <td>
                                                <img src="{{ asset('uploads/posts/'.$posted->posts_file) }}"
                                                    width="70px" height="70px" alt="img">
                                            </td>

                                            <td>

                                                <!-- <form action="{{ url('posts/view-posts/'.$posted->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-danger btn-sm" type="submit" onclick="return confirm('Are you sure?')">Delete</button>
                                                    <a href="{{ url('edit-posts/'.$posted->id) }}" class="btn btn-primary btn-sm">Edit</a>
                                                    <a href="{{ url('posts/view-posts/'.$posted->id) }}" class="btn btn-warning btn-sm">View</a>
                                                </form> -->

                                                <a href="{{ url('restore/'.$posted->id) }}" class="btn btn-success btn-sm">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-clockwise" viewBox="0 0 16 16">
                                                        <path fill-rule="evenodd" d="M8 3a5 5 0 1 0 4.546 2.914.5.5 0 0 1 .908-.417A6 6 0 1 1 8 2z" />
                                                        <path d="M8 4.466V.534a.25.25 0 0 1 .41-.192l2.36 1.966c.12.1.12.284 0 .384L8.41 4.658A.25.25 0 0 1 8 4.466" />
                                                    </svg>
                                                </a>

                                                <a href="{{ route('posts.deletePost_permanent', ['id'=> $posted->id]) }}" class="btn btn-danger btn-sm">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                                        <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z" />
                                                        <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z" />
                                                    </svg>
                                                    Delete
                                                </a>
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="4">
                                                <h5 class="text-center">There are no data.</h5>
                                            </td>
                                        </tr>
                                        @endforelse
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