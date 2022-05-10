<?php
session_start();
date_default_timezone_set('Asia/Bangkok');

$serv = "localhost";
$u = "root";//ชื่อผู้ใช้
$p = "12345678";
$db = "project";

$conx = new mysqli($serv, $u, $p, $db);
if($conx){
  //echo "เชื่อมต่อสำเร็จ";
  $ch = $conx->set_charset("utf8");
}else{
  echo "เชื่อมต่อไม่สำเร็จ"; 
  exit();
}



?>

