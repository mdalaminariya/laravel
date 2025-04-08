<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Session;

class ManagementController extends Controller
{
    public function index(){
        $managers = User::where('role','manager')->get();
        return view('dashboard.management.auth.register',compact('managers'));
    }
    public function store_register(Request $request){
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
            'role' => 'required|in:manager,blogger,user',
        ]);
            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => $request->password,
                'role' => $request->role,
                'created_at' => now(),
            ]);
            return back()->with('success','Register Complete..!');

    }
    public function manager_down($id){
        $manager = User::where('id',$id)->first();

        if($manager->role =='manager'){
            User::find($manager->id)->update([
                'role' => 'user',
                'updated_at' => now(),
            ]);
            return back()->with('success','Manager Demotion Successfully..!');
        }
    }

    //role
    public function role_index(){

        $bloggers =  User::where('role','blogger')->get();
        $users = User::where('role','user')->where('block',false)->get();
        return view('dashboard.management.auth.role.index',[
            'use' => $users,
            'bloggers' => $bloggers,
        ]);
    }
    public function role_assign(Request $request){
        $request->validate([
            'role' => 'required|in:user,blogger,manager',
        ]);

        $user = User::where('id',$request->user_id)->first();

        User::find($user->id)->update([
            'role' => $request->role,
            'updated_at' => now()
        ]);
        Session::flash('success','Role Assign Successfully..!');
        return back();

    }

    //blogger gread down
    public function blogger_gread_down($id){
        $user = User::where('id',$id)->first();
        User::find($user->id)->update([
            'role' => 'user',
            'updated_at' => now()
        ]);
        Session::flash('success','Blogger De-motion Successfully..!');
        return back();
    }
    public function user_gread_down($id){
        $user = User::where('id',$id)->first();
        User::find($user->id)->update([
            'block' => true,
            'updated_at' => now()
        ]);
        Session::flash('success','Block User Successfully..!');
        return back();
    }

    //block user
    public function block_user(){
        $users = User::where('role','user')->where('block',true)->get();
        return view('dashboard.management.auth.block.index',compact('users'));
    }
    public function unblock_user($id){
        $user = User::where('id',$id)->first();
        User::find($user->id)->update([
            'block' => false,
            'updated_at' => now()
        ]);
        Session::flash('success','UnBlock User Successfully..!');
        return back();
    }
    public function auto_delete(){
        $deleted = User::where('block', true)->where('updated_at', '<=', Carbon::now()->subDays(1))->delete();

        $this->info("$deleted blocked users deleted.");
    }
}
