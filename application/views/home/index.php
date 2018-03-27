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
                        <a href="<?php echo site_url('home');?>" class="standard-logo" data-dark-logo="<?php echo base_url().'assets/images/rentooz/logo2.jpg';?>"><img src="<?php echo base_url().'assets/images/rentooz/logo2.jpg';?>" alt="Rentooz"></a>
                        <a href="<?php echo site_url('home');?>" class="retina-logo" data-dark-logo="<?php echo base_url().'assets/images/rentooz/logo2.jpg';?>"><img src="<?php echo base_url().'assets/images/rentooz/logo2.jpg';?>" alt="Rentooz"></a>
                    </div><!-- #logo end -->

                    <!-- Primary Navigation
                    ============================================= -->       
                    <nav id="primary-menu" class="dark">

                        <ul>
                            
                            <?php
                            if($isLoggedin) {
                                echo '<li id="bonusandoffers"class="mega-menu"><a href="'.site_url('home/main').'"><div>products</div></a>';
                                echo '</li>';
                                echo '<li id="bonusandoffers"class="mega-menu"><a href="'.site_url('home/bonusandoffers').'"><div>Bonus & Offers</div></a>';
                                echo '</li>';
                                //echo '<li id="community"class="mega-menu"><a href="'.site_url('home/community').'"><div>Communities</div></a>';
                                echo '</li>';
                                echo '<li id="profile"><a href="'.site_url('home/profile/'.$user_id).'"><div><i class="icon-user"></i>'.$user_name.'</div></a>';
                                echo '  <ul>';
                                echo '      <li><a href="'.site_url('home/wallet/'.$user_id).'"><div><i class="icon-rupee"></i>Wallet</div></a></li>';
                                echo '          <ul>';
                                echo '            <li><a href="'.site_url('home/wallet/'.$user_id).'"><div>Earnings : '.$user_earnings.'</div></a></li>';
                                echo '            <li><a href="'.site_url('home/wallet/'.$user_id).'"><div>Gold Coins : '.$user_coins.'</div></a></li>';
                                echo '            <li><a href="'.site_url('home/wallet/'.$user_id).'"><div>ShaRentooz : '.$sharentoozbonus.'</div></a></li>';
                                echo '          </ul>';
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
                                
                                echo '<li id="bonusandoffers"class="mega-menu"><a href="'.site_url('home/howitworks').'"><div>How it works</div></a>';
                                echo '</li>';
                                echo '<li id="community"class="mega-menu"><a href="'.site_url('home/about-us').'"><div>About Us</div></a>';
                                echo '</li>';
                                echo '<li id="community"class="mega-menu"><a href="'.site_url('home/contact-us').'"><div>Contact Us</div></a>';
                                echo '</li>';
                                echo '<li id="community"class="mega-menu"><a href="'.site_url('home/faq').'"><div>FAQs</div></a>';
                                echo '</li>';
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

        <section id="slider" class="slider-parallax swiper_wrapper full-screen clearfix">

    <div class="swiper-container swiper-parent">
        <div class="swiper-wrapper">
            <div class="swiper-slide dark" style="background-image: url('<?php echo base_url().'assets/images/rentooz/home2.png';?>');">
                <div class="container clearfix">
                    <div class="slider-caption slider-caption-center">
                    <a href="<?php echo site_url('home/login');?>" class="button button-border button-light button-rounded button-reveal tright button-large topmargin "><i class="icon-angle-right"></i><span>Get started!</span></a>
                        <h2 data-caption-animate="fadeInUp">Welcome to Rentooz</h2>
                        <p data-caption-animate="fadeInUp" data-caption-delay="200">Everything cannot be bought, somethings can be rented too!!</p>
                    </div>
                </div>
            </div>
            <div class="swiper-slide dark"  style="background-image: url('<?php echo base_url().'assets/images/rentooz/home4.jpg';?>');">
                <div class="container clearfix">
                    <div class="slider-caption slider-caption-center">
                    <a href="<?php echo site_url('home/login');?>" class="button button-border button-light button-rounded button-reveal tright button-large topmargin "><i class="icon-angle-right"></i><span>Get started!</span></a>
                        <h2 data-caption-animate="fadeInUp">Renting made easier</h2>
                        <p data-caption-animate="fadeInUp" data-caption-delay="200">Rent almost anything and everything you have!!</p>
                    </div>
                </div>
                
            </div>
            <div class="swiper-slide" style="background-image: url('<?php echo base_url().'assets/images/rentooz/home5.jpg';?>'); background-position: center top;">
                <div class="container clearfix">
                    <div class="slider-caption">
                    <a href="<?php echo site_url('home/login');?>" class="button button-border button-dark button-rounded button-reveal tright button-large topmargin "><i class="icon-angle-right"></i><span>Get started!</span></a>
                        <h2 data-caption-animate="fadeInUp">Trust All and Rent All</h2>
                        <p data-caption-animate="fadeInUp" data-caption-delay="200">Overcome the guilt of borrowing and asking money!! Rentooz, a revolutionary platform for renting within a comunity</p>
                    </div>
                </div>
            </div>
        </div>
        <div id="slider-arrow-left"><i class="icon-angle-left"></i></div>
        <div id="slider-arrow-right"><i class="icon-angle-right"></i></div>
    </div>

    <script>
        jQuery(document).ready(function($){
            var swiperSlider = new Swiper('.swiper-parent',{
                paginationClickable: false,
                slidesPerView: 1,
                autoplay: 4000,
                speed: 650,
                grabCursor: true,
                loop: true,
                onSwiperCreated: function(swiper){
                    $('[data-caption-animate]').each(function(){
                        var $toAnimateElement = $(this);
                        var toAnimateDelay = $(this).attr('data-caption-delay');
                        var toAnimateDelayTime = 0;
                        if( toAnimateDelay ) { toAnimateDelayTime = Number( toAnimateDelay ) + 750; } else { toAnimateDelayTime = 750; }
                        if( !$toAnimateElement.hasClass('animated') ) {
                            $toAnimateElement.addClass('not-animated');
                            var elementAnimation = $toAnimateElement.attr('data-caption-animate');
                            setTimeout(function() {
                                $toAnimateElement.removeClass('not-animated').addClass( elementAnimation + ' animated');
                            }, toAnimateDelayTime);
                        }
                    });
                    SEMICOLON.slider.swiperSliderMenu();
                },
                onSlideChangeStart: function(swiper){
                    $('[data-caption-animate]').each(function(){
                        var $toAnimateElement = $(this);
                        var elementAnimation = $toAnimateElement.attr('data-caption-animate');
                        $toAnimateElement.removeClass('animated').removeClass(elementAnimation).addClass('not-animated');
                    });
                    SEMICOLON.slider.swiperSliderMenu();
                },
                onSlideChangeEnd: function(swiper){
                    $('#slider').find('.swiper-slide').each(function(){
                        if($(this).find('video').length > 0) { $(this).find('video').get(0).pause(); }
                        if($(this).find('.yt-bg-player').length > 0) { $(this).find('.yt-bg-player').pauseYTP(); }
                    });
                    $('#slider').find('.swiper-slide:not(".swiper-slide-active")').each(function(){
                        if($(this).find('video').length > 0) {
                            if($(this).find('video').get(0).currentTime != 0 ) $(this).find('video').get(0).currentTime = 0;
                        }
                        if($(this).find('.yt-bg-player').length > 0) {
                            $(this).find('.yt-bg-player').getPlayer().seekTo( $(this).find('.yt-bg-player').attr('data-start') );
                        }
                    });
                    if( $('#slider').find('.swiper-slide.swiper-slide-active').find('video').length > 0 ) { $('#slider').find('.swiper-slide.swiper-slide-active').find('video').get(0).play(); }
                    if( $('#slider').find('.swiper-slide.swiper-slide-active').find('.yt-bg-player').length > 0 ) { $('#slider').find('.swiper-slide.swiper-slide-active').find('.yt-bg-player').playYTP(); }

                    $('#slider .swiper-slide.swiper-slide-active [data-caption-animate]').each(function(){
                        var $toAnimateElement = $(this);
                        var toAnimateDelay = $(this).attr('data-caption-delay');
                        var toAnimateDelayTime = 0;
                        if( toAnimateDelay ) { toAnimateDelayTime = Number( toAnimateDelay ) + 300; } else { toAnimateDelayTime = 300; }
                        if( !$toAnimateElement.hasClass('animated') ) {
                            $toAnimateElement.addClass('not-animated');
                            var elementAnimation = $toAnimateElement.attr('data-caption-animate');
                            setTimeout(function() {
                                $toAnimateElement.removeClass('not-animated').addClass( elementAnimation + ' animated');
                            }, toAnimateDelayTime);
                        }
                    });
                }
            });

            $('#slider-arrow-left').on('click', function(e){
                e.preventDefault();
                swiperSlider.swipePrev();
            });

            $('#slider-arrow-right').on('click', function(e){
                e.preventDefault();
                swiperSlider.swipeNext();
            });
        });
    </script>

</section>  


        


        <!-- #header end -->
    </div>
<!-- Put buyer's code here -->
<div class="modal fade bs-example-modal-sm buyer-code" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-body">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">Enter buyer's code</h4>
                </div>
                <div class="modal-body">
                    <?php echo form_open_multipart('home/start_renting_period/',array('class' => 'nobottommargin','id'=>'buyer-code-form')); ?>
                        <input type="text" id="buyers_code" name="buyers_code" pattern="[a-zA-Z0-9]{6}" class="bottonmargin required" required/>
                        <input class="button button-3d button-mini" type="submit" name="submit" value="submit"/>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php //Put giver's code here ; ?>
<div class="modal fade bs-example-modal-sm giver-code" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-body">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">Enter giver's code</h4>
                </div>
                <div class="modal-body">
                    <?php echo form_open_multipart('home/stop_renting_period/',array('class' => 'nobottommargin','id'=>'giver-code-form')); ?>
                        <input type="text" id="givers_code" name="givers_code" pattern="[a-zA-Z0-9]{6}" class="bottonmargin required" required/>
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

        <!-- Content
		============================================= -->


<section id="content">

            <div class="content-wrap">

                <div class="container clearfix">
                    <div class="row clearfix">

                        <div class="col-lg-5">
                            <div class="heading-block topmargin">
                                <h1>Welcome to Rentooz.<br>Online platform for renting goods.</h1>
                            </div>
                            <p class="lead">Create a community of your own and make yourself comfortable in a world where you can help, share and earn.</p>
                        </div>

                        <div class="col-lg-7">

                            <div style="position: relative; margin-bottom: -60px;" class="ohidden" data-height-lg="426" data-height-md="567" data-height-sm="470" data-height-xs="287" data-height-xxs="183">
                                <img src="<?php echo base_url().'assets/images/rentooz/home7.gif';?>" style="position: absolute; top: 0; left: 0;" data-delay="100" alt="Chrome">
                            </div>

                        </div>

                    </div>
                </div>

                

                <div class="container clearfix">

                    <div class="row topmargin-lg bottommargin-sm">

                        <div class="heading-block center">
                            <h2>Simple for both a giver and a borrower</h2>
                            <span class="divcenter">Rentooz tries to make the life of both a giver and borrower simple by making the method of renting simple and logical.</span>
                        </div>

                        <div class="col-md-4 col-sm-6 bottommargin">
                            <h2 class="fright">Giver</h2>
                            <div class="feature-box fbox-right topmargin-lg" data-animate="fadeIn">
                                <div class="fbox-icon">
                                    <a href="#"><i class="icon-camera-retro"></i></a>
                                </div>
                                <h3>Post an item</h3>
                                <p>Things that you can rent, post an add for them and wait for customers.</p>
                            </div>

                            <div class="feature-box fbox-right topmargin" data-animate="fadeIn" data-delay="200">
                                <div class="fbox-icon">
                                    <a href="#"><i class="icon-gift"></i></a>
                                </div>
                                <h3>Give item to the borrower</h3>
                                <p>Simply by taking borrower's code and giving the borrower the item starts the renting period.</p>
                            </div>

                            <div class="feature-box fbox-right topmargin" data-animate="fadeIn" data-delay="400">
                                <div class="fbox-icon">
                                    <a href="#"><i class="icon-money"></i></a>
                                </div>
                                <h3>Earn Sharentooz and earnings</h3>
                                <p>shaRentooz bonus helps you in many ways and earnings can be converted to more goldcoins, or redeemed as bank transfer, or a mobile recharge.</p>
                            </div>

                        </div>

                        <div class="col-md-4 hidden-sm bottommargin center">
                            <img data-animate="fadeIn" src="<?php echo base_url().'assets/images/rentooz/home8.jpg';?>" alt="iphone 2">

                        </div>

                        <div class="col-md-4 col-sm-6 bottommargin">
                            <h2 class="fleft">Borrower</h2>
                            <div class="feature-box topmargin-lg" data-animate="fadeIn">
                                <div class="fbox-icon">
                                    <a href="#"><i class="icon-search2"></i></a>
                                </div>
                                <h3>Search an item.</h3>
                                <p>Look for an item on the products page and see in which community it is present.</p>
                            </div>

                            <div class="feature-box topmargin" data-animate="fadeIn" data-delay="200">
                                <div class="fbox-icon">
                                    <a href="#"><i class="icon-bullhorn2"></i></a>
                                </div>
                                <h3>Send a request</h3>
                                <p>Send a request for the item and wait for the confirmation from the giver.</p>
                            </div>

                            <div class="feature-box topmargin" data-animate="fadeIn" data-delay="400">
                                <div class="fbox-icon">
                                    <a href="#"><i class="icon-trophy"></i></a>
                                </div>
                                <h3>Use the item and get bonus</h3>
                                <p>Rentooz gives you bonus for being a part of the transaction.</p>
                            </div>

                        </div>

                    </div>

                </div>

                

                

                <div class="section topmargin nobottommargin nobottomborder">
                    <div class="container clearfix">
                        <div class="heading-block center nomargin">
                            <h3>Inspiration to use Rentooz</h3>
                        </div>
                    </div>
                </div>

                <div class="container clearfix">
                    <div class="col_one_third topmargin">
                        <div class="feature-box fbox-small fbox-plain" data-animate="fadeIn">
                            
                            <h3>Get almost anything and everything anytime.</h3>
                            <p>With a unique concept of renting goods within a community, Rentooz helps you see all those products which your community mates are ready to rent. And nowadays everyone has alot of things which they can rent.</p>
                        </div>
                    </div>

                    <div class="col_one_third topmargin">
                        <div class="feature-box fbox-small fbox-plain" data-animate="fadeIn">
                            
                            <h3>Overcome guilt of asking.</h3>
                            <p>You just have to exchange the product. The site shall handle the transaction.</p>
                        </div>
                    </div>

                    <div class="col_one_third col_last topmargin">
                        <div class="feature-box fbox-small fbox-plain" data-animate="fadeIn">
                            
                            <h3>No need to remember your rental transactions</h3>
                            <p>With the feature of wallet, the site shall keep a track of all your ongoing and completed transactions.</p>
                        </div>
                    </div>
                    <div class="clear"></div>

                    <div class="col_one_third">
                        <div class="feature-box fbox-small fbox-plain" data-animate="fadeIn"data-delay="400">
                            
                            <h3>Rent more than one product at a time</h3>
                            <p>You can get more than one product on rent and let Rentooz keep track of all the payment day wise.</p>
                        </div>
                    </div>

                    

                    <div class="col_one_third">
                        <div class="feature-box fbox-small fbox-plain" data-animate="fadeIn" >
                            
                            <h3>Instant Mobile Recharge</h3>
                            <p>You can recharge your mobile quickly and instantly with just one click.</p>
                        </div>
                    </div>

                    <div class="col_one_third col_last">
                        <div class="feature-box fbox-small fbox-plain" data-animate="fadeIn" >
                            
                            <h3>Get money in bank account</h3>
                            <p>If you want your earnings directly in your bank account, you can get it jus by filling up a form on Rentooz.</p>
                        </div>
                    </div>
                    <div class="clear"></div>

                    <div class="col_one_third bottommargin-sm">
                        <div class="feature-box fbox-small fbox-plain" data-animate="fadeIn" >
                            <h3>Earn shaRentooz bonus</h3>
                            <p>Every transaction shall help you get certain bonus which you shall use in the bonus and offer.</p>
                        </div>
                    </div>

                    <div class="col_one_third bottommargin-sm">
                        <div class="feature-box fbox-small fbox-plain" data-animate="fadeIn" >
                            
                            <h3>Demand an item</h3>
                            <p>If you cannot find your desired item on the site, then you can even demand the item so that if anyone has it and is ready to rent, he can do so.</p>
                        </div>
                    </div>

                    <div class="col_one_third bottommargin-sm col_last">
                        <div class="feature-box fbox-small fbox-plain" data-animate="fadeIn" >
                            
                            <h3>Share your referral and earn</h3>
                            <p>By sharing your referral code with your friends, you can earn 50 gold coins which you can use for paying rent on the site.</p>
                        </div>
                    </div>

                    <div class="clear"></div>

                </div>

                

                

                <script type="text/javascript">

                    jQuery(window).load(function(){

                        var $container = $('#portfolio');

                        $container.isotope({
                            transitionDuration: '0.65s',
                            masonry: {
                                columnWidth: $container.find('.portfolio-item:not(.wide)')[0]
                            }
                        });

                        $('#page-menu a').click(function(){
                            $('#page-menu li').removeClass('current');
                            $(this).parent('li').addClass('current');
                            var selector = $(this).attr('data-filter');
                            $container.isotope({ filter: selector });
                            return false;
                        });

                        $(window).resize(function() {
                            $container.isotope('layout');
                        });

                    });

                </script>

                <div class="clear"></div>

                <a href="<?php echo site_url('home/howitworks');?>" class="button button-full button-dark center tright bottommargin-lg">
                    <div class="container clearfix">
                        Interested to know the working of Rentooz?? <strong>Lets Go!!</strong> <i class="icon-caret-right" style="top:4px;"></i>
                    </div>
                </a>

                

                

                
                <div class="section">
                    <div class="container clearfix">

                        <div class="row topmargin-sm">

                            <div class="heading-block center">
                                <h3>Meet Our Team</h3>
                            </div>

                            <div class="col-md-3 col-sm-6 bottommargin topmargin">

                                <div class="team">
                                    <div class="team-image">
                                        <img src="<?php echo base_url().'assets/images/sanket.jpg' ;?>" alt="Sanket Shah">
                                    </div>
                                    <div class="team-desc team-desc-bg">
                                        <div class="team-title"><h4>Sanket Shah</h4><span>Co-Founder</span></div>
                                        <a href="https://www.facebook.com/rentoozIIITH/" class="social-icon inline-block si-small si-light si-rounded si-facebook">
                                            <i class="icon-facebook"></i>
                                            <i class="icon-facebook"></i>
                                        </a>
                                        <!--<a href="#" class="social-icon inline-block si-small si-light si-rounded si-twitter">
                                            <i class="icon-twitter"></i>
                                            <i class="icon-twitter"></i>
                                        </a>
                                        <a href="#" class="social-icon inline-block si-small si-light si-rounded si-gplus">
                                            <i class="icon-gplus"></i>
                                            <i class="icon-gplus"></i>
                                        </a>-->
                                    </div>
                                </div>

                            </div>

                            <div class="col-md-3 col-sm-6 bottommargin topmargin">

                                <div class="team">
                                    <div class="team-image">
                                        <img src="<?php echo base_url().'assets/images/shivang.jpg' ;?>" alt="Shivang Nagaria">
                                    </div>
                                    <div class="team-desc team-desc-bg">
                                        <div class="team-title"><h4>Shivang Nagaria</h4><span>Co-Founder</span></div>
                                        <a href="https://www.facebook.com/rentoozIIITH/" class="social-icon inline-block si-small si-light si-rounded si-facebook">
                                            <i class="icon-facebook"></i>
                                            <i class="icon-facebook"></i>
                                        </a>
                                        <!--<a href="#" class="social-icon inline-block si-small si-light si-rounded si-twitter">
                                            <i class="icon-twitter"></i>
                                            <i class="icon-twitter"></i>
                                        </a>
                                        <a href="#" class="social-icon inline-block si-small si-light si-rounded si-gplus">
                                            <i class="icon-gplus"></i>
                                            <i class="icon-gplus"></i>
                                        </a>-->
                                    </div>
                                </div>

                            </div>

                            <div class="col-md-3 col-sm-6 bottommargin topmargin">

                                <div class="team">
                                    <div class="team-image">
                                        <img height = 350px src="<?php echo base_url().'assets/images/jeevan.jpg' ;?>" alt="Jeevan Chowdary">
                                    </div>
                                    <div class="team-desc team-desc-bg">
                                        <div class="team-title"><h4>Jeevan Chowdary</h4><span>Adviser</span></div>
                                        <a href="https://www.facebook.com/rentoozIIITH/" class="social-icon inline-block si-small si-light si-rounded si-facebook">
                                            <i class="icon-facebook"></i>
                                            <i class="icon-facebook"></i>
                                        </a>
                                        <!--<a href="#" class="social-icon inline-block si-small si-light si-rounded si-twitter">
                                            <i class="icon-twitter"></i>
                                            <i class="icon-twitter"></i>
                                        </a>
                                        <a href="#" class="social-icon inline-block si-small si-light si-rounded si-gplus">
                                            <i class="icon-gplus"></i>
                                            <i class="icon-gplus"></i>
                                        </a>-->
                                    </div>
                                </div>

                            </div>

                            

                        </div>



                    </div>
                </div>

                

            </div>

        </section><!-- #content end -->

        

