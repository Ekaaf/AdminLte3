<?php

namespace App\Http\Controllers;

use App\Models\UserAccess;
use App\Models\Role;
use App\Models\User;
use App\Http\Controllers\Controller;
use DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Mail;
use Session;
use App\SSP;

class UserController extends Controller
{
    public function users(){
        return view('admin.users.list');
    }


    public function getAllUsers(Request $request){
        $table = 
            "(SELECT *from users) testtable";

        

        $primaryKey = 'id';
        $columns = array(

            array( 'db' => 'id', 'dt' => 'id' ),

            array( 'db' => 'email', 'dt' => 'email' ),

            array( 'db' => 'role', 'dt' => 'role' )
        );

        $database = config('database.connections.mysql');

        $sql_details = array(
            'user' => $database['username'],
            'pass' => $database['password'],
            'db'   => $database['database'],
            'host' => $database['host']
        );

        $result =  SSP::simple( $_POST, $sql_details, $table, $primaryKey, $columns);

        $start=$_REQUEST['start']+1;

        $idx=0;

        foreach($result['data'] as &$res){

            $res[0]=(string)$start;

            $start++;

            $idx++;

        }
        echo json_encode($result);

    }

    public function editUser(Request $request,$id){
        $user = User::find($id);
        return view('admin.users.edituser')->with('user', $user);
    }

    public function updateUser(Request $request,$id){
        $user = User::where('id', '!=', $id)->where('email', $request->email)->first();
        if(!is_null($user)){
            return redirect()->back()->with('error', "Email already exists")->withInput();
        }
        $user = User::find($id);
        $user->email = $request->email;
        $user->role = $request->role;
        $user->save();
        return redirect('admin/users')->with('success', "Successfully updated");
    }


    public function addUser(Request $request){
        return view('admin.users.addUser');
    }

    public function saveUser(Request $request){
        if($request->password != $request->con_password){
            return redirect('admin/users/add')->withInput()->with('error', "Password and confirm password do not match");
        }
        $user = User::where('email', $request->email)->first();
        if(!is_null($user)){
            return redirect('admin/users/add')->withInput()->with('error', "Email already exists");;
        }
        $user = new User();
        $user->email = $request->email;
        $user->password = \Hash::make($request->password);
        $user->role = $request->role;
        $user->save();

        return redirect('admin/users')->with('success', "Successfully Saved");;
    }
}