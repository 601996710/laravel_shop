<?php

namespace App\Http\Controllers\Admin;

use App\user;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;


class UserController extends AdminController
{
    //

    public function __construct()
    {
        $this->middleware('auth.admin:admin');
    }

    //本站用户
    public  function webUser(){
        $data = \App\User::paginate(20);

        return view("admin/webUser")->with('data',$data);
    }

    public function addUser(){
        return view("admin/addUser");
    }

    public function saveUser(Request $request){
        $User = User::where("email","=",$request->post('email'))->get();
        if(!$User->isEmpty()){
            return  $this->AdminError('当前邮箱已存在！');
        }
        $data['name'] = $request->post('name');
        $data['email'] = $request->post('email');
        $data['password'] = $request->post('passwd');
        $data['remember_token'] = str_random(10);
        $validator = Validator::make($data,
            [
                'name' => 'required|string|max:255',
                'email' => 'required|email',
                'password' => 'required|min:6',
            ]);

        if($validator->fails()){
            return  $this->AdminError($validator->errors()->first() );
        }
        $data['password'] = bcrypt($request->post('passwd'));

        User::create($data);
        return redirect(url("admin/webUser"));
    }

    public function delUser($id){
        User::find($id)->delete();
        return redirect(url("admin/webUser"));
    }

    public function editUser($id){
        $data = User::find($id);
        return view("admin/addUser")->with(["op"=>"编辑","data"=>$data]);
    }

    public function saveEditUser(Request $request){
        $User = User::where("email","=",$request->post('email'))->get();
        if(!$User->isEmpty()){
            return  $this->AdminError('当前邮箱已存在！');
        }

        $data['name'] = $request->post('name');
        $data['email'] = $request->post('email');
        if(!empty($request->post('passwd'))){
            $data['password'] = $request->post('passwd');
            $validatorArr['password'] = 'required|min:6';
        }

        $validatorArr['name'] =  'required|string|max:255';
        $validatorArr['email'] = 'required|email';

        $validator = Validator::make($data,$validatorArr);

        if($validator->fails()){

            return  $this->AdminError($validator->errors()->first() );
        }
        $data['password'] = bcrypt($request->post('passwd'));

        User::where("id","=",$request->post('id'))->update($data);
        return redirect(url("admin/webUser"));
    }


}
