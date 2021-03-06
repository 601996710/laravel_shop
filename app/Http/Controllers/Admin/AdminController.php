<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth.admin:admin');
    }

    public function AdminError($error = null){
        return view('admin/adminError')->with('error',$error);
    }

}
