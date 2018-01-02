<?php

namespace App\Http\Controllers\Admin;

use App\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class AdminSetController extends AdminController
{
    //
    public function __construct()
    {
        $this->middleware('auth.admin:admin');
    }

    public function adminSet()
    {
        $data  = Admin::paginate(10);
        return view("admin/adminSet")->with("data",$data);
    }

    public function addAdmin(){
        return view("admin/addAdmin");
    }

    public function saveAdmin(Request $request){
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

        Admin::create($data);
        return redirect(url("admin/adminSet"));
    }

    public function delAdmin($id){
        Admin::find($id)->delete();
        return redirect(url("admin/adminSet"));
    }

    public function editAdmin($id){
        $data = Admin::find($id);
        return view("admin/addAdmin")->with(["op"=>"编辑","data"=>$data]);
    }

    public function saveEditAdmin(Request $request){
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

        Admin::where("id","=",$request->post('id'))->update($data);
        return redirect(url("admin/adminSet"));
    }

}
