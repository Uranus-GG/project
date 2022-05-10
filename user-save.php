<?php
require_once('connect.php');
$btnedit =$_POST['btnedit'];
$btnpassword =$_POST['btnpassword'];
$btnpassworduser =$_POST['btnpassworduser'];
if($btnedit){ 
        $m_ID = $_POST['m_ID'];
        $m_username = $_POST['m_username'];
        $m_password =$_POST['m_password'];
        $f_name = $_POST['f_name'];
        $l_name = $_POST['l_name'];
        $m_tel = $_POST['m_tel'];
        $m_email = $_POST['m_email'];
        $role = $_POST['role'];
        $q = "UPDATE `member` SET 
        `f_name` = '$f_name',
        `l_name` = '$l_name', 
        `m_tel` = '$m_tel', 
        `m_email` = '$m_email',
        `m_username` = '$m_username',
        `m_password` = '$m_password', 
        `role` = '$role' 
        WHERE `member`.`m_ID` = $m_ID";
        $qq = $conx->query($q);
        if($qq){
          echo "<script>alert('คุณได้แก้ไขสมาชิกแล้ว!');</script>";
          echo "<script>window.location.href='user-edit.php'</script>";
      }else{
          echo "<script>alert('กรุณาลองใหม่อีกครั้ง.');</script>";
          echo "<script>window.location.href='user-edit.php'</script>";
      }
    }elseif($btnpassword){
      $m_password =md5($_POST['m_password']);
      $sql = "SELECT * FROM `member` WHERE m_password = '$m_password' ";
      $result=mysqli_query($conx,$sql);
      $rows =mysqli_num_rows($result);
      $i=0;
      if($rows>$i){
        $m_password1 =md5($_POST['m_password1']);
        $q = "UPDATE `member` SET `m_password` = '$m_password1' WHERE `member`.`m_ID` = '$_SESSION[m_ID]'";
        $qq = $conx->query($q);
        if($qq){
          echo "<script>alert('คุณได้แก้ไขรหัสผ่านแล้วกรุณาเข้าระบบอีกครั้ง!');</script>";
          echo "<script>window.location.href='logout.php'</script>";
      }else{
          echo "<script>alert('กรุณาลองใหม่อีกครั้ง.');</script>";
          echo "<script>window.location.href='index.php'</script>";
      }
      }else{
        echo "<script>alert('รหัสผ่านเดิมไม่ถูกต้อง!');</script>";
        echo "<script>window.location.href='index.php'</script>";
      }


    }if($btnpassworduser){
      $m_password =md5($_POST['m_password']);
      $sql = "SELECT * FROM `member` WHERE m_password = '$m_password' ";
      $result=mysqli_query($conx,$sql);
      $rows =mysqli_num_rows($result);
      $i=0;
      if($rows>$i){
        $m_ID = $_POST['m_ID'];
        $m_password1 =md5($_POST['m_password1']);
        $q = "UPDATE `member` SET `m_password` = '$m_password1'WHERE m_ID='$m_ID' ";
        $qq = $conx->query($q);
        if($qq){
          echo "<script>alert('คุณได้แก้ไขรหัสผ่านแล้วกรุณาเข้าระบบอีกครั้ง!');</script>";
          echo "<script>window.location.href='logout.php'</script>";
      }else{
          echo "<script>alert('กรุณาลองใหม่อีกครั้ง.');</script>";
          echo "<script>window.location.href='admin-list.php'</script>";
      }
      }else{
        echo "<script>alert('รหัสผ่านเดิมไม่ถูกต้อง!');</script>";
        echo "<script>window.location.href='admin-list.php'</script>";
      }


    }
    ?>
