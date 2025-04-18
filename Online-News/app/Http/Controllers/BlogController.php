<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $blogs = Blog::latest()->paginate(10);
        return view('dashboard.blog.index',compact('blogs')) ;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::where('status','active')->latest()->get();
        return view('dashboard.blog.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $manager = new ImageManager(new Driver());
        $request->validate([

            'category_id' => 'required',
            'thumbnail' => 'required',
            'title' => 'required',
            'short_description' => 'required',
            'description' => 'required',
        ]);
        if($request->hasFile('thumbnail')){
            $new_name = Auth::user()->id .'-'.Str::random(4) .'.'.$request->file('thumbnail')->getClientOriginalExtension();
            $image = $manager->read($request->file('thumbnail'));
            $image->toPng()->save(base_path('public/upload/blog/'.$new_name));

            if($request->slug){
                Blog::create([
                    'user_id' => Auth::user()->id,
                    'category_id' => $request->category_id,
                    'thumbnail' => $new_name,
                    'title' => $request->title,
                    'slug' => Str::slug($request->slug,'-'),
                    'short_description' => $request->short_description,
                    'description' => $request->description,
                ]);
                return redirect()->route('blog.index')->with('success','Blog created successfully..!');
            }else{
                Blog::create([
                    'user_id' => Auth::user()->id,
                    'category_id' => $request->category_id,
                    'thumbnail' => $new_name,
                    'title' => $request->title,
                    'slug' => Str::slug($request->title,'-'),
                    'short_description' => $request->short_description,
                    'description' => $request->description,
                ]);
                return redirect()->route('blog.index')->with('success','Blog created successfully..!');
            }
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Blog $blog)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Blog $blog)
    {
        $categories = Category::where('status','active')->latest()->get();
        return view('dashboard.blog.edit',compact('blog','categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Blog $blog)
    {
        $manager = new ImageManager(new Driver());

        $request->validate([
            'category_id' => 'required',
            'title' => 'required',
            'short_description' => 'required',
            'description' => 'required',
        ]);


        if($request->hasFile('thumbnail')){
            $old_path = base_path('public/upload/blog/'.$blog->thumbnail);
                if(file_exists($old_path)){
                    unlink($old_path);
                }
            $newname = Auth::user()->id .'-'.Str::random(4).'.'.$request->file('thumbnail')->getClientOriginalExtension();
            $image = $manager->read($request->file('thumbnail'));
            $image->toPng()->save(base_path('public/upload/blog/'.$newname));

            if($request->slug){
                Blog::find($blog->id)->update([
                    'user_id' => Auth::user()->id,
                    'category_id' => $request->category_id,
                    'thumbnail' => $newname,
                    'title' => $request->title,
                    'slug' => Str::slug($request->slug,'-'),
                    'short_description' => $request->short_description,
                    'description' => $request->description,
                ]);
                return redirect()->route('blog.index')->with('success','Blog Updated Successfully..!');
            }else{
                Blog::find($blog->id)->update([
                    'user_id' => Auth::user()->id,
                    'category_id' => $request->category_id,
                    'thumbnail' => $newname,
                    'title' => $request->title,
                    'slug' => Str::slug($request->title,'-'),
                    'short_description' => $request->short_description,
                    'description' => $request->description,
                ]);
                return redirect()->route('blog.index')->with('success','Blog Updated Successfully..!');
            }
        }else{
            if($request->slug){
                Blog::find($blog->id)->update([
                    'user_id' => Auth::user()->id,
                    'category_id' => $request->category_id,
                    'title' => $request->title,
                    'slug' => Str::slug($request->slug,'-'),
                    'short_description' => $request->short_description,
                    'description' => $request->description,
                ]);
                return redirect()->route('blog.index')->with('success','Blog Updated Successfully..!');
            }else{
                Blog::find($blog->id)->update([
                    'user_id' => Auth::user()->id,
                    'category_id' => $request->category_id,
                    'title' => $request->title,
                    'slug' => Str::slug($request->title,'-'),
                    'short_description' => $request->short_description,
                    'description' => $request->description,
                ]);
                return redirect()->route('blog.index')->with('success','Blog Updated Successfully..!');
            }
        }


    }

    public function status($slug){
        $blog = Blog::where('slug',$slug)->first();
        if($blog->status == 'deactive'){
            Blog::find($blog->id)->update([
                'status' => 'active',
                'updated_at' => now(),
            ]);
            return redirect()->route('blog.index')->with('success','Blog Status Updated..!');
        }else{
                Blog::find($blog->id)->update([
                    'status' => 'deactive',
                    'updated_at' => now(),
                ]);
                return redirect()->route('blog.index')->with('success','Blog Status Updated..!');
    }
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($slug)
    {
        $blog = Blog::where('slug',$slug)->first();
        if($blog->thumbnail){
            $old_path = base_path('public/upload/blog/'.$blog->thumbnail);
            if(file_exists($old_path)){
                unlink($old_path );
            }
        }
        Blog::find($blog->id)->delete();
        return redirect()->route('blog.index')->with('success','Blog Delete Successfully..!');
    }
}
