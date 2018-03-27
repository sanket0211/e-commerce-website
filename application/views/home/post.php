<section id="page-title">

    <div class="container clearfix">
        <h1>Post item</h1>
        <span>Post an advertisement for your product</span>
        <ol class="breadcrumb">
            <li><a href="<?php echo site_url('home');?>">Home</a></li>
            <li><a href="#"><?php //echo $community_list->community_name; ?></a></li>
            <li class="active">Post Item</li>

        </ol>
    </div>

</section>


<section id="map-overlay">

    <div class="container clearfix">
        <a href="#" class="btn btn-success" data-notify-type="success" data-notify-msg="<i class=icon-ok-sign></i> Message Sent Successfully!" onclick="SEMICOLON.widget.notifications(this); return false;">Show Success</a>
        <a href="#" class="btn btn-warning" data-notify-type="warning" data-notify-msg="<i class=icon-warning-sign></i> Don't try to be too Smart!" onclick="SEMICOLON.widget.notifications(this); return false;">Show Warning</a> 
        <a href="#" class="btn btn-info" data-notify-type="info" data-notify-msg="<i class=icon-info-sign></i> Welcome to Canvas Demo!" onclick="SEMICOLON.widget.notifications(this); return false;">Show Info</a>
        <a href="#" class="btn btn-danger" data-notify-type="error" data-notify-msg="<i class=icon-remove-sign></i> Incorrect Input. Please Try Again!" onclick="SEMICOLON.widget.notifications(this); return false;">Show Error</a>
        <?php
        $tmp = validation_errors();
        if ($tmp) {
            echo '<div class="style-msg alertmsg">';
            echo    '<div class="sb-msg">'.$tmp.'</div>';
            echo '</div>';
        }
        if ($error) {
            echo '<div class="style-msg alertmsg">';
            echo    '<div class="sb-msg">'.$error.'</div>';
            echo '</div>';
        }
        if ($info) {
            echo '<div class="style-msg alertmsg">';
            echo    '<div class="sb-msg">'.$info.'</div>';
            echo '</div>';
        }
        ?>
        <!-- Contact Form Overlay
        ============================================= -->
        <?php
        if(is_null($adpostinginfo)){
            echo '<div class="style-msg alertmsg">';
            echo    '<div class="sb-msg"><i class="icon-warning-sign"></i><strong>Warning!</strong>'.$warn.'</div>';
            echo '</div>';
        }
        else{
            echo '<div class="style-msg infomsg">';
            echo '   <div class="sb-msg"><i class="icon-info-sign"></i>'.$adpostinginfo.'</div>';
            echo '</div>';
        }
        
        ?>
        <div id="" class="clearfix pull-left">

            <div id="contact-form-result" data-notify-type="success" data-notify-msg="<i class=icon-ok-sign></i> Message Sent Successfully!"></div>
            </div>
            
            <p style="color:red">fields marked with astericks(*) are compulsory</p>
            <?php echo form_open_multipart('itemstuff/post/'.$comm_id, array('class'=>'nobottommargin form-group','name'=>'post-item-form','onsubmit'=>'return checkCheckBox(this)'));?>
                
                <div class="row">

                    <div class="col-md-7">
                        <label for="item_name"><b>Name</b><span style="color:red;font-size:15px">*</span>:</label>
                        <input type="text" id="template-contactform-name" name="item_name" value="<?php echo set_value('item_name'); ?>" class="sm-form-control" required />
                        <p>e.g. Peshwari Sherwani (Red), Sony Vaio VPCEH18FG Laptop, Quechua T2 Tent, Steel Wheelchair</p>
                    </div>
                </div>

                <div class="row">

                <div class="col-md-10">
                    <label for="keyfeatures"><b>Key Features</b><span style="color:red;font-size:15px">*</span>:</label>
                    <input type="text" id="template-contactform-name" name="keyfeatures" value="<?php echo set_value('keyfeatures'); ?>" class="sm-form-control" required />
                    <p>e.g. Zardozi Work, 4GB RAM, Waterproof, Steel Frame</p>
                </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <label for="item_cat_id">Category<span style="color:red;font-size:15px">*</span>:</label>
                        <select id="item_cat" name="item_cat_id" class="sm-form-control" value="" required>
                            <option value="">---Select category --- </option>
                            <?php
                                foreach($categories as $category) {
                                    echo '<option value="'.$category->category_id.'">'.$category->category_name.'</option>';
                            }?>
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label for="item_sub_cat_id">Sub-category<span style="color:red;font-size:15px">*</span>:</label>
                        <select id="item_sub_cat" name="item_sub_cat_id" class="sm-form-control" value="" required>
                            <option value="">---Select category --- </option>
                        </select>
                    </div>
                </div>

                <div class="clear"></div>

                <div class="row">
                    <div class="topmargin col-md-6">
                        <label for="item_rent">Rent price<span style="color:red;font-size:15px">*</span>:</label>
                        <input type="number" pattern="[0-9]{1,10}" id="template-contactform-subject" name="item_rent" value="<?php echo set_value('item_rent'); ?>" class="required sm-form-control" required/>
                        <p>Rent Price is in terms of Gold Coins / day. Re. 1 = 10 gold coins <p>
                    </div>

                    <div class="topmargin col-md-6">
                        <label for="item_rent">Purchase Price<span style="color:red;font-size:15px">*</span>:</label>
                        <input type="number" pattern="[0-9]{1,10}" id="template-contactform-subject" name="item_price" value="<?php echo set_value('item_price'); ?>" class="required sm-form-control" required/>
                    </div>

                </div> 

                <div class="row">
                    <div class="col-md-9 topmargin">
                        <label for="item_desc">Description<span style="color:red;font-size:15px">*</span>:</label>
                        <textarea class="required sm-form-control" id="template-contactform-message" name="item_desc" rows="3" cols="30" required><?php echo set_value('item_desc'); ?></textarea>
                        <p>e.g. color, size, working conditions, how old it is, etc</p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-7 topmargin">
                        <label for="userfile">Item photo(max allowed size: 5MB)<span style="color:red;font-size:15px">*</span>:</label>
                        <input class="nomargin" type="file" id="template-contactform-submit" name="userfile"required>
                    </div>
                </div>

                <div class="row">

                    <div class="col-md-7 topmargin">
                        <label for="item_name"><b>Brand</b>:</label>
                        <?php echo form_error('item_name'); ?>
                        <input type="text" id="template-contactform-name" pattern="[a-zA-Z0-9 -]{1,200}" name="item_brand" value="<?php echo set_value('item_brand'); ?>" class="sm-form-control" />
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-7 topmargin">
                        <label for="item_desc">Terms &amp; Conditions if any :</label>
                        <textarea class="required sm-form-control" id="template-contactform-message" name="item_terms" rows="3" cols="30" ><?php echo set_value('item_terms'); ?></textarea>
                        <p>e.g. need advance, want it back on time, borrower fined if item damaged, etc.</p>
                    </div>
                </div>


                <div class="col_full topmargin">
                    <h4>I accept the <a href="<?php echo site_url('home/termsandconditions');?>">terms and conditions</a>: <input type="checkbox" value="0" name="agree"></h4>
                    <h5>BY CLICKING "I ACCEPT", YOU HEREBY STATE THAT YOU HAVE CAREFULLY READ THE TERMS OF THE AGREEMENT AND AGREE TO ENTER INTO BINDING CONTRACT WITH RENTOOZ DULY ENFORCEABLE UNDER LAWS OF INDIA. </h5>
                </div>

                <div class="col_full">
                    <input class="button button-3d nomargin" type="submit" id="template-contactform-submit" name="upload" value="submit">
                </div>

            </form>

        </div><!-- Contact Form Overlay End -->

    </div>
</section>
<script type="text/javascript">  
$(document).ready(function() {  
    $("#item_cat").change(function(){ 
    /*dropdown post *///  
        $.ajax({  
            url:"<?php echo site_url('home/getDropDown') ;?>",  
            data: {category_id:  $(this).val()},
            type: "POST",  
            success:function(data){  
                $("#item_sub_cat").html(data);  
            }  
        });  
    });  
});  
</script> 

<SCRIPT language=JavaScript>
<!--

//Accept terms & conditions script (by InsightEye www.insighteye.com)
//Visit JavaScript Kit (http://javascriptkit.com) for this script & more.

function checkCheckBox(f){
if (f.agree.checked == false )
{
alert('Please check the box to continue.');
return false;
}else
return true;
}
//-->
</SCRIPT>  
