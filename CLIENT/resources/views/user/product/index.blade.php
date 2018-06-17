
@include('user.layout.header')

@include('user.layout.menu')


<div class="special">
	<div class="container">
		<h3>ĐANG ĐẤU GIÁ</h3>
		<div class="specia-top">
			<ul class="grid_2">
				@foreach($getListProduct as $lp)
				<li style="width: 260px; height: 440px; margin-bottom: 20px;">
					<a href=""><img style="width: 262px; height: 270px;" src="{{$lp->hinhdaidien}}" class="img-responsive" alt=""></a>
					<div class="special-info grid_1 simpleCart_shelfItem" style="width: 260px; height: 170px;">
						<h5 style="height: 20px;">{{$lp->tensanpham}}</h5>
						@foreach($getListAuction as $la)
						@if($la->masanpham == $lp->masanpham)
						<div class="item_add"><span class="item_price"><h6><?=number_format($la->giahientai)?> VNĐ</h6></span></div>
						@endif
						@endforeach
						<div class="item_add"><span class="item_price"><a href="">CHI TIẾT</a></span></div>
					</div>
				</li>
				@endforeach
		<div class="clearfix"> </div>
	</ul>
		</div>
	</div>
</div>

@include('user.layout.footer')