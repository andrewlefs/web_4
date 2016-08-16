<?php
$url= $_POST['url'];
$thum = $_POST['thum'];
$kq='false';
if(file_exists($thum))
    unlink($thum);
if(file_exists($url))
    if(unlink($url))
       $kq = 'true';
    else
        $kq = 'false';
echo $kq;
?>
