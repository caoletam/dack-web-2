

@include('user.layout.header')

@include('user.layout.menu')

<!-- content -->
<div class="container">
<div class="main">
	<!-- start registration -->
	<div class="registration_left">
	<br>
	<br>
		<h2>ĐĂNG KÝ <span></span></h2>
		<!-- [if IE] 
		    < link rel='stylesheet' type='text/css' href='ie.css'/>  
		 [endif] -->  
		  
		<!-- [if lt IE 7]>  
		    < link rel='stylesheet' type='text/css' href='ie6.css'/>  
		<! [endif] -->  
		
		 <div class="registration_form">
		 <!-- Form -->
			<form id="registration_form" action="{{route('user-register')}}" method="post" enctype="multipart/form-data">
				{{ csrf_field() }}
				<div>
					<label>
						<input style="text-transform: none;" name="txtName" placeholder="Họ và tên" type="text" tabindex="1" required >
					</label>
				</div>
				<div>
					<label>
						<input style="text-transform: none;" name="txtUserName" id="txtUserName" placeholder="Tên đăng nhập" type="text" tabindex="2" required>
					</label>
				</div>
				<div>
					<label>
						<input style="text-transform: none;" name="txtEmail" id="txtEmail" placeholder="Email" type="text" tabindex="2" required>
					</label>
				</div>
				<div>
					<label>
						<input style="text-transform: none;" name="txtAddress" id="txtAddress" placeholder="Địa chỉ" type="text" tabindex="3" required>
					</label>
				</div>
				<div>
					<label>
						<input style="text-transform: none;" name="txtPhone" id="txtPhone" placeholder="Số điện thoại" type="text" tabindex="3" required>
					</label>
				</div>
				<div class="sky-form">
					<div class="sky_form1">
						<ul>
							<li><label class="radio left"><input type="radio" name="radio" checked="" value="1"><i></i>Nam</label></li>
							<li><label class="radio"><input type="radio" name="radio" value="2"><i></i>Nữ</label></li>
							<div class="clearfix"></div>
						</ul>
					</div>
				</div>
				<div>
					<label>
						<input style="text-transform: none;" name="txtPassword" id="txtPassword" placeholder="Mật khẩu" type="password" tabindex="4" required>
					</label>
				</div>						
				<div>
					<label>
						<input style="text-transform: none;" name="txtConfirmPassword" id="txtConfirmPassword" placeholder="Nhập lại mật khẩu" type="password" tabindex="4" required>
					</label>
				</div>	
				<div>
					<input type="submit" name="btnSubmit" id="btnSubmit" value="ĐĂNG KÝ" id="register-submit">
					<button type="submit">ok</button>
				</div>
				<div class="sky-form">
					<label style="text-transform: none;" class="checkbox"><input type="checkbox" name="checkbox" id="checkbox" ><i></i>Tôi đồng ý với điều khoản và dịch vụ&nbsp;</label>
				</div>
			</form>
			<!-- /Form -->
		</div>
	</div>
	
	<div class="clearfix"></div>
	</div>
	<!-- end registration -->
</div>
</div>

@include('user.layout.footer')