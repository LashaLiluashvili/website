<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\Models\User;

class UserController extends Controller
{

    public function index()
    {
        return view('index');
    }

    public function store(UserRequest $request)
    {
        $data=$request->validated();
        $data["password"]=bcrypt($data["password"]);

        User::create($data);

        return back()->with('success','User created successfully');

    }
}
