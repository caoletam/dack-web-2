
@include('admin.layout.header')

@include('admin.layout.menu')

@include('admin.layout.nav')




<div class="content">
                <div class="container-fluid">
                    
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-4" >
                                    <a href="{{route('product-add')}}" class="btn btn-success btn-block" role="button">Thêm sản phẩm mới</a>
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
                                    <h4 class="card-title ">Danh sách sản phẩm</h4>
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
                                                    Tên sản phẩm
                                                </th>
                                                <th>
                                                    Loại sản phẩm
                                                </th>
                                                <th>
                                                    Đặc tả
                                                </th>
                                                <th>
                                                    Hình đại diện
                                                </th>
                                                <th>
                                                    &nbsp;
                                                </th>
                                                <th>
                                                    &nbsp;
                                                </th>
                                            </thead>
                                            <tbody>
                                                @foreach($result_decode_product as $key => $rs_product)
                                                <tr>
                                                    <td>
                                                        {{$rs_product->masanpham}}
                                                    </td>
                                                    <td>
                                                        {{$rs_product->tensanpham}}
                                                    </td>
                                                    <td>
                                                        @foreach($result_decode_type_of_product as $key => $rs_type_of_product)
                                                        @if($rs_product->maloaisanpham==$rs_type_of_product->maloaisanpham)
                                                        {{$rs_type_of_product->tenloaisanpham}}
                                                        @endif
                                                        @endforeach
                                                    </td>
                                                    <td>
                                                        {{$rs_product->dacta}}
                                                    </td>
                                                    <td>
                                                        <img style="height: 110px; width: 110px; background-image:url({{$rs_product->hinhdaidien}});background-size: 100%;">
                                                    </td>
                                                    <td style="padding-right: 0px; width: 10px;">
                                                        <form action="{{route('product_edit',$rs_product->masanpham)}}" method="get">
                                                            {{ csrf_field() }}
                                                            <button class="btn btn-info btn-edit">Sửa</button>
                                                        </form>
                                                    </td>
                                                    <td style="padding-right: 0px; width: 10px;">
                                                        @if($rs_product->tinhtrang=='0')
                                                        <form action="{{route('product_update',$rs_product->masanpham)}}" method="post">
                                                            {{ csrf_field() }}
                                                            <input type="hidden" value="1" name="txtStatus">
                                                            <button style="width: 88px;" class="btn btn-warning btn-xs btn-delete">Hiện</button>
                                                        </form>
                                                        @elseif($rs_product->tinhtrang=='1')
                                                        <form action="{{route('product_update',$rs_product->masanpham)}}" method="post">
                                                            {{ csrf_field() }}
                                                            <input type="hidden" value="0" name="txtStatus">
                                                            <button style="width: 88px;" class="btn btn-success btn-xs btn-delete">Ẩn</button>
                                                        </form>
                                                        @endif
                                                        
                                                    </td>
                                                    <td>
                                                        <form action="{{route('product_delete',$rs_product->masanpham)}}" method="post">
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