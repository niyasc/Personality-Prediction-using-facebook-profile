<?php
	require_once("../includes/config.php");
	require_once("../includes/initialize.php");
	$uname = $facebook->api('/me?fields=name','GET',array('access_token' => $access_token));
	$logout = $facebook->getLogoutUrl();
	render('test-home.php',array("title"=>"Personality Test", "id"=>$uname['id'], "name"=>$uname['name'],"logout"=>$logout));
?>
