<section id="page-title">

    <div class="container clearfix">
        <h1>Bonus &amp; Offers</h1>
        <span>Browse through all the exciting bonus and offers</span>
        <ol class="breadcrumb">
            <li><a href="<?php echo site_url('home');?>">Home</a></li>
            <li class="active">Bonus &amp; Offers</li>
        </ol>
    </div>

</section>

<section id="content">

    <div class="content-wrap">

        <div class="container clearfix">


                <div class="row clearfix bottommargin-lg common-height">

                    <div class="col-md-12 col-sm-6 dark center col-padding" style="background-color: #515875;">
                        <div>
                            <h3>Totol Sharentooz bonus you have successfully collected is</h3>
                            <div class="counter counter-lined"><span data-from="0" data-to="<?php echo $sharentoozbonus; ?>" data-refresh-interval="1" data-speed="20000"></span></div>
                            <h5>Transact more and earn infinitely more</h5>
                        </div>
                    </div>

                </div>


            
            <div class="promo nopadding bottommargin">
            <div class="row">
                <div class="col-md-8"><h3>Get <span>3 free add posting </span>for <span>50 sharentoozbonus.</span></h3></div>
                <!-- <span>We strive to provide Our Customers with Top Notch Support to make their Theme Experience Wonderful</span> -->
                <div class="col-md-4" ><button class="btn btn-primary btn-lg" data-toggle="modal" data-target="#offer1">Apply</button>

                        <!-- Modal -->
                    <div class="modal fade" id="offer1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-body">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                        <h4 class="modal-title" id="myModalLabel">Free addpost Offer</h4>
                                    </div>
                                    <div class="modal-body">
                                        <?php
                                        if($sharentoozbonus>=50){
                                            echo '<h3>Are you sure you would like to go ahead with this offer??</h3>';
                                            echo form_open('bonus/freeaddposting',array('name'=>'login-form','id'=>'login-form','class'=>'nobottommargin'));
                                            echo '<div class="modal-footer">';
                                            echo '<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>';
                                            echo '<input type="submit" class="btn btn-primary" id="login-form-submit" name="login-form-submit" value="Go">';
                                            echo '</div>';
                                            echo '</form>';
                                        }
                                        else{
                                            echo '<h3>Sorry!! you do not have sufficient sharentooz bonus';
                                        }
                                        ?>
                                        
                                    </div>
                                    <!-- <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        <button type="button" class="btn btn-primary">Save changes</button>
                                    </div> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </div>

            <div class="promo nopadding bottommargin">
            <div class="row">
                <div class="col-md-8"><h3>Get <span>free recaharge of Rs.20 </span>for <span>100 sharentoozbonus.</span></h3></div>
                <!-- <span>We strive to provide Our Customers with Top Notch Support to make their Theme Experience Wonderful</span> -->
                <div class="col-md-4" ><button class="btn btn-primary btn-lg" data-toggle="modal" data-target="#offer2">Apply</button>

                    <!-- Modal -->
                    <div class="modal fade" id="offer2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-body">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                        <h4 class="modal-title" id="myModalLabel">Recharge Offer</h4>
                                    </div>
                                    <div class="modal-body">
                                        <?php
                                        if($sharentoozbonus>=100){
                                            echo form_open('bonus/rechargebonus',array('class' => 'nobottommargin','id' => 'template-contactform','name' => 'template-contactform'));
                                                
                                            echo '    Enter Mobile Number: <input type="text" required name="mobile" placeholder="Enter mobile number" pattern="\d{10}" title="Phone Number Format: 9999999999" >';
                                            echo '    <br/>';


                                            
                                            echo '    Select Operator:';
                                            echo '    <select name="operator" required>';
                                            echo '    <option value="">Choose</option>';
                                            echo '    <option value="AT">Airtel</option>';
                                            echo '    <option value="AL">Aircel</option>';
                                            echo '    <option value="BS">BSNL</option>';
                                            echo '    <option value="BSS">BSNL Special</option>';
                                            echo '    <option value="IDX">Idea</option>';
                                            echo '    <option value="VF">Vodafone</option>';
                                                
                                            echo '    <option value="TD">Docomo GSM</option>';
                                            echo '    <option value="TDS">Docomo GSM Special</option>';
                                            echo '    <option value="TI">Docomo CDMA (Indicom)</option>';
                                            echo '    <option value="RG">Reliance GSM</option>';
                                            echo '    <option value="RL">Reliance CDMA</option>';
                                            echo '    <option value="MS">MTS</option>';
                                            echo '    <option value="UN">Uninor</option>';
                                            echo '    <option value="UNS">Uninor Special</option>';
                                            echo '    <option value="VD">Videocon</option>';
                                            echo '    <option value="VDS">Videocon Special</option>';
                                            echo '    <option value="MTM">MTNL Mumbai</option>';
                                            echo '    <option value="MTMS">MTNL Mumbai Special</option>';
                                            echo '    <option value="MTD">MTNL Delhi</option>';
                                            echo '    <option value="MTDS">MTNL Delhi Special</option>';
                                            echo '    <option value="VG">Virgin GSM</option>';
                                            echo '    <option value="VGS">Virgin GSM Special</option>';
                                            echo '    <option value="VC">Virgin CDMA</option>';
                                            echo '    <option value="T24">T24</option>';
                                            echo '    <option value="T24S">T24 Special</option>';
                                            echo '    </select>';
                                            echo '    <br/>';             
                                            echo '    <button type="submit" name="upload">Recharge</button>';



                                            echo  '   </form>';
                                        }
                                        else{
                                            echo '<h3>Sorry!! you do not have sufficient sharentooz bonus';
                                        }
                                        ?>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        <button type="button" class="btn btn-primary">Save changes</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </div>


            <div class="promo nopadding bottommargin">
            <div class="row">
                <div class="col-md-8"><h3>Get <span>300 gold coins </span>for <span>100 sharentoozbonus.</span></h3></div>
                <!-- <span>We strive to provide Our Customers with Top Notch Support to make their Theme Experience Wonderful</span> -->
                <div class="col-md-4" ><button class="btn btn-primary btn-lg" data-toggle="modal" data-target="#offer4">Apply</button>

                        <!-- Modal -->
                    <div class="modal fade" id="offer4" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-body">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                        <h4 class="modal-title" id="myModalLabel">Free addpost Offer</h4>
                                    </div>
                                    <div class="modal-body">
                                        <?php
                                        if($sharentoozbonus>=100){
                                            echo '<h3>Are you sure you would like to go ahead with this offer??</h3>';
                                            echo form_open('bonus/freegoldcoins',array('name'=>'login-form','id'=>'login-form','class'=>'nobottommargin'));
                                            echo '<div class="modal-footer">';
                                            echo '<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>';
                                            echo '<input type="submit" class="btn btn-primary" id="login-form-submit" name="login-form-submit" value="Go">';
                                            echo '</div>';
                                            echo '</form>';
                                        }
                                        else{
                                            echo '<h3>Sorry!! you do not have sufficient sharentooz bonus';
                                        }
                                        ?>
                                        
                                    </div>
                                    <!-- <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        <button type="button" class="btn btn-primary">Save changes</button>
                                    </div> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </div>

                  

        </div>

    </div>

</section><!-- #content end -->


