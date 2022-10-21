<?php

namespace App\Http\Controllers;

use App\Mail\ReviewMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ReviewController extends Controller
{
    function store(Request $request){
        // dd($request->all());
        $reviewData=[
            'name'=>$request->name,
            'email'=>$request->email,
            'message'=>$request->message
        ];

        Mail::to('theintheinsoe1218@gmail.com')->send(new ReviewMail($reviewData));

        return back()->with('success','Email Sending Successfully');
    }
}
