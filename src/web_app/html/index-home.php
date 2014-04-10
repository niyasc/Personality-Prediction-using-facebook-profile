<?php

 require("../includes/initialize.php");
 require("../includes/config.php");
 include("predict-personality.php");
 //user_id is avilabe
 $traits_predicted = predictPersonality($user_id);
 //print_r($traits_predicted);
 $actual = query("select * from features where uid = ?", $user_id);
 if(count($actual)==0)
 {
 }
 else
   $traits_actual = $actual[0];

 $traits = [];

 if(isset($traits_actual))
 {
	$traits = [ [$traits_predicted[0], $traits_actual['extraversion'], abs($traits_predicted[0]-$traits_actual['extraversion'])*25],
[$traits_predicted[1], $traits_actual['agreeableness'], abs($traits_predicted[1]-$traits_actual['agreeableness'])*25],
[$traits_predicted[2], $traits_actual['conscientiousness'], abs($traits_predicted[2]-$traits_actual['conscientiousness'])*25],
[$traits_predicted[3], $traits_actual['neuroticism'], abs($traits_predicted[3]-$traits_actual['neuroticism'])*25],
[$traits_predicted[4], $traits_actual['openness'], abs($traits_predicted[4]-$traits_actual['openness'])*25]
];
}
else
{
	$traits = $traits_predicted;
}

 //print_r($traits_actual);
 $image = "https://graph.facebook.com/me/picture?type=large&access_token=".$access_token;
 $name = $facebook->api('/me?field=name','GET',array('access_token' => $access_token));
 render("home.php", ["title" => "Personality Predictor", "traits" => $traits, "image" => $image, "name" => $name]); 

?>
