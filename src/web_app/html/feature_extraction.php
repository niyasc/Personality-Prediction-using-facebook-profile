<?php
	//print 'hi';
	require_once("../includes/config.php");
	require_once("../includes/initialize.php");
	$ids=query("select uid from features");
	//print_r($ids);
	foreach($ids as $id)
	{
		print $id["uid"]."<br/>";
		try{
		$uid=$id["uid"];
		$access_token=query("select access_token from user_basic where uid=?",$uid);
		$access_token=$access_token[0]["access_token"];
		$data=$facebook->api('/'.$uid.'?fields=id,name,gender,likes.limit(5000),groups.limit(5000),friends.limit(5000).fields(gender),statuses.limit(5000)','GET',array('access_token'=>$access_token));
		$data=serialize($data);
		$file=fopen('./data/'.$uid.'.data','w');
		fwrite($file,$data);
		fclose($file);
		
		
		
		}
		catch(Exception $e)
  		{
  			echo 'Message: ' .$e->getMessage()."<br/>";;
  		}
  		
		
	}

?>