<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\BlogComment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BlogController extends Controller
{
    public function index(){
        $blog = Blog::latest()->paginate(10);
        return view('frontend.blog.index',compact('blog'));
    }
    public function single($slug){
        $blog = Blog::where('slug',$slug)->first();
        $comments = BlogComment::with('replies')->where('blog_id',$blog->id)->wherenull('parent_id')->paginate(5);
        return view('frontend.blog.single',compact('blog','comments'));
    }
    public function comment(Request $request,$id){
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'comment' => 'required',
        ]);

        BlogComment::create([
            'user_id' => Auth::user()->id,
            'blog_id' => $id,
            'parent_id' => $request->parent_id,
            'name' => $request->name,
            'email' => $request->email,
            'comment' => $request->comment,
            'created_at' => now(),
        ]);
        return back()->withErrors('success','Sent Comment Successfully..!');

    }
}
