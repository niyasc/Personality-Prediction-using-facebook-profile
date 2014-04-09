<?php
	include "predict-personality.php";
	$traits = predictPersonality("100006599203697");
	print_r($traits);
