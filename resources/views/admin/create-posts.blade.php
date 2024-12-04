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

        <div class="card h-100">

            <div class="card-header pb-0 p-3">

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

                <div class="row">
                    <div class="col-md-8 d-flex align-items-center">
                        <h6 class="mb-0">Create Posts</h6>
                    </div>
                    <div class="col-md-4 text-end">
                        <a href="">
                            <i class="fas fa-user-edit text-secondary text-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit Profile"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-body p-3">

                <form action="{{ route('store-posts') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-3">
                        <label for="poststitle" class="form-label">Posts Title</label>
                        <input type="text"
                            class="form-control"
                            id="poststitle"
                            name="posts_title"
                            :value="{{ old('posts_title') }}"
                            placeholder="Tittle of the  posts">
                    </div>

                    <div class="mb-3">
                        <label for="poststitle" class="form-label">Sub Title</label>
                        <input type="text"
                            class="form-control"
                            id="poststitle"
                            name="posts_subtitle"
                            placeholder="Sub title here..."
                            :value="old('posts_subtitle')">
                    </div>
                    <div class="mb-3">
                        <label for="posts_picture" class="form-label">Posts Picture</label>
                        <input type="file"
                            class="form-control"
                            id="posts_picture"
                            name="posts_file"
                            :value="old('posts_file')">
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Descriptions</label>
                        <textarea
                            class="form-control"
                            id="description" rows="3"
                            name="posts_descriptions"
                            :value="old('posts_descriptions')"
                            placeholder="Posts description here..."></textarea>
                    </div>
                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary mb-3">Save</button>
                    </div>

                </form>

            </div>
        </div>

        </div>

        @include('admin.layouts.partials.footer')

        </div>

    </main>

    @include('admin.layouts.partials.scripts')