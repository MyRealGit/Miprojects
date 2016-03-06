<?php
  $rejestrPrzedsiebiorcy_flag=$_POST["rejestrPrzedsiebiorcy"];
 $krs_code=$_POST["krs"];
 $kaptcha_code=$_POST["kaptchafield"];
 $hash_code=$_POST["t:formdata"];
$nn='<p>';


 file_put_contents('myTextFile.html', $rejestrPrzedsiebiorcy_flag.$nn.$kaptcha_code.$nn.$krs_code.$nn.$hash_code);
?>