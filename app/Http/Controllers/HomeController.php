<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Doctor;
use App\Models\Appoinment;

class HomeController extends Controller
{
    public function index(){
        if(Auth::id()){

            return redirect('home');
        }

        else{
        $doctor=doctor::all();
        return view('user.home',compact('doctor'));
            }
    }
    
    public function redirect()
    {
        if(Auth::id())
        {
            if(Auth::User()->usertype=='0')
            {
                $doctor=doctor::all();
                return view('user.home',compact('doctor'));
                
            }
            else
            {
                return view('admin.home');
                
            }
            

        }
        else
        {
        return redirect()->back();
        }
    }

    public function appoinment(Request $request){

        $appoinment_data= new appoinment();
        $appoinment_data->name=$request->name;
        $appoinment_data->email=$request->email;
        $appoinment_data->phone=$request->number;
        $appoinment_data->date=$request->date;
        $appoinment_data->doctor=$request->doctor;
        $appoinment_data->message=$request->message;
        $appoinment_data->status="In progress";

        if (Auth::id()){
            $appoinment_data->user_id=Auth::user()->id;   
        }
        $appoinment_data->save();

        //return redirect()-back();
    }

  
}
