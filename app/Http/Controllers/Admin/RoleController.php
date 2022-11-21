<?php

namespace App\Http\Controllers\Admin;

use App\Models\Role;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Permission;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class RoleController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Role::class);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::paginate(8);
        return view('backend.roles.index',['roles'=>$roles]);
    }

    public function create()
    {
        $permissions = Permission::get();
        return view('backend.roles.create',['permissions'=>$permissions]);
    }


    public function store(Request $request)
    {
        $data = [
            'name'=>$request->name,
            'description'=>$request->description,
        ];
        DB::beginTransaction();
        try {
            $role = Role::create($data);
            $role->permissions()->sync($request->permissionIds);
            DB::commit();
            return redirect()->route('roles.index')->with('success','Tạo vai trò thành công');
        }
        catch (\Exception $e) {
            Log::error($e->getMessage());
            DB::rollback();
            return back()->with('error','Tạo vai trò thất bại');
        }
    }


    public function edit(Role $role)
    {
        $permissions = Permission::get();
        $viewData = [
            'role'=>$role,
            'permissions'=>$permissions,
        ];
        return view('backend.roles.edit',$viewData);
    }


    public function update(Request $request, Role $role)
    {
        $data = [
            'name'=>$request->name,
            'description'=>$request->description,
        ];
        DB::beginTransaction();
        try {
            $role->update($data);
            $role->permissions()->sync($request->permissionIds);
            DB::commit();
            return redirect()->route('roles.index')->with('success','Chỉnh sửa vai trò thành công');
        }
        catch (\Exception $e) {
            Log::error($e->getMessage());
            DB::rollback();
            return back()->with('error','Chỉnh sửa vai trò thất bại');
        }
    }


    public function destroy(Role $role)
    {
        DB::beginTransaction();
        try {
            $role->delete();
            DB::commit();
            return redirect()->route('roles.index')->with('success','Xoá vai trò thành công');
        }
        catch (\Exception $e) {
            Log::error($e->getMessage());
            DB::rollback();
            return back()->with('error','Xoá vai trò thất bại');
        }
    }
}
