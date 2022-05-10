<?php
require_once('connect.php');

        $btnins = $_POST['btnins'];
        $btnedit =$_POST['btnedit'];
        $e_ID = filter_input(INPUT_GET,"e_ID");


    if($btnins){ 
            $e_ID = $_POST['e_ID'];
            $e_title =$_POST['e_title'];
            $e_detail = $_POST['e_detail'];
            $e_start = $_POST['e_start'];
            $e_end = $_POST['e_end'];
            $news_date = date('d-m-y H:i:s');
            $color = $_POST['color'];
             
            @$file = $_FILES['e_image']['tmp_name'];
            @$file_name = $_FILES['e_image']['name'];
            @$file_size = $_FILES['e_image']['size'];

            $now = date('Ymdgis'); //สร้างชื่อไฟล์รูปใหม่ให้ไม่ซ้ำกัน ด้วยค่าวันเวลา

            //ตรวจสอบว่าถ้ามีการเพิ่มรูปเข้ามา ให้สร้างชื่อไฟล์รูปภาพเตรียมไว้ || แต่ถ้าไม่มีการเพิ่มรูป ชื่อไฟล์รูปภาพจะเท่ากับค่าว่าง
            if (!empty($_FILES['e_image']['tmp_name'])) {
                $rest = strrchr($_FILES['e_image']['name'], '.');
                $File_name = $now.$rest;
                $path = 'file_upload/pic/event/'.$File_name;
            } else {
                $File_name = '';
            }
           
 
        $q = "INSERT INTO `event`(`e_ID`, `ID_member`,`e_image`, `e_title`, `e_detail`, `e_start`, `e_end`,`color`) VALUES (NULL,'$_SESSION[m_ID]','$e_title','$File_name','$e_detail','$e_start','$e_end','$color')";
        $qq = $conx->query($q);
        if($qq){
            if (!empty($_FILES['e_image']['name'])) {
                if (!move_uploaded_file($_FILES['e_image']['tmp_name'], $path)) {
                    echo 'Upload Error';
                }
            }

            echo "<script>alert('คุณได้กิจกรรมแล้ว!');</script>";
            echo "<script>window.location.href='event.php'</script>";
        }else{
            echo "<script>alert('กรุณาลองใหม่อีกครั้ง.');</script>";
            echo "<script>window.location.href='event.php'</script>";
        }
    }elseif($btnedit){
        $e_ID = $_POST['e_ID'];
        $status = $_POST['status'];
        $e_title =$_POST['e_title'];
        $e_detail = $_POST['e_detail'];
        $e_start = $_POST['e_start'];
        $e_end = $_POST['e_end'];
        $color = $_POST['color'];
        
        
        @$old_product_pic = filter_input(INPUT_POST,"hidden_product_pic");
        @$file = $_FILES['e_image']['tmp_name'];
        @$file_name = $_FILES['e_image']['name'];
        @$file_size = $_FILES['e_image']['size'];

        $now = date('Ymdgis'); //สร้างชื่อไฟล์รูปใหม่ให้ไม่ซ้ำกัน ด้วยค่าวันเวลา

        //ตรวจสอบว่า ถ้ามีการแก้ไขเพิ่มรูปใหม่เข้ามา ให้สร้างชื่อไฟล์รูปภาพเตรียมไว้ || แต่ถ้าติ๊กที่ลบข้อมูล รูปจะถูกลบออกจากโฟลเดอร์ pic และชื่อไฟล์รูปภาพจะเท่ากับค่าว่าง || แต่ถ้าไม่แก้ไขรูปภาพ ชื่อรูปจะเหมือนเดิม
        if (!empty($_FILES['e_image']['tmp_name'])) {
            $rest = strrchr($_FILES['e_image']['name'], '.');
            $File_name = $now.$rest;
            $path = 'file_upload/pic/event/'.$File_name;
        } elseif (@$_POST['Delete_old_pic'] == 'Yes') {
            @unlink('file_upload/pic/event/'.$old_product_pic);
            $File_name = '';
        } else {
            $File_name = $old_product_pic;
        }



        $q ="UPDATE `event` SET `e_ID`='$e_ID',`status`='$status',`e_image`='$File_name',`e_title`='$e_title',`e_detail`='$e_detail',`e_start`='$e_start',`e_end`='$e_end',`color`='$color' WHERE `event`.`e_ID`='$e_ID'";
        $qq = $conx->query($q);
        if($qq){
            if (!empty($_FILES['e_image']['name'])) {
                if (!empty($old_product_pic)) {
                    @unlink('file_upload/pic/event/'.$old_product_pic);
                }
                if (!move_uploaded_file($_FILES['e_image']['tmp_name'], $path)) {
                    echo 'Upload Error';
                }
            }  
          
          echo "<script>alert('คุณได้แก้ไขข่าวกิจกรรมแล้ว!');</script>";
          echo "<script>window.location.href='event.php'</script>";
      }else{
          echo "<script>alert('กรุณาลองใหม่อีกครั้ง.');</script>";
          echo "<script>window.location.href='event.php'</script>";
      }
    }if($e_ID){
        $e_ID = filter_input(INPUT_GET,"e_ID");

        //ดึงข้อมูลที่ต้องการลบขึ้นมา เพื่อให้ได้ชื่อรูปภาพ
        $sql_event = "SELECT * FROM `event` WHERE e_ID = $e_ID";
        $result_event = $conx->query($sql_event);
        $row_event = $result_event->fetch_assoc();    
        $e_image = $row_event['e_image'];

        $q = "DELETE FROM `event` WHERE `event`.`e_ID` = $e_ID";
        $qq = $conx->query($q);
        if($qq){
            @unlink('file_upload/pic/event/'.$e_image);
            
            echo "<script>alert('คุณได้ลบกิจกรรมแล้ว!');</script>";
            echo "<script>window.location.href='event.php'</script>";
        }else{
            echo "<script>alert('กรุณาลองใหม่อีกครั้ง.');</script>";
            echo "<script>window.location.href='event.php'</script>";
        }

    }
?>
