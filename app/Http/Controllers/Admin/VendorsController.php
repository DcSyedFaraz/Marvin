<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VendorsController extends Controller
{
    public function index()
    {
        $users= User::orderBy('id','ASC')->paginate(10);
        return view('backend.users.index')->with('users',$users);
    }
}
