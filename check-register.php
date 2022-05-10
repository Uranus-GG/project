<?php
include('connect.php');  //ไฟล์เชื่อมต่อกับ database ที่เราได้สร้างไว้ก่อนหน้าน้ี
	//สร้างตัวแปรเก็บค่าที่รับมาจากฟอร์ม
	$register = $_POST["register"];
	$m_ID = $_POST['m_ID'];
    $m_username = $_POST['m_username'];
    $m_password =md5($_POST['m_password']);
    $f_name = $_POST['f_name'];
    $l_name = $_POST['l_name'];
    $m_tel = $_POST['m_tel'];
    $m_email = $_POST['m_email'];
	//เพิ่มเข้าไปในฐานข้อมูล

if($m_username){
	$sql = "SELECT * FROM `member` WHERE m_username = '$_POST[m_username]' ";
	$result=mysqli_query($conx,$sql);
	$rows =mysqli_num_rows($result);
	$i=0;
	if($rows>$i){

				echo '<span class="text-danger ">ผู้ใช้นี้ถูกใช้เเล้ว</span>';
	}else{
				echo '<span class="text-success ">ผู้ใช้นี้ยังไม่ถูกใช้</span>';
	}

}elseif($register){
	$q = "INSERT INTO `member` (`m_ID`, `role`, `f_name`, `l_name`, `m_tel`, `m_email`, `m_username`, `m_password`) VALUES (NULL, 'user', '$f_name', '$l_name', '$m_tel', '$m_email', '$m_username', '$m_password')";
    $qq = $conx->query($q);
	
	echo "<script type='text/javascript'>";
	echo "alert('สมัครสมาชิกสำเร็จ');";
	echo "window.location = 'index.php'; ";
	echo "</script>";
	}
	else{
	echo "<script type='text/javascript'>";
	echo "alert('กรุณาลองใหม่อีกครัง');";
	echo "window.location = 'register.php'; ";
	echo "</script>";
}

?>