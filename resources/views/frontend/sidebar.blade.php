    {{-- sidebar --}}
    <div class="col-md-4 col-lg-2 " >
        <div class="navbar-expand-md mb-4">
         <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#categories" aria-controls="categories" aria-expanded="false" aria-label="Toggle navigation">
             <span class="oi oi-menu"></span> <i class="fa-solid fa-bars"></i> Danh mục
           </button>
        <div class="sidebar">
         <div class="collapse navbar-collapse" id="categories">

             <div class="sidebar-box ">
                 <h2 class="heading-section mb-4">Danh mục</h2>
                 <ul>
                    @foreach ($categories as $category)
                    <li><a href="{{route('get-list-product',$category->slug)}}">{{$category->name}}</a></li>
                    @endforeach
                 </ul>
             </div>
         </div>
        </div>
        </div>
         </div>
