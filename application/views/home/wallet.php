<section id="page-title" >

    <div class="container clearfix">
        <h1>Wallet</h1>
        <span>See your earnings, gold coins</span>
        <ol class="breadcrumb">
            <li><a href="<?php echo site_url('home');?>">Home</a></li>
            <li><a href="active">Wallet</a></li>
        </ol>
    </div>

</section>


<section id="content">

            <div class="content-wrap">

                <div class="container clearfix">
                <?php
            if ($info){
                echo '<div class="alert alert-info">';
                echo '    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
                echo '    <i class="icon-magic"></i>'.$info ;
                echo '</div>';
            }
            if ($error){
                echo '<div class="alert alert-warning">';
                echo '    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
                echo '<i class="icon-warning-sign"></i>'.$error ;
                echo '</div>';
            }?>


                    <div class="pricing bottommargin clearfix">

                        <div class="col-sm-6">

                            <div class="pricing-box">
                                <div class="pricing-title">
                                    <h3>Coins</h3>
                                </div>
                                <div class="pricing-price">
                                     <?php echo $user_coins; ?>
                                </div>
                                <div class="pricing-features">
                                    <ul>
                                        <li>equivalent to <i class="icon-rupee"></i><?php 
                                            $rs = ($user_coins)/10;
                                        echo $rs ?></li>
                                        <li>Coins help you to pay your rent.</li>
                                        <li>This cannot be redeemed.</li>
                                        
                                        
                                    </ul>
                                </div>
                                <div class="pricing-action">

                                <?php
                                    
                                    echo '<button type="button" class="button" data-toggle="modal" data-target=".buycoins">Buy Coins</button>';
                                    
                                    ?>
                                </div>
                                <div class="modal fade buycoins" role="dialog">
                                    <div class="modal-dialog">

                                      <!-- Modal content-->
                                      <div class="modal-content">
                                        <div class="modal-header">
                                          <button type="button" class="close" data-dismiss="modal">&times;</button>
                                          <h4 class="modal-title">Modal Header</h4>
                                        </div>
                                            <?php echo form_open('home/buy_coins',array('class' => 'nobottommargin','id' => 'template-contactform','name' => 'template-contactform')); ?>
                            
                                                <div class="col_full">
                                                    <label for="num_of_coins">enter no. of coins you want to buy</label>
                                                        
                                                    <input name="coins" type="number" min="100" step="1" required>

                                                </div>

                                                <div class="col_full">
                                                    <input class="button button-3d nomargin" type="submit" id="template-contactform-submit" name="upload" value="Buy"/>
                                                </div>

                                            </form>

                                        <div class="modal-footer">
                                          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        </div>
                                      </div>
                                      
                                    </div>
                                </div>
                                
                            </div>

                        </div>

                        

                        <div class="col-sm-6">

                            <div class="pricing-box">
                                <div class="pricing-title">
                                    <h3>Earnings</h3>
                                </div>
                                <div class="pricing-price">

                                    <i class="icon-rupee"></i><?php print_r($user_earnings);?>

                                </div>
                                <div class="pricing-features">
                                    <ul>
                                        <li>equivalent to <?php 
                                            $coins =$user_earnings*10;
                                        echo $coins ?> coins</li>
                                        <li>Earnings is money you earned as rent.</li>
                                        <li>Can be redeemed either as bank transfer or a mobile recharge.</li>
                                        
                                    </ul>
                                </div>
                                <div class="pricing-action">

                                    <?php
                                        if($user_earnings>=200){
                                            echo '<button  class="button" data-toggle="modal" data-target=".bank">Avail Bank transfer</button><br>';
                                        }
                                        else{
                                            echo '<button class="button" data-toggle="modal" data-target=".nobank">Avail Bank transfer</button><br>';
                                        }
                                        if($user_earnings!=0){
                                            echo '<button class="button" data-toggle="modal" data-target=".earningstocoins">convert to coins</button><br>';
                                     
                                        
                                        }
                                        if($user_earnings>=10){
                                            echo '<button class="button" data-toggle="modal" data-target=".recharge">Mobile Recharge</button>';
                                        }
                                        echo '<button class="button" data-toggle="modal" data-target=".recharge_code">Have recharge coupon!</button>';
                                        ?>

                                    

                                    <div class="modal fade bank" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-body">
                                                <div class="modal-content">
                                                    <div class="modal-header">

                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                        <h4 class="modal-title" id="myModalLabel">Account Information</h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        <?php echo form_open_multipart('home/bank_details',array('class' => 'nobottommargin','id' => 'template-contactform','name' => 'template-contactform')); ?>
                                                        <div class="col_full">
                                                            <label for="comm_name">Account Number<span style="color:red;font-size:15px">*</span>:</label>
                                                            <input type="number" id="comm_name" name="account_number" class="sm-form-control required" required/>
                                                        </div>

                                                        <div class="col_full">
                                                            <label for="comm_name">Account Name<span style="color:red;font-size:15px">*</span>:</label>
                                                            <input type="text" id="comm_name" name="account_name" pattern="[a-zA-Z0-9 -]{2,200}" class="sm-form-control required" required/>
                                                        </div>

                                                        <div class="col_full">
                                                            <label for="comm_name">Account Type<span style="color:red;font-size:15px">*</span>:</label>
                                                            <input type="text" id="comm_name" name="account_type" pattern="[a-zA-Z0-9 -]{2,200}" class="sm-form-control required" required/>
                                                        </div>

                                                        <div class="col_full">
                                                            <label for="comm_name">Branch<span style="color:red;font-size:15px">*</span>:</label>
                                                            <input type="text" id="comm_name" name="branch" pattern="[a-zA-Z0-9 -]{2,200}" class="sm-form-control required" required/>
                                                        </div>

                                                        <div class="col_full">
                                                            <label for="comm_name">IFSC Code<span style="color:red;font-size:15px">*</span>:</label>
                                                            <input type="text" id="comm_name" name="ifsc" pattern="[A-Z0-9]{2,200}" class="sm-form-control required" required/>
                                                        </div>

                                                        <div class="col_full">
                                                            <label for="comm_name">Enter Ammount<span style="color:red;font-size:15px">*</span>:</label>
                                                            <input type="number" required name="amount"min="200" step="1" max="<?php echo $user_earnings ?>">

                                                        </div>

                                                        <div class="clear"></div>

                                                        

                                                        <div class="col_full">
                                                            <input class="button button-3d nomargin" type="submit" id="template-contactform-submit" name="upload" value="Transfer Ammount"/>
                                                        </div>

                                                    </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="modal fade nobank" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-body">
                                                <div class="modal-content">
                                                    <div class="modal-header">

                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                        <h4 class="modal-title" id="myModalLabel">Account Information</h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        <h3> Sorry, you have insufficient balance to avail bank transfer. Minimum amount of Rs. 200 is required for a bank transfer.</h3>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>



                                </div>


                                <div>
                                    
                                    <!-- Trigger the modal with a button -->

                                    

                                    <!-- Modal -->
                                    <div class="modal fade earningstocoins" role="dialog">
                                        <div class="modal-dialog">

                                          <!-- Modal content-->
                                          <div class="modal-content">
                                            <div class="modal-header">
                                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                                              <h4 class="modal-title">Modal Header</h4>
                                            </div>
                                                <?php echo form_open('home/get_coins',array('class' => 'nobottommargin','id' => 'template-contactform','name' => 'template-contactform')); ?>
                                
                                                    <div class="col_full">
                                                        <label for="num_of_coins">enter no. of coins</label>
                                                            
                                                        <input name="coins" type="number" min="1" step="1" max="<?php echo $user_earnings*10 ?>" required>

                                                    </div>

                                                    

                                                    <div class="col_full">
                                                        <input class="button button-3d nomargin" type="submit" id="template-contactform-submit" name="upload" value="Create"/>
                                                    </div>

                                                </form>

                                            <div class="modal-footer">
                                              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                            </div>
                                          </div>
                                          
                                        </div>
                                    </div>

                                    <div>
                                    
                                    <!-- Trigger the modal with a button -->
                                    <!-- Modal -->
                                    <div class="modal fade recharge_code" role="dialog">
                                        <div class="modal-dialog">

                                          <!-- Modal content-->
                                          <div class="modal-content">
                                            <div class="modal-header">
                                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                                              <h4 class="modal-title">Mobile Recharge</h4>
                                            </div>
                                                <?php echo form_open('home/match_recharge_code',array('class' => 'nobottommargin','id' => 'recharge_code_form','name' => 'recharge_code_form')); ?>
                                                    <input type="text" placeholder="Recharge code" required name="recharge_code"></input><br>
                                                
                                                    <button class="button" type="submit" name="upload">Add money to earnings</button>
                                                </form>
                                          </div>
                                          
                                        </div>
                                    </div>

                                    <div class="modal fade recharge" role="dialog">
                                        <div class="modal-dialog">

                                          <!-- Modal content-->
                                          <div class="modal-content">
                                            <div class="modal-header">
                                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                                              <h4 class="modal-title">Mobile Recharge</h4>
                                            </div>
                                                <?php echo form_open('recharge/view_plans',array('class' => 'nobottommargin','id' => 'template-contactform','name' => 'template-contactform')); ?>
                                                     Enter Mobile Number: <input type="text" required name="mobile" placeholder="Enter mobile number" pattern='\d{10}' title='Phone Number Format: 9999999999' >

                                                <br/>
Enter Amount: <input type="number" required name="amount"min="10" step="1" max="<?php echo $user_earnings ?>">

                                                <br/>

                                                Select Operator:

                                                <select name="operator" required>

                                                <option value="">Choose</option>

                                                <option value="AT">Airtel</option>
                                                <option value="AL">Aircel</option>

                                              <option value="BS">BSNL</option>

                                                <option value="BSS">BSNL Special</option>

                                                <option value="IDX">Idea</option>

                                                <option value="VF">Vodafone</option>

                                                

                                                <option value="TD">Docomo GSM</option>

                                                <option value="TDS">Docomo GSM Special</option>

                                                <option value="TI">Docomo CDMA (Indicom)</option>

                                                <option value="RG">Reliance GSM</option>

                                                <option value="RL">Reliance CDMA</option>

                                                <option value="MS">MTS</option>

                                                <option value="UN">Uninor</option>

                                                <option value="UNS">Uninor Special</option>

                                                <option value="VD">Videocon</option>

                                                <option value="VDS">Videocon Special</option>

                                                <option value="MTM">MTNL Mumbai</option>

                                                <option value="MTMS">MTNL Mumbai Special</option>

                                                <option value="MTD">MTNL Delhi</option>

                                                <option value="MTDS">MTNL Delhi Special</option>

                                                <option value="VG">Virgin GSM</option>

                                                <option value="VGS">Virgin GSM Special</option>

                                                <option value="VC">Virgin CDMA</option>

                                                <option value="T24">T24</option>

                                                <option value="T24S">T24 Special</option>

                                                </select>


                                                <br/>             
                                               <button type="submit" name="upload">Recharge</button>
                                                </form>
                                                 <div class="modal-footer">

                                             <button type="button" class="btn btn-default" data-dismiss="modal" >Close</button>

                                          </div>
                                          </div>
                                          
                                        </div>
                                    </div>
                                  
                                </div>

                            </div>

                        </div>

                    </div>
                    
                    

                    

                    
                </div>

       

                

                <div class="section nobottommargin">
                    <div class="container clear-bottommargin clearfix">

                        <div class="row topmargin-sm clearfix">

                            <div class="col-md-4 bottommargin">
                            <img height=200px width=200px src="<?php echo base_url().'assets/images/smartart/goldcoin.jpg';?>" class="notopmargin" alt="Image" title="Image" />
                                <div class="heading-block nobottomborder" style="margin-bottom: 15px;">
                                    <span class="before-heading">Gold Coins.</span>
                                    <h4>Paying Rent</h4>
                                </div>
                                <p>Gold coins are used as payment mechanism for the renting transactions. Every new user gets 100 coins for use and thereafter, one can purchase gold coins. 
Rs 1= 10 Gold </p>
                            </div>

                            <div class="col-md-4 bottommargin">
                                <img height=200px width=200px src="<?php echo base_url().'assets/images/smartart/wallet.png';?>" class="notopmargin" alt="Image" title="Image"/>
                                <div class="heading-block nobottomborder" style="margin-bottom: 15px;">
                                    <span class="before-heading">Wallet</span>
                                    <h4>Takes care of the earnings and gold coins</h4>
                                </div>
                                <p>Earnings are in the form of cash which are earned during the renting period. One can redeem the earnings through recharge or transfer the earnings directly into their gold coins</p>
                            </div>

                            <div class="col-md-4 bottommargin">
                                <img height=200px width=200px src="<?php echo base_url().'assets/images/smartart/bonus.png';?>" class="notopmargin" alt="Image" title="Image" />
                                <div class="heading-block nobottomborder" style="margin-bottom: 15px;">
                                    <span class="before-heading">ShaRentooz Bonus</span>
                                    <h4>Earned at end of every transaction</h4>
                                </div>
                                <p>Sharentooz bonus is earned on every renting transaction. The user can redeem this bonus with exciting offers available on the website.</p>
                            </div>

                        </div>

                    </div>
                </div>
                
                </div>

        </section><!-- #content end -->