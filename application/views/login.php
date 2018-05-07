<!DOCTYPE html>
<html lang="en" class="body-full-height">
<head>        
	<!-- META SECTION -->
	<title>Telkomstorage</title>            
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />

	<link rel="icon" href="favicon.ico" type="image/x-icon" />
	<!-- END META SECTION -->

	<!-- CSS INCLUDE -->        
	<link rel="stylesheet" type="text/css" id="theme" href="<?php echo base_url()?>/asset/css/theme-default.css"/>
	<!-- EOF CSS INCLUDE -->  
	<!-- CSS INCLUDE -->        
	<link rel="stylesheet" type="text/css" id="theme" href="<?php echo base_url()?>/asset/css/custom.css"/>
	<!-- EOF CSS INCLUDE -->                                    
</head>
<body>

	<div class="login-container">
		<div class="login-box animated fadeInDown">
			<div class="login-logo"></div>
			<div class="login-body">
				<?php if (isset($_SESSION['error'])): ?>
					<div class="alert alert-danger" role="alert">
						<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
						<strong>Error !</strong> Please check your username/password.
					</div>
				<?php endif ?>
				<div class="login-title"><strong>Welcome</strong>, Please login</div>
				<form action="<?php echo site_url()?>/login/do_login" class="form-horizontal" method="post">
					<div class="form-group">
						<div class="col-md-12">
							<input type="text" class="form-control" placeholder="Username" name="username" />
						</div>
					</div>
					<div class="form-group">
						<div class="col-md-12">
							<input type="password" class="form-control" placeholder="Password" name="password" />
						</div>
					</div>
					<div class="form-group">
						<div class="col-md-6">
							<a href="#" class="btn btn-link btn-block">Forgot your password?</a>
						</div>
						<div class="col-md-6">
							<button class="btn btn-info btn-block">Log In</button>
						</div>
					</div>
				</form>
			</div>
			<div class="login-footer">
				<div class="pull-left col-md-6">
					&copy; 2018 telkomsigma.co.id
				</div>
				<div class="pull-right col-md-6">
					Don't have an account?
				</div>
			</div>
		</div>

	</div>

	<!-- START PLUGINS -->
	<script type="text/javascript" src="<?php echo base_url()?>asset/js/plugins/jquery/jquery.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url()?>asset/js/plugins/jquery/jquery-ui.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url()?>asset/js/plugins/bootstrap/bootstrap.min.js"></script>        
	<!-- END PLUGINS -->


</body>
</html>






