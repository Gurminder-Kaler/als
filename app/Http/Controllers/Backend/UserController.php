<?php

namespace App\Http\Controllers\Backend;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    // user index
    public function index() {
        $users = User::all();
        return view('backend.user.index', compact('users'));
    }
    
    // user create
    public function create() {
        return view('backend.user.create');
    }

    // user store
    public function store() {
        return redirect('/admin/user');
    }
    
    // user update
    public function update() {
        return view('backend.user.update');
    }

    // user delete
    public function delete() {
        return view('backend.user.delete');
    }
}