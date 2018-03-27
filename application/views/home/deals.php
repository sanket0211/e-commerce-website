<section id="page-title" class="page-title-mini">
    <div class="container clearfix">
        <h1>Deals</h1>
        <span>Every deal you have done</span>
        <ol class="breadcrumb">
            <li><a href="<?php echo site_url('home');?>">Home</a></li>
            <li class="active">Deals</li>
        </ol>
    </div>
</section>

<section id="content">
    <div class="content-wrap">
       	<div class="container clearfix">
			<div class="tabs clearfix" id="tabs" data-speed="700" data-active="1" >
	            <ul class="nav nav-tabs">
	                <li class="active my-li"><a href="#tab-1">As a Giver</a></li>
	                <li class="my-li"><a href="#tab-2">As a Borrower</a></li>
	            </ul>
				<div class="tab-content clearfix" id="tab-1">
					<!--This is Tab 1 Content -->
					<div id="posts" class="post-grid grid-3 clearfix">
					<?php
					if ($giver_list != NULL) {
						foreach($giver_list as $deal) {
							$deal_days = $deal->deal_days-1;// -1 to show date correctly
							$start_date = date("d-M-Y", strtotime($deal->start_date));
							$end_date = date("d-M-Y", strtotime($deal->start_date .'+ '. $deal_days .' day'));
					        echo '	<div class="entry clearfix topmargin-sm">';
					        echo '    <div class="entry-image">';
					        echo '        <a href="'.base_url().'uploads/items/'.$deal->item_img_name.$deal->item_img_ext.'" data-lightbox="image"><img class="image_fade" src="'.base_url().'uploads/items/'.$deal->item_img_name.$deal->item_img_ext.'" alt=""></a>';
					        echo '    </div>';
					        echo '    <div class="entry-title">';
					        echo '        <h2 class="inline-block"><a href="'.site_url('home/item/'.$deal->item_id).'">'. $deal->item_name .'</a></h2>';
					        if ($deal->status == DEAL_STATUS_PENDING) {
					        	echo '    <span class="label label-primary">Pending</span>';
					        } else if($deal->status == DEAL_STATUS_ACCEPTED) {
					        	echo '    <span class="label label-info">Accepted</span>';
					        } else if($deal->status == DEAL_STATUS_RENTING_START) {
					        	echo '	  <span class="label label-warning">Renting started</span>';
					        } else if($deal->status == DEAL_STATUS_RENTING_END) {
					        	echo '    <span class="label label-warning">Renting over</span>';
					        } else if($deal->status == DEAL_STATUS_CANCELLED) {
					        	echo '    <span class="label label-default">Cancelled</span>';
					        } else if($deal->status == DEAL_STATUS_G_SEEN or $deal->status == DEAL_STATUS_B_SEEN or $deal->status == DEAL_STATUS_BOTH_SEEN) {
					        	echo '    <span class="label label-success">Successful</span>';
					    	} else if($deal->status == DEAL_STATUS_UNSUCCESS_SEEN) {
					        	echo '    <span class="label label-danger">Failed</span>';
					        }
					        echo '    </div>';
					        echo '    <ul class="entry-meta clearfix">';
					        echo '        <li><i class="icon-rupee"></i> '. $deal->item_rent .'</li>';
					        echo '        <li><i class="icon-diamond"></i> '. ($deal->item_rent/10) .'</li>';
					        echo '    </ul>';
					        echo '    <div class="entry-content">';
					        echo '    	<p class="nobottommargin"><i class="icon-calendar3"></i> '. $start_date .' - '. $end_date.' </p>';
					        echo '      <p class="nobottommargin"><i class="icon-line2-user"></i> Borrowed by : <a href="'. site_url('home/user/'. $deal->user_id) .'">'. $deal->user_name .'</a></p>';
					        echo '      <p class="nobottommargin"><i class="icon-diamond"></i> Total earnings:<i class="icon-rupee"></i> '.$deal->item_rent * ($deal_days+1).'</i></p>';// compansate -1
					        if ($deal->status == DEAL_STATUS_G_SEEN or $deal->status == DEAL_STATUS_B_SEEN or $deal->status == DEAL_STATUS_BOTH_SEEN) {
						        if ($deal->g_reviewed == REVIEW_PENDING OR $deal->g_reviewed == REVIEW_LATER) {
									echo '   <a href="'. site_url('review_user/'.$deal->deal_id ) .'" class="inline-block button button-3d button-mini button-rounded button-red">Submit review</a>';
						        } else if ($deal->g_reviewed == REVIEW_SUBMITTED) {
									echo '   <a href="'. site_url('review_user/'.$deal->deal_id ) .'" class="inline-block button button-3d button-mini button-rounded button-green">Edit review</a>';
						        }
					    	}
					        echo '    </div>';
					        echo '	</div>';
					    }
					} else
					    echo '<h2>No deals as giver</h2>'; 
				    ?>
				    </div>
				</div>
				<div class="tab-content clearfix" id="tab-2">
					<!--This is Tab 2 Content -->
					<div id="posts" class="post-grid grid-3 clearfix">
					<?php
					if ($borrower_list != NULL) {
						foreach($borrower_list as $deal) {
							$deal_days = $deal->deal_days-1;
							$start_date = date("d-M-Y", strtotime($deal->start_date));
							$end_date = date("d-M-Y", strtotime($deal->start_date .'+ '. $deal_days .' day'));
					        echo '	<div class="entry clearfix topmargin-sm">';
					        echo '    <div class="entry-image">';
					        echo '        <a href="'.base_url().'uploads/items/'.$deal->item_img_name.$deal->item_img_ext.'" data-lightbox="image"><img class="image_fade" src="'.base_url().'uploads/items/'.$deal->item_img_name.$deal->item_img_ext.'" alt=""></a>';
					        echo '    </div>';
					        echo '    <div class="entry-title">';
					        echo '        <h2 class="inline-block"><a href="'.site_url('home/item/'.$deal->item_id).'">'. $deal->item_name .'</a></h2>';
					        if ($deal->status == DEAL_STATUS_PENDING) {
					        	echo '    <span class="label label-primary">Pending</span>';
					        } else if($deal->status == DEAL_STATUS_ACCEPTED) {
					        	echo '    <span class="label label-info">Accepted</span>';
					        } else if($deal->status == DEAL_STATUS_RENTING_START) {
					        	echo '	  <span class="label label-warning">Renting started</span>';
					        } else if($deal->status == DEAL_STATUS_RENTING_END) {
					        	echo '    <span class="label label-warning">Renting over</span>';
					        } else if($deal->status == DEAL_STATUS_CANCELLED) {
					        	echo '    <span class="label label-default">Cancelled</span>';
					        } else if($deal->status == DEAL_STATUS_G_SEEN or $deal->status == DEAL_STATUS_B_SEEN or $deal->status == DEAL_STATUS_BOTH_SEEN) {
					        	echo '    <span class="label label-success">Successful</span>';
					    	} else if($deal->status == DEAL_STATUS_UNSUCCESS_SEEN) {
					        	echo '    <span class="label label-danger">Failed</span>';
					        }
					        echo '    </div>';
					        echo '    <ul class="entry-meta clearfix">';
					        echo '        <li><i class="icon-rupee"></i> '. $deal->item_rent .'</li>';
					        echo '        <li><i class="icon-diamond"></i> '. ($deal->item_rent/10) .'</li>';
					        echo '    </ul>';
					        echo '    <div class="entry-content">';
					        echo '    	<p class="nobottommargin"><i class="icon-calendar3"></i> '. $start_date .' - '. $end_date.' </p>';
					        echo '      <p class="nobottommargin"><i class="icon-line2-user"></i> Given by : <a href="'. site_url('home/user/'. $deal->user_id) .'">'. $deal->user_name .'</a></p>';
					        echo '      <p class="nobottommargin"><i class="icon-diamond"></i> Total rent:<i class="icon-rupee"></i> '. $deal->item_rent * ($deal_days+1).'</i></p>';  // compansate -1
					        if ($deal->status == DEAL_STATUS_G_SEEN or $deal->status == DEAL_STATUS_B_SEEN or $deal->status == DEAL_STATUS_BOTH_SEEN) {
						        if ($deal->b_reviewed == REVIEW_PENDING OR $deal->b_reviewed == REVIEW_LATER) {
									echo '   <a href="'. site_url('review_user_item/'.$deal->deal_id ) .'" class="inline-block button button-3d button-mini button-rounded button-red">Submit review</a>';
						        } else if ($deal->b_reviewed == REVIEW_SUBMITTED) {
									echo '   <a href="'. site_url('review_user_item/'.$deal->deal_id ) .'" class="inline-block button button-3d button-mini button-rounded button-green">Edit review</a>';
						        }
					    	}
					        echo '    </div>';
					        echo '	</div>';
					    }
					} else
					    echo '<h2>No deals as borrower</h2>'; 
				    ?>
					</div>
				</div>
        </div>
	</div>
</section><!-- #content end -->

<script>
$(function() {
	$(".my-li").click(function() {
		$(".active").toggleClass("active");
		$(this).toggleClass("active");
	});
});
$('[data-toggle=popover]').popover();
</script>
                         
