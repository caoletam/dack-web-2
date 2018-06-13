@include('admin.layout.header')

@include('admin.layout.menu')

@include('admin.layout.nav')




<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title">Thêm tham số</h4>
                        <p class="card-category">Tất cả</p>
                    </div>
                    <div class="card-body">
                        <form action="{{route('parameter_add')}}" method="post" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label for="txtName" class="bmd-label-floating">Tên tham số</label>
                                        <input type="text" class="form-control" id="txtName" name="txtName">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="txtValue" class="bmd-label-floating">Giá trị</label>
                                        <input type="text" class="form-control" id="txtValue" name="txtValue">
                                    </div>
                                </div>
                            </div>
                            <br>
                            <br>
                            <a href="{{route('parameter')}}" class="btn btn-default pull-right" role="button">Trở lại</a>
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