<?php

namespace App\Http\Controllers;

use App\Http\Operation\Operation;
use App\Models\Employee;
use App\Models\PerHasRol;
use App\Models\Permission;
use App\Models\Post;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class EmployeeController extends Controller
{
    public function login(){
        return view('auth.login');
    }

    public function register(){
        return view('auth.register');
    }

    protected function registerUser(Request $request){
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:employees',
            'password' => 'required|min:6',
        ]);


        $employee = new Employee();
        $employee->name = $request->name;
        $employee->email = $request->email;
        $employee->password = Hash::make($request->password);
        $emp = $employee->save();

        $empl = Employee::all();
        if (count($empl) == 1){
            $op = new Operation($empl);
        }


        if ($emp){
            return back()->with('success', 'You have registered successfully');
        }else{
            return back()->with('fail', 'Something wrong');
        }
    }


    protected function loginUser(Request $request){
        $request->validate([
            'email' => 'required|email|',
            'password' => 'required|min:6',
        ]);
        $employee = Employee::where('email', $request->email)->first();

        if ($employee){
            if (Hash::check($request->password, $employee->password)){
                $request->session()->put('loginId', $employee->id);
                return redirect('dashboard');
            }else{
                return back()->with('fail', 'Wrong password');
            }
        }else{
            return back()->with('fail', 'The email is not registered');
        }
    }

    protected function dashboard(){
        $data = array();

        if (Session::has('loginId')){
            $data = Employee::where('id', Session::get('loginId'))->first();
            $posts = Post::all();
        }
        return view('auth.dashboard', compact('data', 'posts'));
    }

    protected function logout(){
        if (Session::has('loginId')){
            Session::pull('loginId');
            return redirect('login');
        }
    }
}
