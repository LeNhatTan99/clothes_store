@extends('admin.app')
@section('title', 'Xem bài viết' )
@section('addBreadcrumb')
    @include('admin.breadcrumbs',
            [
                'breadcrumb'=> [
                    ['title' => 'Trang admin', 'url' => route('admin')],
                    ['title' => 'Quản lý tin tức', 'url' =>route('news.index') ],
                    ['title' => 'Chi tiết tin tức', 'url' =>"#" ],
                ]
            ])
@stop
@section('content')
<div class="p-4">
    <table class="table">
        <tbody >
          <tr>
            <th >Người tạo:</th>
            <td>{{$news->user->name}}</td>
          </tr>
          <tr>
            <th>Tiêu đề:</th>
            <td>{{$news->title}}</td>
          </tr>
          <tr>
            <th >Hình ảnh:</th>
            <td><img class="img-thumbnail" src="{{ asset('storage/'.$news->thumbnail) }}" alt=""> </td>
          </tr>
          <tr>
            <th>Nội dung:</th>
            <td>{{$news->content}}</td>
          </tr>
        </tbody>
      </table>
</div>
@endsection
