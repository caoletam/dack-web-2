
@include('user.layout.header')

@include('user.layout.menu')


<!-- content -->
<div class="container">
<div class="women_main">
	@include('user.layout.left-bar')
	<!-- start content -->
	<div class="col-md-9 w_content">
		<div class="women">
			@foreach($getListProductByTypeID as $key => $lpbti1)
			@foreach($getListTypeOfProduct as $key => $ltop)
			@if($lpbti1->maloaisanpham == $ltop->maloaisanpham)
			<a href="#"><h4>{{$ltop->tenloaisanpham}} - <span>4449 itemms</span> </h4></a>
			@endif
			@endforeach
			@endforeach
			<ul class="w_nav">
						<li>Sort : </li>
		     			<li><a class="active" href="#">popular</a></li> |
		     			<li><a href="#">new </a></li> |
		     			<li><a href="#">discount</a></li> |
		     			<li><a href="#">price: Low High </a></li> 
		     			<div class="clear"></div>	
		     </ul>
		     <div class="clearfix"></div>	
		</div>
		<br>
		<!-- grids_of_4 -->
		<div class="row">
		  	@foreach($getListProductByTypeID as $key => $lpbti)
		  	<div class="grid1_of_4" style="margin-bottom: 30px; margin-left: 15px;">
				<div class="content_box"><a href="details.html">
			   	   	 <img style="width: 192px; height: 192px;" src="{{$lpbti->hinhdaidien}}" class="img-responsive" alt=""/>
				   	  </a>
				   	  <br>
				    <h4 style="height: 30px;""><a href="details.html"> {{$lpbti->tensanpham}}</a></h4>
				    @foreach($getListAuction as $key => $la)
				    @if($la->masanpham == $lpbti->masanpham)
					<div class="item_add"><span class="item_price"><h6>
					<?=number_format($la->giahientai)?> VNĐ</h6></span></div>
					@endif
					@endforeach
					<div class="item_add"><span class="item_price"><a href="{{route('detail',$lpbti->masanpham)}}">CHI TIẾT</a></span></div>
				</div>
			</div>
			@endforeach
			
			<div class="clearfix"></div>
		</div>
		<!-- end grids_of_4 -->
		
		
	</div>
	<div class="clearfix"></div>
	
	<!-- end content -->

@include('user.layout.footer')