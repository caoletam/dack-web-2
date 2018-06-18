
<?php 

use Carbon\Carbon;

?>

@include('user.layout.header')

@include('user.layout.menu')
<!-- content -->
<div class="container">
<div class="women_main">
	<!-- start content -->
			<div class="row single">
				<div class="col-md-9 det">
				  <div class="single_left">
					<div class="grid images_3_of_2">
						<div class="row">
							<div class="col-md-12">
								<img src="{{$getProductByID->hinhdaidien}}" style="width: 300px; height: 320px; display: inline;">
							</div>
						</div>
						
						<div class="clearfix"></div>		
				  </div>
				  <div>
				  	<form method="post">
				  		{{ csrf_field() }}
				  		<input hidden type="text" id="realtime" value="{{route('detail-realtime',$getProductByID->masanpham)}}" name="realtime">
				  	</form>
				  </div>
				  <div class="desc1 span_3_of_2">
					<h3>{{$getProductByID->tensanpham}}</h3>
					<span class="brand">Danh mục: 
						<a href="#">
						@foreach($getListTypeOfProduct as $key => $ltop)
						@if($getProductByID->maloaisanpham == $ltop->maloaisanpham)
						{{$ltop->tenloaisanpham}}
						@endif
						@endforeach
						</a>
					</span>
					<br>
					<span class="code">Giá hiện tại: <?=number_format($getAuctionByIDProduct->giahientai) ?> VNĐ</span>
					<br>
					<br>
					<div class="price">
						<span class="text">Thời gian còn lại: </span>
						@if($getProductByID->masanpham == $getAuctionByIDProduct->masanpham)
						<p id="realTime">Đợi 1 chút ..</p>
						@endif
					</div>
					<br>
					<form id="form-auction" method="post" action="{{route('auction-product',$getProductByID->masanpham)}}">
						{{ csrf_field() }}
						<div class="det_nav1">
						<h4>Giá của bạn:</h4>
							<div class=" sky-form col col-4">
								<input type="number" name="txtAuction">
							</div>
						</div>
						<div class="btn_form">
							<a type="submit" onclick="document.getElementById('form-auction').submit()">ĐẤU GIÁ</a>
						</div>
						
					</form>
					
					
			   	 </div>
          	    <div class="clearfix"></div>
          	   </div>
          	    <div class="single-bottom1">
					<h6>CHI TIẾT</h6>
					<p class="prod-desc">{{$getProductByID->dacta}}</p>
				</div>
				<div class="single-bottom2">
					<h6>CÓ LIÊN QUAN</h6>
						<div class="product">
						   <div class="product-desc">
								<div class="product-img">
		                           <img src="images/w8.jpg" class="img-responsive " alt=""/>
		                       </div>
		                       <div class="prod1-desc">
		                           <h5><a class="product_link" href="#">Excepteur sint</a></h5>
		                           <p class="product_descr"> Vivamus ante lorem, eleifend nec interdum non, ullamcorper et arcu. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. </p>									
							   </div>
							  <div class="clearfix"></div>
					      </div>
						  <div class="product_price">
								<span class="price-access">$597.51</span>								
								<button class="button1"><span>Add to cart</span></button>
		                  </div>
						 <div class="clearfix"></div>
				     </div>
				     <div class="product">
						   <div class="product-desc">
								<div class="product-img">
		                           <img src="images/w10.jpg" class="img-responsive " alt=""/>
		                       </div>
		                       <div class="prod1-desc">
		                           <h5><a class="product_link" href="#">Excepteur sint</a></h5>
		                           <p class="product_descr"> Vivamus ante lorem, eleifend nec interdum non, ullamcorper et arcu. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. </p>									
							   </div>
							   <div class="clearfix"></div>
					      </div>
						  <div class="product_price">
								<span class="price-access">$597.51</span>								
								<button class="button1"><span>Add to cart</span></button>
		                  </div>
						 <div class="clearfix"></div>
				     </div>
		   	  </div>
	       </div>	
	@include('user.layout.right-bar')
   </div>
		   <div class="clearfix"></div>		
	  </div>
	<!-- end content -->
</div>
</div>
<script type="text/javascript" src="../detail.js"></script>
@include('user.layout.footer')