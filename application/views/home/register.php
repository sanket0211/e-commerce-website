<div class="container">
<div class="row">
	<div class="col-md-6">	
	<h3>Signup!</h3>
		<?php echo $error ;?>
		<?php echo validation_errors(); ?>
		<?php echo form_open_multipart('home/register',array('role'=>'form'));?>
		<div class="form-group">
			<label for="user_name">Name:</label>
			<input id="user_name" class="form-control" type="text" pattern="[a-zA-Z0-9]{2,64}" name="user_name" required />
			<br>

			<label for="user_password_new">Password</label>
			<input id="user_password_new" class="form-control" type="password" name="user_password_new" pattern=".{6,}" required autocomplete="off" />
			<br>
			<label for="user_password_repeat">Confirm Password</label>
			<input id="user_password_repeat" class="form-control" type="password" name="user_password_repeat" pattern=".{6,}" required autocomplete="off" />
			<br>

			<label for="user_email">Email:</label>
			<input id="user_email" type="email" class="form-control" name="user_email" required />
			<br>

			<label for="user_phone">Phone:</label>
			<input type='tel' pattern='\d{10}' class="form-control" title='Phone Number Format: 9999999999' name="user_phone">
			<br>


			<label for="avatar">Avatar</label>
			<input type="file" name="userfile" size="20"/>
			<br>

			<label for="referral">You have a referral. Enter here:</label>
			<input id="user_name" class="form-control" type="text" pattern="[a-zA-Z0-9]{2,64}" name="referral" />
			<br>

			<input type="submit" value="Sign up" name="upload" />
		</div>
		</form>
	</div>
	<div class="col-md-6">
		<h1>Features</h1>
        <p>This is feature one</p>
        <p>This is feature one</p>
        <p>This is feature one</p>
        <p>This is feature one</p>
        <p>This is feature one</p>
        <p>This is feature one</p>
	</div>
</div>
</div>
