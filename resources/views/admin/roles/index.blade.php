@extends('admin.app')
@section('title', 'Quản lý vai trò' )
@section('addBreadcrumb')
    @include('admin.breadcrumbs',
            [
                'breadcrumb'=> [
                    ['title' => 'Trang admin', 'url' => route('admin')],
                    ['title' => 'Quản lý vai trò', 'url' =>'#'],
                ]
            ])
@stop
@section('content')
    <div class="m-3 main-content">
        <div class="heading-section text-center">    
            <!-- Search form -->
            <form class="d-none d-md-flex input-group w-auto my-auto">
                <input autocomplete="off" name="keyword" type="search" class="form-control rounded" placeholder='Nhập từ khoá tìm kiếm'
                    @if($request->has('keyword')) value="{{ $request->keyword}}" @endif
                    style="min-width: 225px; max-width: 480px" />
                <button type="submit" class="input-group-text border-0"><i class="fas fa-search"></i></button>
            </form>
        </div>
        <hr>
        <div class=" read">
            <a href="{{ route('roles.create') }}" class="btn-create">Tạo vai trò</a>
            @if ($roles->count())
                <table>
                    <thead>
                        <td>#</td>
                        <td>Tên vai trò</td>
                        <td>Mô tả</td>
                        <td>Quyền</td>
                        <td>Thao tác</td>
                    </thead>
                    <tbody>
                        @foreach ($roles as $k => $role)
                            <tr>
                                <td>{{ ($roles->currentPage() - 1) * $roles->perPage() + $k + 1 }}</td>
                                <td>{{ $role->name }}</td>
                                <td>{{ $role->description }}</td>
                                <td>
                                    @foreach ($role->permissions as $permission)
                                    - {{$permission->name}} <br>
                                    @endforeach
                                </td>
                                <td class="actions">

                                    <a href="{{ route('roles.edit', ['role' => $role->id]) }}" class="edit-action p-2"><i
                                            class="fas fa-pen fa-xs"></i></a>

                             <form action="{{ route('roles.destroy', ['role' => $role->id]) }}"
                                                method="post" class="d-inline-block">
                                                @csrf
                                                @method('delete')
                                    <button class="delete-action p-2" type="button" data-bs-toggle="modal"
                                        data-bs-target="#item{{$role->id}}">
                                        <i class="fas fa-trash fa-xs"></i>
                                    </button>
                                    <div class="modal" id="item{{$role->id}}">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <!-- Modal Header -->
                                                <div class="modal-header">
                                                    <h4 class="modal-title">Xoá vai trò</h4>
                                                    <button type="button" class="btn " data-bs-dismiss="modal"><i
                                                            class="fa-solid fa-x"></i></button>
                                                </div>
                                                <!-- Modal body -->
                                                <div class="modal-body">
                                                    Bạn có chắc chắn xoá vai trò {{ $role->name }} không?
                                                </div>
                                                <!-- Modal footer -->
                                                <div class="modal-footer">

                                                        <button type="submit" class="btn btn-danger p-2">Xoá</button>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>

                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="my-2">
                    {{ $roles->appends(['keyword' => request()->input('keyword')])->links()}}
                </div> 
            @else
                <p>Chưa có vai trò nào được tạo!</p>
            @endif
        </div>

    </div>
@endsection
