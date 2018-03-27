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
    <link rel="stylesheet" href="<?php echo base_url().'assets/css/rating.css';?>" type="text/css" />

    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <!--[if lt IE 9]>
        <script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>
    <![endif]-->
    <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- External JavaScripts
    ============================================= -->
    <script type="text/javascript" src="<?php echo base_url().'assets/js/jquery.js';?>"></script>
    <script type="text/javascript" src="<?php echo base_url().'assets/js/plugins.js';?>"></script>
    <script type="text/javascript" src="<?php echo base_url().'assets/js/rating.js';?>"></script>
    

    <!-- Document Title
    ============================================= -->
    <link rel="shortcut icon" type="image/png" href="<?php echo base_url().'assets/images/rentooz/logo2.jpg';?>" />
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
        <header id="header" class="transparent-header full-header" data-sticky-class="not-dark">

            <div id="header-wrap">

                <div class="container clearfix">

                    <div id="primary-menu-trigger"><i class="icon-reorder"></i></div>
                        
                    <!-- Logo
                    ============================================= -->
                    <div id="logo">
                        <a href="<?php echo site_url('home');?>" class="standard-logo" data-dark-logo="<?php echo base_url().'assets/images/logo-dark.png';?>"><img src="<?php echo base_url().'assets/images/rentooz/logo2.jpg';?>" alt="Rentooz"></a>
                        <a href="<?php echo site_url('home');?>" class="retina-logo" data-dark-logo="<?php echo base_url().'assets/images/logo-dark@2x.png';?>"><img src="<?php echo base_url().'assets/images/rentooz/logo2.jpg';?>" alt="Rentooz"></a>
                    </div><!-- #logo end -->

                    <!-- Primary Navigation
                    ============================================= -->       
                    <nav id="primary-menu" class="dark">

                        <ul>
                            <li id="home"class="mega-menu"><a href="<?php echo site_url('home/');?>"><div>Home</div></a>
                            </li>
                            <li id="products"class="mega-menu"><a href="<?php echo site_url('home/main');?>"><div>Products</div></a>
                            </li>
                            <li id="bonusandoffers"class="mega-menu"><a href="<?php echo site_url('home/bonusandoffers');?>"><div>Bonus & Offers</div></a>
                            </li>
                            <!--<li id="community"class="mega-menu"><a href="<?php echo site_url('home/community');?>"><div>Communities</div></a>
                            </li>-->
<!--                             <li id="howitworks"class="mega-menu"><a href="<?php echo site_url('home/howitworks');?>"><div>How It Works</div></a>
                            </li>
                            <li id="aboutus" class="mega-menu"><a href="<?php echo site_url('home/about-us');?>"><div>About Us</div></a>
                            </li>
                            <li id="contactus" class="mega-menu"><a href="<?php echo site_url('home/contact-us');?>"><div>Contact Us</div></a>
                            </li> -->
                            <li id="faqs" class="mega-menu"><a href="<?php echo site_url('home/faq');?>"><div>FAQs</div></a>
                            </li>
                            <?php
                            if($isLoggedin) {
                                echo '<li id="profile"><a href="'.site_url('home/profile/'.$user_id).'"><div><i class="icon-user"></i>'.$user_name.'</div></a>';
                                echo '  <ul>';
                                //TODO : previous deals on clicking on wallet
                                echo '      <li><a href="'.site_url('home/wallet/'.$user_id).'"><div><i class="icon-rupee"></i>Wallet</div></a>';
                                echo '          <ul>';
                                echo '            <li><a href="index-corporate.html"><div>Earnings : '.$user_earnings.'</div></a></li>';
                                echo '            <li><a href="index-corporate.html"><div>Gold Coins : '.$user_coins.'</div></a></li>';
                                echo '            <li><a href="index-corporate.html"><div>ShaRentooz : '.$sharentoozbonus.'</div></a></li>';
                                echo '          </ul>';
                                echo '      </li>';
                                echo '      <li><a href="'.site_url('home/refer-earn/'.$user_id).'"><div><i class="icon-gift"></i>Refer & Earn</div></a></li>';
                                echo '      <li><a href="'.site_url('home/profile/'.$user_id).'"><div><i class="icon-cogs"></i>Profile</div></a></li>';
                                echo '      <li><a href="'.site_url('home/deals').'"><div><i class="icon-angellist"></i>Deals</div></a></li>';
                                echo '      <li><a href="'.site_url('home/activities').'"><div><i class="icon-line-globe"></i>Activities</div></a></li>';
                                echo '      <li><a href="'.site_url('home/managemyitems').'"><div><i class="icon-line-globe"></i>Manage my items</div></a></li>';
                                echo '      <li><a href="'.site_url('home/logout').'"><div><i class="icon-rocket"></i>Logout</div></a></li>';
                                echo '  </ul>';
                                echo '</li>';
                                
                            }

                            else {
                                echo '<li id="profile" class="mega-menu"><a href="'.site_url('home/login').'"><div>Sign In</div></a>';
                                echo '</li>';   
                            }

                            ?>
                        </ul>                         
                        <!-- Top Cart
                        ============================================= -->
                        <div id="top-cart">
                        </div>
                         
                        <!-- #top-cart end -->

                        <!-- Top Search
                        ============================================= -->
                       
                    </nav><!-- #primary-menu end -->

                </div>

            </div>

        </header>

        <!-- #header end -->
    </div>
<div class="modal fade bs-example-modal borrower-review-box" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-body">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">Review</h4>
                </div>
                <div class="modal-body">
                    <?php echo form_open('home/submit_review',array('class' => 'nobottommargin','id'=>'borrower-review-form')); ?>
                        <input type="hidden" name="deal_id" id="deal_id_borrower" value=""/>
                        <input type="hidden" name="item_id" id="review_item_id_b" value=""/>
                        Stars<br><input type="text" name="stars"/><br>
                        Comment<br><textarea name="comment" form="borrower-review-form">Your review here...</textarea><br>
                        <!--Comment<br><input type="textbox" name="comment" pattern="[a-zA-Z0-9 ]{20,}" class="bottonmargin required" required/><br>-->
                        <input class="button button-3d button-mini" type="submit" name="submit" value="submit"/>
                    </form>
                    
                </div>
            </div>
        </div>
    </div>
</div>
<?php //Put giver's code here ; ?>
<div class="modal fade bs-example-modal giver-review-box" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-body">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">Review</h4>
                </div>
                <div class="modal-body">
                    <?php echo form_open('home/submit_review',array('class' => 'nobottommargin','id'=>'giver-review-form')); ?>
                        <input type="hidden" name="deal_id" id="deal_id_giver" value=""/>
                        <input type="hidden" name="item_id" id="reviewing_item_id_g" value=""/>
                        Stars<br><input type="text" name="stars"/><br>
                        Comment<br><textarea name="comment" form="giver-review-form">Your review here...</textarea><br>
                        <!--Comment<br><input type="textbox" name="comment" pattern="[a-zA-Z0-9 ]{20,}" class="bottonmargin required" required/><br>-->
                        <input class="button button-3d button-mini" type="submit" name="submit" value="submit"/>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>



var Timer = '';
var Interval = 5;
function notify(){
    $.get("<?php echo site_url('home/getNotifications') ;?>",function(data){
        $('#top-cart').html(data);
    });
}
// item request cancelled and failed
function ok_can_fail($deal_id){
    $url = "<?php echo site_url('home/item_request_can_fail') ;?>";
    $url += "/" + $deal_id;
    $.get($url,function(){});
}
// item request completed and successful
function ok_comp_success($deal_id){
    $url = "<?php echo site_url('home/item_request_comp_success') ;?>";
    $url += "/" + $deal_id;
    $.get($url,function(){});
}

function join_request_ok(notification_id, is_accepted) {
    // request accepted and seen
    if (is_accepted == <?php echo TYPE_ACCEPT; ?>) {
        $url = "<?php echo site_url('home/joining_request_seen/'.TYPE_ACCEPT) ;?>";
        $url += "/" + notification_id;
        $.get($url,function(){});
    } else if (is_accepted == <?php echo TYPE_REJECT; ?>){
        $url = "<?php echo site_url('home/joining_request_seen/'.TYPE_REJECT) ;?>";
        $url += "/" + notification_id;
        $.get($url,function(){});
    }
}


function join_request(notification_id, isAccepted) {
	if (isAccepted == <?php echo TYPE_ACCEPT; ?> ) {
		// join community request accepted
		$url = "<?php echo site_url('home/approve') ;?>";
        $url += "/" + notification_id;
        $.get($url,function(){});
	} else if (isAccepted == <?php echo TYPE_REJECT; ?> ) {
		$url = "<?php echo site_url('home/reject') ;?>";
        $url += "/" + notification_id;
        $.get($url,function(){});
    }
}
function accept_invitation($community_id, $inviter_id) {
    $url = "<?php echo site_url('home/invitation_accept') ;?>";
    $url += "/" + $community_id;
    $url += "/" + $inviter_id;
    $.get($url,function(){})
        .done(function(){
                window.location.replace("<?php echo site_url('home/community/'); ?>" + "/" + $community_id);
        });
}

function decline_invitation($community_id, $inviter_id) {
    $url = "<?php echo site_url('home/invitation_decline') ;?>";
    $url += "/" + $community_id;
    $url += "/" + $inviter_id;
    $.get($url,function(){});
}

function ok_seen_invitation(notification_id) {
    $url = "<?php echo site_url('home/invitation_seen') ;?>";
    $url += "/" + notification_id;
    $.get($url,function(){});
}

function review_later(deal_id, who) {
    $url = "<?php echo site_url('home/review_later') ;?>";
    $url += "/" + deal_id;
    if (who === 1) {
        url += "/1"; // giver
    } else if (who === 2) {
        url += "/2"; // borrower
    }
    $.get($url,function(){});
}
function reviewing(deal_id, who) {
    if (who == <?php echo GIVER ;?>) {
        window.location.replace("<?php echo site_url('review_user'); ?>" + "/" + deal_id);
    } else if (who == <?php echo BORROWER ;?>) {
        window.location.replace("<?php echo site_url('review_user_item'); ?>" + "/" + deal_id);
    }
}
function item_request(deal_id, is_approved) {
    if (is_approved == 1) {
        $url = "<?php echo site_url('home/approve_item_req') ;?>";
        $url += "/" + deal_id;
        $.get($url,function(){});
    } else {
        $url = "<?php echo site_url('home/cancel_item_req') ;?>";
        $url += "/" + deal_id;
        $.get($url,function(){});
    }
}

notify();


$('#top-cart').click(function(){
    $(this).toggleClass("top-cart-open");
});

$(document).on('click','#notify-again',function(e){
    notify();
});

$(document).on('click','.ajax-notify',function(e){
    notify();
});

$(document).ready(function(){
    Timer = setInterval(function(){notify();},Interval*5000);
});
</script>

<script>
  // This is called with the results from from FB.getLoginStatus().
  function statusChangeCallback(response) {
    console.log('statusChangeCallback');
    console.log(response);
    // The response object is returned with a status field that lets the
    // app know the current login status of the person.
    // Full docs on the response object can be found in the documentation
    // for FB.getLoginStatus().
    if (response.status === 'connected') {
      // Logged into your app and Facebook.
      testAPI();
    } else if (response.status === 'not_authorized') {
      // The person is logged into Facebook, but not your app.
      document.getElementById('status').innerHTML = 'Please log ' +
        'into this app.';
    } else {
      // The person is not logged into Facebook, so we're not sure if
      // they are logged into this app or not.
      document.getElementById('status').innerHTML = 'Please log ' +
        'into Facebook.';
    }
  }

  // This function is called when someone finishes with the Login
  // Button.  See the onlogin handler attached to it in the sample
  // code below.
  function checkLoginState() {
    FB.getLoginStatus(function(response) {
      statusChangeCallback(response);
    });
  }

  window.fbAsyncInit = function() {
  FB.init({
    appId      : '1095569180467276',
    cookie     : true,  // enable cookies to allow the server to access 
                        // the session
    xfbml      : true,  // parse social plugins on this page
    version    : 'v2.2' // use version 2.2
  });

  // Now that we've initialized the JavaScript SDK, we call 
  // FB.getLoginStatus().  This function gets the state of the
  // person visiting this page and can return one of three states to
  // the callback you provide.  They can be:
  //
  // 1. Logged into your app ('connected')
  // 2. Logged into Facebook, but not your app ('not_authorized')
  // 3. Not logged into Facebook and can't tell if they are logged into
  //    your app or not.
  //
  // These three cases are handled in the callback function.

  FB.getLoginStatus(function(response) {
    statusChangeCallback(response);
  });

  };

  // Load the SDK asynchronously
  (function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = "//connect.facebook.net/en_US/sdk.js";
    fjs.parentNode.insertBefore(js, fjs);
  }(document, 'script', 'facebook-jssdk'));

  // Here we run a very simple test of the Graph API after login is
  // successful.  See statusChangeCallback() for when this call is made.
  function testAPI() {
    console.log('Welcome!  Fetching your information.... ');
    FB.api('/me?fields=name,email,id', function(response) {
      console.log('Successful login for: ' + response.email);
      var fb_name = document.getElementById('fb_name');
      var fb_id = document.getElementById('fb_id');
      var fb_email = document.getElementById('fb_email');
      fb_name.value = response.name;
      fb_id.value = response.id;
      fb_email.value = response.email;
      FB.logout(function(response) {
      });
      var form = document.getElementById('fb_verify');
      document.getElementById("fb_verify").submit();
      console.log(JSON.stringify(response));
      document.getElementById('status').innerHTML =
        'Thanks for logging in, ' + response.name + '!';
    });
  }
</script>
