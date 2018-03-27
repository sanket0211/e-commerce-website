<section id="page-title">

    <div class="container clearfix">
        <h1><?php echo $giver_name;?></h1>
        <span>See items of <?php echo $giver_name;?></span>
        <ol class="breadcrumb">
            <li><a href="<?php echo site_url('home');?>">Home</a></li>
            <li><?php echo $giver_name; ?></li>
            <li><a href="active">items</a></li>

        </ol>
    </div>

</section>



<section id="content">

            <div class="content-wrap">

                <div class="container clearfix">

                    <!-- Post Content
                    ============================================= -->
                    <div class="postcontent nobottommargin col_last clearfix">

                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Fugiat, eos quibusdam accusamus. Maiores, distinctio similique at fugiat reiciendis corporis pariatur. Iusto, molestiae odio ullam quas ratione! Explicabo, sunt, totam mollitia eveniet quasi commodi maxime impedit quos magni deleniti? Laborum, ad, necessitatibus minima officiis mollitia commodi quia dolore enim animi doloribus.</p>

                        <?php
                        if ($user_phone) {
                            echo '<p><strong>Phone number:</strong> '.$user_phone.'</p>';
                        }
                        if ($user_email) {
                            echo '<p><strong>Email address:</strong> '.$user_email.'</p>';
                        }
                        ?>

                        
                    <div class="fancy-title title-center title-dotted-border topmargin">
                        <h3>Products of <?php echo $giver_name; ?></h3>
                    </div>

                    <div id="oc-products" class="owl-carousel products-carousel">

                    <?php 
                    foreach($items as $item){
                        echo '<div class="oc-item">';
                            echo '<div class="product iproduct clearfix">';
                                echo '<div class="product-image">';
                                    echo '<a href="#"><img src="'.base_url().'uploads/items/'.$item->item_img_name.$item->item_img_ext.'" alt="Checked Short Dress"></a>';
                                    echo '<a href="#"><img src="'.base_url().'uploads/items/'.$item->item_img_name.$item->item_img_ext.'" alt="Checked Short Dress"></a>';
                                    echo '<div class="product-overlay">';
                                        echo '<a href="#" class="add-to-cart"><i class="icon-shopping-cart"></i><span> Add to Cart</span></a>';
                                        echo '<a href="'.base_url().'uploads/items/'.$item->item_img_name.$item->item_img_ext.'" class="left-icon" data-lightbox="image"><i class="icon-zoom-in2"></i><span> Quick View</span></a>';
                                    echo '</div>';
                                echo '</div>';
                                echo '<div class="product-desc center">';
                                    echo '<div class="product-title"><h3><a href="#">'.$item->item_name.'</a></h3></div>';
                                    echo '<div class="product-price"><del>'.$item->item_purchase_price.'</del> <ins>'.$item->item_rent.'</ins></div>';
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

                    ?>

                        

                    </div>

                    <script type="text/javascript">

                        jQuery(document).ready(function($) {

                            var ocProducts = $("#oc-products");

                            ocProducts.owlCarousel({
                                margin: 20,
                                nav: false,
                                autoplay: false,
                                autoplayHoverPause: true,
                                dots: true,
                                responsive:{
                                    0:{ items:1 },
                                    600:{ items:2 },
                                    1000:{ items:3 },
                                    1200:{ items:4 }
                                }
                            });

                        });

                    </script>

                    </div><!-- .postcontent end -->

                    <!-- Sidebar
                    ============================================= -->
                    <div class="sidebar nobottommargin clearfix">
                        <div class="sidebar-widgets-wrap">

                            <div class="widget widget_links clearfix">

                                <table>
                                    <tr>
                                        
                                        <td><img width="250" height="250" src="https://graph.facebook.com/<?php echo $fb_id; ?>/picture?height=400" alt="Pink Printed Dress">
                                        </td>
                                    </tr>

                                    <tr>
                                    <td style="padding:5px;">
                                    
                                    </td>
                                    </tr>
                                    <tr>
                                    <td>
                                    <div class=" nobottommargin">
                                        <ul class="list-group nobottommargin">
                                            
                                            <li class="list-group-item list-group-item-info" style="font-size:20px;padding:20px"><i class="i-rounded i-bordered icon-check"></i>EMAIL VERIFIED</li>
                                            
                                        </ul>
                                    </div>
                                    </td>
                                    </tr>
                                    <tr>
                                    <td>
                                    <div class="nobottommargin">
                                        <ul class="list-group nobottommargin">
                                            
                                            <li class="list-group-item list-group-item-info" style="font-size:20px;padding:20px"><i class="i-rounded i-bordered icon-check"></i>NUMBER VERIFIED</li>
                                            
                                        </ul>
                                    </div>
                                    </td>
                                    </tr>
                                </table>

                            </div>

                            

                        

                        </div>
                    </div><!-- .sidebar end -->

                </div>

            </div>

        </section><!-- #content end -->