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
                    <div class="card mt-4">

                        @if (session('status'))
                        <h6 class="alert alert-success">{{ session('status') }}</h6>
                        @endif

                        <div class="card-header">
                            <h4>View uploaded posts
                                <a href="{{ route('posts.index') }}" class="btn btn-primary float-end">Back</a>
                            </h4>
                        </div>
                        <form action="{{ url('posts/view-posts/'.$posted->id ) }}" method="post">
                            <div class="card mb-3">
                                <img src="{{ asset('uploads/posts/'.$posted->posts_file) }}" class="card-img-top w-100 p-3 img-fluid" 
                                style="height: 400px;" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $posted->posts_title }}</h5>
                                    <h6 class="card-subtitle">{{ $posted->posts_subtitle }}</h6>
                                    <p class="card-text">{{ $posted->posts_descriptions }}</p>
                                    <p class="card-text"><small class="text-muted">Date/Time posted {{ $posted->created_at }}</small></p>
                                    <p class="card-text"><small class="text-muted">Date/Time update {{ $posted->updated_at }}</small></p>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>


        </div>

        @include('admin.layouts.partials.footer')

        </div>

    </main>

    @include('admin.layouts.partials.scripts')