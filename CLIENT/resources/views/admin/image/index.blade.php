
@include('admin.layout.header')

@include('admin.layout.menu')

@include('admin.layout.nav')




<div class="content">
                <div class="container-fluid">
                    
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-4" >
                                    <a href="{{route('image_add')}}" class="btn btn-success btn-block" role="button">Thêm hình mới</a>
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
                                    <h4 class="card-title ">Danh sách hình</h4>
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
                                                    Sản phẩm
                                                </th>
                                                <th>
                                                    Đường dẫn
                                                </th>
                                                <th>
                                                    Hình
                                                </th>
                                                <th>
                                                    &nbsp;
                                                </th>
                                                <th>
                                                    &nbsp;
                                                </th>
                                            </thead>
                                            <tbody>
                                                @foreach($result_decode_image as $key => $rs_image)
                                                <tr>
                                                    <td>
                                                        {{$rs_image->mahinh}}
                                                    </td>
                                                    <td>
                                                        @foreach($result_decode_product as $key => $rs_product)
                                                        @if($rs_image->masanpham==$rs_product->masanpham)
                                                        {{$rs_product->tensanpham}}
                                                        @endif
                                                        @endforeach
                                                    </td>
                                                    <td>
                                                        {{$rs_image->duongdan}}
                                                    </td>
                                                    <td>
                                                        <img style="height: 110px; width: 110px; background-image:url({{$rs_image->duongdan}});background-size: 100%;">
                                                    </td>
                                                    <td style="padding-right: 0px; width: 10px;">
                                                        <form action="{{route('image_edit',$rs_image->mahinh)}}" method="get">
                                                            {{ csrf_field() }}
                                                            <button class="btn btn-warning btn-edit">Sửa</button>
                                                        </form>
                                                    </td>
                                                    <td>
                                                        <form action="{{route('image_delete',$rs_image->mahinh)}}" method="post">
                                                            {{ csrf_field() }}
                                                            <input type="hidden" value="" name="txtDeleteID">
                                                            <button class="btn btn-danger btn-xs btn-delete">Xóa</button>
                                                        </form>
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
                        
                        
                    </div>
                </div>
            </div>


@include('admin.layout.footer')