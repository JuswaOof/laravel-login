<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // if(auth()->user()->hasRole('superadmin')){
        //     return view('superAdmin');
        // }elseif(auth()->user()->hasRole('admin')){
        //     return view('admin');
        // }else{
        //     return view('user');
        // }

        $roleTable = Role::all();
    

        return view('home', compact(['roleTable']));
    }

    public function role_store(Request $request){

        $validatedData = $request->validate([
            'name' => ['required', 'unique:roles,name'],
            'display_name' => ['required'],
            'description' => ['required'],
        ]);

        $role = Role::create($validatedData);

        
        
        // $roleTable = Role::all();

        return redirect()->route('home')->with('success', 'Role Created. Congrats!');
        
    }

    public function role_delete($id){

        Role::findOrFail($id)->delete();

        return redirect()->route('home')->with('error', 'Role Deleted!');

        // return $id;
    }

    public function role_edit(Request $request){
    
        // $name = $request->input('name');
        // dd($request->request);
        

    $validatedData = $request->validate([
        'name' => ['required', 'unique:roles,name,' . $request->input('id')],
        'display_name' => ['required'],
        'description' => ['required'],
    ]);

    // Find the existing role by ID
    $role = Role::find($request->input('id'));

    // Update the role with the validated data
    $role->update($validatedData);

    // Redirect with a success message
    return redirect()->route('home')->with('success', 'Role updated successfully.');

    }
}