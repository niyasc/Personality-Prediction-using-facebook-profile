<?php

 require("../includes/initialize.php");
 require("../includes/config.php");
 require("./predict-personality.php");
 //user_id is avilabe
 $traits_predicted = predictPersonality($user_id);
 //print_r($traits_predicted);
 $actual = query("select * from features where uid = ?", $user_id);
 if(count($actual)==0)
 {
 }
 else
   $traits_actual = $actual[0];
 //print_r($traits_actual);
 $image = "https://graph.facebook.com/me/picture?type=large&access_token=".$access_token;
 $name = $facebook->api('/me?field=name','GET',array('access_token' => $access_token));
 render("home.php", ["title" => "Personality Predictor", "predicted" => $traits_predicted, "actual" => $traits_actual, "image" => $image, "name" => $name]); 

?>
