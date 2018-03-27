<!DOCTYPE html>
<html dir="ltr" lang="en-US">
<head>

    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta name="author" content="SemiColonWeb" />

    <!-- Stylesheets
    ============================================= -->
    <link href="http://fonts.googleapis.com/css?family=Lato:300,400,400italic,600,700|Raleway:300,400,500,600,700|Crete+Round:400italic" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="<?php echo base_url().'assets/css/bootstrap.css' ;?>" type="text/css" />
    <link rel="stylesheet" href="<?php echo base_url().'assets/style.css' ;?>" type="text/css" />
    <link rel="stylesheet" href="<?php echo base_url().'assets/css/dark.css';?>" type="text/css" />
    <link rel="stylesheet" href="<?php echo base_url().'assets/css/font-icons.css';?>" type="text/css" />
    <link rel="stylesheet" href="<?php echo base_url().'assets/css/animate.css';?>" type="text/css" />
    <link rel="stylesheet" href="<?php echo base_url().'assets/css/magnific-popup.css';?>" type="text/css" />

    <link rel="stylesheet" href="<?php echo base_url().'assets/css/responsive.css';?>" type="text/css" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <!--[if lt IE 9]>
        <script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>
    <![endif]-->
<link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- External JavaScripts
    ============================================= -->
    <script type="text/javascript" src="<?php echo base_url().'assets/js/jquery.js';?>"></script>
    <script type="text/javascript" src="<?php echo base_url().'assets/js/plugins.js';?>"></script>

    <!-- Document Title
    ============================================= -->
    <title>Rentooz</title>
   
</head>


<body class="stretched">

    <!-- Document Wrapper
    ============================================= -->
    <div id="wrapper" class="clearfix">

        <!-- Content
        ============================================= -->
        <section id="content">

            <div class="content-wrap nopadding">

                <div class="section nopadding nomargin" style="width: 100%; height: 100%; position: absolute; left: 0; top: 0; background: #444;"></div>

                <div class="section nobg full-screen nopadding nomargin">
                    <div class="container vertical-middle divcenter clearfix">

                        

                        <div class="panel panel-default divcenter noradius noborder" style="max-width: 400px;">
                            <div class="panel-body" style="padding: 40px;">
                                <?php echo form_open('home/verifychangepassword/'.$code,array('name'=>'login-form','id'=>'login-form','class'=>'nobottommargin'));?>

                                    <?php
                                    if(!is_null($error)){
                                        echo '<div class="style-msg errormsg">';
                                        echo '<div class="sb-msg">'.$error.' '.$info.' '.validation_errors().'</div>';
                                        echo '</div>';
                                    }
                                    ?>
                            

                                    <h2>Change Password</h2>

                                        <div class="col_full">
                                            <label for="user_password_new">New Password<span style="color:red;font-size:15px">*</span>:</label>
                                            <input type="password" id="user_password_new" name="user_password_new" placeholder="Enter password" class="form-control" pattern=".{6,}" title="Choose password of more then 6 digits" required autocomplete="off" />
                                        </div>

                                        <div class="col_full">
                                            <label for="user_password_repeat">Re-enter Password<span style="color:red;font-size:15px">*</span>:</label>
                                            <input type="password" id="user_password_repeat" name="user_password_repeat" placeholder="Confirm password" class="form-control" pattern=".{6,}" required autocomplete="off" />
                                        </div>


                                        <div class="col_full nobottommargin">
                                            <input type="submit" class="button button-3d button-black nomargin" id="login-form-submit" name="login-form-submit" value="Change Password">
                                            
                                        </div>

                                    </form>

                                <div class="line line-sm"></div>

                                
                            </div>
                        </div>

                        <div class="row center dark"><small>Copyrights &copy; All Rights Reserved by Canvas Inc.</small></div>

                    </div>
                </div>

            </div>

        </section><!-- #content end -->

    </div><!-- #wrapper end -->

    <!-- Go To Top
    ============================================= -->
    <div id="gotoTop" class="icon-angle-up"></div>

    <!-- Footer Scripts
    ============================================= -->
    <script type="text/javascript" src="<?php echo base_url().'assets/js/functions.js';?>"></script>

</body>
</html>