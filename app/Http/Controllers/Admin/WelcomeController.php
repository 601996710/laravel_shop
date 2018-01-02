<?php

namespace App\Http\Controllers\Admin;

use App\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class WelcomeController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth.admin:admin');
    }

    public function index(Request $request){

        return View("admin.index");
    }
}
