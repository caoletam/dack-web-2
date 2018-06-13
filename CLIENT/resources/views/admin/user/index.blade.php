
@include('admin.layout.header')

@include('admin.layout.menu')

@include('admin.layout.nav')




<div class="content">
                <div class="container-fluid">
                    
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-4" >
                                    <a href="{{route('user-add')}}" class="btn btn-success btn-block" role="button">Thêm tài khoản</a>
                                </div>
                                <div class="col-md-8">
                                    <form class="navbar-form">
                                        <div class="input-group no-border">
                                            <input type="text" value="" class="form-control" placeholder="Tìm kiếm">
                                            <button type="submit" class="btn btn-white btn-round btn-just-icon">
                                                <i class="material-icons">search</i>
                                                <div class="ripple-container"></div>
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header card-header-primary">
                                    <h4 class="card-title ">Danh sách tài khoản</h4>
                                    <p class="card-category"> Tất cả</p>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead class=" text-primary">
                                                <th>
                                                    #
                                                </th>
                                                <th>
                                                    Tên
                                                </th>
                                                <th>
                                                    Email
                                                </th>
                                                <th>
                                                    Điện thoại
                                                </th>
                                                <th>
                                                    Địa chỉ
                                                </th>
                                                <th>
                                                    Loại tài khoản
                                                </th>
                                                <th>
                                                    &nbsp;
                                                </th>
                                            </thead>
                                            <tbody>
                                                @foreach($list_user as $lu)
                                                <tr>
                                                    <td>
                                                        {{$lu->mataikhoan}}
                                                    </td>
                                                    <td>
                                                        {{$lu->tenhienthi}}
                                                    </td>
                                                    <td>
                                                        {{$lu->email}}
                                                    </td>
                                                    <td>
                                                        {{$lu->dienthoai}}
                                                    </td>
                                                    <td>
                                                        {{$lu->diachi}}
                                                    </td>
                                                    <td>
                                                        @if($lu->maloaitaikhoan==1)
                                                        Người dùng
                                                        @elseif($lu->maloaitaikhoan==2)
                                                        Quản trị viên
                                                        @endif
                                                    </td>
                                                    <td>
                                                        
                                                    </td>
                                                </tr>
                                                @endforeach
                                                
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>
                        <br>
                        
                        <!-- <div class="col-md-12">
                            <div class="card">
                                <div class="card-header card-header-primary">
                                    <h4 class="card-title ">Danh sách loại tài khoản</h4>
                                    <p class="card-category"> Tất cả</p>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead class=" text-primary">
                                                <th>
                                                    #
                                                </th>
                                                <th>
                                                    Tên loại
                                                </th>
                                            </thead>
                                            <tbody>
                                                @foreach($list_type_of_user as $rs)
                                                <tr>
                                                    <td>
                                                        {{$rs->maloaitaikhoan}}
                                                    </td>
                                                    <td>
                                                        {{$rs->tenloaitaikhoan}}
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div> -->
                    </div>
                </div>
            </div>


@include('admin.layout.footer')