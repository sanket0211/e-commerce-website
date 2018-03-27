<section id="page-title" class="page-title-mini" >

    <div class="container clearfix">
        <h1>Create Community</h1>
        <span>Create your own community</span>
        <ol class="breadcrumb">
            <li><a href="<?php echo site_url('home');?>">Home</a></li>
            <li>Create Community</li>
        </ol>
    </div>

</section>
<section id="content">
    <div class="content-wrap row topmargin">

        <div class="container clearfix">
            <div class="col_half" style="border-right:solid #000000;padding-right:50px;">

            <?php 
					
					if(!is_null($error)){
								echo '<div class="style-msg errormsg">';
                            	echo '<div class="sb-msg">'.$error.' '.$info.' '.validation_errors().'</div>';
                        		echo '</div>';
                        	}
                        	?>
    
            <div class="fancy-title title-dotted-border">
                <h3>Create Community</h3>
            </div>
<p style="color:red">fields marked with astericks(*) are compulsory</p>
            <!-- Contact Form
            ============================================= -->
            <?php echo form_open_multipart('home/create_comm',array('class' => 'nobottommargin','id' => 'template-contactform','name' => 'template-contactform')); ?>
                <div class="col_full">
                    <label for="comm_name">Name<span style="color:red;font-size:15px">*</span>:</label>
                    <input type="text" id="comm_name" name="comm_name" pattern="[a-zA-Z0-9 -]{2,200}" class="sm-form-control required" required/>
                </div>

                <div class="clear"></div>

                <!-- <div class="col_full">
                    <label for="comm_privacy">Privacy</label><br/>
                    <input type="radio" name="comm_privacy" class="leftmargin-sm" value="Public" checked/> Public <br>
                    <input type="radio" name="comm_privacy" class="leftmargin-sm" value="Private"/> Private 
                </div> -->

                <div class="col_full">
                    <label for="comm_location">Location<span style="color:red;font-size:15px">*</span>:</label>
                        
                    <select name="comm_location" class="sm-form-control">
                        <?php
                        foreach($cities as $city) {
                            echo '<option value="'.$city->city_id.'">'.$city->city_name.'</option>';
                        }?>
                    </select>

                </div>

                <div class="clear"></div>

                <div class="col_full">
                    <label for="comm_desc">Description<span style="color:red;font-size:15px">*</span>:</label>
                    <textarea class="required sm-form-control" id="comm_desc" name="comm_desc" pattern="[a-zA-Z0-9 ]{10,1000}" rows="6" cols="30" required></textarea>
                </div>

                <div class="clear"></div>
                <div class="col_full">
                    <label for="comm_desc">Cover:</label>
                    <input type="file"  name="userfile" size="20">
                </div>

                <div class="col_full">
                    <input class="button button-3d nomargin" type="submit" id="template-contactform-submit" name="upload" value="Create"/>
                </div>

            </form>

        <!--<script type="text/javascript">
                $("#template-contactform").validate({
                    submitHandler: function(form) {
                        $('.form-process').fadeIn();
                        $(form).ajaxSubmit({
                            target: '#contact-form-result',
                            success: function() {
                                $('.form-process').fadeOut();
                                $('#template-contactform').find('.sm-form-control').val('');
                                $('#contact-form-result').attr('data-notify-msg', $('#contact-form-result').html()).html('');
                                SEMICOLON.widget.notifications($('#contact-form-result'));
                            }
                        });
                    }
                });
            </script> -->

            </div><!-- Contact Form Overlay End -->

            <div class="col_half col_last">


                        <div>
                            <!--<h3 class="uppercase" style="font-weight: 600;">Create your community</h3>
                            <p style="line-height: 1.8;">
                            <li>Post any item you want to rent and all members of the community can see it.</li> 
                            <li>invite members and grow your community big.</li>
                            <li>view all the items which the members of your community have put on rent.</li>
                            <li>View all members of your community along with their profile picture.</li>
                            
                            </p>-->
                            <img src="<?php echo base_url().'assets/images/smartart/createcommunity.png';?>" width=600px height=700px class=" notopmargin" alt="Image" title="Image" data-animate="bounce"/>

                            
                        
                    </div>
            </div>
        </div>
    </div>
</section>
<!-- <div class="content-wrap row topmargin">
 		<div class="clearfix col_half">
			<?php //echo $error ;?> 
			<?php //echo validation_errors(); ?>
			<?php //echo form_open_multipart('home/create_comm'); ?>
	<label for="comm_name">Community</label>
	<input id="comm_name" type="text" pattern="[a-zA-Z0-9 -]{2,200}" name="comm_name" required />
	<br>
	<label for="comm_desc">Description</label>
	<textarea id="comm_desc" rows="5" cols="40"  pattern="[a-zA-Z0-9 ]{10,1000}" name="comm_desc" required></textarea>
	<br>
	<br>
   	Privacy
	<input type="radio" name="comm_privacy" value="Public" checked>Public
	<input type="radio" name="comm_privacy" value="Private">Private
	<br>
	</br>
	Community Photo<br><input type="file" name="userfile" size="20">
	<br>
	<br>
   	<input type="submit" name="upload" value="Submit">
	</form>
</div>
</div>
 -->