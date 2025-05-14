<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\BlogComment;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function showBySlug($slug)
{
     $post = Blog::where('slug', $slug)->firstOrFail();
     $post->increment('views');
     $post->refresh();
     $comments = BlogComment::with('replies')
        ->where('blog_id', $post->id)
        ->whereNull('parent_id')
        ->paginate(5);

    return view('frontend.blog.single', ['blog' => $post], ['comments' => $comments]);
}
}
