<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Admin;
use App\User;
use DB;
use Auth;

class AdminController extends Controller
{
  public function delete($id){
    if(empty(User::find($id))){
      return redirect('/admin/manage');
    }
    User::destroy($id);
    DB::table('administrator_privileges')->where('user_id', '=', $id)->delete();
    return redirect('/admin/manage');
  }
    public function create(){
      return view('admin.create');
    }
    public function store(request $request){
      $request->validate([
          'email' => 'required|max:50|email',
          'access_level' => 'required',
      ]);
      $id = User::select('id')->where('email',$request->email)->get();
      $data = new Admin;
      $data->user_id = $id[0]['id'];
      $data->access_level = $request->access_level;
      $data->save();
      return redirect('admin/create');
    }
    public function edit($id){
      $data = User::find($id);
      return view('admin.edit',compact('data'));
    }
    public function update(request $request){
      $data = User::find($request->id);
      $data->name = $request->name;
      $data->email = $request->email;
      $data->job_title = $request->job_title;
      if(!empty($request->password)){
        if($request->password === $request->password_confirmation){
          $data->password = bcrypt($request->password);
        }
      }
      $data->save();
      return redirect('admin/manage');
    }

    public function manage(){
      $data = Admin::all();
      return view('admin/manage',compact('data'));
    }
    public function manageAdministration(){
      $admins = DB::table('administrator_privileges')->get();
      $data = array();
      foreach ($admins as $admin) {
        $x = array();
        $userInfo = DB::table('users')->where('id',$admin->user_id)->get();
        $x['userinfo'] = $userInfo;
        $x['admininfo'] = $admin;
        $data[] = $x;
      }
      return view('admin.manageAdmin', compact('data'));
    }
    public function updateAdministrator(){
      if(isset($_POST)){
         unset($_POST['_token']);

        foreach($_POST as $id=>$access_level){
            $user = DB::table('administrator_privileges')->where('id',$id)->get();
              if($user[0]->user_id > '1'){

                DB::table('administrator_privileges')
                ->where('id', $id)
                ->update(['access_level' => $access_level]);
              }
            }
        }
      return redirect('/admin/manageAccess');
    }
    public function removeAdministrator($id){
      DB::table('administrator_privileges')->where('id', $id)->delete();
      return redirect('/admin/manageAccess');
    }
}
