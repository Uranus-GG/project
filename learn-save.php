<?php
require_once('connect.php');

        $btnins = $_POST['btnins'];
        $btnedit =$_POST['btnedit'];
        $l_ID = filter_input(INPUT_GET,"l_ID");
    if($btnins){   
            $l_ID = $_POST['l_ID'];
            $l_title =$_POST['l_title'];
            $l_detail = $_POST['l_detail'];

            @$file = $_FILES['l_image']['tmp_name'];
            @$file_name = $_FILES['l_image']['name'];
            @$file_size = $_FILES['l_image']['size'];

            $now = date('Ymdgis'); //สร้างชื่อไฟล์รูปใหม่ให้ไม่ซ้ำกัน ด้วยค่าวันเวลา

            //ตรวจสอบว่าถ้ามีการเพิ่มรูปเข้ามา ให้สร้างชื่อไฟล์รูปภาพเตรียมไว้ || แต่ถ้าไม่มีการเพิ่มรูป ชื่อไฟล์รูปภาพจะเท่ากับค่าว่าง
            if (!empty($_FILES['l_image']['tmp_name'])) {
                $rest = strrchr($_FILES['l_image']['name'], '.');
                $File_name = $now.$rest;
                $path = 'upload/learn/'.$File_name;
            } else {
                $File_name = '';
            }
        $q = "INSERT INTO `learn` (`l_ID`, `l_title`,`l_detail`, `l_image`) VALUES (NULL, '$l_title','$l_detail', '$File_name')";
        $qq = $conx->query($q);
        if($qq){
            if (!empty($_FILES['l_image']['name'])) {
                if (!move_uploaded_file($_FILES['l_image']['tmp_name'], $path)) {
                    echo 'Upload Error';
                }
            }
            
            echo "<script>alert('คุณได้เพิ่มกรรมการเรียนรู้แล้ว!');</script>";
            echo "<script>window.location.href='learn-add.php'</script>";
        }else{
            echo "<script>alert('กรุณาลองใหม่อีกครั้ง.');</script>";
            echo "<script>window.location.href='learn-add.php'</script>";
        }
    }elseif($btnedit){
        $l_ID = $_POST['l_ID'];
        $l_title = $_POST['l_title'];
        $l_detail =$_POST['l_detail'];
        @$old_product_pic = filter_input(INPUT_POST,"hidden_product_pic");
        @$file = $_FILES['l_image']['tmp_name'];
        @$file_name = $_FILES['l_image']['name'];
        @$file_size = $_FILES['l_image']['size'];

        $now = date('Ymdgis'); //สร้างชื่อไฟล์รูปใหม่ให้ไม่ซ้ำกัน ด้วยค่าวันเวลา

        //ตรวจสอบว่า ถ้ามีการแก้ไขเพิ่มรูปใหม่เข้ามา ให้สร้างชื่อไฟล์รูปภาพเตรียมไว้ || แต่ถ้าติ๊กที่ลบข้อมูล รูปจะถูกลบออกจากโฟลเดอร์ pic และชื่อไฟล์รูปภาพจะเท่ากับค่าว่าง || แต่ถ้าไม่แก้ไขรูปภาพ ชื่อรูปจะเหมือนเดิม
        if (!empty($_FILES['l_image']['tmp_name'])) {
            $rest = strrchr($_FILES['l_image']['name'], '.');
            $File_name = $now.$rest;
            $path = 'upload/learn/'.$File_name;
        } elseif (@$_POST['Delete_old_pic'] == 'Yes') {
            @unlink('upload/learn/'.$old_product_pic);
            $File_name = '';
        } else {
            $File_name = $old_product_pic;
        }

        $q = "UPDATE `learn` SET 
        `l_ID`='$l_ID',
        `l_title`='$l_title',
        `l_detail`='$l_detail',
        `l_image`='$File_name'
        WHERE `learn`.`l_ID`='$l_ID'";
        $qq = $conx->query($q);
        if($qq){
            if (!empty($_FILES['l_image']['name'])) {
                if (!empty($old_product_pic)) {
                    @unlink('upload/learn/'.$old_product_pic);
                }
                if (!move_uploaded_file($_FILES['l_image']['tmp_name'], $path)) {
                    echo 'Upload Error';
                }
            }          
          echo "<script>alert('คุณได้แก้ไขกรรมการเรียนรู้แล้ว!');</script>";
          echo "<script>window.location.href='learn-edit.php'</script>";
      }else{
          echo "<script>alert('กรุณาลองใหม่อีกครั้ง.');</script>";
          echo "<script>window.location.href='learn-edit.php'</script>";
      }
    }elseif($l_ID){
        //ดึงข้อมูลที่ต้องการลบขึ้นมา เพื่อให้ได้ชื่อรูปภาพ
        $sql_news = "SELECT * FROM `learn` WHERE l_ID = $l_ID";
        $result_news = $conx->query($sql_news);
        $row_news = $result_news->fetch_assoc();    
        $l_image = $row_news['l_image'];
        $q = "DELETE FROM `learn` WHERE `learn`.`l_ID` = $l_ID";
        $qq = $conx->query($q);
        if($qq){
            @unlink('upload/learn/'.$l_image);
            echo "<script>alert('คุณได้ลบข้อมูล!');</script>";
            echo "<script>window.location.href='learn-edit.php'</script>";
        }else{
            echo "<script>alert('กรุณาลองใหม่อีกครั้ง.');</script>";
            echo "<script>window.location.href='learn-edit.php'</script>";
        }
    }
?>
