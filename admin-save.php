<?php
    require_once('connect.php');


    $btnins = $_POST['btnins'];
    $btnedit =$_POST['btnedit'];
    $m_ID = filter_input(INPUT_GET,"m_ID");

    if($btnins){
        $m_ID = $_POST['m_ID'];
        $m_username = $_POST['m_username'];
        $m_password =$_POST['m_password'];
        $f_name = $_POST['f_name'];
        $l_name = $_POST['l_name'];
        $m_tel = $_POST['m_tel'];
        $m_email = $_POST['m_email'];
        $role = $_POST['role'];
        $q = "INSERT INTO `member`(`m_ID`, `f_name`, `l_name`, `m_tel`, `m_email`, `m_username`, `m_password`, `role`) VALUES (NULL,'$f_name','$l_name','$m_tel','$m_email','$m_username','$m_password','$role')";
        $qq = $conx->query($q);
        if($qq){
            echo "<script>alert('คุณได้เพิ่มสมาชิกแล้ว!');</script>";
            echo "<script>window.location.href='admin-list.php'</script>";
        }else{
            echo "<script>alert('กรุณาลองใหม่อีกครั้ง.');</script>";
            echo "<script>window.location.href='admin-list.php'</script>";
        }
    }elseif($btnedit){ 
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
          echo "<script>window.location.href='admin-list.php'</script>";
      }else{
          echo "<script>alert('กรุณาลองใหม่อีกครั้ง.');</script>";
          echo "<script>window.location.href='admin-list.php'</script>";
      }
    }if($m_ID){
        $m_ID = filter_input(INPUT_GET,"m_ID");
        $q = "DELETE FROM `member` WHERE `member`.`m_ID` = $m_ID";
        $qq = $conx->query($q);
        if($qq){
            echo "<script>alert('คุณได้ลบสมาชิกแล้ว!');</script>";
            echo "<script>window.location.href='admin-list.php'</script>";
        }else{
            echo "<script>alert('กรุณาลองใหม่อีกครั้ง.');</script>";
            echo "<script>window.location.href='admin-list.php'</script>";
        }
    }
       
    ?>
