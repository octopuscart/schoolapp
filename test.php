<?php
//error_reporting(E_ALL); 
ini_set('display_errors', 0); 
header("Access-Control-Allow-Origin: *"); 
echo $filename = $_FILES['file']['name'];
echo $img_type = $_FILES['file']['type'];