@include('admin.layout.header')

@include('admin.layout.menu')

@include('admin.layout.nav')




<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title">Thêm sản phẩm</h4>
                        <p class="card-category">Tất cả</p>
                    </div>
                    <div class="card-body">
                        <form action="{{route('product-add')}}" method="post" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="txtName" class="bmd-label-floating">Tên sản phẩm</label>
                                        <input type="text" class="form-control" id="txtName" name="txtName">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="cbType">Loại sản phẩm</label>
                                        <select class="form-control" id="cbType" name="cbType">
                                            @foreach($result_decode_type_of_product as $rs)
                                            <option value="{{$rs->maloaisanpham}}">{{$rs->tenloaisanpham}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="txtDescription" class="bmd-label-floating">Đặc tả</label>
                                        <input type="text" class="form-control" id="txtDescription" name="txtDescription">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="txtLinkAvatar" class="bmd-label-floating">Link hình đại diện</label>
                                        <input type="text" class="form-control" id="txtLinkAvatar" name="txtLinkAvatar">
                                    </div>
                                </div>
                            </div>
                            <br>
                            <a href="{{route('product')}}" class="btn btn-default pull-right" role="button">Trở lại</a>
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