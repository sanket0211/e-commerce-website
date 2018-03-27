<link rel="stylesheet" href="<?php echo base_url().'assets/css/jquery-ui.css' ;?>">
<!-- Page Title
============================================= -->
<section id="page-title">
    
    <div class="container clearfix">
        <h1><?php echo $item -> item_name; ?></h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo site_url('home'); ?>">Home</a></li>
            <li class="active"><a href="#"><?php echo $item -> item_name; ?></a></li>
        </ol>
    </div>

</section><!-- #page-title end -->

<!-- Content
============================================= -->

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
            <div class="single-product">

                <div class="product">

                    <div class="col_two_fifth">

                        <!-- Product Single - Gallery

                        ============================================= -->

                        <div class="product-image">

                            <div class="fslider" data-pagi="false" data-arrows="false" data-thumbs="true">
                                <div class="flexslider">
                                    <div class="slider-wrap" data-lightbox="gallery">

                                        <div class="slide" data-thumb="<?php echo base_url() . 'uploads/items/' . $item -> item_img_name . $item -> item_img_ext; ?>">
                                            <a href="<?php echo base_url() . 'uploads/items/' . $item -> item_img_name . $item -> item_img_ext; ?>" title="Pink" data-lightbox="gallery-item">
                                                <img src="<?php echo base_url() . 'uploads/items/' . $item -> item_img_name . $item -> item_img_ext; ?>" alt="Pink Printed Dress">
                                            </a>
                                        </div>
                                        <div class="slide" data-thumb="<?php echo base_url() . 'uploads/items/' . $item -> item_img_name . $item -> item_img_ext; ?>">
                                            <a href="<?php echo base_url() . 'uploads/items/' . $item -> item_img_name . $item -> item_img_ext; ?>" title="Pink" data-lightbox="gallery-item">
                                                <img src="<?php echo base_url() . 'uploads/items/' . $item -> item_img_name . $item -> item_img_ext; ?>" alt="Pink Printed Dress">
                                            </a>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <!-- Use if want to promote an item -->
                            <!-- <div class="sale-flash">Sale!</div> -->

                        </div><!-- Product Single - Gallery End -->

                    </div>

                    <div class="col_two_fifth product-desc">

                        <!-- Product Single - Price

                        ============================================= -->

                         <!-- Product Single - Price End -->
                        <?php
                        echo '<div class="row" >';
                            echo '<div class="col_half">';
                            ?>
                            <div class="product-price">₹<del><?php echo $item -> item_purchase_price; ?></del>
                            </div>
                            <?php
                            echo '<img align=right height=30px width=30px src="'.base_url().'assets/images/gold.png" alt="'.$item->item_name.'">';
                            echo '</div>';
                            echo '<div class="col_half col_last">';
                            echo '<div class="product-price" align=left>'.$item->item_rent.'/day</div>';
                            echo '</div>';
                            echo '</div>';
                       
                            ?>


                        <!-- Product Single - Rating

                        ============================================= -->

                        <div class="product-rating">

                            <i class="icon-star3"></i>

                            <i class="icon-star3"></i>

                            <i class="icon-star3"></i>

                            <i class="icon-star-half-full"></i>

                            <i class="icon-star-empty"></i>

                        </div><!-- Product Single - Rating End -->

                        <div class="clear"></div>   

                        <div class="line"></div>

                        <!-- Product Single - Quantity & Cart Button

                        ============================================= -->

                    <?php
                    if ($user_id == $item->user_id) {
                        echo '<button class="btn btn-danger" data-toggle="modal" data-target=".bs-example-modal-lg">Edit Item</button>';
                        echo '<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">';
                        echo '    <div class="modal-dialog modal-lg">';
                        echo '        <div class="modal-body">';
                        echo '            <div class="modal-content">';
                        echo '                <div class="modal-header">';
                        echo '                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>';
                        echo '                    <h4 class="modal-title" id="myModalLabel">Edit Item</h4>';
                        echo '                </div>';
                        echo '                <div class="modal-body">';

                        echo '<p style="color:red">fields marked with astericks(*) are compulsory</p>';
                        echo form_open_multipart('home/updateitemdetails/' . $item -> item_id, array('class' => 'nobottommargin', 'name' => 'post-item-form', 'onsubmit' => 'return checkCheckBox(this)'));
                        echo '<div class="col_full">';
                        echo '<label for="item_name">Name<span style="color:red;font-size:15px">*</span>:</label>';
                        echo form_error('item_name');
                        echo '<input value="' . $item -> item_name . '" type="text" id="template-contactform-name" pattern="[a-zA-Z0-9 -]{2,200}" name="item_name" value="" class="sm-form-control" required />';
                        echo '<p>e.g. Peshwari Sherwani (Red), Sony Vaio VPCEH18FG Laptop, Quechua T2 Tent, Steel Wheelchair</p>';
                        echo '</div>';

                        echo '<div class="col_half">';
                        echo '<label for="item_cat_id">Category<span style="color:red;font-size:15px">*</span>:</label>';
                        echo '<select id="item_cat" name="item_cat_id" class="sm-form-control" required>';
                        echo '<option value="">---Select category --- </option>';

                        foreach ($categories as $category) {
                            echo '<option value="' . $category -> category_id . '">' . $category -> category_name . '</option>';
                        }
                        echo '</select>';
                        echo '</div>';
                        echo '<div class="col_half col_last">';
                        echo '<label for="item_sub_cat_id">Sub-category<span style="color:red;font-size:15px">*</span>:</label>';
                        echo '<select id="item_sub_cat" name="item_sub_cat_id" class="sm-form-control" required>';
                        echo '<option value="">---Select category --- </option>';
                        echo '</select>';
                        echo '</div>';

                        
                        echo '<div class=" col_half">';
                            echo '<label for="item_rent">Rent price<span style="color:red;font-size:15px">*</span>:</label>';
                            echo '<input type="number" pattern="[0-9]{1,10}" id="template-contactform-subject" name="item_rent" value= "' . $item -> item_rent . '" class="required sm-form-control" required/>';
                        echo '</div>';

                        echo '<div class=" col_half col_last">';
                            echo '<label for="item_rent">Purchase Price<span style="color:red;font-size:15px">*</span>:</label>';
                            echo '<input type="number" pattern="[0-9]{1,10}" id="template-contactform-subject" name="item_purchase_price" value= "' . $item -> item_purchase_price . '" class="required sm-form-control" required/>';
                        echo '</div>';

                        echo '<div class="row">';

                        echo '<div class="col-md-12">';
                            echo '<label for="item_name"><b>Key Features</b><span style="color:red;font-size:15px">*</span>:</label>';
                            echo '<input type="text" id="template-contactform-name" name="item_key_features" value="' . $item -> item_key_features . '" class="sm-form-control" required />';
                            echo '<p>e.g. Zardozi Work, 4GB RAM, Waterproof, Steel Frame</p>';
                        echo '</div>';
                        echo '</div>';

                        echo '<div class="col_full">';
                        echo '<label for="item_desc">Description<span style="color:red;font-size:15px">*</span>:</label>';
                        echo '<textarea class="required sm-form-control" id="template-contactform-message" name="item_desc" rows="3" cols="30" required>' . $item -> item_desc . '</textarea>';
                        echo '<p>e.g. color, size, working conditions, how old it is, etc</p>';
                        echo '</div>';

                        echo '<div class="row">';

                        echo '<div class="col-md-12 ">';
                            echo '<label for="item_name"><b>Brand</b>:</label>';

                            echo '<input type="text" id="template-contactform-name" pattern="[a-zA-Z0-9 -]{2,200}" name="item_brand" value= "' . $item -> item_brand . '" class="sm-form-control" />';
                            
                        echo '</div>';
                        echo '</div>';

                        echo '<div class="row">';
                        echo '<div class="col-md-12 ">';
                            echo '<label for="item_desc">Terms &amp; Conditions if any :</label>';
                            echo '<textarea class="required sm-form-control" id="template-contactform-message" name="item_terms" rows="3" cols="30" >' . $item -> item_terms . '</textarea>';
                            echo '<p>e.g. need advance, want it back on time, borrower fined if item damaged, etc.</p>';
                        echo '</div>';
                        echo '</div>';

                        echo '<div class="col_full">';
                        echo 'I accept the <a href="' . site_url('home/termsandconditions') . '">terms and conditions</a>: <input type="checkbox" value="0" name="agree">';
                        echo '</div>';
                        

                        echo '<div class="col_full">';
                        echo '<input class="button button-3d nomargin" type="submit" id="template-contactform-submit" name="upload" value="submit">';
                        echo '</div>';

                        echo '</form>';

                        echo '                 </div>';
                        echo '            </div>';
                        echo '        </div>';
                        echo '    </div>';
                        echo '</div>';
                                                

                    } 
                    else {
                        

                            echo '<div class="quantity clearfix">';

                                echo '<input type="button" value="-" class="minus" onclick="decrease_no_of_days()">';
                                echo '<input type="text" step="1" min="1" id="no_of_days" name="no_of_days" value="1" title="Qty" class="qty" size="4" />';
                                echo '<input type="button" value="+" class="plus" onclick="increase_no_of_days()">';

                            echo '</div>';
                echo '<p>Date: <input type="text" id="datepicker" name="renting_start_date" required></p>';
            // confirmrequest --> change it to confirm_request
                            echo '<button class="add-to-cart button nomargin" data-toggle="modal" data-target=".confirmrequest" onclick="myFunction()" >Request This Item</button>';

                            echo '<div class="modal fade confirmrequest" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">';
                                echo '<div class="modal-dialog modal-lg">';
                                    echo '<div class="modal-body">';
                                        echo '<div class="modal-content">';
                                            echo '<div class="modal-header">';
                                                echo '<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>';
                                                echo '<h4 class="modal-title" id="myModalLabel">Request Confirmation</h4>';
                                            echo '</div>';
                                            echo '<div class="modal-body">';
                                            echo '<h3>Are you sure you want to request for this item??</h3>' ; 
                                            echo form_open('home/itemRequest/'. $item->community_id .'/'. $item->item_id , array('class' => "cart nobottommargin clearfix"));
                                            echo '<div class="row ">';
                                            echo '<div class="col-md-6">';
                                            echo '<label for="item_name"><b>Name</b>:</label>';
                                            
                                            echo '<input type="text" id="template-contactform-name" name="item_name" value="'.$item->item_name.'" class="sm-form-control" readonly/>';
                                            
                                            echo '</div>';
                                            
                                            

                                            echo '<div class="col-md-6">';
                                                echo '<label for="item_name"><b>Number of Days</b>:</label>';
                                                echo '<input type="text" id="days" name="no_of_days" value="" class="sm-form-control" readonly />';
                                                
                                            echo '</div>';
                                            echo '</div>';

                                            echo '<div class="row">';
                                            echo '<div class="col-md-6">';
                                            echo '<label for="item_name"><b>Renting Start Date</b>:</label>';
                                            
                                            echo '<input type="text" id="date" name="renting_start_date" value="" class="sm-form-control" readonly/>';
                                            
                                            echo '</div>';
                                            
                                            echo '<div class="col-md-6">';
                                            echo '<label for="item_name"><b>Borrowing From:</b>:</label>';
                                            
                                            echo '<input type="text" id="giver" name="item_name" value="'.$giver_name.'" class="sm-form-control" readonly/>';
                                            
                                            echo '</div>';
                                            echo '</div>';

                                            echo '<div class="clear"></div>';

                        echo '<button type="submit" class="add-to-cart button topmargin">Request this Item</button>';
                    echo '</div>';
                    echo '</div>';
                echo '</div>';
            echo '</div>';
            echo '</div>';

                        echo '</form><!-- Product Single - Quantity & Cart Button End -->';

                        echo '<div class="clear"></div>';

                        echo '<div class="line"></div>';
                    }?>

                        <p class=""><b>Description </b>: <?php echo $item -> item_desc; ?> </p>
                        <p class=""><b>Key Features : </b><?php echo $item -> item_key_features; ?> </p>
                        <p calss=""><b>Owner : </b><a href="<?php echo site_url('home/GiverItems/'.$giver_id);?>"><?php echo $giver_name;?> </a></p>


                        <div class="panel panel-default product-meta">

                            <div class="panel-body">

                                <!--<span itemprop="productID" class="sku_wrapper">SKU: <span class="sku">8465415</span></span>-->

                                <span class="posted_in">Category: <a href="#" rel="tag"><?php echo $item -> category; ?></a>.</span>

                                <span class="tagged_as">Sub-Category:
                                    <a href="#" rel="tag"><?php echo $item -> sub_category; ?></a>
                                    <!-- <a href="#" rel="tag">Pink</a>, <a href="#" rel="tag">Short</a>, <a href="#" rel="tag">Dress</a>, <a href="#" rel="tag">Printed</a>. -->
                                </span>

                            </div>

                        </div><!-- Product Single - Meta End -->

                        <!-- Product Single - Share

                        ============================================= -->

                        <!-- <div class="si-share noborder clearfix">

                            <span>Share:</span>

                            <div>

                                <a href="#" class="social-icon si-borderless si-facebook">

                                    <i class="icon-facebook"></i>

                                    <i class="icon-facebook"></i>

                                </a>

                                <a href="#" class="social-icon si-borderless si-twitter">

                                    <i class="icon-twitter"></i>

                                    <i class="icon-twitter"></i>

                                </a>

                                <a href="#" class="social-icon si-borderless si-pinterest">

                                    <i class="icon-pinterest"></i>

                                    <i class="icon-pinterest"></i>

                                </a>

                                <a href="#" class="social-icon si-borderless si-gplus">

                                    <i class="icon-gplus"></i>

                                    <i class="icon-gplus"></i>

                                </a>

                                <a href="#" class="social-icon si-borderless si-rss">

                                    <i class="icon-rss"></i>

                                    <i class="icon-rss"></i>

                                </a>

                                <a href="#" class="social-icon si-borderless si-email3">

                                    <i class="icon-email3"></i>

                                    <i class="icon-email3"></i>

                                </a>

                            </div>

                        </div>-->
                        <!-- Product Single - Share End -->

                    </div>

                    <div class="col_one_fifth col_last">

                        <a href="#" title="Brand Logo" class="hidden-xs"><img class="image_fade" src="images/shop/brand.jpg" alt="Brand Logo"></a>

                        <div class="divider divider-center"><i class="icon-circle-blank"></i></div>

                        <div class="feature-box fbox-plain fbox-dark fbox-small">

                            <div class="fbox-icon">

                                <i class="icon-check"></i>

                            </div>

                            <h3>Verified User</h3>

                            <p class="notopmargin">We guarantee you the posting of Item from verified User</p>

                        </div>

                        <div class="feature-box fbox-plain fbox-dark fbox-small">

                            <div class="fbox-icon">

                                <i class="icon-thumbs-up2"></i>

                            </div>

                            <h3>Trust</h3>

                            <p class="notopmargin">Trust of community have good number of people.</p>

                        </div>

                        <!--<div class="feature-box fbox-plain fbox-dark fbox-small">

                            <div class="fbox-icon">

                                <i class="icon-truck2"></i>

                            </div>

                            <h3>Free Shipping</h3>

                            <p class="notopmargin">Free Delivery to 100+ Locations on orders above $40.</p>

                        </div>-->

                        <div class="feature-box fbox-plain fbox-dark fbox-small">

                            <div class="fbox-icon">

                                <i class="icon-undo"></i>

                            </div>

                            <h3>24-Hours Returns</h3>

                            <p class="notopmargin">Cancel deals of items rented within 24 hours.</p>

                        </div>

                    </div>

                    <div class="col_full nobottommargin">

                        <div class="tabs clearfix nobottommargin" id="tab-1">

                            <ul class="tab-nav clearfix">

                                <li><a href="#tabs-2"><i class="icon-info-sign"></i><span class="hidden-xs"> Additional Information</span></a></li>

                                <li><a href="#tabs-1"><i class="icon-align-justify2"></i><span class="hidden-xs">Terms &amp; Conditions</span></a></li>

                                <li><a href="#tabs-3"><i class="icon-star3"></i><span class="hidden-xs"> Reviews (<?php echo count($item_reviews) ;?>)</span></a></li>

                            </ul>

                            <div class="tab-container">

                                <div class="tab-content clearfix" id="tabs-1">

                                    <p><?php echo $item->item_terms;?></p>
                                </div>

                                <div class="tab-content clearfix" id="tabs-2">

                                    <table class="table table-striped table-bordered">

                                        <tbody>

                                            <tr>

                                                <td>Brand</td>

                                                <td><?php echo $item->item_brand; ?></td>

                                            </tr>

                                            <tr>

                                                <td>Purchase Price</td>

                                                <td><?php echo $item->item_purchase_price; ?></td>

                                            </tr>

                                            <tr>

                                                <td>Key Features</td>

                                                <td><?php echo $item->item_key_features; ?></td>

                                            </tr>

                                            <tr>

                                                <td>Post Date</td>

                                                <td><?php echo $item->post_date; ?></td>

                                            </tr>

                                            

                                        </tbody>

                                    </table>

                                </div>

                    <div class="tab-content clearfix" id="tabs-3">

                        <div id="reviews" class="clearfix">

                            <ol class="commentlist clearfix">
                            <?php
                            if ($item_reviews) {
                                foreach ($item_reviews as $item_review) {

                                    echo '<li class="comment even thread-even depth-1" id="li-comment-1">';

                                    echo '    <div id="comment-1" class="comment-wrap clearfix">';

                                    echo '        <div class="comment-meta">';

                                    echo '            <div class="comment-author vcard">';

                                    echo '                <span class="comment-avatar clearfix">';

                                    echo '                <img alt="" src="'. base_url() .'uploads/profile/'. $item_review->reviewer_img_name . $item_review->reviewer_img_ext .'" height="60" width="60"/></span>';

                                    echo '            </div>';

                                    echo '        </div>';

                                    echo '        <div class="comment-content clearfix">';

                                    echo '         <div class="comment-author">'. $item_review->reviewer_name .'<span>';

                                    echo '         <a href="#" title="Permalink to this comment">April 24, 2014 at 10:46AM</a>';
                                    echo '         </span>';
                                    echo '        </div>';

                                    echo '            <p>'. $item_review->comment .'</p>';
                                    $stars = $item_review->stars;

                                    echo '            <div class="review-comment-ratings">';
                                        for ($i = 0; $i < 5; $i++ ) {
                                            if ($i < $stars)
                                                echo '     <i class="icon-star3"></i>';
                                            else
                                                echo '     <i class="icon-star-empty"></i>';
                                        }
                                    echo '            </div>';

                                    echo '        </div>';

                                    echo '        <div class="clear"></div>';

                                    echo '    </div>';

                                    echo '</li>';
                                }
                            }
                            ?>


                            </ol>

                            <!-- Modal Reviews
                            
                            =============================================
                            
                            <a href="#" data-toggle="modal" data-target="#reviewFormModal" class="button button-3d nomargin fright">Add a Review</a>
                            
                            <div class="modal fade" id="reviewFormModal" tabindex="-1" role="dialog" aria-labelledby="reviewFormModalLabel" aria-hidden="true">
                            
                                <div class="modal-dialog">
                            
                                    <div class="modal-content">
                            
                                        <div class="modal-header">
                            
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            
                                            <h4 class="modal-title" id="reviewFormModalLabel">Submit a Review</h4>
                            
                                        </div>
                            
                                        <div class="modal-body">
                            
                                            <form class="nobottommargin" id="template-reviewform" name="template-reviewform" action="#" method="post">
                            
                                                <div class="col_half">
                            
                                                    <label for="template-reviewform-name">Name <small>*</small></label>
                            
                                                    <div class="input-group">
                            
                                                        <span class="input-group-addon"><i class="icon-user"></i></span>
                            
                                                        <input type="text" id="template-reviewform-name" name="template-reviewform-name" value="" class="form-control required" />
                            
                                                    </div>
                            
                                                </div>
                            
                                                <div class="col_half col_last">
                            
                                                    <label for="template-reviewform-email">Email <small>*</small></label>
                            
                                                    <div class="input-group">
                            
                                                        <span class="input-group-addon">@</span>
                            
                                                        <input type="email" id="template-reviewform-email" name="template-reviewform-email" value="" class="required email form-control" />
                            
                                                    </div>
                            
                                                </div>
                            
                                                <div class="clear"></div>
                            
                                                <div class="col_full col_last">
                            
                                                    <label for="template-reviewform-rating">Rating</label>
                            
                                                    <select id="template-reviewform-rating" name="template-reviewform-rating" class="form-control">
                            
                                                        <option value="">-- Select One --</option>
                            
                                                        <option value="1">1</option>
                            
                                                        <option value="2">2</option>
                            
                                                        <option value="3">3</option>
                            
                                                        <option value="4">4</option>
                            
                                                        <option value="5">5</option>
                            
                                                    </select>
                            
                                                </div>
                            
                                                <div class="clear"></div>
                            
                                                <div class="col_full">
                            
                                                    <label for="template-reviewform-comment">Comment <small>*</small></label>
                            
                                                    <textarea class="required form-control" id="template-reviewform-comment" name="template-reviewform-comment" rows="6" cols="30"></textarea>
                            
                                                </div>
                            
                                                <div class="col_full nobottommargin">
                            
                                                    <button class="button button-3d nomargin" type="submit" id="template-reviewform-submit" name="template-reviewform-submit" value="submit">Submit Review</button>
                            
                                                </div>
                            
                                            </form>
                            
                                        </div>
                            
                                        <div class="modal-footer">
                            
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            
                                        </div>
                            
                                    </div>/.modal-content
                            
                                </div>/.modal-dialog
                            
                            </div>/.modal
                            
                            Modal Reviews End -->

                        </div>

                    </div>

                </div>

                        </div>

                    </div>

                </div>

            </div>

            <div class="clear"></div><div class="line"></div>

            <div class="col_full nobottommargin">
            <?php
            if (count($relatedItems) > 0) {

                echo '<h4>Related Products</h4>';

                echo '<div id="oc-product" class="owl-carousel product-carousel">';
                foreach ($relatedItems as $relatedItem) {

                    echo '<div class="oc-item">';

                    echo '<div class="product iproduct clearfix">';

                    echo '<div class="product-image">';
                    echo '<a href="#"><img src="' . base_url() . 'uploads/items/' . $relatedItem -> item_img_name . $relatedItem -> item_img_ext . '" alt="' . $relatedItem -> item_rent . '"></a>';
                    //echo '<a href="#"><img src="images/shop/dress/1-1.jpg" alt="Checked Short Dress"></a>';
                    //echo '<div class="sale-flash">50% Off*</div>';

                    echo '<div class="product-overlay">';
                    echo '<a href="' . site_url('home/item/' . $relatedItem -> item_id) . '" class="add-to-cart"><i class="icon-shopping-cart"></i><span> View</span></a>';
                    echo '<a href="include/ajax/shop-item.html" class="item-quick-view" data-lightbox="ajax"><i class="icon-zoom-in2"></i><span> Quick View</span></a>';
                    echo '</div>';

                    echo '</div>';

                    echo '<div class="product-desc center">';
                    echo '<div class="product-title"><h3><a href="#">' . $relatedItem -> item_name . '</a></h3></div>';
                    echo '<div class="product-price">₹' . $relatedItem -> item_rent . '</div>';
                    echo '<div class="product-rating">';
                    echo '<i class="icon-star3"></i>';
                    echo '<i class="icon-star3"></i>';
                    echo '<i class="icon-star3"></i>';
                    echo '<i class="icon-star3"></i>';
                    echo '<i class="icon-star-half-full"></i>';
                    echo '</div>';

                    echo '</div>';

                    echo '</div>';

                    echo '</div>';
                }

                echo '</div>';
            } else {
                echo '<h4>No Related Products</h4>';
            }?>
                <script type="text/javascript">
                    jQuery(document).ready(function($) {

                        var ocProduct = $("#oc-product");

                        ocProduct.owlCarousel({

                            margin : 30,

                            nav : true,

                            navText : ['<i class="icon-angle-left"></i>', '<i class="icon-angle-right"></i>'],

                            autoplayHoverPause : true,

                            dots : false,

                            responsive : {

                                0 : {
                                    items : 1
                                },

                                480 : {
                                    items : 2
                                },

                                768 : {
                                    items : 3
                                },

                                992 : {
                                    items : 4
                                }

                            }

                        });

                    });

                </script>

            </div>

        </div>

    </div>

</section><!-- #content end -->
<script type="text/javascript">  
    $(document).ready(function() {  
    $("#item_cat").change(function(){ 
        /*dropdown post *///  
            $.ajax({  
                url:"<?php echo site_url('home/getDropDown'); ?>",
                data: {category_id:  $(this).val()},
                type: "POST",
                success:function(data){
                    $("#item_sub_cat").html(data);
                }
            });
        });
    });
</script>
<script>
function increase_no_of_days() {
    var value = $('#no_of_days').val();
    var coins = <?php echo $user_coins - $offset ; ?>;
    var rent = <?php echo $item -> item_rent; ?>;
    console.log(rent);
    console.log(value);
    console.log(coins);
    if (coins > value * rent) {
        value ++;
        $('#no_of_days').val(value);
    }
}
    
function decrease_no_of_days() {
	var value = $('#no_of_days').val();
	if (value > 1) {
		value--;
		$('#no_of_days').val(value);
	}
}
</script>

<script>
function myFunction() {
    var no_of_days = document.getElementById("no_of_days").value;
    var date_picker = document.getElementById("datepicker").value;

    var date = document.getElementById("date");
    var time = document.getElementById("days");

    date.value=date_picker;
    days.value = no_of_days;

}
</script>
 
  <script src="<?php echo base_url().'assets/js/jquery-ui.js';?> "></script>
  <script>
  $(function() {
    $( "#datepicker" ).datepicker();
  });
  </script>

<script type="text/javascript">

    function checkCheckBox(f){
    if (f.agree.checked == false ) {
        alert('Please check the box to continue.');
    return false;
    } else
        return true;
    }

</script>  
