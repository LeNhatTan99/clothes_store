<?php

namespace App\Http\Controllers\Admin;

use App\Models\Permission;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use App\Http\Requests\Admin\PermissionStoreRequest;

class PermissionController extends Controller
{

    public function __construct()
    {
        $this->authorizeResource(Permission::class);
    }

    public function index(Request $request)
    {
        $conditions = Permission::query();
        $keyword = $request->get('keyword');
        if (!empty($keyword)) {
            $conditions->where('permissions.name', 'like', '%' . $keyword . '%');
        }
        $permissions = $conditions->paginate(8);
        return view('admin.permissions.index',['permissions'=>$permissions, 'request'=>$request]);
    }


    public function create()
    {
        return view('admin.permissions.create');
    }


    public function store(PermissionStoreRequest $request)
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
        return view('admin.permissions.edit',['permission'=>$permission]);
    }


    public function update(PermissionStoreRequest $request, Permission $permission)
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
