@include('admin.layout.header')

@include('admin.layout.menu')

@include('admin.layout.nav')




<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title">Thêm phiên đấu giá</h4>
                        <p class="card-category">Tất cả</p>
                    </div>
                    <div class="card-body">
                        <form action="{{route('auction_add')}}" method="post" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="cbName">Tên sản phẩm</label>
                                        <select class="form-control" id="cbName" name="cbName">
                                            @foreach($getListProductNotExistAuction as $lpnea)
                                            <option value="{{$lpnea->masanpham}}">{{$lpnea->tensanpham}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                
                                
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="txtTime" class="bmd-label-floating">Thời gian đấu (ngày)</label>
                                        <input type="text" class="form-control" id="txtTime" name="txtTime">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="txtCurrency" class="bmd-label-floating">Giá khởi điểm</label>
                                        <input type="text" class="form-control" id="txtCurrency" name="txtCurrency">
                                    </div>
                                </div>  
                            </div>
                            <br>
                            <br>
                            <a href="{{route('auction')}}" class="btn btn-default pull-right" role="button">Trở lại</a>
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