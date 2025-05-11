<?php

namespace App\Http\Controllers;

use App\Models\PromotionRequest;
use App\Models\User;
use Illuminate\Http\Request;

class PromotionRequestController extends Controller
{
    public function index(){
        $requests = PromotionRequest::latest()->get();
        return view('dashboard.user_request.index',compact('requests'));
    }
    public function accept($id){
        $request = PromotionRequest::where('id', $id)->first();

        User::find($request->user_id)->update([
            'role' => 'blogger',
            'updated_at' => now(),
        ]);
        PromotionRequest::find($id)->delete();
        return redirect()->route('promotion.request.show')->with('success','Request Accepted Successfully..!');
    }
    public function cancel($id){
        $request = PromotionRequest::where('id', $id)->first();

        PromotionRequest::find($id)->delete();
        return redirect()->route('promotion.request.show')->with('success','Request Canceled Successfully..!');
    }
    public function promotion_request(Request $request, $id){
        $request->validate([
            'message' => 'required',
        ]);
        PromotionRequest::create([
            'user_id' => $id,
            'message' => $request->message,
            'created_at' => now(),
        ]);
        return redirect()->route('home')->with('success','Request Sent Successfully.!');
    }



}
