

@include('user.layout.header')

@include('user.layout.menu')

<!-- content -->
<div class="container">
<div class="main">
	<!-- start registration -->
	

	<div class="registration_left">
	<br>
	<br>
		<h2>ĐĂNG NHẬP <span></span></h2>
		 <div class="registration_form">
		 <!-- Form -->
			<form id="registration_form" action="{{route('user-login')}}" method="post">
				{{ csrf_field() }}
				<div>
					<label>
						<input style="text-transform: none;" name="txtEmail" placeholder="Email" type="email" required>
					</label>
				</div>
				<div>
					<label>
						<input style="text-transform: none;" name="txtPassword" placeholder="Mật khẩu" type="password" required>
					</label>
				</div>						
				<div>
					<input type="submit" value="ĐĂNG NHẬP" id="register-submit">
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