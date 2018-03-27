<section id="page-title">

    <div class="container clearfix">
        <h1>Review</h1>
        <span>Review the borrower</span>
        <ol class="breadcrumb">
            <li><a href="<?php echo site_url('home');?>">Home</a></li>
            <li class="active">Review</li>
        </ol>
    </div>

</section>
<section id="content">

	<div class="content-wrap">

		<div class="container clearfix">

			<div class="col_half">
				<div class="panel panel-default">
					<div class="panel-body">
						Returning customer? <a href="login-register.html">Click here to login</a>
					</div>
				</div>
			</div>
			<div class="col_half col_last">
				<div class="panel panel-default">
					<div class="panel-body">
						Have a coupon? <a href="login-register.html">Click here to enter your code</a>
					</div>
				</div>
			</div>

			<div class="row clearfix">
				<div class="col-md-3">
					<div class="product iproduct clearfix">
                        <div class="product-image">
                            <a href="#"><img src="<?php echo base_url() . 'uploads/profile/' . $borrower->user_img_name . $borrower->user_img_ext; ?>" alt="Checked Short Dress"></a>
                        </div>
                        <div class="product-desc center">
                            <div class="product-title"><h3><?php echo $borrower->user_name; ?></h3></div>
                            <div class="product-title"><h5>The borrower</h5></div>
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
                            <div class="product-title"><h5>Your item</h5></div>
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
					<?php echo form_open('submit_user_review',array('class' => 'nobottommargin','id'=>'borrower-review-form', 'name'=>'shipping-form')); ?>
						<input type="hidden" name="deal_id" id="deal_id" value="<?php echo $deal_id ;?>"/>	
                        <div class="col_full">
                            <label for="borrower-behaviour">How was the behaviour of the giver during deal ?</label><span style="color:red;font-size:15px">*</span>
                            <div id="star-rating-1">
                                <input type="radio" name="borrower-behaviour" class="rating" value="1" required/>
                                <input type="radio" name="borrower-behaviour" class="rating" value="2" required/>
                                <input type="radio" name="borrower-behaviour" class="rating" value="3" required/>
                                <input type="radio" name="borrower-behaviour" class="rating" value="4" required/>
                                <input type="radio" name="borrower-behaviour" class="rating" value="5" required/>
                            </div>
                            <input type="hidden" name="borrower-behaviour" id="borrower-behaviour" value=""/>
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
                            <label for="borrower-timing">Did the giver came on time during exchange of the item ?</label><span style="color:red;font-size:15px">*</span>
                            <div id="star-rating-3">
                                <input type="radio" name="borrower-timing" class="rating" value="1" required/>
                                <input type="radio" name="borrower-timing" class="rating" value="2" required/>
                                <input type="radio" name="borrower-timing" class="rating" value="3" required/>
                                <input type="radio" name="borrower-timing" class="rating" value="4" required/>
                                <input type="radio" name="borrower-timing" class="rating" value="5" required/>
                            </div>
                            <input type="hidden" name="borrower-timing" id="borrower-timing" value=""/>
                        </div>

                        <div class="col_full">
                            <label for="other-comment"> Any other comment <small>*</small></label>
                            <textarea class="sm-form-control" id="comment" name="comment" rows="6" cols="30"></textarea>
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
        $('#borrower-behaviour').val(vote);
    });
    $('#star-rating-2').rating(function(vote, event){
        $('#item-condition').val(vote);
    });
    $('#star-rating-3').rating(function(vote, event){
        $('#borrower-timing').val(vote);
    });
});
</script>