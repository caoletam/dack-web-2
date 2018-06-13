@include('admin.layout.header')

@include('admin.layout.menu')

@include('admin.layout.nav')




<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title">Thêm hình</h4>
                        <p class="card-category">Tất cả</p>
                    </div>
                    <div class="card-body">
                        <form action="{{route('image_add')}}" method="post" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label for="txtLink" class="bmd-label-floating">Đường dẫn hình ảnh</label>
                                        <input type="text" class="form-control" id="txtLink" name="txtLink">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="cbName">Tên sản phẩm</label>
                                        <select class="form-control" id="cbName" name="cbName">
                                            @foreach($result_decode_product as $rs)
                                            <option value="{{$rs->masanpham}}">{{$rs->tensanpham}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <br>
                            <a href="{{route('image')}}" class="btn btn-default pull-right" role="button">Trở lại</a>
                            <button type="submit" class="btn btn-primary pull-right">Thêm</button>
                            
                            <div class="clearfix"></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@include('admin.layout.footer')