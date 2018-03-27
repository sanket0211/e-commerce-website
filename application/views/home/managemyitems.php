<script>

    document.getElementById("howitworks").className = 'mega-menu';
    document.getElementById("aboutus").className = 'mega-menu';
    document.getElementById("contactus").className = 'mega-menu';
    document.getElementById("faqs").className = 'mega-menu';

    document.getElementById("community").className = 'mega-menu';
    document.getElementById("home").className = 'mega-menu'
    document.getElementById("products").className = 'current';
</script>


<!-- Content 
============================================= -->
<section id="page-title">

	<div class="container clearfix">
	    <h1>Manage My Products</h1>
	    <span>View all my products</span>
	    <ol class="breadcrumb">
	        <li><a href="active">Home</a></li>
	    </ol>
	</div>

</section>

<section id="content">
    <div class="content-wrap">
        <div class="container clearfix">
                <?php
                if($info){
                    echo '<div class="alert alert-info">';
                    echo '    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
                    echo '    <i class="icon-magic"></i><strong>Well done!</strong>'.$info ;
                    echo '</div>';
                }
                if($error){
                    echo '<div class="alert alert-warning">';
                    echo '    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
                    echo '<i class="icon-warning-sign"></i>'.$error ;
                    echo '</div>';
                }
                ?>
                    <!-- Post Content
                    ============================================= -->
            <div class="nobottommargin clearfix notopmargin">
            	<div class="tabs clearfix" id="tabs" data-speed="700" data-active="1" >
					<ul class="nav nav-tabs nav-justified clearfix" style="tab-size:100px">
						<li class="my-li active" ><a href="#tab-1"><strong>Active Items</strong></a></li>
						<li class="my-li" ><a href="#tab-2"><strong>Non - Active Items</strong></a></li>
					</ul>
                    
						<div class="tab-content clearfix" id="tab-1">
							<?php 
								echo '<div class="section nobottommargin notopmargin">';

						        echo '<div class="container clearfix">';

						        //    <!-- Portfolio Filter
						        //    ============================================= -->
						        echo '    <ul id="portfolio-filter" class="clearfix">';

						        echo '        <li class="activeFilter"><a href="#" data-filter="*">Show All</a></li>';
						        echo '        <li><a href="#" data-filter=".pf-elec">Electronics</a></li>';
						        echo '        <li><a href="#" data-filter=".pf-men">Men</a></li>';
						        echo '        <li><a href="#" data-filter=".pf-women">Women</a></li>';
						        echo '        <li><a href="#" data-filter=".pf-baby">Baby & Kids</a></li>';
						        echo '        <li><a href="#" data-filter=".pf-home">Home & Furniture</a></li>';
						        echo '        <li><a href="#" data-filter=".pf-media">Books & Media</a></li>';
						        echo '        <li><a href="#" data-filter=".pf-sports">Auto & Sports</a></li>';

						        echo '    </ul>';//<!-- #portfolio-filter end -->

						        

						        echo '    <div class="clear"></div>';

						        //    <!-- Portfolio Items
						        //    ============================================= -->
						        echo '    <div id="portfolio1" class="portfolio-nomargin clearfix">';

						        if($activeitems!=-1 and count($activeitems)>0) {
									foreach($activeitems as $item) {
									/*echo '	<tr class="cart_item">';
									echo '		<td class="cart-product-thumbnail">';

									echo '			<a href="#"><img width="64" height="64" src="'.base_url().'uploads/items/'.$item->item_img_name.$item->item_img_ext.'" alt="Pink Printed Dress" alt="Pink Printed Dress"></a>';

									echo '		</td>';
									echo '		<td class="cart-product-name">';
									echo '			<a href="#">'.$item->item_name.'</a>';
									echo '		</td>';
									echo '		<td class="cart-product-price">';
									echo '			<span class="amount">'.$item->item_end_date.'</span>';
									echo '		</td>';
									echo '		<td class="cart-product-subtotal">';
									echo '			<span class="amount">'.$item->item_rent.'</span>';
									echo '		</td>';
									echo '	</tr>';*/

									/*echo '<div class="product clearfix">';
			                        echo    '<div class="product-image">';
			                        echo '			<a href="#"><img src="'.base_url().'uploads/items/'.$item->item_img_name.$item->item_img_ext.'" alt="Pink Printed Dress" alt="Pink Printed Dress"></a>';
			                        echo        '<div class="sale-flash">50% Off*</div>';
			                                <div class="product-overlay">
			                                    <a href="#" class="add-to-cart"><i class="icon-shopping-cart"></i><span> Add to Cart</span></a>
			                                    <a href="include/ajax/shop-item.html" class="item-quick-view" data-lightbox="ajax"><i class="icon-zoom-in2"></i><span> Quick View</span></a>
			                                </div>
			                        echo    '</div>';
			                        echo    '<div class="product-desc">';
			                        echo        '<div class="product-title"><h3><a href="#">'.$item->item_name.'</a></h3></div>';
			                        echo        '<div class="product-price"><ins>'.$item->item_rent.'</ins></div>';
			                        echo    '</div>';
			                        echo '</div>';
	*/
			                        if($item->category_id == 1){
				                	   echo '<article class="portfolio-item pf-elec">';
				                    }
				                    else if($item->category_id == 2){
				                       echo '<article class="portfolio-item pf-men">';
				                    }
				                    else if($item->category_id == 3){
				                       echo '<article class="portfolio-item pf-women">';
				                    }
				                    else if($item->category_id == 4){
				                       echo '<article class="portfolio-item pf-baby">';
				                    }
				                    else if($item->category_id == 5){
				                       echo '<article class="portfolio-item pf-home">';
				                    }
				                    else if($item->category_id == 6){
				                       echo '<article class="portfolio-item pf-media">';
				                    }
				                    else if($item->category_id == 7){
				                       echo '<article class="portfolio-item pf-sports">';
				                    }
				                 	echo '   <div class="portfolio-image">';
					                echo '       <a href="portfolio-single.html">';
									echo '           <img src="'.base_url().'uploads/items/'.$item->item_img_name.$item->item_img_ext.'" alt="Open Imagination">';
				              		echo '         </a>';
				                	echo '        <div class="portfolio-overlay">';
				                	echo '            <a href="'.base_url().'uploads/items/'.$item->item_img_name.$item->item_img_ext.'" class="left-icon" data-lightbox="image"><i class="icon-line-plus"></i></a>';
				                	echo '            <a href="'.site_url('home/item/'.$item->item_id).'" class="right-icon"><i class="icon-line-ellipsis"></i></a>';
				                	echo '        </div>';
				                	echo '    </div>';
				                	echo '    <div class="portfolio-desc">';
				                 	echo '       <h3><a href="'.site_url('home/item/'.$item->item_id).'">'.$item->item_name.'</a></h3>';

				                 	echo '       <h3><a href="'.site_url('home/item/'.$item->item_id).'">'.$item->item_rent	.'</a></h3>';
                        			echo '		<button class="btn btn-danger" data-toggle="modal" data-target=".'.$item->item_id.'">Deactivate</button>';
                        			echo '<div class="modal fade '.$item->item_id.'" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">';
			                        echo '    <div class="modal-dialog modal-lg">';
			                        echo '        <div class="modal-body">';
			                        echo '            <div class="modal-content">';
			                        echo '                <div class="modal-header">';
			                        echo '                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>';
			                        echo '                    <h4 class="modal-title" id="myModalLabel">Deactivate Item</h4>';
			                        echo '                </div>';
			                        echo '                <div class="modal-body">';
			                                     echo '<h3>Are you sure you would like to deactivate '.$item->item_name.' ??</h3>';
			                                            echo form_open('itemstuff/deactivateitem/'.$item->item_id,array('name'=>'login-form','id'=>'login-form','class'=>'nobottommargin'));
			                                             echo '<div class="modal-footer">';
			                                            echo '<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>';
			                                            echo '<input type="submit" class="btn btn-primary" id="login-form-submit" name="login-form-submit" value="Go">';
			                                            echo '</div>';
			                                            echo '</form>';

			                        echo '                 </div>';
			                        echo '            </div>';
			                        echo '        </div>';
			                        echo '    </div>';
			                        echo '</div>';

				                	echo '        <span><a href="#">'.$item->sub_category.'</a>, <a href="#">'.$item->category.'</a></span>';
				               		echo '     </div>';
				               		echo ' </article>';

									}
								}
							?>
								</div>
							</div>
						</div>
					   </div>
					   
					   <div class="tab-content clearfix" id="tab-2">
						<!--This is Tab 2 Content -->
							
										<?php 

										echo '<div class="section nobottommargin notopmargin">';

								        echo '<div class="container clearfix">';

								        //    <!-- Portfolio Filter
								        //    ============================================= -->
								        echo '    <ul id="portfolio-filter" class="clearfix">';

								        echo '        <li class="activeFilter"><a href="#" data-filter="*">Show All</a></li>';
								        echo '        <li><a href="#" data-filter=".pf-elec">Electronics</a></li>';
								        echo '        <li><a href="#" data-filter=".pf-men">Men</a></li>';
								        echo '        <li><a href="#" data-filter=".pf-women">Women</a></li>';
								        echo '        <li><a href="#" data-filter=".pf-baby">Baby & Kids</a></li>';
								        echo '        <li><a href="#" data-filter=".pf-home">Home & Furniture</a></li>';
								        echo '        <li><a href="#" data-filter=".pf-media">Books & Media</a></li>';
								        echo '        <li><a href="#" data-filter=".pf-sports">Auto & Sports</a></li>';

								        echo '    </ul>';//<!-- #portfolio-filter end -->

								        echo '    <div id="portfolio-shuffle">';
								        echo '        <i class="icon-random"></i>';
								        echo '    </div>';

								        echo '    <div class="clear"></div>';

								        //    <!-- Portfolio Items
								        //    ============================================= -->
								        echo '    <div id="portfolio" class="portfolio-nomargin clearfix">';

								        if($notactiveitems!=-1 and count($notactiveitems)>0){
										foreach($notactiveitems as $item) {
										/*echo '	<tr class="cart_item">';
										echo '		<td class="cart-product-thumbnail">';

										echo '			<a href="#"><img width="64" height="64" src="'.base_url().'uploads/items/'.$item->item_img_name.$item->item_img_ext.'" alt="Pink Printed Dress" alt="Pink Printed Dress"></a>';

										echo '		</td>';
										echo '		<td class="cart-product-name">';
										echo '			<a href="#">'.$item->item_name.'</a>';
										echo '		</td>';
										echo '		<td class="cart-product-price">';
										echo '			<span class="amount">'.$item->item_end_date.'</span>';
										echo '		</td>';
										echo '		<td class="cart-product-subtotal">';
										echo '			<span class="amount">'.$item->item_rent.'</span>';
										echo '		</td>';
										echo '	</tr>';*/

										/*echo '<div class="product clearfix">';
				                        echo    '<div class="product-image">';
				                        echo '			<a href="#"><img src="'.base_url().'uploads/items/'.$item->item_img_name.$item->item_img_ext.'" alt="Pink Printed Dress" alt="Pink Printed Dress"></a>';
				                        echo        '<div class="sale-flash">50% Off*</div>';
				                                <div class="product-overlay">
				                                    <a href="#" class="add-to-cart"><i class="icon-shopping-cart"></i><span> Add to Cart</span></a>
				                                    <a href="include/ajax/shop-item.html" class="item-quick-view" data-lightbox="ajax"><i class="icon-zoom-in2"></i><span> Quick View</span></a>
				                                </div>
				                        echo    '</div>';
				                        echo    '<div class="product-desc">';
				                        echo        '<div class="product-title"><h3><a href="#">'.$item->item_name.'</a></h3></div>';
				                        echo        '<div class="product-price"><ins>'.$item->item_rent.'</ins></div>';
				                        echo    '</div>';
				                        echo '</div>';
*/
				                        if($item->category_id == 1){
					                	   echo '<article class="portfolio-item pf-elec">';
					                    }
					                    else if($item->category_id == 2){
					                       echo '<article class="portfolio-item pf-men">';
					                    }
					                    else if($item->category_id == 3){
					                       echo '<article class="portfolio-item pf-women">';
					                    }
					                    else if($item->category_id == 4){
					                       echo '<article class="portfolio-item pf-baby">';
					                    }
					                    else if($item->category_id == 5){
					                       echo '<article class="portfolio-item pf-home">';
					                    }
					                    else if($item->category_id == 6){
					                       echo '<article class="portfolio-item pf-media">';
					                    }
					                    else if($item->category_id == 7){
					                       echo '<article class="portfolio-item pf-sports">';
					                    }
					                 	echo '   <div class="portfolio-image">';
						                echo '       <a href="portfolio-single.html" id="wrapper1">';
										echo '           <img id="myImage" src="'.base_url().'uploads/items/'.$item->item_img_name.$item->item_img_ext.'" alt="Open Imagination">';
					              		echo '         </a>';
					                	echo '        <div class="portfolio-overlay">';
					                	echo '            <a href="'.base_url().'uploads/items/'.$item->item_img_name.$item->item_img_ext.'" class="left-icon" data-lightbox="image"><i class="icon-line-plus"></i></a>';
					                	echo '            <a href="'.site_url('home/item/'.$item->item_id).'" class="right-icon"><i class="icon-line-ellipsis"></i></a>';
					                	echo '        </div>';
					                	echo '    </div>';
					                	echo '    <div class="portfolio-desc">';
					                 	echo '       <h3><a href="'.site_url('home/item/'.$item->item_id).'">'.$item->item_name.'</a></h3>';
					                 	echo '       <h3><a href="'.site_url('home/item/'.$item->item_id).'">community : '.$item->comm_name.'</a></h3>';
					                 	echo '       <h3><a href="'.site_url('home/item/'.$item->item_id).'">'.$item->item_rent	.'</a></h3>';

					                 	echo '		<button class="btn btn-info" data-toggle="modal" data-target=".'.$item->item_id.'">Activate</button>';
	                        			echo '<div class="modal fade '.$item->item_id.'" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">';
				                        echo '    <div class="modal-dialog modal-lg">';
				                        echo '        <div class="modal-body">';
				                        echo '            <div class="modal-content">';
				                        echo '                <div class="modal-header">';
				                        echo '                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>';
				                        echo '                    <h4 class="modal-title" id="myModalLabel">Deactivate Item</h4>';
				                        echo '                </div>';
				                        echo '                <div class="modal-body">';
				                                     echo '<h3>Are you sure you would like to Activate '.$item->item_name.' ??</h3>';
				                                            echo form_open('itemstuff/activateitem/'.$item->item_id,array('name'=>'login-form','id'=>'login-form','class'=>'nobottommargin'));
                    					echo '<label for="item_rent">New Rent price<span style="color:red;font-size:15px">*</span>:</label>';
                    					echo '<input  value ='.$item->item_rent.' type="number" pattern="[0-9]{1,10}" id="template-contactform-subject" name="item_rent" class="sm-form-control" required/>';

				                                             echo '<div class="modal-footer">';
				                                            echo '<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>';
				                                            echo '<input type="submit" class="btn btn-primary" id="login-form-submit" name="login-form-submit" value="Go">';
				                                            echo '</div>';
				                                            echo '</form>';

				                        echo '                 </div>';
				                        echo '            </div>';
				                        echo '        </div>';
				                        echo '    </div>';
				                        echo '</div>';

					                	echo '        <span><a href="#">'.$item->sub_category.'</a>, <a href="#">'.$item->category.'</a></span>';
					               		echo '     </div>';
					               		echo ' </article>';

										}
										}?>
									
						</div>
	                 </div>
				</div>
            </div><!-- .postcontent end -->

        </div>
    </div>
</section>


<script>
$(function() {
	$(".my-li").click(function() {
		$(".active").toggleClass("active");
		$(this).toggleClass("active");
	});
});
</script>

<script src="<?php echo base_url().'assets/samples-common.js';?>"></script>
<script src="<?php echo base_url().'assets/jquery.filtertable.min.js';?>"></script>

<script>
	$(document).ready(function() {
	    // apply filterTable to all tables on this page
	    $('table').filterTable({filterExpression: 'filterTableFindAll'});
	});
</script>
<script src="<?php echo base_url().'assets/jquery.filtertable.min.js';?>"></script>
<script>
    $(document).ready(function() {
        // apply filterTable to all tables on this page
        $('table').filterTable({filterExpression: 'filterTableFindAll'});
    });
    function invite(caller, invitee_id, community_id) {
        if(caller.classList.contains('button-black')) {
            $url = "<?php echo site_url('home/sendInvitation') ;?>";
            $url += "/" + invitee_id;
            $url += "/" + community_id;
            $.get($url,function(){}).
            done(function(){
                caller.classList.remove('button-black');
                caller.classList.add('button-white');
                caller.classList.add('button-light');
                caller.innerHTML = '<i class="icon-ok"></i>Invited';
            });
        } else {
            // TODO: undo the invitations
            caller.classList.remove('button-white');
            caller.classList.remove('button-light');
            caller.classList.add('button-black');
            caller.innerHTML = '<i class="icon-plus"></i>Invite';
        }
        
    }
</script>
<script src="<?php echo base_url().'assets/samples-common.js';?>"></script>
<script type="text/javascript">

    jQuery(window).load(function(){

        var $container = $('#portfolio');

        $container.isotope({ transitionDuration: '0.65s' });

        $('#portfolio-filter a').click(function(){
            $('#portfolio-filter li').removeClass('activeFilter');
            $(this).parent('li').addClass('activeFilter');
            var selector = $(this).attr('data-filter');
            $container.isotope({ filter: selector });
            return false;
        });

        $('#portfolio-shuffle').click(function(){
        $container.isotope('updateSortData').isotope({
            sortBy: 'random'
        });
    });

        $(window).resize(function() {
            $container.isotope('layout');
        });

    });
</script><!-- Portfolio Script End -->
<script type="text/javascript">

    jQuery(window).load(function(){

        var $container = $('#portfolio1');

        $container.isotope({ transitionDuration: '0.65s' });

        $('#portfolio-filter a').click(function(){
            $('#portfolio-filter li').removeClass('activeFilter');
            $(this).parent('li').addClass('activeFilter');
            var selector = $(this).attr('data-filter');
            $container.isotope({ filter: selector });
            return false;
        });

        

        $(window).resize(function() {
            $container.isotope('layout');
        });

    });
</script><!-- Portfolio Script End -->
<style>
#myImage {
    opacity: 0.4;
    filter: alpha(opacity=40); /* msie */
}

/* or */

#wrapper1 {
    opacity: 0.4;
    filter: alpha(opacity=40); /* msie */
    background-color: #000;
}
</style>
