<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/

#s$route['default_controller'] = 'home/index';
$route['default_controller'] = 'home/comingsoon';

$route['home/comingsoon'] = 'home/comingsoon';
$route['home/termsandconditions'] = 'nonessentials/termsandconditions';
$route['home/privacypolicy'] = 'nonessentials/privacypolicy';
$route['home/get_coins'] = 'home/get_coins';
$route['home/subscriber'] = 'home/subscriber';
$route['home/buy_coins'] = 'home/buy_coins';
$route['home/payment_success'] = 'home/payment_success';

$route['home/index']='home';
$route['home/main'] = 'home/main';
$route['home/bank_details'] = 'home/bank_details';
$route['home/community'] = 'home/community';
$route['home/faq'] = 'home/faq';
$route['home/howitworks'] = 'home/howitworks';
$route['home/fb_verify'] = 'home/fb_verify';




// For communitystuff controller
$route['home/create_comm'] = 'communitystuff/create_comm';
$route['home/community/(:num)'] = 'communitystuff/view/$1';

//for recharge controller
$route['home/recharge']='recharge/recharge';
$route['home/view_plans']='recharge/view_plans';
$route['home/match_recharge_code'] = 'recharge/match_recharge_code';


// For request controller
$route['home/join_comm/(:num)'] = 'request/join_community/$1'; // Join community request
$route['home/approve/(:num)'] = 'request/approve/$1';
$route['home/reject/(:num)'] = 'request/reject/$1';
$route['home/joining_request_seen/(:num)/(:num)'] = 'request/joining_request_seen/$1/$2';


$route['home/sendInvitation/(:num)/(:num)'] = 'request/sendInvitation/$1/$2';
$route['home/invitation_accept/(:num)/(:num)'] = 'request/invitation_accept/$1/$2';
$route['home/invitation_decline/(:num)/(:num)'] = 'request/invitation_decline/$1/$2';
$route['home/invitation_seen/(:num)'] = 'request/invitation_seen/$1';

$route['home/upvote_demand/(:num)'] = 'request/upvote_demand/$1';
$route['home/downvote_demand/(:num)'] = 'request/downvote_demand/$1';


// For category controller
$route['home/getDropDown'] = 'categories/getDropDown';

//for bonus controller
$route['home/freeaddposting'] = 'bonus/freeaddposting';
$route['home/freegoldcoins'] = 'bonus/freegoldcoins';
$route['home/freeaddposting'] = 'rechargebonus/freeaddposting';
$route['home/bonusandoffers'] = 'nonessentials/bonusandoffers';


// For deal controller
$route['home/deals'] = 'dealstuff/deals';
$route['home/approve_item_req/(:num)'] = 'dealstuff/approve_item_req/$1';
$route['home/start_renting_period/(:num)'] = 'dealstuff/start_renting_period/$1';
$route['home/stop_renting_period/(:num)'] = 'dealstuff/stop_renting_period/$1';
$route['home/cancel_item_req/(:num)'] = 'dealstuff/cancel_item_req/$1';
$route['home/item_request_comp_success/(:num)'] = 'dealstuff/item_request_comp_success/$1';
$route['home/item_request_can_fail/(:num)'] = 'dealstuff/item_request_can_fail/$1';

$route['home/review_later/(:num)/(:num)'] = 'dealstuff/submit_review/$1/2/$2'; // 2--> for review later


// For itemstuff controller
$route['home/item/(:num)'] = 'itemstuff/item/$1';
$route['home/post/(:num)'] = 'itemstuff/post/$1';
$route['home/updateitemdetails/(:num)'] = 'itemstuff/updateitemdetails/$1';
$route['home/changeitemimage/(:num)'] = 'itemstuff/changeitemimage/$1';
$route['home/managemyitems'] = 'itemstuff/managemyitems';
$route['home/deactivateitem/(:num)'] = 'itemstuff/deactivateitem/$1';
$route['home/activateitem/(:num)'] = 'itemstuff/activateitem/$1';


// For userstuff controller
$route['home/profile/(:num)'] = 'userstuff/profile/$1';
$route['home/register'] = 'userstuff/register';
$route['home/login'] = 'userstuff/login';
$route['home/changeprofilephoto'] = 'userstuff/changeprofilephoto';
$route['home/changemobilenumber'] = 'userstuff/changemobilenumber';
$route['home/logout'] = 'userstuff/logout';
$route['home/passwordchangelink'] = 'userstuff/passwordchangelink';
$route['home/forgotpassword'] = 'userstuff/forgotpassword';
$route['home/send_changepassword_email'] = 'userstuff/send_changepassword_email';
$route['home/changepassword/(:any)'] = 'userstuff/changepassword/$1';
$route['home/verifychangepassword/(:any)'] = 'userstuff/verifychangepassword/$1';


//nonessential controller
$route['home/faq'] = 'nonessentials/faq';
$route['home/howitworks'] = 'nonessentials/howitworks';
$route['home/about-us'] = 'nonessentials/about_us';
$route['home/contact-us'] = 'nonessentials/contact_us';
$route['home/queries'] = 'nonessentials/queries';
$route['home/contactusform'] = 'nonessentials/contactusform';

//userstuff controller
$route['home/wallet/(:num)'] = 'home/wallet/$1';
$route['home/send_mail'] = 'userstuff/send_mail';
$route['home/verify/(:any)'] = 'userstuff/verify/$1';

$route['home/send_mail'] = 'userstuff/send_mail';
$route['home/gen_otp'] = 'userstuff/gen_otp';
$route['home/send_otp'] = 'userstuff/send_otp';
$route['home/verify_mobile'] = 'userstuff/verify_mobile';


// For notification controller
$route['home/getNotifications'] = 'notification/getNotifications';


// For activitystuff controller
$route['home/activities'] = 'activitystuff/activities';


// For reviewstuff controller
$route['review_user/(:num)'] = 'reviewstuff/review_user/$1'; 
$route['submit_user_review'] = 'reviewstuff/submit_user_review';
$route['review_user_item/(:num)'] = 'reviewstuff/review_user_item/$1'; 
$route['submit_user_item_review'] = 'reviewstuff/submit_user_item_review';



// For home controller

$route['home/refer-earn/(:num)'] = 'home/refer_earn/$1';
$route['home/putDemand'] = 'home/putDemand';
$route['home/itemRequest/(:num)/(:num)'] = 'home/itemRequest/$1/$2';
$route['home/wallet/(:num)'] = 'home/wallet/$1';

//$route['home/(:any)'] = 'home/view/$1';
$route['home/user/(:num)'] = 'home/GiverItems/$1';

$route['example'] = 'example/index';

$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
?>
