<?php $this->load("partial.header") ?>
<style type="text/css">
.form-group {
	margin-bottom: 0px;
}

#username, #password {
	font-size: 1.2em;
}

.input-username {
	border-bottom-left-radius: 0px;
	border-bottom-right-radius: 0px;
}

.input-password {
	border-top-right-radius: 0px;
	border-top-left-radius: 0px;
}

.login-wrapper {
	background-color: rgba(255,255,255,0.7);
	padding: 15px;
	padding-top:20px;
	padding-bottom:20px;
}
</style>
<div class="container">
	<div class="row">
		<div class="col-sm-12 col-md-4 m-auto">
			<br><br><br>
			<div class="login-wrapper">
				<h2 align="center" class="text-danger">Login</h2>
				<hr>
				<p align="center">
					Gunakan username dan password admin untuk login ke dalam sistem.
				</p>
				<div class="form-container">
					<?php if ($error) { ?>
					<div class="alert alert-danger" role="alert">
						Username or Password is invalid.
					</div>						
					<?php } ?>
					<form method="post" action="/login">
						<div class="form-group">
							<input type="text" name="username" id="username" class="form-control input-username" placeholder="Username" required="">
							<span class="form-error username">username cannot be empty</span>
						</div>
						<div class="form-group">
							<input type="password" name="password" id="password" class="form-control input-password" placeholder="Password" required="">
							<span class="form-error password">password cannot be empty</span>
						</div>
						<div class="form-group">
							<p></p>
							<button class="btn btn-danger btn-block"><i class="fa fa-sign-in-alt"></i> Login</button>
						</div>
					</form>
				</div>
				<br>
				<p align="center"> Copyright &copy; 2019 - <a href="https://stmikroyal.ac.id/">STMIK ROYAL KISARAN</a></p>
			</div>
		</div>
	</div>
</div>
<?php $this->load("partial.footer") ?>
