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
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                        @endif

                        @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                        @endif


                        <div class="card-header">
                            <h4>Update posts
                                <a href="{{ route('posts.index') }}" class="btn btn-primary float-end">Back</a>
                            </h4>
                        </div>
                        <img src="{{ asset('uploads/posts/'.$posted->posts_file) }}" class="card-img-top w-100 p-3 img-fluid"
                            style="height: 300px;" alt="...">
                        <!-- <video class="card-img-top w-100 p-3 img-fluid" height="240" controls>
                            <source src="{{ asset('uploads/posts/'.$posted->posts_file) }}" type="video/mp4">
                        </video> -->
                        <div class="card-body">

                            <form action="{{ url('update-posts/'.$posted->id) }}" method="POST" enctype="multipart/form-data"
                                class="row g-3">
                                @csrf
                                @method('PUT')

                                <div class="col-md-6 mb-3">
                                    <label for="poststitle" class="form-label">Posts Title</label>
                                    <input type="text"
                                        class="form-control"
                                        id="poststitle"
                                        name="posts_title"
                                        value="{{ $posted->posts_title }}"
                                        placeholder="Tittle of the  posts">
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="poststitle" class="form-label">Sub Title</label>
                                    <input type="text"
                                        class="form-control"
                                        id="poststitle"
                                        name="posts_subtitle"
                                        placeholder="Sub title here..."
                                        value="{{ $posted->posts_subtitle }}">
                                </div>
                                <div class="mb-3">
                                    <label for="posts_picture" class="form-label">Posts Picture</label>
                                    <input type="file"
                                        class="form-control"
                                        id="posts_picture"
                                        name="posts_file"
                                        value="{{ $posted->posts_file }}">
                                </div>
                                <div class="mb-3">
                                    <label for="description" class="form-label">Descriptions</label>

                                    <textarea
                                        class="form-control"
                                        id="description" rows="3"
                                        name="posts_descriptions"
                                        placeholder="Posts description here...">{{ $posted->posts_descriptions }}</textarea>
                                </div>
                                <div class="mb-3">
                                    <button type="submit" class="btn btn-primary mb-3">Update Posts</button>
                                </div>

                            </form>
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