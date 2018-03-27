<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Display Debug backtrace
|--------------------------------------------------------------------------
|
| If set to TRUE, a backtrace will be displayed along with php errors. If
| error_reporting is disabled, the backtrace will not display, regardless
| of this setting
|
*/
defined('SHOW_DEBUG_BACKTRACE') OR define('SHOW_DEBUG_BACKTRACE', TRUE);

/*
|--------------------------------------------------------------------------
| File and Directory Modes
|--------------------------------------------------------------------------
|
| These prefs are used when checking and setting modes when working
| with the file system.  The defaults are fine on servers with proper
| security, but you may wish (or even need) to change the values in
| certain environments (Apache running a separate process for each
| user, PHP under CGI with Apache suEXEC, etc.).  Octal values should
| always be used to set the mode correctly.
|
*/
defined('FILE_READ_MODE')  OR define('FILE_READ_MODE', 0644);
defined('FILE_WRITE_MODE') OR define('FILE_WRITE_MODE', 0666);
defined('DIR_READ_MODE')   OR define('DIR_READ_MODE', 0755);
defined('DIR_WRITE_MODE')  OR define('DIR_WRITE_MODE', 0755);

/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
*/
defined('FOPEN_READ')                           OR define('FOPEN_READ', 'rb');
defined('FOPEN_READ_WRITE')                     OR define('FOPEN_READ_WRITE', 'r+b');
defined('FOPEN_WRITE_CREATE_DESTRUCTIVE')       OR define('FOPEN_WRITE_CREATE_DESTRUCTIVE', 'wb'); // truncates existing file data, use with care
defined('FOPEN_READ_WRITE_CREATE_DESCTRUCTIVE') OR define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE', 'w+b'); // truncates existing file data, use with care
defined('FOPEN_WRITE_CREATE')                   OR define('FOPEN_WRITE_CREATE', 'ab');
defined('FOPEN_READ_WRITE_CREATE')              OR define('FOPEN_READ_WRITE_CREATE', 'a+b');
defined('FOPEN_WRITE_CREATE_STRICT')            OR define('FOPEN_WRITE_CREATE_STRICT', 'xb');
defined('FOPEN_READ_WRITE_CREATE_STRICT')       OR define('FOPEN_READ_WRITE_CREATE_STRICT', 'x+b');

/*
|--------------------------------------------------------------------------
| Exit Status Codes
|--------------------------------------------------------------------------
|
| Used to indicate the conditions under which the script is exit()ing.
| While there is no universal standard for error codes, there are some
| broad conventions.  Three such conventions are mentioned below, for
| those who wish to make use of them.  The CodeIgniter defaults were
| chosen for the least overlap with these conventions, while still
| leaving room for others to be defined in future versions and user
| applications.
|
| The three main conventions used for determining exit status codes
| are as follows:
|
|    Standard C/C++ Library (stdlibc):
|       http://www.gnu.org/software/libc/manual/html_node/Exit-Status.html
|       (This link also contains other GNU-specific conventions)
|    BSD sysexits.h:
|       http://www.gsp.com/cgi-bin/man.cgi?section=3&topic=sysexits
|    Bash scripting:
|       http://tldp.org/LDP/abs/html/exitcodes.html
|
*/
defined('EXIT_SUCCESS')        OR define('EXIT_SUCCESS', 0); // no errors
defined('EXIT_ERROR')          OR define('EXIT_ERROR', -1); // generic error
defined('EXIT_CONFIG')         OR define('EXIT_CONFIG', -3); // configuration error
defined('EXIT_UNKNOWN_FILE')   OR define('EXIT_UNKNOWN_FILE', -4); // file not found
defined('EXIT_UNKNOWN_CLASS')  OR define('EXIT_UNKNOWN_CLASS', -5); // unknown class
defined('EXIT_UNKNOWN_METHOD') OR define('EXIT_UNKNOWN_METHOD', -6); // unknown class member
defined('EXIT_USER_INPUT')     OR define('EXIT_USER_INPUT', -7); // invalid user input
defined('EXIT_DATABASE')       OR define('EXIT_DATABASE', -8); // database error
defined('EXIT__AUTO_MIN')      OR define('EXIT__AUTO_MIN', -9); 
defined('EXIT__AUTO_MAX')      OR define('EXIT__AUTO_MAX', -125); // lowest automatically-assigned error code
// Accept/Reject constant mostly used on js funtion call
define('TYPE_ACCEPT', 1);
define('TYPE_REJECT', 0);

// Constants used to differentiate b/w Giver or Borrower
define('GIVER', 1);
define('BORROWER', 2);

// Notification types
define('NOTIFICATION_TYPE_JOIN', 0);
define('NOTIFICATION_TYPE_INVITE', 1);

// Notification status
define('NOTIFICATION_PENDING', 0);
define('NOTIFICATION_ACCEPTED', 1);
define('NOTIFICATION_REJECTED', 2);
define('NOTIFICATION_ACCEPTED_AND_SEEN', 3);
define('NOTIFICATION_REJECTED_AND_SEEN', 4);


// Activity type and respected constants
define('TYPE_CREATE_COMMUNITY', 0);
define('TYPE_POST_ITEM', 1);
define('TYPE_REQUEST_ITEM', 2);
define('TYPE_ACCEPT_ITEM_REQUEST', 3);
define('TYPE_REJECT_ITEM_REQUEST', 4);
define('TYPE_JOIN_COMMUNITY_REQ', 5);
define('TYPE_JOIN_COMMUNITY_REQ_ACCEPTED', 6);
define('TYPE_JOIN_COMMUNITY_REQ_REJECTED', 7);
define('TYPE_INVITATION_SENT', 8);
define('TYPE_INVITATION_ACCEPTED', 9);
define('TYPE_INVITATION_REJECTED', 10);
define('TYPE_ITEM_REVIEW_SUBMITTED', 11);
define('TYPE_USER_REVIEW_SUBMITTED', 12);
define('TYPE_DEAL_CANCELED', 13);

// Deal status
define('DEAL_STATUS_PENDING', 0);
define('DEAL_STATUS_ACCEPTED', 1);
define('DEAL_STATUS_RENTING_START', 2);
define('DEAL_STATUS_RENTING_END', 3);
define('DEAL_STATUS_CANCELLED', 4);
define('DEAL_STATUS_G_SEEN', 5);
define('DEAL_STATUS_B_SEEN', 6);
define('DEAL_STATUS_UNSUCCESS_SEEN', 7);
define('DEAL_STATUS_BOTH_SEEN', 8);

// Item activate/deactivate
define('ACTIVATE_ITEM', 0);
define('DEACTIVATE_ITEM', 1);

// Review status
define('REVIEW_PENDING', 0);
define('REVIEW_SUBMITTED', 1);
define('REVIEW_LATER', 2);

// Role type
define('USER_TYPE_ADMIN', 1);
define('USER_TYPE_MEMBER', 0);
