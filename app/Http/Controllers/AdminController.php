<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function users(){
        $users = User::all();
        return view('admin.users', compact('users'));

    }
    public function upadteUsers(Request $request ){
        $request->validate([
            'id' => 'required|integer|exists:users,id',
            'role' => 'required|string|in:user,moderator,admin'
        ]);
        switch ($request['type']){
            case 'update':{
                User::find($request['id'])->update(['role'=> $request['role']]);
                break;
            }
            case 'delete':{
                User::find($request['id'])->delete();
                break;
            }
        }
        return redirect()->back();
    }
}
