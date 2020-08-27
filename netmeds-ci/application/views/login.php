<!DOCTYPE html>
<html>
<head>
	<title>NetMeds.Com</title>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url().'assets/css/bootstrap.css'?>">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url().'assets/css/style.css'?>">
</head>
<body>

<div class="container">
	<div class="login-form">
		<form class="text-center border border-collapse p-4" action="login" method="post">
			<p class="h4 mb-4">Sign in</p>
			<div class="form-group has-feedback">
				<input type="text" name="email" class="form-control" placeholder="Email">
				<?php echo form_error('email')?>
			</div>
			<div class="form-group has-feedback">
				<input type="password" name="password" class="form-control" placeholder="Password">
				<?php echo form_error('password') ?>
			</div>
			<button class="btn btn-info btn-block my-4" type="submit">Sign in</button>
		</form>
	</div>
</div>
<script type="text/javascript" src="<?php echo base_url().'assets/js/jquery-3.2.1.js'?>"></script>
<script type="text/javascript" src="<?php echo base_url().'assets/js/bootstrap.js'?>"></script>
</body>
</html>