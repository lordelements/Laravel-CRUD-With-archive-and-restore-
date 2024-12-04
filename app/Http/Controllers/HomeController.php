<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Posts;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index() {
        
        $data['TotalPostsCount'] = Posts::count();
        $posts = Posts::all();
        $users = User::all();
        return view('admin.dashboard', compact('posts', 'users'));
    }
    public function edit() {
        
        return view('admin.profile.edit');
    }
}
