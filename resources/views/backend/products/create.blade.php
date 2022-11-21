
@extends('backend.app')
@section('content')
<div class="m-3">
    <div class="heading-section text-center">
        Tạo sản phẩm
    </div>
    <hr>
    <div class="create px-3">
        <form action="{{route('products.store')}}" method="post" enctype="multipart/form-data">
            @csrf

            <div class=" py-2 px-3">
                   <div class="form-group">
                    <label for="name">Tên sản phẩm</label>
                    <input class="form-control" type="text" name="name" value="{{old('name')}}">
                    @if ($errors->has('name'))
                    <span class="text-danger">{{$errors->first('name')}}</span>
                    @endif
                   </div>

                   <div class="row">
                       <div class="col-6 form-group">
                        <label for="price">Giá gốc</label>
                        <input class="form-control" type="number" name="price" value="{{old('price')}}">
                        @if ($errors->has('price'))
                        <span class="text-danger">{{$errors->first('price')}}</span>
                        @endif
                       </div>

                       <div class="col-6 form-group">
                         <label for="discount">Giá khuyến mãi</label>
                         <input class="form-control" type="number" name="discount" value="{{old('discount')}}">
                         @if ($errors->has('discount'))
                         <span class="text-danger">{{$errors->first('discount')}}</span>
                         @endif
                       </div>

                      <div class="col-6  form-group">
                        <label >Trạng thái</label>
                        <select name="status" class="form-control"  >
                            <option {{old('status')=="unemployed"? 'selected':''}}  value="bình thường">Bình thường</option>
                            <option {{old('status')=="employed"? 'selected':''}} value="mới">Mới</option>
                            <option {{old('status')=="employed"? 'selected':''}} value="bán chạy">Bán chạy</option>
                          </select>
                          @if ($errors->has('status'))
                          <span class="text-danger">{{$errors->first('status')}}</span>
                          @endif
                      </div>

                      <div class="col-6 form-group">
                        <label for="inventory">Số lượng</label>
                        <input class="form-control" type="number" name="inventory" value="{{old('inventory')}}">
                        @if ($errors->has('inventory'))
                        <span class="text-danger">{{$errors->first('inventory')}}</span>
                        @endif
                      </div>
                   </div>

                  <div class="form-group">
                    <label for="thumbnail">Hình ảnh</label>
                    <input class="form-control" type="file" name="thumbnail" value="{{old('thumbnail')}}">
                    @if ($errors->has('thumbnail'))
                    <span class="text-danger">{{$errors->first('thumbnail')}}</span>
                    @endif
                  </div>
                    <div class="form-group">
                        <label for="description">Mô tả</label>
                    <textarea  type="text" class=" form-control create-textarea" name="description"  cols="30" rows="20">
                        {{old('description')}}
                    </textarea>
                    @if ($errors->has('description'))
                    <span class="text-danger">{{$errors->first('description')}}</span>
                    @endif
                    </div>
                    <div class="my-3">
                        <p >Danh mục sản phẩm</p>
                       </div>
                        @if ($categories->count())
                            <div class="form-group">
                              @foreach ($categories as $category)
                                <div class="form-check">
                                  <input id="flexCheckCheckedCategory{{$category->id}}" class="form-check-input" type="radio" value="{{ $category->id }}" name="categoryId">
                                  <label class="form-check-label" for="flexCheckCheckedCategory{{$category->id}}">
                                    {{ $category->name }}
                                  </label>
                                </div>
                              @endforeach
                            </div>
                        @endif
            <button type="submit" class="btn-create">Tạo mới</button>
            </div>

        </form>

    </div>

</div>
@endsection
