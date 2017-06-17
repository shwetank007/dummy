<!DOCTYPE html>
<html>
@section('title')
	User Login
@stop
@include('layouts.head')

<body>
<div class="login-page">
  <div class="form">
    <form class="register-form" id="registerForm" method="post" action="{{ route('user.create') }}">
    	<input type="hidden" value="{{ csrf_token() }}" name="_token">
    	<input type="text" name="name" placeholder="Name"/>
      	<input type="password" name="password" placeholder="Password"/>
      	<input type="text" name="email" placeholder="E-mail"/>
      	<button id="registerBtn">Register</button>
      	<p class="message">Already registered? <a href="javascript:;">Sign In</a></p>
    </form>
    <form class="login-form" id="loginForm" method="post" action="{{ route('user.loginuser') }}">
    	<input type="hidden" value="{{ csrf_token() }}" name="_token">
    	<input type="text" name="email" placeholder="E-mail"/>
      	<input type="password" name="password" placeholder="Password"/>
      	<button id="loginBtn">Login</button>
      	<p class="message">Not registered? <a href="javascript:;">Create an account</a></p>
    </form>
  </div>
</div>

@include('layouts.footerjs')
<script>

$('.message a').click(function(){
   $('form').animate({height: "toggle", opacity: "toggle"}, "slow");
});


$(document).ready(function() {

	//Register Form

	$('#registerForm').submit(function(e) {
		e.preventDefault();
		
		$.ajax({
			type: $('#registerForm').attr('method'),
			url: $('#registerForm').attr('action'),
			data: $('#registerForm').serialize(),
			beforeSend: function () {
				$('#registerBtn').attr('disabled', 'disabled');
			},
			success: function (data) {

			},
			error: function (xhr, textStatus, thrownError) {
                alert('Something went wrong. Please try again!');
            }
		});

		return false;
	});

	//Login Form

	$('#loginForm').submit(function(e) {
		e.preventDefault();

		$.ajax({
			type: $('#loginForm').attr('method'),
			url: $('#loginForm').attr('action'),
			data: $('#loginForm').serialize(),
			beforeSend: function () {
				$('#loginBtn').attr('disabled', 'disabled');
			},
			success: function (data) {
				var obj = JSON.parse(data);
				console.log(obj);
			},
			error: function (xhr, textStatus, thrownError) {
                alert('Something went wrong. Please try again!');
            }
		});
	});

});

</script>

</body>
</html>