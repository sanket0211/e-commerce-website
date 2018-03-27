<section id="page-title" >

    <div class="container clearfix">
        <h1><?php echo $comm_name;?></h1>
        <span>View details of the community</span>
        <ol class="breadcrumb">
            <li><a href="<?php echo site_url('home');?>">Home</a></li>
            <li><a href="active"><?php echo $comm_name;?></a></li>
        </ol>
    </div>

</section>

<section id="container">
    <!-- Large modal -->
    <div class="section nobg nobottommargin">

        
        <div class="container clearfix">
        <?php 
        if(!is_null($info)){
            echo '<div class="style-msg errormsg">';
            echo '<div class="sb-msg">'.$info.'</div>';
            echo '</div>';
        }
       
        ?>




            <?php echo $error ;?>
            <div class="col_two_third nobottommargin center">
            <div class="col_half">

            <img src="<?php echo base_url().'uploads/communities/'.$comm_image.$comm_image_ext ;?>" alt="Image" data-animate="fadeInLeft">

            </div>
            <div class="col_half nobottommargin col_last">
                <div class="heading-block" style="padding-top: 40px;">
                     <h2><?php echo $comm_name ;?></h2>
                    <!--<span>This is an description</span>-->
                </div>
                <p><?php echo $comm_desc ;?></p>
                <p>Community Code :<?php echo $comm_code ;?></p>

            <?php
            if($isMember != -1){
            echo '<a href="'.site_url('home/post/'.$comm_id).'" class="button button-rounded button-lime button-reveal topmargin-sm noleftmargin"><i class="icon-paperplane"></i>Post item</a><br>';
            echo '<button class="button button-rounded button-dirtygreen button-reveal topmargin-sm noleftmargin" data-toggle="modal" data-target=".invite"><i class="icon-users2"></i>Invite People</button>';
                     echo '<button class="button button-rounded button-dirtygreen topmargin-sm noleftmargin" data-toggle="modal" data-target=".members">View Members</button>';
            echo '<div class="modal fade bs-example-modal-lg invite" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">';
            echo '  <div class="modal-dialog modal-lg">';
            echo '      <div class="modal-body">';
            echo '          <div class="modal-content">';
            echo '              <div class="modal-header">';
            echo '                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>';
            echo '                  <h4 class="modal-title" id="myModalLabel">Invite people</h4>';
            echo '              </div>';
            echo '              <div class="modal-body">';
            echo '                  <div class="table-responsive bottommargin">';
            echo '                      <table class="table table-striped table-condensed voc_list " overflow-y: scroll align="center">';
            echo '                          <colgroup>';
            echo '                              <col span="1" style="width: 150px;">';
            echo '                              <col span="1" style="width: 300px;">';
            echo '                              <col span="1" style="width: 150px;">';
            echo '                          </colgroup>';
            echo '                          <thead>';
            echo '                              <tr> ';   
            echo '                              <th class="cart-product-thumbnail">Image</th>';
            echo '                              <th class="cart-product-name">Name</th>';
            echo '                              <th class="cart-product-price">Email</th>';                                    
            echo '                              </tr>';
            echo '                          </thead>';
            echo '                          <tbody>';
                foreach($Users as $user) {
            echo '                          <tr class="cart_item">';
            echo '                          <td class="cart-product-thumbnail">';
            echo '                              <a href="#"><img width="64" height="64" src="https://graph.facebook.com/'.$user->fb_id.'/picture?height=400"  alt="'.$user->user_name.'"></a>';
            echo '                          </td>';
            echo '                          <td class="cart-product-name">';
            echo '                              <a href="#">'.$user->user_name.'</a>';
            echo '                          </td>';
            echo '                          <td class="cart-product-price">';
            echo '                              <span class="amount">'.$user->user_email.'</span>';
            echo '                          </td>';
            echo '                          <td class="cart-product-price">';
            echo '                              <button onclick="invite(this, '.$user->user_id.','.$comm_id.')" class="invite-button button button-3d button-rounded button-black noleftmargin"><i class="icon-plus"></i>Invite</button>';
            echo '                          </td>';
            echo '                          </tr>';
                }
            echo '                      </tbody>';
            echo '                  </table>';
            echo '              </div>';
            echo '          </div>';
            echo '      </div>';
            echo '  </div>';
            echo '</div>';
            echo '</div>';  

            } else {
                // view other community members 
                // TODO: do it via ajax
                echo '<a href="'.site_url('home/join_comm/'.$comm_id).'" class="button button-rounded button-red topmargin-sm noleftmargin">Join community</a>';
                echo '<button class="button button-rounded button-dirtygreen topmargin-sm noleftmargin" data-toggle="modal" data-target=".members">View Members</button>';
            }
            ?>

            
            
            </div>
            </div>

            
            <div class="modal fade members" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-sm">
                    <div class="modal-body">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                <h4 class="modal-title" id="myModalLabel">Members</h4>
                            </div>
                            <div class="modal-body">
                                <table class="table table-striped table-condensed voc_list" align="center">
                                    
                                    <thead>
                                        <tr>    
                                        <th class="cart-product-thumbnail" style="padding-right:50">Photo</th>
                                        <th class="cart-product-name">Name</th>
                                        
                                        
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                        $flag=0;
                                        
                                        foreach($members_list as $member){
                                                
                                                
                                                echo '  <tr class="cart_item">';
                                                echo '      <td class="cart-product-thumbnail">';

                                                echo '          <a href="#"><img width="64" height="64" src="https://graph.facebook.com/'.$member->fb_id->user_fb_id.'/picture?height=400" alt"profile picture" alt="'.$member->user_name.'"></a>';
                                                
                                                
                                                

                                                echo '      </td>';
                                                echo '      <td class="cart-product-name">';
                                                echo '          <a href="">'.$member->user_name.'</a>';
                                                echo '      </td>';
                                                
                                     
                                            
                                        }?>
                                    </tbody>
                                </table>    
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col_one_third col_last">
                    <h4>Top demands</h4>
                        <?php
                        if($demands AND $demands != -1) {
                        foreach ($demands as $demand) {
                            echo'<div id="post-list-footer">';
                            echo'    <div class="spost clearfix">';
                            echo'        <div class="entry-c">';
                            echo'            <div class="entry-title">';
                            echo'                <h4><strong>'.$demand->demand_item.'</strong><br>'.$demand->demand_item_desc.'</h4>';
                            echo'            </div>';
                            echo'            <ul class="entry-meta">';
                            echo'                <li>Hits: '.$demand->hits.'</li>';
                            echo'            </ul>';
                            echo'        </div>';
                                if($demand->isUpvoted == 1) {
                                echo'    <a class="button button-mini button-green nomargin" href="'.site_url('home/upvote_demand/'.$demand->demand_id).'"><i class="icon-upload"></i>Upvote</a>';
                                }
                                else{
                                echo'    <a class="button button-mini button-green nomargin" disabled="disable" href="'.site_url('home/downvote_demand/'.$demand->demand_id).'"><i class="icon-download"></i>Upvoted</a>';
                                }
                            echo'    </div>';
                            echo'</div>';
                            echo '<hr>';
                            }
                        }
                        ?>
                        <button class="button button-small button-dark button-rounded" data-toggle="modal" data-target=".all-demands-modal">All Demands</button>

                        <div class="modal fade all-demands-modal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-body">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            <h4 class="modal-title" id="myModalLabel">All Demands</h4>

                                        </div>
                                        <div class="modal-body">
                                            <p class="nobottommargin">
                                                <?php
                                                if($alldemands AND $alldemands != -1) {
                                                    foreach ($alldemands as $demand) {
                                                    echo'<div id="post-list-footer">';
                                                    echo'    <div class="spost clearfix">';
                                                    echo'        <div class="entry-c">';
                                                    echo'            <div class="entry-title">';
                                                    echo'                <h4><strong>'.$demand->demand_item.'</strong><br>'.$demand->demand_item_desc.'</h4>';
                                                    echo'            </div>';
                                                    echo'            <ul class="entry-meta">';
                                                    echo'                <li>Hits: '.$demand->hits.'</li>';
                                                    echo'            </ul>';
                                                    echo'        </div>';
                                                        if($demand->isUpvoted == 1) {
                                                        echo'    <a class="button button-mini button-green nomargin" href="'.site_url('home/upvote_demand/'.$demand->demand_id).'"><i class="icon-upload"></i>Upvote</a>';
                                                        }
                                                        else{
                                                        echo'    <a class="button button-mini button-green nomargin" disabled="disable" href="'.site_url('home/downvote_demand/'.$demand->demand_id).'"><i class="icon-download"></i>Upvoted</a>';
                                                        }
                                                    echo'    </div>';
                                                    echo'</div>';
                                                    echo '<hr>';
                                                    }
                                                }
                                                ?>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                        if($isMember != -1){
                        echo '<button data-toggle="modal" data-target=".demand-form" class="button button-rounded button-reveal button-blue tright topmargin-sm">';
                        echo '<i class="icon-plus-sign"></i>Demand a new item';
                        echo '</button>';
                    }
                    ?>
            </div>

            <div class="modal fade bs-example-modal-lg demand-form" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-body">
            <div class="modal-content col_half">
                <div class="modal-body">
                    
                    <div class="fancy-title title-dotted-border">
                        <h3>Demand a new item</h3>
                    </div>

                    <div id="contact-form-result" data-notify-type="success" data-notify-msg="<i class=icon-ok-sign></i> Message Sent Successfully!"></div>
                    <?php echo form_open('home/putDemand',array('name'=>'demand-form','id'=>'demand-form','class'=>'nobottommargin'));?>


                        <div class="col_full">
                            <label for="demand_item">Item Name<small>*</small></label>
                            <input type="text" id="template-contactform-name" name="demand_item" pattern="[a-zA-Z0-9 -]{2,200}" class="sm-form-control required" />
                        </div>

                        <div class="col_full">
                            <input type="hidden" value="<?php echo $comm_id;?> " id="template-contactform-name" name="community_id" pattern="[a-zA-Z0-9 -]{2,200}" class="sm-form-control required" />
                        </div>


                        <div class="col_full">
                            <label for="cat_id">Category</label>
                            <select id="template-contactform-service" name="cat_id" class="sm-form-control">
                            <?php
                                foreach($categories as $category) {
                                    echo '<option value="'.$category->category_id.'">'.$category->category_name.'</option>';
                            }?>
                            </select>
                        </div>


                        <div class="col_full">
                            <label for="sub_cat_id">Sub-category</label>
                            <select id="template-contactform-service" name="sub_cat_id" class="sm-form-control">
                            <?php
                                foreach($sub_categories as $sub) {
                                    echo '<option value="'.$sub->sub_category_id.'">'.$sub->sub_category_name.'</option>';
                            }?>
                            </select>
                        </div>

                        <div class="clear"></div>

                        <div class="col_full">
                            <label for="demand_item_desc">Message <small>*</small></label>
                            <textarea class="required sm-form-control" pattern="[a-zA-Z0-9 ]{10,1000}" id="template-contactform-message" name="demand_item_desc" rows="6" cols="30"></textarea>
                        </div>


                        <div class="col_full">
                            <input class="button button-3d nomargin" type="submit" id="template-contactform-submit" name="template-contactform-submit" value="submit" />
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>





        </div>
    </div>

    <?php
        if($isMember != -1) {
        echo '<div class="section nobottommargin">';

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
             
            if(count($items) > 0 and $items) {
                //var_dump($items);
                foreach($items as $item) {
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
                    echo '        <span><a href="#">'.$item->sub_category.'</a>, <a href="#">'.$item->category.'</a></span>';
                    echo '     </div>';
                    echo ' </article>';
                }
            }
        }
        ?>
            
            </div>
        </div>


    </div>
</section>
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
</script><!-- Portfolio Script End -->
<script>
    $(function() {
        $(".my-li").click(function() {
            $(".active").toggleClass("active");
            $(this).toggleClass("active");
        });
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
