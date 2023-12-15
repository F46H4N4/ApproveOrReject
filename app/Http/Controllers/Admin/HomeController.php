<?php

namespace App\Http\Controllers\Admin;
use App\Models\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
public function index(){
    $users = User::all();
    // dd($users);
    return view('admin.dashboard',compact('users'));
}
public function approve($id){
    $user = User::find($id);

    if ($user) {
        $user->status = 1; // Set status to 1 for approval
        $user->save();
        return redirect()->back()->with('success', 'User approved successfully.');
    }

    return redirect()->back()->with('error', 'User not found.');
}

public function reject($id){
    $user = User::find($id);

    if ($user) {
        $user->status = 0; // Set status to 1 for approval
        $user->save();
        return redirect()->back()->with('success', 'Rejected');
    }

    return redirect()->back()->with('error', 'User not found.');
}
}
