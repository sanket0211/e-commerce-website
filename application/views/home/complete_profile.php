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
    <link rel="shortcut icon" type="image/png" href="<?php echo base_url().'assets/images/rentooz/logo2.jpg';?> " />
    <title>Rentooz</title>
    <style>
    .btn-circle {
  width: 30px;
  height: 30px;
  text-align: center;
  padding: 6px 0;
  font-size: 12px;
  line-height: 1.428571429;
  border-radius: 15px;
}
</style>
</head>

<body class="stretched">

    <!-- Document Wrapper
    ============================================= -->
    <div id="wrapper" class="clearfix">

        <!-- Header
        ============================================= -->
        <header id="header" class="dark" >

            <div id="header-wrap">

                <div class="container clearfix">

                    <div id="primary-menu-trigger"><i class="icon-reorder"></i></div>
                        
                    <!-- Logo
                    ============================================= -->
                    <div id="logo">
                        <a href="<?php echo site_url('home');?>" class="standard-logo" data-dark-logo="<?php echo base_url().'assets/images/rentooz/logo2.jpg';?>"><img src="<?php echo base_url().'assets/images/rentooz/logo2.jpg';?>" alt="Rentooz"></a>
                        <a href="<?php echo site_url('home');?>" class="retina-logo" data-dark-logo=""><img src="<?php echo base_url().'assets/images/rentooz/logo2.jpg';?>" alt="Rentooz"></a>
                    </div><!-- #logo end -->

                    <!-- Primary Navigation
                    ============================================= -->       
                    <nav id="primary-menu" class="dark">

                        
                       
                    </nav><!-- #primary-menu end -->

                </div>

            </div>

        </header>
        
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
                    

                    <img width="300" height="300" src="http://graph.facebook.com/<?php echo $fb_id; ?>/picture?type=normal" alt"profile picture" data-animate="fadeInLeftBig">


<!--
  Below we include the Login Button social plugin. This button uses
  the JavaScript SDK to present a graphical Login button that triggers
  the FB.login() function when clicked.
-->
                   


                </div>



            </div>



            <div class="col_two_third col_last nobottommargin">


                <h3>Fill up your Profile Here!!</h3>

                <p></p>

                <?php echo form_open_multipart('home/register',array('name'=>'register-form','id'=>'register-form','class'=>'nobottommargin'));?>

                    <div class="col_half">
                        <label for="register-form-name">Name<span style="color:red;font-size:15px">*</span> :</label>
                        <input readonly type="text" id="register-form-name" name="user_name" value="<?php echo $fb_name; ?>" class="required form-control input-block-level" />
                    </div>

                    <div class="col_half col_last">
                        <label for="register-form-email">Email Address<span style="color:red;font-size:15px">*</span> :</label>
                        <input readonly type="text" id="register-form-email" name="user_email" value="<?php echo $fb_email; ?>" class="required form-control input-block-level" />
                    </div>

                    <div class="clear"></div>

                    <!--<div class="col_half">
                        <label for="register-form-username">Address<span style="color:red;font-size:15px">*</span> :</label>
                        <input type="text" id="register-form-username" name="user_address" value="<?php echo set_value('user_address') ?>" class="required form-control input-block-level" />
                    </div>

                    <div class="col_half col_last">
                        <label for="register-form-phone">Phone<span style="color:red;font-size:15px">*</span> :</label>
                        <input type="text" id="register-form-phone" name="user_phone" value="<?php echo set_value('user_phone'); ?>" class="required form-control input-block-level" />
                    </div>-->

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
                    <label for="city">City<span style="color:red;font-size:15px">*</span>:</label>
            
                <select name="city_id" class="sm-form-control">
                    <?php
                    foreach($cities as $city) {
                        echo '<option value="'.$city->city_id.'">'.$city->city_name.'</option>';
                    }?>
                </select>
            </div>

                    

                    <div class="clear"></div>

                    <div class="col_half">
                        <label for="user_name">Do you have a referral code?? Enter here:</label>
                        <input type="text" id="user_name" name="referral" placeholder="Referral" pattern="[a-zA-Z0-9]{1,32}" class="form-control"/>
                    </div>
                    
                    <div class="clear"></div>

                    

                    <div class="col_full nobottommargin">
                        <input class="button button-3d button-black nomargin" type="submit" id="upload" name="upload" value="Register Now"/>
                    </div>
                    
                    <input type="hidden" id="fb_id" name="fb_id" value = <?php echo $fb_id; ?> />

                    <input type="hidden" id="fb_id" name="fb_email" value = <?php echo $fb_email; ?> />


                </form>


            </div>

        </div>

    </div>

</section><!-- #content end -->





        <!-- Footer
        ============================================= -->
        <footer id="footer" class="dark">

            <div class="container">

                <!-- Footer Widgets
                ============================================= -->
                <div class="footer-widgets-wrap clearfix">

                    <div class="col_two_third">

                        <div class="widget clearfix">

                            <img src="images/footer-widget-logo.png" alt="" class="alignleft" style="margin-top: 8px; padding-right: 18px; border-right: 1px solid #4A4A4A;">

                            <p>Everything cannot be bought, Somethings can be rented too!!</p>

                            <div class="line" style="margin: 30px 0;"></div>

                            <div class="row">

                                <div class="col-md-6 col-sm-3 bottommargin-sm widget_links">
                                   <div style="background: url('images/world-map.png') no-repeat center center; background-size: 100%;">
                                        <address>
                                            <strong>Headquarters:</strong><br>
                                            Palash Nivas, OBH-E 201/OBH-E 214 IIIT-Hyderabad<br>
                                            Gachibowli, Hyderabad, Telangana.<br>
                                        </address>
                                        <abbr title="Phone Number"><strong>Phone:</strong></abbr> (+91) 97 0353 1305<br>

                                        <abbr title="Phone Number"><strong>Phone:</strong></abbr> (+91) 95 8110 5549<br> 

                                        <abbr title="Email Address"><strong>Email:</strong></abbr> support@rentooz.com
                                    </div> 
                                </div>

                                <div class="col-md-3 col-sm-6 bottommargin-sm widget_links">
                                    <ul>
                                        <li><a href="<?php echo site_url('home/');?>">Home</a></li>
                                        <li><a href="<?php echo site_url('home/main');?>">Products</a></li>
                                        <li><a href="<?php echo site_url('home/community');?>">Communities</a></li>
                                        <li><a href="<?php echo site_url('home/howitworks');?>">How it Works</a></li>
                                        <li><a href="<?php echo site_url('home/bonusandoffers');?>">Bonus & Offers</a></li>
                                        <li><a href="<?php echo site_url('home/');?>">Testimoials</a></li>
                                    </ul>
                                </div>

                                <div class="col-md-3 col-sm-6 bottommargin-sm widget_links">
                                    <ul>
                                        <li><a href="<?php echo site_url('home/about-us');?>">About Us</a></li>
                                        <li><a href="<?php echo site_url('home/contact-us');?>">Contct Us</a></li>
                                        <li><a href="<?php echo site_url('home/faq');?>">FAQs</a></li>
                                        <li><a href="<?php echo site_url('home/termsandconditions');?>">Terms of Use</a></li>
                                        <li><a href="<?php echo site_url('home/privacypolicy');?>">Privacy Plicy</a></li>
                                    </ul>
                                </div>

                            </div>

                        </div>

                    </div>

                    <div class="col_one_third col_last">

                        <div class="widget subscribe-widget clearfix">
                            <div class="widget quick-contact-widget clearfix">

                            <h4>Send Message</h4>

                            <div id="quick-contact-form-result" data-notify-type="success" data-notify-msg="<i class=icon-ok-sign></i> Message Sent Successfully!"></div>


                            <?php echo form_open('nonessentials/queries',array('class' => 'nobottommargin','name' => 'template-contactform')); ?>
                                <div class="form"></div>

                                <div class="input-group divcenter">
                                    <span class="input-group-addon"><i class="icon-user"></i></span>
                                    <input type="text" class="required form-control input-block-level" id="quick-contact-form-name" name="full_name" value="" placeholder="Full Name" required/>
                                </div>
                                <div class="input-group divcenter">
                                    <span class="input-group-addon"><i class="icon-email2"></i></span>
                                    <input type="text" class="required form-control email input-block-level" id="quick-contact-form-email" name="email" value="" placeholder="Email Address" required/>
                                </div>
                                <textarea class="required form-control input-block-level short-textarea" id="quick-contact-form-message" name="message" rows="4" cols="30" placeholder="Message" required></textarea>
                                <!-- <input type="text" class="hidden" id="quick-contact-form-botcheck" name="quick-contact-form-botcheck" value="" /> -->
                                <div class="col_full">
                                <input class="button button-3d nomargin" type="submit" id="template-contactform-submit" name="upload" value="send"/>
                                </div>

                            </form>

                            <script type="text/javascript">



                            </script>

                        </div>
                            <script type="text/javascript">
                                $("#widget-subscribe-form").validate({
                                    submitHandler: function(form) {
                                        $(form).find('.input-group-addon').find('.icon-email2').removeClass('icon-email2').addClass('icon-line-loader icon-spin');
                                        $(form).ajaxSubmit({
                                            target: '#widget-subscribe-form-result',
                                            success: function() {
                                                $(form).find('.input-group-addon').find('.icon-line-loader').removeClass('icon-line-loader icon-spin').addClass('icon-email2');
                                                $('#widget-subscribe-form').find('.form-control').val('');
                                                $('#widget-subscribe-form-result').attr('data-notify-msg', $('#widget-subscribe-form-result').html()).html('');
                                                SEMICOLON.widget.notifications($('#widget-subscribe-form-result'));
                                            }
                                        });
                                    }
                                });
                            </script>
                        </div>

                        <div class="widget clearfix" style="margin-bottom: -20px;">

                            <!-- <div class="row">

                                <div class="col-md-6 clearfix bottommargin-sm">
                                    <a href="#" class="social-icon si-dark si-colored si-facebook nobottommargin" style="margin-right: 10px;">
                                        <i class="icon-facebook"></i>
                                        <i class="icon-facebook"></i>
                                    </a>
                                    <a href="#"><small style="display: block; margin-top: 3px;"><strong>Like us</strong><br>on Facebook</small></a>
                                </div>
                                <div class="col-md-6 clearfix">
                                    <a href="#" class="social-icon si-dark si-colored si-rss nobottommargin" style="margin-right: 10px;">
                                        <i class="icon-rss"></i>
                                        <i class="icon-rss"></i>
                                    </a>
                                    <a href="#"><small style="display: block; margin-top: 3px;"><strong>Subscribe</strong><br>to RSS Feeds</small></a>
                                </div>

                            </div>
 -->
                        </div>

                    </div>

                </div><!-- .footer-widgets-wrap end -->

            </div>

            <!-- Copyrights
            ============================================= -->
            <div id="copyrights">

                <div class="container clearfix">

                    <div class="col_half">
                        Copyrights &copy; 2016 All Rights Reserved by Rentooz.
                    </div>

                    <div class="col_half col_last tright">
                        <div class="fright clearfix">
                            <div class="copyrights-menu copyright-links nobottommargin">

                                <a href="<?php echo site_url('home');?>">Home</a>/<a href="<?php echo site_url('home/about-us');?>">About</a>/<a href="<?php echo site_url('home/faq');?>">FAQs</a>/<a href="<?php echo site_url('home/contact-us');?>">Contact</a>

                            </div>
                        </div>
                    </div>

                </div>

            </div><!-- #copyrights end -->

        </footer><!-- #footer end -->

    </div><!-- #wrapper end 'images/footer-bg.jpg'-->

    <!-- Go To Top
    ============================================= -->
    <div id="gotoTop" class="icon-angle-up"></div>

    <!-- Footer Scripts
    ============================================= -->
    <script type="text/javascript" src="<?php echo base_url().'assets/js/functions.js';?>"></script>

</body>
</html>