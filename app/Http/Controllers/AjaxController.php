<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ajax;
class AjaxController extends Controller
{
    public function Ajax(Request $req){
        // $img = $req->photo;
        // $imagename = time().'.'.$img->getClientOriginalExtension();
        // $req->photo->move('images',$imagename);
        $req->validate([
            'name' =>'required',
            'password' =>'required',
            'photo' =>'required',
        ]);

        $data = new Ajax;
        $data->name =$req->name;
        $data->password =md5($req->password);
        $data->photo =$req->photo;
        $data->save();
        return redirect('/');	
    }


    public function alldata(){
        $data = Ajax::orderBy('id','DESC')->get();
        return response()->json($data);
    }
    public function editData($id){
        $data = Ajax::find($id);
        return response()->json($data);
    }

    public function Update(Request $req,$id){
        $req->validate([
            'name' =>'required',
            'password' =>'required',
            'photo' =>'required',
        ]);
        
        $data = Ajax::find($id);
        $data->name =$req->name;
        $data->password =md5($req->password);
        $data->photo =$req->photo;
        $data->save();

        return response()->json($data);
    }
}
