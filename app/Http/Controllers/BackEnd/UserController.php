<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
    public function view(){
    	$allUser = User::where('usertype','admin')->get();
    	return view('backend.user.view-user',compact('allUser'));    
    }
    public function addUser(){
    	return view('backend.user.add-user');
    }
    public function storeUser(Request $request){
    	$user = new User();
        $code = rand(0000,9999);
        $user->usertype = 'admin';
        $user->role = $request->role;
       	$user->name = $request->name;
    	$user->email = $request->email;
    	$user->password = bcrypt($code);
        $user->code = $code;
      	$result= $user->save();
        if($result):
            return redirect('view-user')->with('success','inserted sucessfully');
        else:
            return redirect()->back()->with('danger','inserted unsucessfully');
        endif;
     }

     public function editUser($id){
        $editData = User::find($id);
        return view('backend.student.student_reg',compact('editData'));
     }
     public function updateUser(Request $request,$id){
        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->role = $request->role;
        $result= $user->save();

        if($result):
            return redirect('view-user')->with('success','updated sucessfully');
        else:
            return redirect()->back()->with('danger','update unsucessfull');
        endif;
     }
     public function deleteUser(){
        
     }

}
