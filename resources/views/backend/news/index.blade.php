@extends('backend.app')
@section('content')
    <div class="m-3">
        <div class="heading-section text-center">
            Quản lý tin tức
        </div>
        <hr>
        <div class=" read">
            <a href="{{ route('news.create') }}" class="btn-create">Tạo tin tức</a>
            @if ($news->count())
                <table>
                    <thead>
                        <td>#</td>
                        <td>Người tạo</td>
                        <td>Tiêu đề</td>
                        <td>Hình ảnh</td>
                        <td>Nội dung</td>
                        <td>Thao tác</td>
                    </thead>
                    <tbody>
                        @foreach ($news as $post)
                            <tr>
                                <td>{{ $post->id }}</td>
                                <td>{{ $post->user->name }}</td>
                                <td>{{ $post->title }}</td>
                                <td><img src="{{ asset('storage/'.$post->thumbnail) }}" alt=""> </td>
                                <td class="read-description">{{ $post->content }}</td>
                                <td class="actions">
                                    <a href="{{ route('news.show', ['news' => $post->id]) }}" class="show-action p-2"><i class="fa-solid fa-eye fa-xs"></i></a>
                                   <a href="{{ route('news.edit', ['news' => $post->id]) }}" class="edit-action p-2"><i
                                            class="fas fa-pen fa-xs"></i></a>

                             <form action="{{ route('news.destroy', ['news' => $post->id]) }}"
                                                method="post" class="d-inline-block">
                                                @csrf
                                                @method('delete')
                                    <button class="delete-action p-2" type="button" data-bs-toggle="modal"
                                        data-bs-target="#item{{$post->id}}">
                                        <i class="fas fa-trash fa-xs"></i>
                                    </button>
                                    <div class="modal" id="item{{$post->id}}">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <!-- Modal Header -->
                                                <div class="modal-header">
                                                    <h4 class="modal-title">Xoá tin tức</h4>
                                                    <button type="button" class="btn " data-bs-dismiss="modal"><i
                                                            class="fa-solid fa-x"></i></button>
                                                </div>
                                                <!-- Modal body -->
                                                <div class="modal-body">
                                                    Bạn có chắc chắn xoá tin tức {{ $post->name }} không?
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
                <p>Chưa có bài viết nào được tạo!</p>
            @endif
        </div>
        {{ $news->links() }}
    </div>
@endsection
