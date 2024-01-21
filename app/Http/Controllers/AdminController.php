<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Doctor; // Model name

class AdminController extends Controller
{
    public function addview(){

        return view ('admin.add_doctor');
    }

    public function upload(Request $request){
        $data=new doctor; //table name
        $data->name=$request->name;
        $data->phone=$request->phone;
        $data->speciality=$request->speciality;
        $data->room=$request->room;
        $image=$request->file;
        $imagename=time(). '.'.$image->getClientOriginalExtension();
        $request->file->move('doctorimage',$imagename);
        $data->image=$imagename;

        $data->save();
        return redirect()->back()->with('message','Doctor added successfully');
        


    }
}
