
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
                                            <strong>Address</strong><br>
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
                                        <li><a href="<?php echo site_url('home/');?>">Testimonials</a></li>
                                    </ul>
                                </div>

                                <div class="col-md-3 col-sm-6 bottommargin-sm widget_links">
                                    <ul>
                                        <li><a href="<?php echo site_url('home/about-us');?>">About Us</a></li>
                                        <li><a href="<?php echo site_url('home/contact-us');?>">Contct Us</a></li>
                                        <li><a href="<?php echo site_url('home/faq');?>">FAQs</a></li>
                                        <li><a href="<?php echo site_url('home/termsandconditions');?>">Terms of Use</a></li>
                                        <li><a href="<?php echo site_url('home/privacypolicy');?>">Privacy Policy</a></li>
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