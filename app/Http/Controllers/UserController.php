<?php

namespace App\Http\Controllers;
use App\Models\Register;
use Illuminate\Http\Request;
use Session;

use Illuminate\Support\Facades\Hash;
use App\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\MailNotify;
use App\Jobs\SendEmailJob;
use App\Jobs\SendEmails;


class UserController extends Controller
{
    //
    public function _construct(Register $user)
    {
        $this->user = $user;
    }

    public function register(){
        return view('register');
    }

    public function home(){
        return view('/home');
    }

    public function validateForm(Request $request){
        $this->validate($request,array(
        'name' => 'required',
        'email' => 'required',
        'password' => 'required',
        'confirm_password' => 'required'
        ));
        Register::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'confirm_password' => bcrypt($request->password)
        ]);
        Session::flash('success','User registration successful');
        return redirect('/login');
    }

    public function login(){
        return view('login');
    }

    public function loginForm(Request $request){
        $this->validate($request,[
            'name' => 'required',
            'password' => 'required'
        ]);
       
        $user = Register::where('name',$request->name)->first();
        if($user && Hash::check($request->password,$user->password)){
            Session::put('id',$user->id);
            Session::put('name',$user->name);

            return redirect('/home')->with('success','Login successfully');
        }
        else{
            return back()->with('errors','Invalid credentials');
        }
    }

    public function forgot(){
            return view('forgot');
    }
    public function sent(){
        return view('sent');
    }

    public function forgotpassword(Request $request){

        $user = Register::where('email',$request->email)->first();
        //dd($user);
        
        if(isset($user)){
            $details = new SendEmailJob($request->all());
            //dd($details);
            dispatch($details);
            return redirect('/sent')->with('success','Login successfully');
        }
        else{
            return back()->with('error','Invalid Login credentials');
        }
    }

    Public function setpassword(Request $request){
        $user = Register::where('email',$request->email)->first();
        //dd($user);
        return view('/newpassword',compact('user'));
    }

    public function newpassword(Request $request){
        $this->validate($request,[
            'current_password' => 'required',
            'new_password' => 'required|same:confirm_password',
            'confirm_password' => 'required'
        ]);

        $user = Register::where('email',$request->email)->first();
        //dd($user);
        if(!Hash::check($request->current_password,$user->password)){
            return back()->with('error','current password does not match');
        }
        $user->password = Hash::make($request->new_password);
        $user->save();

        $request->session()->flash('success', 'Password changed');
        return redirect('/login');
    }

}
