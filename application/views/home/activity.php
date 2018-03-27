<section id="page-title" class="page-title-mini">

        <div class="container clearfix">
            <h1>Activity Log</h1>
            <span>Your activity log</span>
            <ol class="breadcrumb">
                <li><a href="<?php echo site_url('home');?>">Home</a></li>
                <li class="active">Activity</li>
            </ol>
        </div>

</section>
<section id="content">

            <div class="content-wrap">

                <div class="container clearfix">
                	<?php
					if ($activities) {
						
						foreach ($activities as $activity) {
							echo '<div class="postcontent nobottommargin clearfix">';
                       	   	//echo '	<h3>Standard</h3>';
							if ($activity->activity_type == TYPE_CREATE_COMMUNITY) {
								echo '<p>Created the '. $activity->community_name .' community.</p>';
							} elseif ($activity->activity_type == TYPE_POST_ITEM) {
								echo '<p>Posted the '. $activity->item_name . '</p>';
							} elseif ($activity->activity_type == TYPE_REQUEST_ITEM) {
								echo '<p>Requested for '. $activity->item_name . ' from '. $activity->giver_name .'.</p>';
							} elseif ($activity->activity_type == TYPE_ACCEPT_ITEM_REQUEST) {
								echo '<p>Accepted the request for '. $activity->item_name .' of '. $activity->borrower_name.'.</p>';
							} elseif ($activity->activity_type == TYPE_REJECT_ITEM_REQUEST) {
								echo '<p>Rejected the request for '. $activity->item_name .' of '. $activity->borrower_name.'.</p>';
							} elseif ($activity->activity_type == TYPE_JOIN_COMMUNITY_REQ) {
								echo '<p>Requested to join the '. $activity->community_name .' community.</p>';
							} elseif ($activity->activity_type == TYPE_JOIN_COMMUNITY_REQ_ACCEPTED) {
								echo '<p>Accepted join request for the '. $activity->community_name .' community.</p>';
							} elseif ($activity->activity_type == TYPE_JOIN_COMMUNITY_REQ_REJECTED) {
								echo '<p>Rejected join request for the '. $activity->community_name .' community.</p>';
							} elseif ($activity->activity_type == TYPE_INVITATION_SENT) {
								echo '<p>Invitation to join the '. $activity->community_name .' community sent to '. $activity->other_user_name .'.</p>';
							} elseif ($activity->activity_type == TYPE_INVITATION_ACCEPTED) {
								echo '<p>Accepted the invitation to join the '. $activity->community_name .' community sent by '. $activity->other_user_name .'.</p>';
							} elseif ($activity->activity_type == TYPE_INVITATION_REJECTED) {
								echo '<p>Rejected the invitation to join the '. $activity->community_name .' community sent by '. $activity->other_user_name .'.</p>';
							} elseif ($activity->activity_type == TYPE_ITEM_REVIEW_SUBMITTED) {
								echo '<p>Submitted review for the item '. $activity->item_name .'</p>';
							} elseif ($activity->activity_type == TYPE_USER_REVIEW_SUBMITTED) {
								echo '<p>Submitted review for the user '. $activity->other_user_name .'</p>';
							} elseif ($activity->activity_type == TYPE_DEAL_CANCELED) {
								echo '<p>Canceled the deal for the item '. $activity->item_name .'</p>';
							} 
							echo '	<div class="divider"><i class="icon-circle"></i></div>';

                    		echo '</div>';
						}
						// Sidebar ============================================= 
                    	echo '<div class="sidebar nobottommargin col_last clearfix">';
                        echo '	<div class="sidebar-widgets-wrap">';

                        echo '  	<div class="widget widget_links clearfix">';

                        echo '        <h4>Month</h4>';
                        echo '        <ul>';
                        echo '            <li><a href="animations.html"><div>Month 1</div></a></li>';
                        echo '            <li><a href="buttons.html"><div>Month 2</div></a></li>';
                        echo '        </ul>';

                        echo '    	</div>';

                        echo '	</div>';
                    	echo '</div>'; // sidebar end
						
					} else {
						echo "<h2>No activities</h2>";
					}
					?>

                    

                </div>

            </div>

        </section><!-- #content end -->
