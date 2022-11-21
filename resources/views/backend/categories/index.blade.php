@extends('backend.app')
@section('content')
    <div class="m-3">
        <div class="heading-section text-center">
            Quản lý danh mục sản phẩm
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
                        @foreach ($categories as $category)
                            <tr>
                                <td>{{ $category->id }}</td>
                                <td>{{ $category->name }}</td>
                                <td>{{ $category->slug }}</td>
                                <td>{{ $category->description }}</td>
                                <td class="actions">
                                    <a href="" class="show-action p-2"><i class="fa-solid fa-eye fa-xs"></i></a>
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
            @else
                <p>Chưa có danh mục sản phẩm nào được tạo!</p>
            @endif
        </div>

    </div>
@endsection
