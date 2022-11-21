<?php

namespace App\Http\Controllers\Admin;

use App\Models\Permission;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class PermissionController extends Controller
{

    public function __construct()
    {
        $this->authorizeResource(Permission::class);
    }

    public function index()
    {
        $permissions = Permission::paginate(8);
        return view('backend.permissions.index',['permissions'=>$permissions]);
    }


    public function create()
    {
        return view('backend.permissions.create');
    }


    public function store(Request $request)
    {
        $data = [
            'name'=>$request->name,
            'description'=>$request->description,
        ];
        DB::beginTransaction();
        try {
            $permission = Permission::create($data);
            DB::commit();
            return redirect()->route('permissions.index')->with('success','Tạo quyền thành công');
        }
        catch (\Exception $e) {
            Log::error($e->getMessage());
            DB::rollback();
            return back()->with('error','Tạo quyền thất bại');
        }
    }


    public function edit(Permission $permission)
    {
        return view('backend.permissions.edit',['permission'=>$permission]);
    }


    public function update(Request $request, Permission $permission)
    {
        $data = [
            'name'=>$request->name,
            'description'=>$request->description,
        ];
        DB::beginTransaction();
        try {
            $permission ->update($data);
            DB::commit();
            return redirect()->route('permissions.index')->with('success','Chỉnh sửa quyền thành công');
        }
        catch (\Exception $e) {
            Log::error($e->getMessage());
            DB::rollback();
            return back()->with('error','Chỉnh sửa quyền thất bại');
        }
    }

    public function destroy(Permission $permission)
    {
        DB::beginTransaction();
        try {
            $permission->delete();
            DB::commit();
            return redirect()->route('permissions.index')->with('success','Xoá quyền thành công');
        }
        catch (\Exception $e) {
            Log::error($e->getMessage());
            DB::rollback();
            return back()->with('error','Xoá quyền thất bại');
        }
    }
}
