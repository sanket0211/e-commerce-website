<script>
function startRentPeriod($id){
    document.getElementById('buyer-code-form').setAttribute("action","<?php echo site_url('home/start_renting_period/') ;?>" + "/" + $id);
}
function stopRentPeriod($id){
    document.getElementById('giver-code-form').setAttribute("action","<?php echo site_url('home/stop_renting_period/') ;?>" + "/" + $id);
}
</script>

<footer id="footer" class="dark">

            <div class="container">

                <!-- Footer Widgets
                ============================================= -->
                <div class="footer-widgets-wrap clearfix">

                    <div class="col_one_third">

                        <div class="widget clearfix">
                            <!-- Replace this src with our logo 
                            <img src="images/footer-widget-logo.png" alt="" class="footer-logo"> -->

                            <!-- Replace the world map with something else -->
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

                    </div>

                    <div class="col_one_third">

                        <div class="widget clearfix">
                            <h4>Client Testimonials</h4>

                            <div class="fslider testimonial no-image nobg noborder noshadow nopadding" data-animation="slide" data-arrows="false">
                                <div class="flexslider">
                                    <div class="slider-wrap">
                                        <div class="slide">
                                            <div class="testi-image">
                                                <!-- Replace with client image 
                                                <a href="#"><img src="images/testimonials/3.jpg" alt="Customer Testimonails"></a>-->
                                            </div>
                                            <div class="testi-content">

                                                <p>I never knew that renting things was so simple and easy. 
                                                Through Rentooz, I was able to put many things 
                                                on rent and readily got customers for it. Great Concept!!! congrats.</p>
                                                <div class="testi-meta">
                                                    Raj Manvar
                                                </div>
                                            </div>
                                        </div>
                                        <div class="slide">
                                            <div class="testi-image">
                                                <!-- Replace with client image
                                                <a href="#"><img src="images/testimonials/2.jpg" alt="Customer Testimonails"></a>-->
                                            </div>
                                            <div class="testi-content">

                                                <p>Rentooz has helped me know more people around me, reason being they 
                                                regularly take things on rent from me.</p>
                                                <div class="testi-meta">
                                                    Prajjwal khariya

                                                </div>
                                            </div>
                                        </div>
                                        <div class="slide">
                                            <div class="testi-image">
                                                <!-- Replace with client image
                                                <a href="#"><img src="images/testimonials/1.jpg" alt="Customer Testimonails"></a>-->
                                            </div>
                                            <div class="testi-content">
                                                <p>Incidunt deleniti blanditiis quas aperiam recusandae consequatur ullam quibusdam cum libero illo rerum!</p>
                                                <div class="testi-meta">
                                                    John Doe
                                                    <span>XYZ Inc.</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>

                    <div class="col_one_third col_last">

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

    </div><!-- #wrapper end -->

    <!-- Go To Top
    ============================================= -->
    <div id="gotoTop" class="icon-angle-up"></div>

    <!-- Footer Scripts
    ============================================= -->
    <script type="text/javascript" src="<?php echo base_url().'assets/js/functions.js';?>"></script>

</body>
</html>
