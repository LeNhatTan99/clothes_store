@extends('backend.app')
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
