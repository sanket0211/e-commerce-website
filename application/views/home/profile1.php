<script>

    document.getElementById("howitworks").className = 'mega-menu';
    document.getElementById("products").className = 'mega-menu';
    document.getElementById("aboutus").className = 'mega-menu';
    document.getElementById("contactus").className = 'mega-menu';
    document.getElementById("faqs").className = 'mega-menu';
    document.getElementById("profile").className = 'current';

</script>


<section id="page-title">

    <div class="container clearfix">
        <h1>My Profile</h1>
        <span>View your entire profile</span>
        <ol class="breadcrumb">
            <li><a href="<?php echo site_url('home');?>">Home</a></li>
            <li class="active">Profile</li>
        </ol>
    </div>

</section>

<div class="section nobg topmargin-lg nobottommargin">
    <div class="container clearfix">
        
        
        <?php
        if($error){
            echo '<div class="style-msg errormsg">';
            echo  '<div class="sb-msg"><i class="icon-remove"></i><strong>Oh snap!</strong>'.$error.'</div>';
            echo '</div>';
        }
        if($info){
            echo '<div class="style-msg successmsg">';
            echo    '<div class="sb-msg"><i class="icon-thumbs-up"></i><strong>Well done!</strong>'.$info.'</div>';
            echo '</div>';
        }
        ?>
        <div class="col_half nobottommargin center">

            <img src="https://graph.facebook.com/<?php echo $fb_id; ?>/picture?height=400" alt"profile picture" data-animate="fadeInLeftBig">
            <?php echo $error ;?>
        <?php echo validation_errors(); ?>
        <?php echo form_open_multipart('home/changeprofilephoto',array('role'=>'form'));?>
        <div class="form-group">
            <input type="file" name="userfile" size="20"/>
            <input type="submit" value="Change Profile Photo" name="upload" />
        </div>
        </form>
        </div>
        <div class="col_half nobottommargin col_last">

            <div class="heading-block" style="padding-top: 40px;">
                <h2><?php echo $user_name ?></h2>
            </div>

            <p>Phone Number: <?php echo $user_phone ?><button class="button button-small button-rounded" data-toggle="modal" data-target=".all-demands-modal">edit</button></p>
            <p>Email Id: <?php echo $user_email ?></p>

            <!--modal for changing phoe number-->
            <div class="modal fade all-demands-modal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-body">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                <h4 class="modal-title" id="myModalLabel">ENTER MOBILE NUMBER</h4>

                            </div>
                            <div class="modal-body">
                                <?php echo form_open_multipart('home/changemobilenumber',array('role'=>'form'));?>
                                    <div class="form-group">
                                       
                                        <label for="user_phone">Phone:</label>
                                        <input type='tel' pattern='\d{10}' class="form-control" title='Phone Number Format: 9999999999' name="user_phone" required>
                                        
                                        <input type="submit" value="submit" name="upload" />
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        
        <?php
            if($isMobileVerified == 0){
                echo '<button onclick="gen_otp()" class="button button-border button-large button-rounded topmargin-sm noleftmargin" data-toggle="modal" data-target=".otp-box">Verify mobile</button>';
                //echo '<button href="#" class="button button-border button-large button-rounded topmargin-sm noleftmargin">Verify mobile</a>';
            }
            ?>
        </div>

    </div>
</div>
<?php // put otp here ;?>
<div class="modal fade bs-example-modal-sm otp-box" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-body">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">Enter OTP</h4>
                </div>
                <div class="modal-body">
                    <?php echo form_open_multipart('home/verify_mobile/',array('class' => 'nobottommargin','id'=>'otp-form')); ?>
                        <input type="text" id="mob_otp" name="mob_otp" title="please enter 4 digit OTP" pattern="[0-9]{4}" class="bottonmargin required" required/>
                        <input class="button button-3d button-mini inline-block" type="submit" name="submit" value="submit"/>
                    </form>
                    <button onclick="resend_otp();" class="inline-block button button-3d button-mini">Resend OTP</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function gen_otp(){
    var $tmp = $.get("<?php echo site_url('home/gen_otp') ;?>");
    console.log($tmp); 
 }
function resend_otp(){
    var $tmp = $.get("<?php echo site_url('home/send_otp') ;?>");
    console.log($tmp); 
}
</script>





