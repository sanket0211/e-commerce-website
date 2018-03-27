<?php
// Manages all notification related actions
class Notification extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Notify');
		$this->load->model('Deal');

	}

	private function is_logged_in() {
		return null !== $this->session->userdata('logged_in');
	}

	private function getUserId() {
		if($this->is_logged_in()) {
			$session_data = $this->session->userdata('logged_in');
			return $session_data['user_id'];
		}
		return NULL;
	}

	private function getNotificationsCount() {
		$user_id = $this->getUserId();

		// Join community request from a user to its members
		$requests_count = $this->Notify->member_notification_count($user_id);

		// notification related to join community requests (accepted/rejected)
		$joining_notify = $this->Notify->join_community_notifications($user_id);

		// notification related to invitations
		$invitee_notify = $this->Notify->invitee_notifications($user_id);

		// notification related to invitations
		$inviter_notify = $this->Notify->inviter_notifications($user_id);

		// item requests(for giver)
		$item_requests = $this->Deal->notify_giver($user_id);
		$item_requests_count = 0;
		if ($item_requests) {
			foreach ($item_requests as $item_request) {
				// for giver
				$status = $item_request->status;
				if($item_request->status == DEAL_STATUS_PENDING){
					$item_requests_count++;
				} else if($item_request->status == DEAL_STATUS_ACCEPTED) {
					$item_requests_count++;
				} else if($item_request->status == DEAL_STATUS_RENTING_START) {
					$item_requests_count++;
				} else if($item_request->status == DEAL_STATUS_RENTING_END OR $item_request->status == DEAL_STATUS_B_SEEN) {
					$item_requests_count++;
				}
				if(($status == DEAL_STATUS_RENTING_END OR $status == DEAL_STATUS_B_SEEN OR $status ==DEAL_STATUS_G_SEEN OR $status == DEAL_STATUS_BOTH_SEEN) AND $item_request->g_reviewed == REVIEW_PENDING) {
					$item_requests_count++;
				}
			}
		}
		//var_dump($item_requests_count);


		// item reponses corresponds to a request(for borrower)
		$item_responses = $this->Deal->notify_borrower($user_id);
		$item_responses_count = 0;
		if ($item_responses) {
			// for borrower
			foreach ($item_responses as $item_response) {
				$status = $item_response->status;
				if($status == DEAL_STATUS_ACCEPTED) {
					$item_responses_count++;
				} else if($status == DEAL_STATUS_RENTING_START) {
					$item_responses_count++;
				} else if($status == DEAL_STATUS_RENTING_END OR $status == DEAL_STATUS_G_SEEN) {
					$item_responses_count++;
				} else if($status == DEAL_STATUS_CANCELLED) {
					$item_responses_count++;
				}
				if( ($status == DEAL_STATUS_RENTING_END OR $status == DEAL_STATUS_B_SEEN OR $status == DEAL_STATUS_G_SEEN
						OR $status == DEAL_STATUS_BOTH_SEEN) AND $item_response->b_reviewed == REVIEW_PENDING) {
					$item_responses_count++;
				}
			}
		}
		//var_dump($item_responses_count);

		$notification = array();
		$notification['count'] = $requests_count + count($joining_notify) + count($invitee_notify) +
					count($inviter_notify) + $item_requests_count + $item_responses_count;
		$notification['requests_count'] = $requests_count;
		$notification['joining_notify_count'] = count($joining_notify);
		$notification['invitee_notify_count'] = count($invitee_notify);
		$notification['inviter_notify_count'] = count($inviter_notify);
		$notification['item_requests_count'] = $item_requests_count;
		$notification['item_responses_count'] = $item_responses_count;

		return (object) $notification;
	}

	// All the notification stuff managed here
	public function getNotifications(){

		if (!$this->is_logged_in()) {
			return NULL;
		}
		
		$user_id = $this->getUserId();

		// Join community request from a user to its members
		$requests = $this->Notify->notify_members($user_id);

		// notification related to join community requests (accepted/rejected)
		$joining_notify = $this->Notify->join_community_notifications($user_id);

		// notification related to invitations
		$invitee_notify = $this->Notify->invitee_notifications($user_id);

		// notification related to invitations
		$inviter_notify = $this->Notify->inviter_notifications($user_id);

		// item requests(for giver)
		$item_requests = $this->Deal->notify_giver($user_id);

		// item reponses corresponds to a request(for borrower)
		$item_responses = $this->Deal->notify_borrower($user_id);

		// number of notifications
		$notifications = $this->getNotificationsCount();

		
		/*var_dump($item_responses);
		die();*/
		if ($notifications->count > 0 ) {
			$lol = '<a href="#" id="top-cart-trigger"><i class="icon-bell"></i><span>'.$notifications->count .'</span></a>';
		} else {
			$lol = '<a href="#" id="top-cart-trigger"><i class="icon-bell"></i></a>';
		}
		echo $lol;
		echo '	<div class="top-cart-content">';
		echo '		<div class="top-cart-title">';
        echo '			<h4>Notifications</h4>';
        echo '		</div>';
        echo '		<div class="top-cart-items" style="height:200px; overflow-y: scroll;">';
        
		if($notifications->joining_notify_count > 0) {
			// join communities requests
			foreach($joining_notify as $response) {
                echo '<div class="top-cart-item clearfix">';
				echo '	<div class="top-cart-item-desc" id="div-response">';
				if($response->status == NOTIFICATION_ACCEPTED) {
					echo ' 		<p class="nobottommargin"> your request for join ' . $response->community_name . ' community  is accepted !</p>' ;
					echo '      <button onclick="join_request_ok('. $response->notification_id .', '. TYPE_ACCEPT .')" class="ajax-notify inline-block button button-3d button-mini button-rounded button-leaf">OK</button>';
				}
				else if($response->status == NOTIFICATION_REJECTED) {
					echo ' 		<p class="nobottommargin"> your request has for join ' . $response->community_name . ' community is rejected !</p>' ;
					echo '      <button onclick="join_request_ok('. $response->notification_id .', '. TYPE_REJECT .')" class="ajax-notify inline-block button button-3d button-mini button-rounded button-leaf">OK</button>';
				}
                echo '    </div>';
                echo '</div>';
            }
        }
        if($notifications->invitee_notify_count > 0) {
			// invitations for invitee
			// var_dump($invitee_notify);
			foreach($invitee_notify as $invite) {
                echo '<div class="top-cart-item clearfix">';
				echo '	<div class="top-cart-item-desc" id="div-response">';
				echo ' 		<p class="nobottommargin"><a class="inline-block" href='. site_url('home/GiverItems/'. $invite->invitee_id ) .'> '. $invite->invitee_name .'</a> invited you to join ' . $invite->community_name . ' Community</p>' ;					
				echo '      <button onclick="accept_invitation('. $invite->community_id . ',' . $invite->invitee_id .')" class="ajax-notify inline-block button button-3d button-mini button-rounded button-green">Accept</button>';
				echo '      <button onclick="decline_invitation('. $invite->community_id . ',' . $invite->invitee_id .')" class="ajax-notify inline-block button button-3d button-mini button-rounded button-amber">Reject</button>';
            	echo '    </div>';
            	echo '</div>';
            }
        }
        if($notifications->inviter_notify_count > 0) {
			// invitation responses for inviter
			// var_dump($inviter_notify);
			foreach($inviter_notify as $invite) {
                echo '<div class="top-cart-item clearfix">';
				echo '	<div class="top-cart-item-desc" id="div-response">';
				if($invite->status == 1) {
					echo ' 		<p class="nobottommargin">' . $invite->user_name. ' had accepted the invitation for joining  ' . $invite->community_name . ' Community</p>' ;

				}
				else if($invite->status == 2 ) {
					echo ' 		<p class="nobottommargin">' . $invite->user_name. ' had declined the invitation for joining  ' . $invite->community_name . ' Community</p>' ;
				}
				echo '      <button onclick="ok_seen_invitation('. $invite->notification_id .')" class="ajax-notify inline-block button button-3d button-mini button-rounded button-leaf">OK</button>';
            	echo '    </div>';
            	echo '</div>';
            }
        }
        if($notifications->requests_count > 0) {
            foreach($requests as $request){
                echo '<div class="top-cart-item clearfix">';
				echo '  <div class="top-cart-item-desc" id="div-request">';
				echo '  	<p class="nobottommargin"><a class="inline-block" href='. site_url('home/GiverItems/'. $request->user_id ) .'> '. $request->user_name .'</a> has requested to join your community '.$request->community_name.'</p>';
               	echo '      <button onclick="join_request('. $request->notification_id .', '. TYPE_ACCEPT .')" class="inline-block button button-3d button-mini button-rounded button-green ajax-notify">Accept</a>';
               	echo '      <button onclick="join_request('. $request->notification_id .', '. TYPE_REJECT .')" class="inline-block button button-3d button-mini button-rounded button-amber ajax-notify">Reject</a>';
                echo '    </div>';
                echo '</div>';
            }
        }
        if($notifications->item_requests_count > 0) {
        	// for giver
            foreach($item_requests as $item_request){
            	$status = $item_request->status;
				$item_name = $item_request->item_name;
                
                // pending request
                if($item_request->status == DEAL_STATUS_PENDING){
                   echo '<div class="top-cart-item clearfix">';
				   echo '  <div class="top-cart-item-desc" id="div-item-request">';
				   echo '  	<p class="nobottommargin">'.$item_request->user_name.' has requested for '.$item_request->item_name.'</p>';
				   echo '   <button onclick="item_request('. $item_request->deal_id . ', 1)" class="ajax-notify inline-block button button-3d button-mini button-rounded button-green">Accept</button>';
				   echo '   <button onclick="item_request('. $item_request->deal_id . ', 0)" class="ajax-notify inline-block button button-3d button-mini button-rounded button-amber">Reject</button>';
				   echo '    </div>';
                   echo '</div>';
                }
                // request accepted.
                else if($item_request->status == DEAL_STATUS_ACCEPTED) {
                	echo '<div class="top-cart-item clearfix">';
				   echo '  <div class="top-cart-item-desc" id="div-item-request">';
                   echo '   <p class="nobottommargin">Deal! Contact <a class="inline-block" href='. site_url('home/GiverItems/'. $item_request->user_id ) .'> '. $item_request->user_name .'</a></p>';
                   echo '    </div>';
                   echo '</div>';
                }
                // renting period started
                else if($item_request->status == DEAL_STATUS_RENTING_START) {
                	echo '<div class="top-cart-item clearfix">';
				    echo '  <div class="top-cart-item-desc" id="div-item-request">';
                    echo '  <p class="nobottommargin">Renting period for the '.$item_name.' has started!';
                    echo '    </div>';
                	echo '</div>';
                }
                // renting period over
                else if($item_request->status == DEAL_STATUS_RENTING_END OR $item_request->status == DEAL_STATUS_B_SEEN) {
                	echo '<div class="top-cart-item clearfix">';
				    echo '  <div class="top-cart-item-desc" id="div-item-request">';
                    echo '   <p class="nobottommargin">Renting period for the '.$item_request->item_name.' is now over.</p>';
                    echo '   <button onclick="ok_comp_success('.$item_request->deal_id.')" id="notify-again" class="inline-block button button-3d button-mini button-rounded button-leaf">OK</button>';
                    echo '    </div>';
                	echo '</div>';
                }
				// Asking for review
				if( ($status == DEAL_STATUS_RENTING_END OR $status == DEAL_STATUS_B_SEEN OR $status == DEAL_STATUS_G_SEEN
					OR $status == DEAL_STATUS_BOTH_SEEN) AND $item_request->g_reviewed == REVIEW_PENDING) {
					echo '<div class="top-cart-item clearfix">';
				    echo '  <div class="top-cart-item-desc" id="div-item-request">';
					echo '   <p class="nobottommargin">Please review the '.$item_request->user_name.' that you lend the '. $item_request->item_name.'.</p>';
                   	echo '   <button onclick="reviewing('. $item_request->deal_id .','. GIVER .')" id="notify-again" class="inline-block button button-3d button-mini button-rounded button-leaf">Review Now!</button>';
					echo '   <button onclick="review_later('.$item_request->deal_id.', 1)" id="notify-again" class="inline-block button button-3d button-mini button-rounded button-leaf">Review later</button>';
					echo '    </div>';
                	echo '</div>';
				}
                
            }
        }
        if($notifications->item_responses_count > 0) {
        	// for borrower
            foreach($item_responses as $item_response){
                $status = $item_response->status;
                $item_name = $item_response->item_name;
                $mobile = "Mobile number";
				$email = "Email id";
                
                // request accepted
                if($status == DEAL_STATUS_ACCEPTED) {
                	echo '<div class="top-cart-item clearfix">';
                	echo '   <div class="top-cart-item-desc" id="div-item-response">';
                    echo '   <p class="nobottommargin">Deal! Contact <a class="inline-block" href='. site_url('home/GiverItems/'. $item_response->user_id ) .'> '. $item_response->user_name  .'</a> at Phone <strong>'. $mobile .'</strong> or at Email <strong>'. $email .'</strong>.</p>';
                    echo '    </div>';
                	echo '</div>';
                }
                // renting period started.
                else if($status == DEAL_STATUS_RENTING_START) {
                	echo '<div class="top-cart-item clearfix">';
                	echo '   <div class="top-cart-item-desc" id="div-item-response">';
                    echo '  <p class="nobottommargin">Renting period for the '.$item_name.' has started!';
                    echo '    </div>';
                	echo '</div>';
                }
                // renting period over, ask for review
                else if($status == DEAL_STATUS_RENTING_END OR $status == DEAL_STATUS_G_SEEN) {
                	echo '<div class="top-cart-item clearfix">';
                	echo '   <div class="top-cart-item-desc" id="div-item-response">';
                    echo '   <p class="nobottommargin">Renting period for the '.$item_response->item_name.' is now over.</p>';
                   	echo '   <button onclick="ok_comp_success('.$item_response->deal_id.')" id="notify-again" class="inline-block button button-3d button-mini button-rounded button-leaf">OK</button>';
                   	echo '    </div>';
                	echo '</div>';
                }
                // request cancelled
                else if($status == DEAL_STATUS_CANCELLED) {
                	echo '<div class="top-cart-item clearfix">';
                	echo '   <div class="top-cart-item-desc" id="div-item-response">';
                    echo '   <p class="nobottommargin"> Your request for the '.$item_name.' has cancelled.</p>';
                    echo '   <button onclick="ok_can_fail('.$item_response->deal_id.')" id="notify-again" class="inline-block button button-3d button-mini button-rounded button-leaf">OK</button>';
                    echo '    </div>';
                	echo '</div>';
                }
                
                // Asking for review
				if( ($status == DEAL_STATUS_RENTING_END OR $status == DEAL_STATUS_B_SEEN OR $status == DEAL_STATUS_G_SEEN
					OR $status == DEAL_STATUS_BOTH_SEEN) AND $item_response->b_reviewed == REVIEW_PENDING) {
					echo '<div class="top-cart-item clearfix">';
                	echo '   <div class="top-cart-item-desc" id="div-item-response">';
					echo '   <p class="nobottommargin">Please review the '.$item_response->user_name.' and his '. $item_response->item_name.' that you borrower.</p>';
                   	echo '   <button onclick="reviewing('. $item_response->deal_id .', '. BORROWER .')" id="notify-again" class="inline-block button button-3d button-mini button-rounded button-leaf" data-toggle="modal" data-target=".borrower-review-box">Review Now!</button>';
					echo '   <button onclick="review_later('.$item_response->deal_id.', 2)" id="notify-again" class="inline-block button button-3d button-mini button-rounded button-leaf">Review later</button>';
					echo '    </div>';
                	echo '</div>';
				}
                
            }
        }

        if($notifications->count == 0) {
	            echo '<div class="top-cart-item clearfix">';
	            echo '  <div class="top-cart-item-desc">';
	            echo '      <p class="nobottommargin">No new notifications</p>';
	            echo '    </div>';
	            echo '</div>';
		}
		        // show all notifications
		        /*echo '<div class="top-cart-item clearfix">';
		        echo '  <div class="top-cart-item-desc">';
		        echo '      <a href="'.site_url('home/deals').'" class="inline-block button button-3d button-mini button-rounded button-dirtygreen">View all notifications</a>';
		        echo '    </div>';
		        echo '</div>';*/
    	
		echo '		</div>';
        echo '	</div>';
	}
}
?>