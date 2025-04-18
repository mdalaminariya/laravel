<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Category;
use Illuminate\Http\Request;

class FrontController extends Controller
{
    public function Front_Page($slug){
        $category = Category::where('slug',$slug)->first();
        $blogs = Blog::where('category_id',$category->id)->latest()->paginate(10);


        return view('frontend.category.index',compact('category','blogs'));
    }
}
