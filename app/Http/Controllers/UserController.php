<?php

namespace App\Http\Controllers;

use App\Models\Hospital;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\DataTables\UserDT;
use App\User;
use Spatie\Permission\Models\Role;
use Yajra\Datatables\Datatables;

class UserController extends Controller
{
    public function index(UserDT $dataTable){

        return $dataTable->render('users.index');
        //return view('users.index');
    }



    public function edit($id){
        $user = User::with('roles')->findOrFail($id);
        $hospitals = ['' => 'Select one...'] + Hospital::lists('hospital_name','id')->all();

        $roles = ['' => 'Select a role...'] + Role::lists('name','id')->all();
        return view('users.edit', compact(['user','hospitals','roles']));
    }

    public function update($id, Request $request){
        $user = User::findOrFail($id);

        $roleName = Role::where('id','=',$request->input('roles'))->first()->name;



        $this->validate($request,[
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$id,
            'password' => 'required_with:password_confirmation|min:3|confirmed',
            'password_confirmation' => 'required_with:password|min:3',
            'roles' => 'required'
        ]);

        $roles = Role::all();


        if (trim($request->input('password')) == '') {
            $input = $request->except('password');
        }
        else {
            $input = $request->all();
        }

        $user->fill($input)->save();
        foreach($roles as $role) {
            $user->removeRole($role);
        }
        $user->assignRole($roleName);

        return \Redirect::route('users.show',$user->id)->with('flash_message', 'User successfully updated!');
    }

    public function destroy($id)
    {
        User::destroy($id);

    }

    public function create()
    {
        $hospitals = ['' => 'Select one...'] + Hospital::lists('hospital_name','id')->all();
        $roles = ['' => 'Select a role...'] + Role::lists('name','id')->all();
        return view('users.create',compact(['roles','hospitals']));
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required_with:password_confirmation|min:3|confirmed',
            'password_confirmation' => 'required_with:password|min:3',
            'roles' => 'required'
        ]);

        $input = $request->all();
        $user = User::create( $input );

        $user->assignRole(Role::findOrFail($request->roles)->name);

        return \Redirect::route('users.show',$user->id)->with('flash_message', 'User successfully created! <a href="'. url('users/create') .'">Add More</a>');
    }

    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('users.show')->withUser($user);
    }
}
