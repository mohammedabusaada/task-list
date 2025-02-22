<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UserController extends Controller{


    // Show Users List
    public function index(){
        $users = DB::table('users')->get();
        return view('users', compact('users'));
    }


    // Add New User
    public function addUser(Request $request){
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6'
        ], [
            'email.unique' => 'This email is already registered. Please use a different one.'
        ]);
        
    
        DB::table('users')->insert([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')), // Hash password for security
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    
        return redirect('/users')->with('success', 'User added successfully!');
    }
    


    // Update User
    public function update(Request $request, $id){
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
        ]);
    
        DB::table('users')->where('id', $id)->update([
            'name' => $request->name,
            'email' => $request->email,
            'updated_at' => now(),
        ]);
    
        return redirect('/users')->with('success', 'User updated successfully!');
    }
    
    
    public function edit($id){
        $user = DB::table('users')->where('id', $id)->first();
        $users = DB::table('users')->get(); // Keep user list for display
        return view('users', compact('user', 'users'));
    }
    


    // Delete User
    public function destroy($id){
        DB::table('users')->where('id', $id)->delete();
        return redirect('/users')->with('success', 'User deleted successfully!');
    }
    
}
