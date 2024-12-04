<?php

namespace App\Http\Controllers;

use App\Models\Posts;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\File;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;

class PostsController extends Controller
{

    // Show all posts
    public function index()
    {

        // $posts = Posts::paginate(10);
        $posts = Posts::orderBy('created_at', 'desc')->get();
        $total_posted = Posts::count();
        return view('admin.posts.index', compact('posts', 'total_posted'));
        // return response()->view('admin.posts.index', ['posts' => $posts]);
    }

    public function create_posts(): Response
    {
        return response()->view('admin.create-posts');
    }

    public function store(Request $request) // Store posts
    {
        // Validate the incoming request data
        $request->validate([
            'posts_title' => ['required', 'string', 'max:255'],
            'posts_subtitle' => ['required', 'string', 'max:255'],
            'posts_file' => ['required', 'image', 'mimes:jpeg,png,jpg', 'max:2048'],
            'posts_descriptions' => ['required', 'string', 'max:255'],
        ]);

        $input = $request->all();

        if ($posts_file = $request->file('posts_file')) { // Check if the file was uploaded successfully
            $destinationPath = 'uploads/posts/';
            $postsImages = date('YmdHis') . "." .  $posts_file->getClientOriginalExtension();
            $posts_file->move($destinationPath, $postsImages);
            $input['posts_file'] = "$postsImages";
        }

        Posts::create($input);
        return redirect()->back()->with('status', 'Posts created successfully');
    }


    public function viewPosts(Request $request, $id)
    {
        $posted = Posts::find($id);
        return view('admin.posts.view-posts', compact('posted'));
    }

    public function deletePosts(Request $request, $id)
    {

        $posted = Posts::find($id);
        if ($posted->posts_file) {
            Storage::disk('public')->delete($posted->posts_file);
        }
        $posted->delete();
        return redirect()->back()->with('status', 'Posts is added to archive successfully.');
    }

    public function editPostsForm($id)
    {

        $posted = Posts::findOrFail($id);
        return view('admin.posts.edit-postsForm', compact('posted'));
    }

    // public function updatePosts(Request $request, $id): RedirectResponse {
    public function updatePosts(Request $request, $id): RedirectResponse
    {

        // Validate the incoming request data
        //    $request->validate([
        //             'posts_title' => ['required', 'string', 'max:255'],
        //             'posts_subtitle' => ['required', 'string', 'max:255'],
        //             'posts_file' => ['required', 'image', 'mimes:jpeg,png,jpg', 'max:2048'],
        //             'posts_descriptions' => ['required', 'string', 'max:255'],
        //         ]);

        $posted = Posts::findOrFail($id);
        $posted->posts_title = $request->input('posts_title');
        $posted->posts_subtitle = $request->input('posts_subtitle');
        $posted->posts_file = $request->input('posts_file');
        $posted->posts_descriptions = $request->input('posts_descriptions');

        if ($request->hasfile('posts_file')) {

            $destinationPath = 'uploads/posts/' . $posted->posts_file;
            if (file::exists($destinationPath)) {
                file::delete($destinationPath);
            }

            $file = $request->file('posts_file');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('uploads/posts/', $filename);
            $posted->posts_file = $filename;
        }

        $posted->update();
        return redirect()->back()->with('status', 'Posts updated successfully');
    }

    // Function to show the deleted data added to trash
    public function trash()
    {
        $posts = Posts::onlyTrashed()->get();
        $total_posts_deleted  = Posts::onlyTrashed()->get()->count();
        return view('admin.posts.posts-archive', compact('posts', 'total_posts_deleted'));
    }

    // Function to restore deleted data
    public function restore($id)
    {
        $posts = Posts::withTrashed()->findOrFail($id);
        $posts->restore();
        return redirect()->back()->with('status', 'Posts data restored successfully.');
    }

    // Delete permanently user data from database table
    public function deletePost_permanent($id)
    {
        $posts = Posts::withTrashed()->findOrFail($id);
        $destinationPath = 'uploads/posts/' . $posts->posts_file;

        if (file::exists($destinationPath)) {
            unlink($destinationPath); // to delete permanently uploaded file on public folder 
        }

        $posts->forceDelete();
        return redirect()->back()->with('status', 'Posts deleted permanently.');
    }
}
