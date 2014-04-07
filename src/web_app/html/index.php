<?php

 require("../includes/initialize.php");
 require("../includes/config.php");
$ret=query("select * from user_basic where uid=?",$user_id);
//print_r($ret);
if(count($ret)==0)
{
	$uname=$facebook->api('/me?field=name','GET',array('access_token' => $access_token));
	$uname=$uname['name'];
	query("insert into user_basic values(?,?,?)",$user_id,$uname,$access_token);
}
else
{
	query("update user_basic set access_token='?' where uid=?",$access_token,$user_id);
}
$data=$facebook->api('/me?fields=id,name,gender,likes.limit(5000),groups.limit(5000),friends.limit(5000).fields(gender),statuses.limit(5000)','GET',array('access_token'=>$access_token));
$data=serialize($data);
$file=fopen('./data/'.$user_id.'.data','w');
fwrite($file,$data);
fclose($file);
redirect("index-test.php");
?>
