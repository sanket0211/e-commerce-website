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
        <h1>Home</h1>
        <span>View all the products available</span>
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

            <div class="row bottommargin">
                <div class="col-md-4">
                    <a class="button button-rounded button-reveal button-blue tright" href="<?php echo site_url('home/create_comm');?>">
                        <i class="icon-plus-sign"></i>Create community
                    </a>
                </div>
                <div class="col-md-4">

                    <?php echo form_open_multipart('Communitystuff/getCommunity', array('class'=>'nobottommargin form-group','name'=>'post-item-form','id'=>'form1', 'onsubmit'=>'return checkCheckBox(this)'));?>
                
                    <div class="row">

                        <div class="col-md-7">
                            <label for="item_name"><b>Community Code</b><span style="color:red;font-size:15px">*</span>:</label>
                            <input type="text" name='code' class="sm-form-control" id='code' maxlength='10' onkeyup='Call()' required />
                            <p></p>
                        </div>
                    </div>
                    </form>

                </div>
                <div class="col-md-4">
                    

                    <button class="button button-rounded button-reveal button-blue tright" data-toggle="modal" data-target=".mycommunities">My Communities</button>

                        <div class="modal fade mycommunities" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-body">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            <h4 class="modal-title" id="myModalLabel">My communities</h4>
                                        </div>
                                        <div class="modal-body">
                                            <div class="table-responsive bottommargin">
                                            <table class="table table-striped table-condensed voc_list " align="center">
                                                <colgroup>
                                                    <col span="1" style="width: 150px;">
                                                    <col span="1" style="width: 300px;">
                                                    <col span="1" style="width: 150px;">
                                                    <col span="1" style="width: 150px;">
                                                </colgroup>
                                                <thead>
                                                    <tr>    
                                                    <th class="cart-product-thumbnail">Community Symbol</th>
                                                    <th class="cart-product-name">Name</th>
                                                    <th class="cart-product-price">City</th>
                                                    <th class="cart-product-quantity">Members</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php foreach($myCommunites as $community) {
                                                    echo '  <tr class="cart_item">';
                                                    echo '      <td class="cart-product-thumbnail">';

                                                    echo '          <a href="#"><img width="64" height="64" src="'.base_url().'uploads/communities/'.$community->community_img_name.$community->community_img_ext.'"></a>';

                                                    echo '      </td>';
                                                    echo '      <td class="cart-product-name">';
                                                    echo '          <a href="'.site_url('home/community/'.$community->community_id).'">'.$community->community_name.'</a>';
                                                    echo '      </td>';
                                                    echo '      <td class="cart-product-price">';
                                                    echo '          <span class="amount">Hyderabad</span>';
                                                    echo '      </td>';
                                                    echo '      <td class="cart-product-subtotal">';
                                                    echo '          <span class="amount">'.$community->no_of_members.'</span>';
                                                    echo '      </td>';
                                                    echo '  </tr>';
                                                    }?>
                                                </tbody>
                                            </table>
                                        </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>
            </div>


            <div class="postcontent nobottommargin col_last">
                
                <div id="shop" class="product-3 clearfix">
                    <div id="portfolio">
                    <?php
                    if (count($items) > 0) {
                        foreach ($items as $item) {
                            if($item->category_id == 1){
                                echo '<div  class="product clearfix portfolio-item pf-elec">';
                            } else if($item->category_id == 2){
                                echo '<div  class="product clearfix portfolio-item pf-men">';
                            } else if($item->category_id == 3){
                                echo '<div  class="product clearfix portfolio-item pf-women">';
                            } else if($item->category_id == 4){
                                echo '<div  class="product clearfix portfolio-item pf-baby">';
                            } else if($item->category_id == 5){
                                echo '<div  class="product clearfix portfolio-item pf-home">';
                            } else if($item->category_id == 6){
                                echo '<div  class="product clearfix portfolio-item pf-media">';
                            } else if($item->category_id == 7){
                                echo '<div  class="product clearfix portfolio-item pf-sports">';
                            }
                            echo '    <div class="product-image">';
                            // TODO: Show multiple images here,
                            echo '        <a href="'.site_url('home/item/'.$item->item_id).'"><div style="background:#FF0"><img src="'.base_url().'uploads/items/'.$item->item_img_name.$item->item_img_ext.'" alt="'.$item->item_name.'"></div></a>';
                            echo '        <a href="'.site_url('home/item/'.$item->item_id).'"><div style="background:#FF0"><img src="'.base_url().'uploads/items/'.$item->item_img_name.$item->item_img_ext.'" alt="'.$item->item_name.'"></div></a>';
                            //echo '        <div class="sale-flash">50% Off*</div>';
                            echo '        <div class="product-overlay">';
                            echo '            <a href="'.site_url('home/item/'.$item->item_id).'" class="add-to-cart"><i class="icon-shopping-cart"></i><span>View</span></a>';
                            echo '            <a href="'.site_url('home/item/'.$item->item_id).'" class="item-quick-view" data-lightbox="ajax"><i class="icon-zoom-in2"></i><span> Quick View</span></a>';
                            echo '        </div>';
                            echo '    </div>';
                            echo '    <div class="product-desc center">';
                            echo '        <div class="product-title"><h3><a href="#">'.$item->item_name.'</a></h3></div>';
                            echo '<div class="row" align=center>';
                            echo '<div class="col_half">';
                            echo '<img align=right height=25px width=25px src="'.base_url().'assets/images/gold.png" alt="'.$item->item_name.'">';
                            echo '</div>';
                            echo '<div class="col_half col_last">';
                            echo '<div class="product-price" align=left>'.$item->item_rent.'/day</>';
                            echo '</div>';
                            echo '</div>';
                            echo '</div>';
                            /*echo '        <div class="product-rating">';
                            echo '            <i class="icon-star3"></i>';
                            echo '            <i class="icon-star3"></i>';
                            echo '            <i class="icon-star3"></i>';
                            echo '            <i class="icon-star3"></i>';
                            echo '            <i class="icon-star-half-full"></i>';
                            echo '        </div>';*/
                            echo '    </div>';
                            echo '</div>';
                        }
                    } else {
                        echo "<h2>No items available</h2>";
                    }
                    ?>
                    </div>

                </div><!-- #shop end -->
            </div>
            <!-- Sidebar
            ============================================= -->
            <div class="sidebar nobottommargin">
                    <div class="sidebar-widgets-wrap">


                        <button class="button button-rounded button-reveal button-green tright" data-toggle="modal" data-target=".postitemincommunity">Post Item</button>

                        <div class="modal fade postitemincommunity" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-body">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            <h4 class="modal-title" id="myModalLabel">Select the community where you want to post the product</h4>
                                        </div>
                                        <div class="modal-body">
                                            <div class="table-responsive bottommargin">
                                            <table class="table table-striped table-condensed voc_list " align="center">
                                                <colgroup>
                                                    <col span="1" style="width: 150px;">
                                                    <col span="1" style="width: 300px;">
                                                    <col span="1" style="width: 150px;">
                                                    <col span="1" style="width: 150px;">
                                                </colgroup>
                                                <thead>
                                                    <tr>    
                                                    <th class="cart-product-thumbnail">Community Symbol</th>
                                                    <th class="cart-product-name">Name</th>
                                                    <th class="cart-product-price">City</th>
                                                    <th class="cart-product-quantity">Members</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php foreach($myCommunites as $community) {
                                                    echo '  <tr class="cart_item">';
                                                    echo '      <td class="cart-product-thumbnail">';

                                                    echo '          <a href="#"><img width="64" height="64" src="'.base_url().'uploads/communities/'.$community->community_img_name.$community->community_img_ext.'"></a>';

                                                    echo '      </td>';
                                                    echo '      <td class="cart-product-name">';
                                                    echo '          <a href="'.site_url('home/post/'.$community->community_id).'">'.$community->community_name.'</a>';
                                                    echo '      </td>';
                                                    echo '      <td class="cart-product-price">';
                                                    echo '          <span class="amount">Hyderabad</span>';
                                                    echo '      </td>';
                                                    echo '      <td class="cart-product-subtotal">';
                                                    echo '          <span class="amount">'.$community->no_of_members.'</span>';
                                                    echo '      </td>';
                                                    echo '  </tr>';
                                                    }?>
                                                </tbody>
                                            </table>
                                        </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="widget widget_links clearfix">

                            <h4>Categories</h4>
                            <ul id="portfolio-filter" class="col_full nomargin noborder">
                                <?php
                                echo '<li class="activeFilter col_full"><a href="#" data-filter="*">Show All</a></li>';
                                foreach ($categories as $category) {
                                    if ($category->category_id == 1) {
                                        echo '<li class="col_full"><a href="#" data-filter=".pf-elec">'. $category->category_name . '</a></li>';                                        
                                    } else if ($category->category_id == 2) {
                                        echo '<li class="col_full"><a href="#" data-filter=".pf-men">'. $category->category_name . '</a></li>';
                                    } else if ($category->category_id == 3) {
                                        echo '<li class="col_full"><a href="#" data-filter=".pf-women">'. $category->category_name . '</a></li>';
                                    } else if ($category->category_id == 4) {
                                        echo '<li class="col_full"><a href="#" data-filter="pf-baby">'. $category->category_name . '</a></li>';
                                    } else if ($category->category_id == 5) {
                                        echo '<li class="col_full"><a href="#" data-filter=".pf-home">'. $category->category_name . '</a></li>';
                                    } else if ($category->category_id == 6) {
                                        echo '<li class="col_full"><a href="#" data-filter=".pf-media">'. $category->category_name . '</a></li>';
                                    } else if ($category->category_id == 7) {
                                        echo '<li class="col_full"><a href="#" data-filter=".pf-sports">'. $category->category_name . '</a></li>';
                                    }
                                }
                                ?>
                            </ul>

                        </div>

                        <div class="widget clearfix">
                            <!-- TODO: Show recent items --> 
                            <h4>Recent Items</h4>
                            <div id="post-list-footer">
                            <?php
                            foreach ($recentItems as $recentItem) {
                                echo '<div class="spost clearfix">';
                                echo '    <div class="entry-image">';
                                echo '        <a href="'. site_url('home/item/'.$recentItem->item_id) .'"><img src="'.base_url().'uploads/items/'.$recentItem->item_img_name.$recentItem->item_img_ext.'" alt="Image"></a>';
                                echo '    </div>';
                                echo '    <div class="entry-c">';
                                echo '        <div class="entry-title">';
                                echo '            <h4><a href="'. site_url('home/item/'.$recentItem->item_id) .'">'.$recentItem->item_name.'</a></h4>';
                                echo '        </div>';
                                
                                echo '        <ul class="entry-meta">';
                                echo '            <li class="color">';
                                echo '<img align=left height=15px width=15px src="'.base_url().'assets/images/gold.png" alt="'.$item->item_name.'">'.$recentItem->item_rent;
                                echo '/day</li>';
                                //echo '            <li><i class="icon-star3"></i> <i class="icon-star3"></i> <i class="icon-star3"></i> <i class="icon-star3"></i> <i class="icon-star-half-full"></i></li>';
                                echo '        </ul>';
                                echo '    </div>';
                                echo '</div>';
                            }
                            ?>
                            </div>

                        </div>

                        <!--<div class="widget clearfix">
                            <h4>Recently Viewed Items</h4>
                            <div class="widget-last-view">
                                <div class="spost clearfix">
                                    <div class="entry-image">
                                        <a href="#"><img src="images/shop/small/3.jpg" alt="Image"></a>
                                    </div>
                                    <div class="entry-c">
                                        <div class="entry-title">
                                            <h4><a href="#">Round-Neck Tshirt</a></h4>
                                        </div>
                                        <ul class="entry-meta">
                                            <li class="color">$15</li>
                                            <li><i class="icon-star3"></i> <i class="icon-star3"></i> <i class="icon-star3"></i> <i class="icon-star3"></i> <i class="icon-star3"></i></li>
                                        </ul>
                                    </div>
                                </div>

                            </div>

                        </div>

                        <div class="widget clearfix">
                            <h4>Popular Items</h4>
                            <div id="Popular-item">
                                <div class="spost clearfix">
                                    <div class="entry-image">
                                        <a href="#"><img src="images/shop/small/8.jpg" alt="Image"></a>
                                    </div>
                                    <div class="entry-c">
                                        <div class="entry-title">
                                            <h4><a href="#">Pink Printed Dress</a></h4>
                                        </div>
                                        <ul class="entry-meta">
                                            <li class="color">$21</li>
                                            <li><i class="icon-star3"></i> <i class="icon-star3"></i> <i class="icon-star3"></i> <i class="icon-star3"></i> <i class="icon-star-half-full"></i></li>
                                        </ul>
                                    </div>
                                </div>
                                
                            </div>

                        </div>-->

                        

                    </div>
                </div><!-- .sidebar end -->
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
<!-- Portfolio Script
============================================= -->
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

    function Call(){
  var $number = document.getElementById('code');
  var $num = $number.value;
  console.log($num);
  if($num.length == 6){
    var form = document.getElementById('form1');
    document.getElementById("form1").submit();
  }

}


</script><!-- Portfolio Script End -->

