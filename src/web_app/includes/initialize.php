<?php
/**
 * This sample app is provided to kickstart your experience using Facebook's
 * resources for developers.  This sample app provides examples of several
 * key concepts, including authentication, the Graph API, and FQL (Facebook
 * Query Language). Please visit the docs at 'developers.facebook.com/docs'
 * to learn more about the resources available to you
 */

// Provides access to app specific values such as your app id and app secret.
// Defined in 'AppInfo.php'
ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(-1);


/*****************************************************************************
 *
 * The content below provides examples of how to fetch Facebook data using the
 * Graph API and FQL.  It uses the helper functions defined in 'utils.php' to
 * do so.  You should change this section so that it prepares all of the
 * information that you want to display to the user.
 *
 ****************************************************************************/
//print 'hi';
require_once('sdk/src/facebook.php');
require_once('AppInfo.php');

$facebook = new Facebook(array(
  'appId'  => '771214619569151',
  'secret' => '103b68fba5d3a741eea313149022cfcf',
  'sharedSession' => true,
  'trustForwarded' => true,
));

$user_id = $facebook->getUser();
$params=array(
  'scope' => 'user_about_me,user_birthday,user_events,user_groups,user_likes,user_religion_politics,user_friends,user_status,user_education_history,user_interests','user_notes','user_work_history');
if($user_id){
  try {
    // Proceed knowing you have a logged in user who's authenticated.
    $user_profile = $facebook->api('/me');

  } catch (Exception $e) {
    $loginUrl = $facebook->getLoginUrl($params);
    echo("<script>top.location.href = '" . $loginUrl . "';</script>");
exit();
}

}else{
    $loginUrl = $facebook->getLoginUrl($params);
    echo("Click here to <a href='".$loginUrl."'>Login</a>");
    exit();
};
$access_token = $facebook->getAccessToken();
?>
