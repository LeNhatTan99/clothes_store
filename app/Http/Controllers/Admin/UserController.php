<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Models\Role;
use App\Http\Requests\Admin\UserStoreRequest;

class UserController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(User::class);
    }

    public function index(Request $request)
    {
        $conditions = User::query();
        $keyword = $request->get('keyword');
        if (!empty($keyword)) {
            $conditions->where('users.name', 'like', '%' . $keyword . '%')
                        ->orWhere('users.phone_number', 'like', '%' . $keyword . '%')
                        ->orWhere('users.email', 'like', '%' . $keyword . '%');
        }
        $users = $conditions->paginate(8);
        return view('admin.users.index',['users'=>$users, 'request' => $request]);
    }

    public function create()
    {
        $roles = Role::get();
        return view('admin.users.create',compact('roles'));
    }


    public function store(UserStoreRequest $request)
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
        return view('admin.users.show',['user'=>$user]);
    }


    public function edit(User $user)
    {
        $roles = Role::get();
        $viewData = [
            'user'=>$user,
            'roles'=>$roles,
        ];
        return view('admin.users.edit',$viewData);
    }


    public function update(UserStoreRequest $request, User $user)
    {
        $password = Hash::make($request->password);
        $data = [
            'name'=>$request->name,
            'email'=>$request->email,
            'phone_number'=>$request->phone_number,
            'address'=>$request->address,
            'email'=>$request->email,
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
