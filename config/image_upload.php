<?php

// new filename
$filename = 'pic_'.date('YmdHis') . '.jpeg';

$url = '';
if( move_uploaded_file($_FILES['webcam']['tmp_name'],'../images/'.$filename) ){
   $url = 'http://' . $_SERVER['HTTP_HOST'] . '/swatchta/images/' . $filename;
}

// Return image url
echo $url;