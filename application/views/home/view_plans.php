<section id="page-title">

    <div class="container clearfix">
        <h1>Recharge</h1>
        <span>Mobile recharge</span>
        <ol class="breadcrumb">
            <li><a href="<?php echo site_url('home');?>">Home</a></li>

        </ol>
    </div>

</section>

<section id="content">

    <div class="content-wrap">

        <div class="container clearfix">
        
          <?php
               
                if($error){
                    echo '<div class="alert alert-warning">';
                    echo '    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
                    echo '<i class="icon-warning-sign"></i>'.$error ;
                    echo '</div>';
                }
                ?>
 
            <!-- Post Content
            ============================================= -->
            <div class="postcontent nobottommargin col_last"> 
            
            
            
            
            
                

                <ul id="myTab2" class="nav nav-pills boot-tabs">
                  <li class="active"><a href="#topup" data-toggle="tab">Top Up</a></li>
                  <li><a href="#ftt" data-toggle="tab">Full Talktime</a></li>
                  <li><a href="#twog" data-toggle="tab">2G</a></li>
                  <li><a href="#threeg" data-toggle="tab">3G/4G</a></li>
                  <li><a href="#sms" data-toggle="tab">SMS</a></li>
                  <li><a href="#lsc" data-toggle="tab">Local/STD/ISD</a></li>
                  <li><a href="#roaming" data-toggle="tab">Roaming</a></li>
                  <li><a href="#other" data-toggle="tab">Other</a></li>
                  
                </ul>
                <div id="myTabContent2" class="tab-content">
                  <div class="tab-pane fade in active" id="topup">
                  <?php
                  
                  
                    if (count($topup) > 0) {
      echo "<table class=\"table\"><thead><tr><th>Detail</th><th>Amount (Rs.)</th> <th>Validity (days)</th><th>Pick</th> </tr></thead><tbody>";
      foreach($topup as $key => $value) {
      echo " <tr><td>" .$value["Detail"] . "</td>  <td>" .$value["Amount"] . "</td>    <td>" .$value["Validity"] . "</td><td><input type='checkbox' value=".$value["Amount"]."></td> </tr>";
      }
      echo "</tbody></table><br/>";
      }else{echo"Nooffer details available for this category";}?>
                  </div>
                  <div class="tab-pane fade" id="ftt">
                    <?php
                    if (count($fulltalktime) > 0) {
      echo "<table class=\"table\"><thead><tr><th>Detail</th><th>Amount (Rs.)</th> <th>Validity (days)</th><th>Pick</th>  </tr></thead><tbody>";
      foreach($fulltalktime as $key => $value) {
      echo " <tr><td>" .$value["Detail"] . "</td>  <td>" .$value["Amount"] . "</td>    <td>" .$value["Validity"] . "</td><td><input type='checkbox' value=".$value["Amount"]."></td> </tr>";
      }
      echo "</tbody></table><br/>";
      }else{echo"Nooffer details available for this category";}?>
                  </div>
                  <div class="tab-pane fade" id="twog">
                    <?php
                    if (count($twog) > 0) {
      echo "<table class=\"table\"><thead><tr><th>Detail</th><th>Amount (Rs.)</th> <th>Validity (days)</th><th>Pick</th> </tr></thead><tbody>";
      foreach($twog as $key => $value) {
      echo " <tr><td>" .$value["Detail"] . "</td>  <td>" .$value["Amount"] . "</td>    <td>" .$value["Validity"] . "</td><td><input type='checkbox' value=".$value["Amount"]."></td> </tr>";
      }
      echo "</tbody></table><br/>";
      }else{echo"Nooffer details available for this category";}?>
                  </div>
                  <div class="tab-pane fade" id="threeg">
                    <?php
                    if (count($threeg) > 0) {
      echo "<table class=\"table\"><thead><tr><th>Detail</th><th>Amount (Rs.)</th> <th>Validity (days)</th> <th>Pick</th> </tr></thead><tbody>";
      foreach($threeg as $key => $value) {
      echo " <tr><td>" .$value["Detail"] . "</td>  <td>" .$value["Amount"] . "</td>    <td>" .$value["Validity"] . "</td> <td><input type='checkbox' value=".$value["Amount"]."></td></tr>";
      }
      echo "</tbody></table><br/>";
      }else{echo"Nooffer details available for this category";}?>
                  </div>
                  <div class="tab-pane fade" id="lsc">
                    <?php
                    if (count($localstd) > 0) {
      echo "<table class=\"table\"><thead><tr><th>Detail</th><th>Amount (Rs.)</th> <th>Validity (days)</th> <th>Pick</th> </tr></thead><tbody>";
      foreach($localstd as $key => $value) {
      echo " <tr><td>" .$value["Detail"] . "</td>  <td>" .$value["Amount"] . "</td>    <td>" .$value["Validity"] . "</td><td><input type='checkbox' value=".$value["Amount"]."></td> </tr>";
      }
      echo "</tbody></table><br/>";
      }else{echo"Nooffer details available for this category";}?>
                  </div>
                  
                  <div class="tab-pane fade" id="sms">
                    <?php
                    if (count($sms) > 0) {
      echo "<table class=\"table\"><thead><tr><th>Detail</th><th>Amount (Rs.)</th> <th>Validity (days)</th> <th>Pick</th> </tr></thead><tbody>";
      foreach($sms as $key => $value) {
      echo " <tr><td>" .$value["Detail"] . "</td>  <td>" .$value["Amount"] . "</td>    <td>" .$value["Validity"] . "</td><td><input type='checkbox' value=".$value["Amount"]."></td> </tr>";
      }
      echo "</tbody></table><br/>";
      }else{echo"Nooffer details available for this category";}?>
                  </div>
                  
                  <div class="tab-pane fade" id="roaming">
                    <?php
                    if (count($roaming) > 0) {
      echo "<table class=\"table\"><thead><tr><th>Detail</th><th>Amount (Rs.)</th> <th>Validity (days)</th><th>Pick</th>  </tr></thead><tbody>";
      foreach($roaming as $key => $value) {
      echo " <tr><td>" .$value["Detail"] . "</td>  <td>" .$value["Amount"] . "</td>    <td>" .$value["Validity"] . "</td><td><input type='checkbox' value=".$value["Amount"]."></td> </tr>";
      }
      echo "</tbody></table><br/>";
      }else{echo"Nooffer details available for this category";}?>
                  </div>
                  
                  <div class="tab-pane fade" id="other">
                    <?php
                    if (count($other) > 0) {
      echo "<table class=\"table\"><thead><tr><th>Detail</th><th>Amount (Rs.)</th> <th>Validity (days)</th><th>Pick</th>  </tr></thead><tbody>";
      foreach($other as $key => $value) {
      echo " <tr><td>" .$value["Detail"] . "</td>  <td>" .$value["Amount"] . "</td>    <td>" .$value["Validity"] . "</td><td><input type='checkbox' value=".$value["Amount"]."></td> </tr>";
      }
      echo "</tbody></table><br/>";
      }else{echo"Nooffer details available for this category";}?>
                  </div>
                  
                </div>

            </div><!-- .postcontent end -->
            
            <div class="sidebar nobottommargin">
                        <div class="sidebar-widgets-wrap">

                
                <?php echo form_open_multipart('recharge/view_plans', array('class'=>'well555 form-search','name'=>'form1','id'=>'form1'));?>
    
    
    <div class="control-group">
          <label class="control-label">Mobile Number</label>
      <div class="controls">
          <div class="input-prepend">
        <span class="add-on"><i class="icon-mobile"></i></span>
    <input type='text' class='input-large' name='mobile' id='mobile' maxlength='10' onkeyup='Call()' value="" required >                <br/>
           <span class="label label-important" style="display: none;" id="mobno_err_span">Please enter a valid mobile number.</span>
        </div>
      </div>
    </div>
    
      
    
    

          <div class="control-group">
            <label class="control-label" for="select01">Service Provider</label>
            <div class="controls">
             <div class="input-prepend">
              <span class="add-on"><i class="icon-signal"></i></span>
              <select readonly name="operator" id="operator" onload="checkValidOption();" required>
                <option value="">Choose</option>              
               <option value="28">Airtel</option>
               <option value="1">Aircel</option>
               <option value="3">BSNL</option>
               <option value="24">BSNL Special</option>
               <option value="8">Idea</option>
               <option value="22">Vodafone</option>
               <option value="17">Docomo GSM</option>
               <option value="25">Docomo GSM Special</option>
               <option value="18">Docomo CDMA (Indicom)</option>
                <option value="13">Reliance GSM</option>
               <option value="12">Reliance CDMA</option>
        <option value="10">MTS</option>
              <option value="19">Uninor</option>
               <option value="26">Uninor Special</option>
               <option value="9">Loop Mobile</option>
              <option value="5">Videocon</option>
               <option value="27">Videocon Special</option>
               <option value="6">MTNL Mumbai</option>
               <option value="7">MTNL Mumbai Special</option>
               <option value="20">MTNL Delhi</option>
               <option value="21">MTNL Delhi Special</option>
               <option value="30">Virgin GSM</option>
               <option value="31">Virgin GSM Special</option>
               <option value="32">Virgin CDMA</option>
               <option value="33">T24</option>
               <option value="34">T24 Special</option>
               </select>
               </div>
            </div>
          </div>
          
           <div class="control-group">
            <label class="control-label" for="select01">Service Circle</label>
            <div class="controls">
             <div class="input-prepend">
              <span class="add-on"><i class="icon-signal"></i></span>
              <select name="circle" id="circle" onchange="this.form.submit()" required>
                <option value="">Choose</option>
                <option value='5' selected>Andhra Pradesh</option>
  <option value="19">Assam</option>
  <option value="17">Bihar & Jharkhand</option>
  <option value="23">Chennai</option>
  <option value="1">Delhi/NCR</option>
  <option value="8">Gujarat</option>
  <option value="16">Haryana</option>
  <option value="21">Himachal Pradesh</option>
  <option value="22">Jammu & Kashmir</option>
  <option value="7">Karnataka</option>
  <option value="14">Kerala</option>
  <option value="3">Kolkata</option>
  <option value="4">Maharashtra</option>
  <option value="10">Madhya Pradesh</option>
  <option value="2">Mumbai</option>
  <option value="20">North East</option>
  <option value="18">Orissa</option>
  <option value="15">Punjab</option>
  <option value="13">Rajasthan</option>
  <option value="6">Tamil Nadu</option>
  <option value="9">Uttar Pradesh (E)</option>
  <option value="11">Uttar Pradesh (W)</option>
  <option value="12">West Bengal</option>
               </select>
               </div>
            </div>
          </div>
  
  <div id="loading" style="display: none;"><img src="loading.gif" /></div>
       
  
 
  <div class="control-group">
       <label class="control-label">Amount</label>
      <div class="controls">
          <div class="input-prepend">
        <span class="add-on"><i class="icon-rupee"></i></span>
          <input type="number" class="input-large" name="amount" id="amount" value="" required>
          </div>
      </div>
  </div>  
    
        
    
</form> 
<button onclick="clickme()" class="button button-3d button-rounded button-dirtygreen"><i class="icon-mobile"></i></i>Go for Recharge</button>

                            
                        </div>
                    </div><!-- .sidebar end -->

            
            

        </div>

    </div>

</section><!-- #content end -->
<script>
var circle = document.getElementById('circle');
var operator = document.getElementById('operator');
var nums = document.getElementById('mobile');
nums.onload = function () { fieldcheck(); }
operator.onload = function () { fieldcheck(); }
fieldcheck(); 
function fieldcheck() {
    
        operator.value = <?php echo $operator_id; ?>;
        circle.value = <?php echo $circode; ?>;
  nums.value = <?php echo $mobile; ?>;
}


function Call(){
  var $number = document.getElementById('mobile');
  var $num = $number.value;
  console.log($num);
  if($num.length == 10){
    var form = document.getElementById('form1');
    form.action = 'view_plans';
    document.getElementById("form1").submit();
  }

}

function clickme(){
console.log("hello");
  var amt = document.getElementById('amount');
  if(amt.value <10 || amt.value > <?php echo $user_earnings; ?>){
    alert('Amount should be greater than Rs. 10 but less than your Earnings (Rs. <?php echo $user_earnings; ?>)');
  }
  else {
    var form = document.getElementById('form1');
      form.action = 'recharge';
      document.getElementById("form1").submit();
  }
}



$(document).ready(function(){
    $checks = $(":checkbox");
    $checks.on('click', function() {
        var string = $checks.filter(":checked").map(function(i,v){
            return this.value;
        }).get().join(" ");
        $('#amount').val(string);
    });
});
</script>

<script>
$(document).ready(function(){
  $("#homebtn").click(function(){
        $('#maincontent').html('<img src="loading.png" />');
            setTimeout( function() {   
                                    $("#maincontent").load("mem.php #home");  
                                     $("html, body").animate({ scrollTop: $('#maincontent').offset().top }, 1500);               
                                   }, 500);
                               
 
    
  });
  
  
  
  
  $("#verifyemailbtn").click(function(){
        $('#maincontent').html('<img src="loading.png" />');
            setTimeout( function() {   
                                    $("#maincontent").load("ajax_verifyemail.php");   
                                     $("html, body").animate({ scrollTop: $('#maincontent').offset().top }, 1500);             
                                   }, 500);
                               
 
    
  });
  
  $("#verifymobilebtn").click(function(){
        $('#maincontent').html('<img src="loading.png" />');
            setTimeout( function() {   
                                    $("#maincontent").load("ajax_verifymobile.php");      
                                     $("html, body").animate({ scrollTop: $('#maincontent').offset().top }, 1500);           
                                   }, 500);
                               
 
    
  });
  
   $("#viewprofilebtn").click(function(){
        $('#maincontent').html('<img src="loading.png" />');
            setTimeout( function() {   
                                    $("#maincontent").load("ajax_viewprofile.php");  
                                     $("html, body").animate({ scrollTop: $('#maincontent').offset().top }, 1500);               
                                   }, 500);
                               
 
    
  });
  
   $("#api_earningsbtn786").click(function(){
        $('#maincontent').html('<img src="loading.png" />');
            setTimeout( function() {   
                                    $("#maincontent").load("ajax_api_earnings.php");  
                                     $("html, body").animate({ scrollTop: $('#maincontent').offset().top }, 1500);               
                                   }, 500);
                               
 
    
  });
  
  $("#balancerequestbtn").click(function(){
        $('#maincontent').html('<img src="loading.png" />');
            setTimeout( function() {   
                                    $("#maincontent").load("ajax_balancerequest.php");  
                                     $("html, body").animate({ scrollTop: $('#maincontent').offset().top }, 1500);               
                                   }, 500);
                               
 
    
  });

$("#payment_bankbtn").click(function(){
        $('#maincontent').html('<img src="loading.png" />');
            setTimeout( function() {   
                                    $("#maincontent").load("ajax_payment_bank.php");  
                                     $("html, body").animate({ scrollTop: $('#maincontent').offset().top }, 1500);               
                                   }, 500);
                               
 
    
  });
 $("#payment_addfundbtn").click(function(){
        $('#maincontent').html('<img src="loading.png" />');
            setTimeout( function() {   
                                    $("#maincontent").load("ajax_balancerequest.php");  
                                     $("html, body").animate({ scrollTop: $('#maincontent').offset().top }, 1500);               
                                   }, 500);
                               
 
    
  });
  
  $("#payment_viewfundhistorybtn").click(function(){
        $('#maincontent').html('<img src="loading.png" />');
            setTimeout( function() {   
                                    $("#maincontent").load("ajax_payment_viewfundhistory.php");  
                                     $("html, body").animate({ scrollTop: $('#maincontent').offset().top }, 1500);               
                                   }, 500);
                               
 
    
  });
  
  $("#packagedetailbtn").click(function(){
        $('#maincontent').html('<img src="loading.png" />');
            setTimeout( function() {   
                                    $("#maincontent").load("ajax_packagedetail.php");    
                                     $("html, body").animate({ scrollTop: $('#maincontent').offset().top }, 1500);             
                                   }, 500);
                               
 
    
  });
  
 $("#redeemrequestbtn").click(function(){
        $('#maincontent').html('<img src="loading.png" />');
            setTimeout( function() {   
                                    $("#maincontent").load("ajax_redeemrequest.php");  
                                     $("html, body").animate({ scrollTop: $('#maincontent').offset().top }, 1500);               
                                   }, 500);
                               
 
    
  });
  
  $("#redeemrequestbtn2").click(function(){
        $('#maincontent').html('<img src="loading.png" />');
            setTimeout( function() {   
                                    $("#maincontent").load("ajax_redeemrequest.php"); 
                                     $("html, body").animate({ scrollTop: $('#maincontent').offset().top }, 1500);                
                                   }, 500);
                               
 
    
  });
  
  $("#redeemrequest_viewbtn").click(function(){
        $('#maincontent').html('<img src="loading.png" />');
            setTimeout( function() {   
                                    $("#maincontent").load("ajax_redeemrequest_view.php"); 
                                     $("html, body").animate({ scrollTop: $('#maincontent').offset().top }, 1500);                
                                   }, 500);
                               
 
    
  });
  
  $("#api_helpdesk_createbtn").click(function(){
        $('#maincontent').html('<img src="loading.png" />');
            setTimeout( function() {   
                                    $("#maincontent").load("ajax_api_helpdesk_create.php"); 
                                     $("html, body").animate({ scrollTop: $('#maincontent').offset().top }, 1500);                
                                   }, 500);
                               
 
    
  });
  
  $("#api_helpdesk_viewbtn").click(function(){
        $('#maincontent').html('<img src="loading.png" />');
            setTimeout( function() {   
                                    $("#maincontent").load("ajax_api_helpdesk_view.php"); 
                                     $("html, body").animate({ scrollTop: $('#maincontent').offset().top }, 1500);                
                                   }, 500);
                               
 
    
  });
  
  
  $("#api_earningsbtn").click(function(){
        $('#maincontent').html('<img src="loading.png" />');
            setTimeout( function() {   
                                    $("#maincontent").load("ajax_api_earnings.php"); 
                                     $("html, body").animate({ scrollTop: $('#maincontent').offset().top }, 1500);                
                                   }, 500);
                               
 
    
  });
  
   $("#api_statementbtn").click(function(){
        $('#maincontent').html('<img src="loading.png" />');
            setTimeout( function() {   
                                    $("#maincontent").load("ajax_api_statement.php"); 
                                     $("html, body").animate({ scrollTop: $('#maincontent').offset().top }, 1500);                
                                   }, 500);
                               
 
    
  });
  
  
  $("#generatekeybtn").click(function(){
        $('#maincontent').html('<img src="loading.png" />');
            setTimeout( function() {   
                                    $("#maincontent").load("ajax_generatekey.php"); 
                                     $("html, body").animate({ scrollTop: $('#maincontent').offset().top }, 1500);                
                                   }, 500);
                               
 
    
  });
  
  $("#serveripbtn").click(function(){
        $('#maincontent').html('<img src="loading.png" />');
            setTimeout( function() {   
                                    $("#maincontent").load("ajax_serverip.php"); 
                                     $("html, body").animate({ scrollTop: $('#maincontent').offset().top }, 1500);                
                                   }, 500);
                               
 
    
  });
  
  $("#apilockerbtn").click(function(){
        $('#maincontent').html('<img src="loading.png" />');
            setTimeout( function() {   
                                    $("#maincontent").load("ajax_apilocker.php"); 
                                     $("html, body").animate({ scrollTop: $('#maincontent').offset().top }, 1500);                
                                   }, 500);
                               
 
    
  });
  
  $("#apisynchronizebtn").click(function(){
        $('#maincontent').html('<img src="loading.png" />');
            setTimeout( function() {   
                                    $("#maincontent").load("ajax_apisynchronize.php"); 
                                     $("html, body").animate({ scrollTop: $('#maincontent').offset().top }, 1500);                
                                   }, 500);
                               
 
    
  });
  
  $("#apiservicestsbtn").click(function(){
        $('#maincontent').html('<img src="loading.png" />');
            setTimeout( function() {   
                                    $("#maincontent").load("ajax_apiservicests.php"); 
                                     $("html, body").animate({ scrollTop: $('#maincontent').offset().top }, 1500);                
                                   }, 500);
                               
 
    
  });
  
   $("#smscreditrequestbtn").click(function(){
        $('#maincontent').html('<img src="loading.png" />');
            setTimeout( function() {   
                                    $("#maincontent").load("ajax_smscreditrequest.php"); 
                                     $("html, body").animate({ scrollTop: $('#maincontent').offset().top }, 1500);                
                                   }, 500);
                               
 
    
  });
  
  $("#smscreditrequestbtn2").click(function(){
        $('#maincontent').html('<img src="loading.png" />');
            setTimeout( function() {   
                                    $("#maincontent").load("ajax_smscreditrequest.php"); 
                                     $("html, body").animate({ scrollTop: $('#maincontent').offset().top }, 1500);                
                                   }, 500);
                               
 
    
  });
  
  $("#smscredithistory").click(function(){
        $('#maincontent').html('<img src="loading.png" />');
            setTimeout( function() {   
                                    $("#maincontent").load("ajax_smscredithistory.php"); 
                                     $("html, body").animate({ scrollTop: $('#maincontent').offset().top }, 1500);                
                                   }, 500);
                               
 
    
  });
  
  $("#api_prepaidtxnbtn").click(function(){
        $('#maincontent').html('<img src="loading.png" />');
            setTimeout( function() {   
                                    $("#maincontent").load("ajax_api_prepaidtxn.php");
                                     $("html, body").animate({ scrollTop: $('#maincontent').offset().top }, 1500); 
                                    }, 0);
    
  });
  
  $("#api_dthtxnbtn").click(function(){
        $('#maincontent').html('<img src="loading.png" />');
            setTimeout( function() {   
                                    $("#maincontent").load("ajax_api_dthtxn.php");
                                     $("html, body").animate({ scrollTop: $('#maincontent').offset().top }, 1500); 
                                    }, 0);
    
  });
  
  $("#api_datacardtxnbtn").click(function(){
        $('#maincontent').html('<img src="loading.png" />');
            setTimeout( function() {   
                                    $("#maincontent").load("ajax_api_datacardtxn.php");
                                     $("html, body").animate({ scrollTop: $('#maincontent').offset().top }, 1500); 
                                    }, 0);
    
  });
  
   $("#api_postpaidtxnbtn").click(function(){
        $('#maincontent').html('<img src="loading.png" />');
            setTimeout( function() {   
                                    $("#maincontent").load("ajax_api_postpaidtxn.php");
                                     $("html, body").animate({ scrollTop: $('#maincontent').offset().top }, 1500); 
                                    }, 0);
    
  });
  
  $("#api_landlinetxnbtn").click(function(){
        $('#maincontent').html('<img src="loading.png" />');
            setTimeout( function() {   
                                    $("#maincontent").load("ajax_api_landlinetxn.php");
                                     $("html, body").animate({ scrollTop: $('#maincontent').offset().top }, 1500); 
                                    }, 0);
    
  });
  
  $("#api_electricitytxnbtn").click(function(){
        $('#maincontent').html('<img src="loading.png" />');
            setTimeout( function() {   
                                    $("#maincontent").load("ajax_api_electricitytxn.php");
                                     $("html, body").animate({ scrollTop: $('#maincontent').offset().top }, 1500); 
                                    }, 0);
    
  });
  
  $("#api_gastxnbtn").click(function(){
        $('#maincontent').html('<img src="loading.png" />');
            setTimeout( function() {   
                                    $("#maincontent").load("ajax_api_gastxn.php");
                                     $("html, body").animate({ scrollTop: $('#maincontent').offset().top }, 1500); 
                                    }, 0);
    
  });
  
  $("#api_insurancetxnbtn").click(function(){
        $('#maincontent').html('<img src="loading.png" />');
            setTimeout( function() {   
                                    $("#maincontent").load("ajax_api_insurancetxn.php");
                                     $("html, body").animate({ scrollTop: $('#maincontent').offset().top }, 1500); 
                                    }, 0);
    
  });
  
  $("#api_antivirustxnbtn").click(function(){
        $('#maincontent').html('<img src="loading.png" />');
            setTimeout( function() {   
                                    $("#maincontent").load("ajax_api_antivirustxn.php");
                                     $("html, body").animate({ scrollTop: $('#maincontent').offset().top }, 1500); 
                                    }, 0);
    
  });
  
  $("#api_smstxnbtn").click(function(){
        $('#maincontent').html('<img src="loading.png" />');
            setTimeout( function() {   
                                    $("#maincontent").load("ajax_api_smstxn.php");
                                     $("html, body").animate({ scrollTop: $('#maincontent').offset().top }, 1500); 
                                    }, 0);
    
  });
  
  $("#api_refundtxnbtn").click(function(){
        $('#maincontent').html('<img src="loading.png" />');
            setTimeout( function() {   
                                    $("#maincontent").load("ajax_api_refundtxnbtn.php");
                                     $("html, body").animate({ scrollTop: $('#maincontent').offset().top }, 1500); 
                                    }, 0);
    
  });
  
  $("#purchasesbtn").click(function(){
        $('#maincontent').html('<img src="loading.png" />');
            setTimeout( function() {   
                                    $("#maincontent").load("ajax_purchasesbtn.php");
                                     $("html, body").animate({ scrollTop: $('#maincontent').offset().top }, 1500); 
                                    }, 0);
    
  });
  
  $("#emp_balancebtn").click(function(){
        $('#maincontent').html('<img src="loading.png" />');
            setTimeout( function() {   
                                    $("#maincontent").load("ajax_emp_balance.php");
                                     $("html, body").animate({ scrollTop: $('#maincontent').offset().top }, 1500); 
                                    }, 0);
    
  });
  
  $("#emp_customersbtn").click(function(){
        $('#maincontent').html('<img src="loading.png" />');
            setTimeout( function() {   
                                    $("#maincontent").load("ajax_emp_customers.php");
                                     $("html, body").animate({ scrollTop: $('#maincontent').offset().top }, 1500); 
                                    }, 0);
    
  });
  
  $("#emp_prepbtn").click(function(){
        $('#maincontent').html('<img src="loading.png" />');
            setTimeout( function() {   
                                    $("#maincontent").load("ajax_emp_prep.php");
                                     $("html, body").animate({ scrollTop: $('#maincontent').offset().top }, 1500); 
                                    }, 0);
    
  });
  
  $("#emp_dthbtn").click(function(){
        $('#maincontent').html('<img src="loading.png" />');
            setTimeout( function() {   
                                    $("#maincontent").load("ajax_emp_dth.php");
                                     $("html, body").animate({ scrollTop: $('#maincontent').offset().top }, 1500); 
                                    }, 0);
    
  });
  
  $("#emp_dcbtn").click(function(){
        $('#maincontent').html('<img src="loading.png" />');
            setTimeout( function() {   
                                    $("#maincontent").load("ajax_emp_dc.php");
                                     $("html, body").animate({ scrollTop: $('#maincontent').offset().top }, 1500); 
                                    }, 0);
    
  });
  
  $("#emp_ppbtn").click(function(){
        $('#maincontent').html('<img src="loading.png" />');
            setTimeout( function() {   
                                    $("#maincontent").load("ajax_emp_pp.php");
                                     $("html, body").animate({ scrollTop: $('#maincontent').offset().top }, 1500); 
                                    }, 0);
    
  });
  
  $("#emp_llbtn").click(function(){
        $('#maincontent').html('<img src="loading.png" />');
            setTimeout( function() {   
                                    $("#maincontent").load("ajax_emp_ll.php");
                                     $("html, body").animate({ scrollTop: $('#maincontent').offset().top }, 1500); 
                                    }, 0);
    
  });
  
  $("#emp_eebtn").click(function(){
        $('#maincontent').html('<img src="loading.png" />');
            setTimeout( function() {   
                                    $("#maincontent").load("ajax_emp_ee.php");
                                     $("html, body").animate({ scrollTop: $('#maincontent').offset().top }, 1500); 
                                    }, 0);
    
  });
  
  $("#emp_gasbtn").click(function(){
        $('#maincontent').html('<img src="loading.png" />');
            setTimeout( function() {   
                                    $("#maincontent").load("ajax_emp_gas.php");
                                     $("html, body").animate({ scrollTop: $('#maincontent').offset().top }, 1500); 
                                    }, 0);
    
  });
  
  $("#emp_insubtn").click(function(){
        $('#maincontent').html('<img src="loading.png" />');
            setTimeout( function() {   
                                    $("#maincontent").load("ajax_emp_insu.php");
                                     $("html, body").animate({ scrollTop: $('#maincontent').offset().top }, 1500); 
                                    }, 0);
    
  });
  
  $("#emp_antbtn").click(function(){
        $('#maincontent').html('<img src="loading.png" />');
            setTimeout( function() {   
                                    $("#maincontent").load("ajax_emp_ant.php");
                                     $("html, body").animate({ scrollTop: $('#maincontent').offset().top }, 1500); 
                                    }, 0);
    
  });
  
  $("#admin_active").click(function(){
        $('#maincontent').html('<img src="loading.png" />');
            setTimeout( function() {   
                                    $("#maincontent").load("ajax_admin_active.php");
                                     $("html, body").animate({ scrollTop: $('#maincontent').offset().top }, 1500); 
                                    }, 0);
    
  });
  
  $("#emp_auditdebitbtn").click(function(){
        $('#maincontent').html('<img src="loading.png" />');
            setTimeout( function() {   
                                    $("#maincontent").load("ajax_emp_auditdebit.php");
                                     $("html, body").animate({ scrollTop: $('#maincontent').offset().top }, 1500); 
                                    }, 0);
    
  });
  $("#emp_auditcreditbtn").click(function(){
        $('#maincontent').html('<img src="loading.png" />');
            setTimeout( function() {   
                                    $("#maincontent").load("ajax_emp_auditcredit.php");
                                     $("html, body").animate({ scrollTop: $('#maincontent').offset().top }, 1500); 
                                    }, 0);
    
  });
  
  $("#api_oldprepaidtxnbtn").click(function(){
        $('#maincontent').html('<img src="loading.png" />');
            setTimeout( function() {   
                                    $("#maincontent").load("ajax_api_oldprepaidtxn.php");
                                     $("html, body").animate({ scrollTop: $('#maincontent').offset().top }, 1500); 
                                    }, 0);
    
  });
  
  $("#api_olddthtxnbtn").click(function(){
        $('#maincontent').html('<img src="loading.png" />');
            setTimeout( function() {   
                                    $("#maincontent").load("ajax_api_olddthtxn.php");
                                     $("html, body").animate({ scrollTop: $('#maincontent').offset().top }, 1500); 
                                    }, 0);
    
  });
  
  $("#kycbtn").click(function(){
        $('#maincontent').html('<img src="loading.png" />');
            setTimeout( function() {   
                                    $("#maincontent").load("ajax_kyc.php"); 
                                     $("html, body").animate({ scrollTop: $('#maincontent').offset().top }, 1500);                
                                   }, 500);
                               
 
    
  });
  
  
  
});
</script>
