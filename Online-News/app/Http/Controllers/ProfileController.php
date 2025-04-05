<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;


class ProfileController extends Controller
{
    public function index(){
        return view('dashboard.profile.index');
    }
    public function name_update(Request $request){
        $request->validate([
            'name'=> 'required|ascii',
        ]);
        User::find(Auth::user()->id)->update([
            'name'=> $request->name,
            'updated_at' => now(),
        ]);
        return back()->with('success','Name Update Successfully.!');
    }
    public function email_update(Request $request){
        $request->validate([
            'email'=> 'required|email',
        ]);
        User::find(Auth::user()->id)->update([
            'email'=> $request->email,
            'updated_at' => now(),
        ]);
        return back()->with('success','Email Update Successfully.!');
    }
    public function password_update(Request $request){
        $request->validate([
            'current_password'=> 'required',
            'password' => 'required',
        ]);
        if(Hash::check($request->current_password, Auth::user()->password)){
            User::find(Auth::user()->id)->update([
                'password' => $request->password,
                'updated_at' => now(),
            ]);
            return back()->with('success','Password Update Successfully.!');
        }else{
            return back()->withErrors(["current_password" => "Please Insert Correct Password.!"])->withInput();
        }
    }
    public function image_update(Request $request){
        $manager = new ImageManager(new Driver());
        $request->validate([
            'image' => 'required|image',
        ]);
        if($request->hasFile('image')){
            if(Auth::user()->image){
                $old_path = base_path('public/upload/profile/'.Auth::user()->image);
                if(file_exists($old_path)){
                    unlink($old_path );
                }
            }
            $new_name = Auth::user()->id .'-'.now()->format('D M, Y') .'-'.rand(0,9999) .'.'.$request->file('image')->getClientOriginalExtension();
            $image = $manager->read($request->file('image'));
            $image->toPng()->save(base_path('public/upload/profile/'.$new_name));
            User::find(Auth::user()->id)->update([
                'image' => $new_name,
                'updated_at' => now(),
            ]);
            return back()->with('success','Image Update Successfully.!');
        }
    }
}
