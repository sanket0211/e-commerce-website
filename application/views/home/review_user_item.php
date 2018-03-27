<section id="page-title">

    <div class="container clearfix">
        <h1>Review</h1>
        <span>Review the giver and his item</span>
        <ol class="breadcrumb">
            <li><a href="<?php echo site_url('home');?>">Home</a></li>
            <li class="active">Review</li>
        </ol>
    </div>

</section>
<section id="content">

	<div class="content-wrap">

		<div class="container clearfix">
        <?php echo $error; ?>
        <?php echo $info; ?>
        
			
			<div class="row clearfix">
				<div class="col-md-3">
					<div class="product iproduct clearfix">
                        <div class="product-image">
                            <a href="#"><img src="<?php echo base_url() . 'uploads/profile/' . $giver->user_img_name . $giver->user_img_ext; ?>" alt="Checked Short Dress"></a>
                        </div>
                        <div class="product-desc center">
                            <div class="product-title"><h3><?php echo $giver->user_name; ?></h3></div>
                            <div class="product-title"><h5>The giver</h5></div>
                            <div class="product-rating">
                                <i class="icon-star3"></i>
                                <i class="icon-star3"></i>
                                <i class="icon-star3"></i>
                                <i class="icon-star3"></i>
                                <i class="icon-star-half-full"></i>
                            </div>
                        </div>
                    </div>
                    <div class="product iproduct clearfix">
                        <div class="product-image">
                            <a href="#"><img src="<?php echo base_url() . 'uploads/items/' . $item->item_img_name . $item->item_img_ext; ?>" alt="Checked Short Dress"></a>
                            <a href="#"><img src="<?php echo base_url() . 'uploads/items/' . $item->item_img_name . $item->item_img_ext; ?>" alt="Checked Short Dress"></a>
                        </div>
                        <div class="product-desc center">
                            <div class="product-title"><h3><?php echo $item->item_name; ?></h3></div>
                            <div class="product-title"><h5>Item borrowed</h5></div>
                            <div class="product-price"><del>$24.99</del> <ins>$12.49</ins></div>
                            <div class="product-rating">
                                <i class="icon-star3"></i>
                                <i class="icon-star3"></i>
                                <i class="icon-star3"></i>
                                <i class="icon-star3"></i>
                                <i class="icon-star-half-full"></i>
                            </div>
                        </div>
                    </div>
				</div>
				
				<div class="col-md-9">
					<h3 class="">Review</h3>
					<?php echo form_open('submit_user_item_review',array('class' => 'nobottommargin','id'=>'giver-review-form', 'name'=>'shipping-form')); ?>
						<input type="hidden" name="deal_id" id="deal_id" value="<?php echo $deal_id ;?>"/>	
                        <div class="col_full">
                            <label for="giver-behaviour">How was the behaviour of the giver during deal ?</label><span style="color:red;font-size:15px">*</span>
                            <div id="star-rating-1">
                                <input type="radio" name="giver-behaviour" class="rating" value="1" required/>
                                <input type="radio" name="giver-behaviour" class="rating" value="2" required/>
                                <input type="radio" name="giver-behaviour" class="rating" value="3" required/>
                                <input type="radio" name="giver-behaviour" class="rating" value="4" required/>
                                <input type="radio" name="giver-behaviour" class="rating" value="5" required/>
                            </div>
                            <input type="hidden" name="giver-behaviour" id="giver-behaviour" value=""/>
                        </div>

                        <div class="col_full">
                            <label for="item-condition">Did the giver gave the item in shown condition ?</label><span style="color:red;font-size:15px">*</span>
                            <div id="star-rating-2">
                                <input type="radio" name="item-condition" class="rating" value="1" required/>
                                <input type="radio" name="item-condition" class="rating" value="2" required/>
                                <input type="radio" name="item-condition" class="rating" value="3" required/>
                                <input type="radio" name="item-condition" class="rating" value="4" required/>
                                <input type="radio" name="item-condition" class="rating" value="5" required/>
                            </div>
                            <input type="hidden" name="item-condition" id="item-condition" value=""/>
                        </div>

                        <div class="col_full">
                            <label for="giver-timing">Did the giver came on time during exchange of the item ?</label><span style="color:red;font-size:15px">*</span>
                            <div id="star-rating-3">
                                <input type="radio" name="giver-timing" class="rating" value="1" required/>
                                <input type="radio" name="giver-timing" class="rating" value="2" required/>
                                <input type="radio" name="giver-timing" class="rating" value="3" required/>
                                <input type="radio" name="giver-timing" class="rating" value="4" required/>
                                <input type="radio" name="giver-timing" class="rating" value="5" required/>
                            </div>
                            <input type="hidden" name="giver-timing" id="giver-timing" value=""/>
                        </div>

                        <div class="col_full">
                            <label for="other-comment"> Any other comment <small>*</small></label>
                            <textarea class="sm-form-control" id="comment" name="comment" rows="6" cols="30"></textarea>
                        </div>
                        

                        <div class="col_full">
                            <label for="item-usefulness">How much the item was useful to you ?</label><span style="color:red;font-size:15px">*</span>
                            <div id="star-rating-4">
                                <input type="radio" name="item-usefulness" class="rating" value="1" required/>
                                <input type="radio" name="item-usefulness" class="rating" value="2" required/>
                                <input type="radio" name="item-usefulness" class="rating" value="3" required/>
                                <input type="radio" name="item-usefulness" class="rating" value="4" required/>
                                <input type="radio" name="item-usefulness" class="rating" value="5" required/>
                            </div>
                            <input type="hidden" name="item-usefulness" id="item-usefulness" value=""/>
                        </div>

                        <div class="col_full">
                            <label for="item-rent-appropriate">Is rent price of the item is appropriate ?</label><span style="color:red;font-size:15px">*</span>
                            <div id="star-rating-5">
                                <input type="radio" name="item-rent-appropriate" class="rating" value="1" required/>
                                <input type="radio" name="item-rent-appropriate" class="rating" value="2" required/>
                                <input type="radio" name="item-rent-appropriate" class="rating" value="3" required/>
                                <input type="radio" name="item-rent-appropriate" class="rating" value="4" required/>
                                <input type="radio" name="item-rent-appropriate" class="rating" value="5" required/>
                            </div>
                            <input type="hidden" name="item-rent-appropriate" id="item-rent-appropriate" value=""/>
                        </div>

                        <div class="col_full">
                            <label for="item-review-comment">Comment about the item <small>*</small></label>
                            <textarea class="sm-form-control" id="item-review-comment" name="item-review-comment" rows="6" cols="30"></textarea>
                        </div>

                        <div class="col_full">
							<input class="button button-3d button-large" type="submit" name="submit" value="submit"/>
						<div class="col_full">
                        
                    </form>
				</div>
				<div class="clear bottommargin"></div>
				
			</div>
		</div>

	</div>

</section><!-- #content end -->

<script type="text/javascript">
$(function(){
    $('#star-rating-1').rating(function(vote, event){
        $('#giver-behaviour').val(vote);
    });
    $('#star-rating-2').rating(function(vote, event){
        $('#item-condition').val(vote);
    });
    $('#star-rating-3').rating(function(vote, event){
        $('#giver-timing').val(vote);
    });
    $('#star-rating-4').rating(function(vote, event){
        $('#item-usefulness').val(vote);
    });
    $('#star-rating-5').rating(function(vote, event){
        $('#item-rent-appropriate').val(vote);
    });
});
</script>