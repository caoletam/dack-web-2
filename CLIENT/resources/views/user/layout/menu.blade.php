
		<!-- start header menu -->
		<ul class="megamenu skyblue">
			<li class="active grid"><a class="color1" href="{{route('index')}}">Trang chủ</a></li>
			@foreach($getListTypeOfProduct as $ltop)
			<li><a class="color1" href="{{route('category',$ltop->maloaisanpham)}}">{{$ltop->tenloaisanpham}}</a></li>
			@endforeach
		 </ul> 
	</div>
</div>
</div>

