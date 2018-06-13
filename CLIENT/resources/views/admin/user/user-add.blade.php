@include('admin.layout.header')

@include('admin.layout.menu')

@include('admin.layout.nav')




<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title">Thêm thành viên</h4>
                        <p class="card-category">Tất cả</p>
                    </div>
                    <div class="card-body">
                        <form action="{{route('user-add')}}" method="post" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="txtUserName" class="bmd-label-floating">Tên đăng nhập</label>
                                        <input type="text" class="form-control" id="txtUserName" name="txtUserName">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="txtName" class="bmd-label-floating">Họ và tên</label>
                                        <input type="text" class="form-control" id="txtName" name="txtName">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="txtEmail" class="bmd-label-floating">Email</label>
                                        <input type="text" class="form-control" id="txtEmail" name="txtEmail">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="txtPhone" class="bmd-label-floating">SĐT</label>
                                        <input type="text" class="form-control" id="txtPhone" name="txtPhone">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="txtAddress" class="bmd-label-floating">Địa chỉ</label>
                                        <input type="text" class="form-control" id="txtAddress" name="txtAddress">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="cbType">Loại tài khoản</label>
                                        <select class="form-control" id="cbType" name="cbType">
                                            <option value="volvo">Volvo</option>
                                              <option value="saab">Saab</option>
                                              <option value="mercedes">Mercedes</option>
                                              <option value="audi">Audi</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="bmd-label-floating" for="txtPassword">Mật khẩu</label>
                                        <input type="password" class="form-control" id="txtPassword" name="txtPassword">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="bmd-label-floating" for="txtConfirmPassword">Xác nhận mật khẩu</label>
                                        <input type="password" class="form-control" id="txtConfirmPassword" name="txtConfirmPassword">
                                    </div>
                                </div>
                            </div>
                            <br>
                            <a href="{{route('user')}}" class="btn btn-default pull-right" role="button">Trở lại</a>
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