<html>
<head>
	<title>CodeIgniter : Login Facebook via Oauth 2.0</title>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/style.css">
	<link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro|Open+Sans+Condensed:300|Raleway' rel='stylesheet' type='text/css'>
</head>
<body>
	<div id="main">
		<div id="login">
			<h2>Multiple Image</h2>
			<?php echo $error; ?>
			<?php echo form_open_multipart('example/img_upload'); ?>
				<input type="file" multiple name="userfile[]" size="20"/>
				<input type="submit" value="upload">
			</form>
		</div>
	</div>
</body>
</html>

