<script>

    document.getElementById("howitworks").className = 'mega-menu';
    document.getElementById("aboutus").className = 'mega-menu';
    document.getElementById("contactus").className = 'mega-menu';
    document.getElementById("faqs").className = 'mega-menu';

    document.getElementById("community").className = 'current';
    document.getElementById("home").className = 'mega-menu';

</script>


<section id="page-title">

    <div class="container clearfix">
        <h1>Communities</h1>
        <span>See all communities on Rentooz.</span>
        <ol class="breadcrumb">
            <li><a href="<?php echo site_url('home');?>">Home</a></li>
            <li class="active">Commuities</li>
        </ol>
    </div>

</section>



<section id="content">

    <div class="content-wrap nopadding">

        
        <div class="section parallax nomargin notopborder" style="background: url('<?php echo base_url().'assets/images/parallax/3.jpg';?>') center center; padding: 100px 0;" data-stellar-background-ratio="0.3">
            <div class="container-fluid center clearfix">

                <div class="heading-block">
                    <h2>Welcome to the world of <span>Communities</span></h2>
                    <span></span>
                    <div class="clear"></div>
                </div>

                <div class="col_one_fifth nobottommargin" data-animate="bounceIn">
                    <img width="150" height="150" src="<?php echo base_url().'assets/images/process1.jpeg';?>" alt="Process 1">
                    <h5>Create a Community / Join existing community</h5>
                </div>

                <div class="col_one_fifth nobottommargin" data-animate="bounceIn" data-delay="200">
                    <img width="150" height="150" src="<?php echo base_url().'assets/images/process2.jpeg';?>" alt="Process 2">
                    <h5>Send invitation</h5>
                </div>

                <div class="col_one_fifth nobottommargin" data-animate="bounceIn" data-delay="400">
                    <img width="75" height="150" src="<?php echo base_url().'assets/images/process3.jpeg';?>" alt="Process 3">
                    <img width="75" height="150" src="<?php echo base_url().'assets/images/process4.jpeg';?>" alt="Process 4">
                    <h5>Search item / Post advertisement</h5>
                </div>

                <div class="col_one_fifth nobottommargin" data-animate="bounceIn" data-delay="600">
                    <img width="150" height="150" src="<?php echo base_url().'assets/images/process5.jpeg';?>" alt="Process 5">
                    <h5>Start Renting</h5>
                </div>

                <div class="col_one_fifth nobottommargin col_last" data-animate="bounceIn" data-delay="800">
                    <img width="150" height="150" src="<?php echo base_url().'assets/images/process6.jpeg';?>" alt="Process 6">
                    <h5>Earn bonus</h5>
                </div>

            </div>
        </div>


        

    </div>

</section><!-- #content end -->





<section id="content">
    <div class="content-wrap">
        <div class="container clearfix">

            <div style="display:inline">
            <span style="font-size:45px">You wanna create a new community, click here : </span>
                    <a class="button button-rounded button-reveal button-red tright" href="<?php echo site_url('home/create_comm');?>">
                        <i class="icon-plus-sign"></i>Create community
                    </a>
                    <hr>
            </div>   

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
            <div class="nobottommargin clearfix">
                <div class="tabs clearfix" id="tabs" data-speed="700" data-active="1" >
                    <ul class="nav nav-tabs nav-justified clearfix" style="tab-size:100px">
                        
                        <li class="my-li"><a href="#tab-1"><strong>All communities</strong></a></li>
                        
                        <li class="my-li"><a href="#tab-2"><strong>My communities</strong></a></li>
                        
                    </ul>
                    
                    <div class="tab-container notopmargin">
                        <div class="tab-content clearfix" id="tab-1">
                            <!--This is Tab 1 Content -->
                            <div class="table-responsive bottommargin">
                                <table class="table table-striped table-condensed voc_list" align="center">
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
                                        <?php foreach($all_communites as $community) {
                                        echo '  <tr class="cart_item">';
                                        echo '      <td class="cart-product-thumbnail">';

                                        echo '          <a href="#"><img width="64" height="64" src="'.base_url().'uploads/communities/'.$community->community_img_name.$community->community_img_ext.'" alt="Community Image"></a>';

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
                        <div class="tab-content clearfix" id="tab-2">
                        <!--This is Tab 2 Content -->
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
            </div><!-- .postcontent end -->

            <!-- Sidebar
            ============================================= -->
            
        </div>
    </div>
</section>
