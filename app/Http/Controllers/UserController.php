<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
// use Illuminate\Support\Facades\DB; We Don't Need This Anymore!

class UserController extends Controller{


    // Show Users List
    public function index(){
        $users = User::all();
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
        
    
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password), // Hash password for security
        ]);
    
        return redirect('/users')->with('success', 'User added successfully!');
    }
    


    // Update User
    public function update(Request $request, $id){
        $user = User::findOrFail($id);
    
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'nullable|string|min:6' // Optional (at least 6 Characters)
        ]);
    
        $user->name = $request->name;
        $user->email = $request->email;
    
        // Check if a new password was provided
        if (!empty($request->password)) {
            $user->password = Hash::make($request->password);
        }
    
        $user->save();
    
        return redirect('/users')->with('success', 'User updated successfully!');
    }
    


    public function edit($id){
        $user = User::findOrFail($id);
        $users = User::all();
        return view('users', compact('user', 'users'));
    }


    // Delete User
    public function destroy($id){
        User::findOrFail($id)->delete();
        return redirect('/users')->with('success', 'User deleted successfully!');
    }
    
}
