<?php
	$file = fopen("100000184531749.data", "r");
	$data = unserialize(fread($file, filesize("100000184531749.data")));
	//print_r($data);
	$statuses = $data["statuses"]["data"];
	$text="";
	foreach( $statuses as $status)
	{
		if(isset($status["message"]))
			$text = $text." ".$status["message"];
	}
	//print_r($statuses[0]);
	//print_r($statuses);
	include("./vendor/autoloader.php");
	use \NlpTools\Tokenizers\WhitespaceAndPunctuationTokenizer;
 
 
	$punct = new WhitespaceAndPunctuationTokenizer();
 
	
	$tokens = $punct->tokenize($text);
	
	$lower = [];
	foreach($tokens as $token)
	{
		array_push($lower, strtolower($token));
	}
 
 	$first_singular = ["i", "i'm", "me", "mine", "my", "myself"];
 	$first_plural = ["we", "we're", "us", "our", "ours", "ourselves"];
 	$second = ["you", "you're", "yours"];
 	$third_singular = ["he", "she", "her", "his", "him", "himself", "herself"];
 	$third_plural = ["they", "theirs", "their", "them"];
 	$relative = ["that", "which", "who", "whom", "whose", "which ever", "whoever", "whomever"];
 	$indefinite_singular = ["anybody", "anyone", "anything", "each", "either", "everybody", "everyone", "everything", "neither", "nobody", "nothing", "one", "somebody", "someone", "something"];
 	$indefinite_plural = ["both", "few", "many", "several"];
 	$indefinite_sorp = ["all", "any", "most", "none", "some"];
 	$symbols = [".", "?", ",", "<", ">", "/", "'", ";", ":", "[", "{", "]", "}", "`", "~", "!", "@", "#", "$", "%", "^", "&", "*", "(", ")", "-", "_", "+", "="];
 	
 	//print "Number of words ".count($lower)."\n";
 	//print "Number of statuses".count($statuses)."\n";
 	//$wps = count($lower)/count($statuses);
 	//print "Number of words per status".$wps."\n";
 	$feat=["fs" => 0, "fp" => 0, "s" => 0, "ts" => 0, "tp" => 0, "rel" => 0, "is" => 0, "ip" => 0, "isop" => 0, "sym" => 0];
 	
 	foreach($lower as $l)
 	{
 		if ( in_array($l, $first_singular))
 			$feat["fs"]+=1;
		else if(in_array($l, $first_plural))
			$feat["fp"]+=1;
		else if(in_array($l, $second))
			$feat["s"]+=1;
		else if(in_array($l, $third_singular))
			$feat["ts"]+=1;
		else if(in_array($l, $third_plural))
			$feat["tp"]+=1;
		else if(in_array($l, $relative))
			$feat["rel"]+=1;
		else if(in_array($l, $indefinite_singular))
			$feat["is"]+=1;
		else if(in_array($l, $indefinite_plural))
			$feat["ip"] += 1;
		else if(in_array($l, $indefinite_sorp))
			$feat["isop"]+=1;
		else if(in_array($l, $symbols))
 			$feat["sym"]+=1;
 	}
 	foreach($feat as $key=>$val)
 	{
 		$feat[$key]/=count($lower);
 	}
 	$feat["wps"] = count($lower)/count($statuses);
 	
 	print_r($feat);
