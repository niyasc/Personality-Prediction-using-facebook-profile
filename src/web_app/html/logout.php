<?php

include '../includes/initialize.php';
include '../includes/config.php';

$facebook->_killFacebookCookies();
        redirect("index.php");