
<section id="page-title" >

	<div class="container clearfix">
	    <h1>Home</h1>
	    <span>Everything you need to know about our Company</span>
	    <ol class="breadcrumb">
	        <li><a href="#">Login</a></li>
	    </ol>
	</div>

</section>

<!-- Content
============================================= -->
<section id="content">
	<div class="content-wrap row topmargin">

		<div class="container clearfix">
			<div class="col_half">
			<div class="tabs divcenter nobottommargin clearfix" id="tab-login-register" style="max-width: 500px;">
           		<ul class="tab-nav tab-nav2 center clearfix">
					<li class="inline-block"><a href="#tab-login">Login</a></li>
					<li class="inline-block"><a href="#tab-register">Register</a></li>
				</ul>

				<div class="tab-container">


					<div class="tab-content clearfix" id="tab-login">
						<div class="panel panel-default nobottommargin">
							<div class="panel-body" style="padding:40px;">
							<?php 
							if(!is_null($error)){
								echo '<div class="style-msg errormsg">';
                            	echo '<div class="sb-msg">'.$error.' '.$info.' '.validation_errors().'</div>';
                        		echo '</div>';
                        	}
                        	?>
								
								
								

								<h3>Login to your Account</h3>
<p style="color:red">fields marked with astericks(*) are compulsory</p>
								
								<?php echo form_open('home/login',array('name'=>'login-form','id'=>'login-form','class'=>'nobottommargin'));?>


										<div class="col_full">
											<label for="user_email">Email<span style="color:red;font-size:15px">*</span>:</label>
											<input  id="login-form-username" name="user_email"  placeholder="Enter email" class="form-control" type="email">
										</div>

										<div class="col_full">
											<label for="user_password">Password<span style="color:red;font-size:15px">*</span>:</label>
											<input type="password" id="login-form-password" name="user_password"  placeholder="password" class="form-control" type="password" pattern=".{6,}" autocomplete="off">
										</div>

										<div class="col_full nobottommargin">
											<input type="submit" class="button button-3d button-black nomargin" id="login-form-submit" name="login-form-submit" value="Login">
											<a href="<?php echo site_url('home/forgotpassword');?>" class="fright">Forgot Password?</a>
										</div>

									</form>
							</div>
						</div>
					</div>

					<div class="tab-content clearfix" id="tab-register">
						<div class="panel panel-default nobottommargin">
							<div class="panel-body" style="padding: 40px;">
							<?php
							if(!is_null($error)){
								echo '<div class="style-msg errormsg">';
                            	echo '<div class="sb-msg">'.$error.' '.$info.' '.validation_errors().'</div>';
                        		echo '</div>';
                        	}
                        	?>
								<h3>Register for an Account</h3>
								<p style="color:red">fields marked with astericks(*) are compulsory</p>
								<?php echo form_open_multipart('home/register',array('name'=>'register-form','id'=>'register-form','class'=>'nobottommargin'));?>
									<div class="col_full">
										<label for="user_name">Name<span style="color:red;font-size:15px">*</span>:</label>
										<input type="text" id="user_name" name="user_name" placeholder="Enter full name" pattern="[a-zA-Z]{1,32}[ ]{0,1}[a-zA-Z]{1,32}" class="form-control" required/>
									</div>

									<div class="col_full">
										<label for="user_email">Email Address<span style="color:red;font-size:15px">*</span>:</label>
										<input type="text" id="user_email" name="user_email" placeholder="Enter email" class="form-control" required/>
									</div>

									<div class="col_full">
										<label for="user_phone">Mobile Number<span style="color:red;font-size:15px">*</span>:</label>
										<input type="text" id="user_phone" name="user_phone" placeholder="Enter mobile number" pattern='\d{10}' title='Phone Number Format: 9999999999' class="form-control" />

									</div>

									<div class="col_full">
										<label for="user_password_new">Choose Password<span style="color:red;font-size:15px">*</span>:</label>
										<input type="password" id="user_password_new" name="user_password_new" placeholder="Enter password" class="form-control" pattern=".{6,}" title="Choose password of more then 6 digits" required autocomplete="off" />
									</div>

									<div class="col_full">
										<label for="user_password_repeat">Re-enter Password<span style="color:red;font-size:15px">*</span>:</label>
										<input type="password" id="user_password_repeat" name="user_password_repeat" placeholder="Confirm password" class="form-control" pattern=".{6,}" required autocomplete="off" />
									</div>
									<div class="col_full">
										<label for="user_name">Address<span style="color:red;font-size:15px">*</span>:</label>
										<input type="text" id="user_address" name="user_name" placeholder="Enter Address" class="form-control" required/>
									</div>
									<label for="city">City<span style="color:red;font-size:15px">*</span>:</label>
									<div class="col_full">
										<select name="city_id" class="sm-form-control">
											<?php
											foreach($cities as $city) {
												echo '<option value="'.$city->city_id.'">'.$city->city_name.'</option>';
											}?>
										</select>
									</div>
									<div class="col_full">
										<label for="avatar">Upload Profile Picture:</label>
    									<input type="file" id="avatar" name="userfile" size="20" />
									</div>

									<div class="col_full">
										<label for="user_name">Do you have a referral code?? Enter here:<span style="color:red;font-size:15px">*</span>:</label>
										<input type="text" id="user_name" name="referral" placeholder="Referral" pattern="[a-zA-Z0-9]{1,32}" class="form-control"/>
									</div>



									<div class="col_full nobottommargin">
										<input class="button button-3d button-black nomargin" type="submit" id="upload" name="upload" value="Register Now"/>
									</div>

								</form>
							</div>
						</div>
					</div>

				</div>

			</div>

		</div>


		<div class="col_half col_last">

            <div class="col-md-12 dark col-padding ohidden" style="background-color: #1abc9c;">
                <div>
                    <!-- <h3 class="uppercase" style="font-weight: 600;">Joining Rentooz gives you a whole new experience</h3>
                    <p style="line-height: 1.8;">
                    <li>Earn points by sharing your referral.</li> 
                    <li>Rent out any item you want.</li>
                    <li>Decide yourself what amount you are expecting as rent.</li>
                    <li>Don't worry about the keeping track of items you give for rent.</li>
                    <li>Money easily transferred in your wallet on daily basis.</li>
                    <li>Almost get all that you want on rent on the site at minimum proce.</li>
                    </p> -->

                    <img src="<?php echo base_url().'assets/images/smartart/logincrop.png';?>" class=" notopmargin" alt="Image" title="Image" data-animate="bounce"/>
                
                    <i class="icon-bulb bgicon"></i>
                </div>
            </div>

		</div>

	</div>
</section><!-- #content end -->

