<section id="page-title" >

    <div class="container clearfix">
        <h1>Login</h1>
        <span>Gateway to the rentooz</span>
        <ol class="breadcrumb">
            <li><a href="<?php echo site_url('home');?>">Home</a></li>
            <li class="active">Login</li>
        </ol>
    </div>

</section>


<section id="content">

    <div class="content-wrap">

        <div class="container clearfix">

        <?php 
        if(!is_null($error)){
            echo '<div class="style-msg errormsg">';
            echo '<div class="sb-msg">'.$error.' '.$info.' '.validation_errors().'</div>';
            echo '</div>';
        }
        ?>

            <div class="col_one_third nobottommargin">



                <div class="well well-lg nobottommargin">
                    

                    <?php echo form_open('home/login',array('name'=>'login-form','id'=>'login-form','class'=>'nobottommargin','method'=>"post"));?>
                        
                        <h3>Login to your Account</h3>
                        <p style="color:red">fields marked with astericks(*) are compulsory</p>

                        <div class="col_full">
                            <label for="user_email">Email<span style="color:red;font-size:15px">*</span>:</label>
                            <input  id="login-form-username" name="user_email"  placeholder="Enter email" class="form-control" type="email">
                        </div>

                        <div class="col_full">
                            <label for="login-form-password">Password<span style="color:red;font-size:15px">*</span> :</label>
                            <input type="password" id="login-form-password" name="user_password" value="" class="required form-control input-block-level" />
                        </div>

                        <div class="col_full nobottommargin">
                            <input type="submit" class="button button-3d button-black nomargin" id="login-form-submit" name="login-form-submit" value="Login">
                            <a href="<?php echo site_url('home/forgotpassword');?>" class="fright">Forgot Password?</a>
                        </div>

                    </form>


                    <!--
                      Below we include the Login Button social plugin. This button uses
                      the JavaScript SDK to present a graphical Login button that triggers
                      the FB.login() function when clicked.
                    -->
                    
                </div>

            </div>

                <div class="col_two_third nobottommargin col_last">

                <h3>Dont have an Account? Register Now.</h3>

                <p></p>

                <?php echo form_open_multipart('home/register',array('name'=>'register-form','id'=>'register-form','class'=>'nobottommargin'));?>
                    
                    <div class="col_half">
                        <label for="register-form-name">Name<span style="color:red;font-size:15px">*</span> :</label>
                        <input type="text" id="register-form-name" name="user_name" value="" class="required form-control input-block-level" />
                    </div>

                    <div class="col_half col_last">
                        <label for="register-form-email">Email Address<span style="color:red;font-size:15px">*</span> :</label>
                        <input type="text" id="register-form-email" name="user_email" value="" class="required form-control input-block-level" />
                    </div>

                    <div class="clear"></div>

                  <!--   <div class="col_half">
                        <label for="register-form-username">Address<span style="color:red;font-size:15px">*</span> :</label>
                        <input type="text" id="register-form-username" name="user_address" value="" class="required form-control input-block-level" />
                    </div>

                    <div class="col_half col_last">
                        <label for="register-form-phone">Phone<span style="color:red;font-size:15px">*</span> :</label>
                        <input type="text" id="register-form-phone" name="user_phone" value="" class="required form-control input-block-level" />
                    </div> -->

                    <div class="clear"></div>

                    <div class="col_half">
                        <label for="register-form-password">Choose Password<span style="color:red;font-size:15px">*</span> :</label>
                        <input type="password" id="register-form-password" name="user_password_new" value="" class="required form-control input-block-level" />
                    </div>

                    <div class="col_half col_last">
                        <label for="register-form-repassword">Re-enter Password<span style="color:red;font-size:15px">*</span> :</label>
                        <input type="password" id="register-form-repassword" name="user_password_repeat" value="" class="required form-control input-block-level" />
                    </div>
                    
                    <div class="clear"></div>

                    <div class="col_half">
                        <label for="avatar">Upload Profile Picture:</label>
                        <input type="file" id="avatar" name="userfile" size="20" />
                    </div>
                    <div class="col_half col_last">
                    
            
                
            </div>

                    <!-- <div class="clear"></div>

                    <div class="col_half">
                        <label for="user_name">Do you have a referral code?? Enter here:</label>
                        <input type="text" id="user_name" name="referral" placeholder="Referral" pattern="[a-zA-Z0-9]{1,32}" class="form-control"/>
                    </div>

                    <div class="clear"></div>
 -->
                    <div class="col_full nobottommargin">
                        <input class="button button-3d button-black nomargin" type="submit" id="upload" name="upload" value="Register Now"/>
                    </div>

                </form>
 

                

                    <!-- <div class="heading-block topmargin-sm">
                        <h2>You Don't have an account!!</h2>
                        <span>You can sign up here.</span>
                    </div> 
 -->
                    <!-- <p>To have an account on Rentooz, it is mandatory for the user to have a facebook account.</p> -->

                <!-- <fb:login-button scope="public_profile,email" size="large" onlogin="checkLoginState();">
                    Login with Facebook
                </fb:login-button> -->
               <!--  <div id="status">
                </div> -->

                </div>

            </div>

        </div>

    </div>

</section><!-- #content end -->
<?php echo form_open_multipart('home/fb_verify/',array('class' => 'nobottommargin','id'=>'fb_verify')); ?>
    <input type="hidden" id="fb_name" name="fb_name" />
    <input type="hidden" id="fb_id" name="fb_id" />
    <input type="hidden" id="fb_email" name="fb_email" />
</form>   


