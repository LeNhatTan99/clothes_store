<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Models\Role;

class UserController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(User::class);
    }

    public function index()
    {
        $users = User::paginate(8);
        return view('backend.users.index',['users'=>$users]);
    }

    public function create()
    {
        $roles = Role::get();
        return view('backend.users.create',compact('roles'));
    }


    public function store(Request $request)
    {
        $password = Hash::make($request->password);
        $data = [
            'name'=>$request->name,
            'email'=>$request->email,
            'phone_number'=>$request->phone_number,
            'address'=>$request->address,
            'email'=>$request->email,
            'password'=>$password,
        ];
        DB::beginTransaction();
        try {
            $user = User::create($data);
            $user->roles()->sync($request->roleId);
            DB::commit();
            return redirect()->route('users.index')->with('success','Tạo tài khoản thành công');
        }
        catch (\Exception $e) {
            Log::error($e->getMessage());
            DB::rollback();
            return back()->with('error','Tạo tài khoản thất bại');
        }
    }


    public function show(User $user)
    {
        return view('backend.users.show',['user'=>$user]);
    }


    public function edit(User $user)
    {
        $roles = Role::get();
        $viewData = [
            'user'=>$user,
            'roles'=>$roles,
        ];
        return view('backend.users.edit',$viewData);
    }


    public function update(Request $request, User $user)
    {
        $password = Hash::make($request->password);
        $data = [
            'name'=>$request->name,
            'email'=>$request->email,
            'phone_number'=>$request->phone_number,
            'address'=>$request->address,
            'email'=>$request->email,
            'password'=>$password,
        ];
        DB::beginTransaction();
        try {
            $user->update($data);
            $user->roles()->sync($request->roleId);
            DB::commit();
            return redirect()->route('users.index')->with('success','Cập nhật tài khoản thành công');
        }
        catch (\Exception $e) {
            Log::error($e->getMessage());
            DB::rollback();
            return back()->with('error','Cập nhật tài khoản thất bại');
        }
    }


    public function destroy(User $user)
    {
        DB::beginTransaction();
        try {
            $user->delete();
            DB::commit();
            return redirect()->route('users.index')->with('success','Xoá tài khoản thành công');
        }
        catch (\Exception $e) {
            Log::error($e->getMessage());
            DB::rollback();
            return back()->with('error','Xoá tài khoản thất bại');
        }
    }

}
