@extends('admin.app')
@section('title', 'Quản lý danh mục sản phẩm' )
@section('addBreadcrumb')
    @include('admin.breadcrumbs',
            [
                'breadcrumb'=> [
                    ['title' => 'Trang admin', 'url' => route('admin')],
                    ['title' => 'Quản lý danh mục sản phẩm', 'url' =>'#'],
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
            <a href="{{ route('categories.create') }}" class="btn-create">Tạo danh mục sản phẩm</a>
            @if ($categories->count())
                <table>
                    <thead>
                        <td>#</td>
                        <td>Tên danh mục sản phẩm</td>
                        <td>Slug</td>
                        <td>Mô tả</td>
                        <td>Thao tác</td>
                    </thead>
                    <tbody>
                        @foreach ($categories as $k => $category)
                            <tr>
                                <td>{{ ($categories->currentPage() - 1) * $categories->perPage() + $k + 1 }}</td>
                                <td>{{ $category->name }}</td>
                                <td>{{ $category->slug }}</td>
                                <td>{{ $category->description }}</td>
                                <td class="actions">
                                    <a href="{{ route('categories.edit', ['category' => $category->id]) }}" class="edit-action p-2"><i
                                            class="fas fa-pen fa-xs"></i></a>

                             <form action="{{ route('categories.destroy', ['category' => $category->id]) }}"
                                                method="post" class="d-inline-block">
                                                @csrf
                                                @method('delete')
                                    <button class="delete-action p-2" type="button" data-bs-toggle="modal"
                                        data-bs-target="#item{{$category->id}}">
                                        <i class="fas fa-trash fa-xs"></i>
                                    </button>
                                    <div class="modal" id="item{{$category->id}}">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <!-- Modal Header -->
                                                <div class="modal-header">
                                                    <h4 class="modal-title">Xoá danh mục sản phẩm</h4>
                                                    <button type="button" class="btn " data-bs-dismiss="modal"><i
                                                            class="fa-solid fa-x"></i></button>
                                                </div>
                                                <!-- Modal body -->
                                                <div class="modal-body">
                                                    Bạn có chắc chắn xoá danh mục sản phẩm {{ $category->name }} không?
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
                    {{ $categories->appends(['keyword' => request()->input('keyword')])->links()}}
                </div> 
            @else
                <p>Chưa có danh mục sản phẩm nào được tạo!</p>
            @endif
        </div>

    </div>
@endsection
