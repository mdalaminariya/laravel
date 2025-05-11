<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Category;
use App\Models\PromotionRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index(){
        $features = Blog::where('status','active')->latest()->take(3)->get();
        $blogs = Blog::latest()->take(5)->paginate(5);
        $categories = Category::where('status','active')->latest()->get();
        return view('frontend.home.index',compact('categories','features' , 'blogs'));
    }

}
