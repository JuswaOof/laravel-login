<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Laratrust\Models\Role;

class DashboardController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    // public function superAdmin(){
    //     if(Auth::user()->hasRole('superadmin')){
    //         return redirect()->route('superadmin')
    //     }
    // }
    // public function admin(){
    //     if(Auth::user()->hasRole('admin')){
    //         return redirect()->route('admin')
    //     }
    // }
    // public function user(){
    //     if(Auth::user()->hasRole('user')){
    //         return redirect()->route('user')
    //     }
    // }
}