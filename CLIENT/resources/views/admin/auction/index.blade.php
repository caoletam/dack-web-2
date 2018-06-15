
@include('admin.layout.header')

@include('admin.layout.menu')

@include('admin.layout.nav')

<?php 

use Carbon\Carbon;

?>


<div class="content">
                <div class="container-fluid">
                    
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-4" >
                                    <a href="{{route('image_add')}}" class="btn btn-success btn-block" role="button">Thêm phiên đấu giá mới</a>
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
                                    <h4 class="card-title ">Danh sách các phiên đấu giá</h4>
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
                                                    Thời gian còn
                                                </th>
                                                <th>
                                                    Giá hiện tại
                                                </th>
                                                <th>
                                                    Mã phiếu thắng
                                                </th>
                                                <th>
                                                    Tình trạng phiên
                                                </th>
                                                <th>
                                                    &nbsp;
                                                </th>
                                                <th>
                                                    &nbsp;
                                                </th>
                                            </thead>
                                            <tbody>
                                                @foreach($listAuction as $key => $la)
                                                <tr>
                                                    <td>
                                                        {{$la->maphiendaugia}}
                                                    </td>
                                                    <td>
                                                        @foreach($listProduct as $key => $lp)
                                                        @if($la->masanpham==$lp->masanpham)
                                                        {{$lp->tensanpham}}
                                                        @endif
                                                        @endforeach
                                                    </td>
                                                    <td>
                                                        <?php 

                                                        $now = Carbon::now();
                                                        $now->setTimezone('Asia/Bangkok');
                                                        $inputSeconds = strtotime($la->thoigiandau) - strtotime($now);

                                                        if($inputSeconds>0){
                                                            $secondsInAMinute = 60;
                                                            $secondsInAnHour  = 60 * $secondsInAMinute;
                                                            $secondsInADay    = 24 * $secondsInAnHour;

                                                            // extract days
                                                            $days = floor($inputSeconds / $secondsInADay);

                                                            // extract hours
                                                            $hourSeconds = $inputSeconds % $secondsInADay;
                                                            $hours = floor($hourSeconds / $secondsInAnHour);

                                                            // extract minutes
                                                            $minuteSeconds = $hourSeconds % $secondsInAnHour;
                                                            $minutes = floor($minuteSeconds / $secondsInAMinute);

                                                            // extract the remaining seconds
                                                            $remainingSeconds = $minuteSeconds % $secondsInAMinute;
                                                            $seconds = ceil($remainingSeconds);

                                                            echo $days.' ngày '.$hours.' giờ '.$minutes.' phút '.$seconds.' giây ';
                                                        }
                                                        else{
                                                            echo 'null';
                                                        }
                                                        

                                                        ?>
                                                    </td>
                                                    <td>
                                                        {{$la->giahientai}}
                                                    </td>
                                                    <td>
                                                        {{$la->maphieuthang}}
                                                    </td>
                                                    <td>
                                                        @foreach($listAuctionStatus as $key => $las)
                                                        @if($la->matinhtrangphiendaugia==$las->matinhtrangphiendaugia)
                                                        {{$las->tentinhtrangphiendaugia}}
                                                        @endif
                                                        @endforeach
                                                    </td>
                                                    <td style="padding-right: 0px; width: 10px;">
                                                        <form action="{{route('auction_edit',$la->maphiendaugia)}}" method="get">
                                                            {{ csrf_field() }}
                                                            <button class="btn btn-info btn-edit">Sửa</button>
                                                        </form>
                                                    </td>
                                                    <td style="padding-right: 0px; width: 10px;">
                                                        @if($la->matinhtrangphiendaugia=='2')
                                                        <form action="{{route('auction_update',$la->maphiendaugia)}}" method="post">
                                                            {{ csrf_field() }}
                                                            <input type="hidden" value="1" name="txtStatus">
                                                            <button style="width: 88px;" class="btn btn-default btn-xs btn-delete">HIỆN</button>
                                                        </form>
                                                        @elseif($la->matinhtrangphiendaugia=='1')
                                                        <form action="{{route('auction_update',$la->maphiendaugia)}}" method="post">
                                                            {{ csrf_field() }}
                                                            <input type="hidden" value="2" name="txtStatus">
                                                            <button style="width: 88px;" class="btn btn-success btn-xs btn-delete">ẨN</button>
                                                        </form>
                                                        @endif
                                                        
                                                    </td>
                                                    <td>
                                                        <form action="{{route('auction_delete',$la->maphiendaugia)}}" method="post">
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