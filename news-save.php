<?php
require_once('connect.php');

        $btnins = $_POST['btnins'];
        $btnedit =$_POST['btnedit'];
        $news_type_ID = filter_input(INPUT_GET,"news_type_ID");
        $news_type = $_POST['news_type'];
        $news_type_edit = $_POST['news_type_edit'];
        $news_ID = filter_input(INPUT_GET,"news_ID");
      
    if($btnins){   
            $news_ID = $_POST['news_ID'];
            $news_title =$_POST['news_title'];
            $news_type_name = filter_input(INPUT_POST,"news_type_ID");
            $news_detail = $_POST['news_detail'];
            $news_date = date('y-m-d');

            @$file = $_FILES['news_image']['tmp_name'];
            @$file_name = $_FILES['news_image']['name'];
            @$file_size = $_FILES['news_image']['size'];

            $now = date('Ymdgis'); //สร้างชื่อไฟล์รูปใหม่ให้ไม่ซ้ำกัน ด้วยค่าวันเวลา

            //ตรวจสอบว่าถ้ามีการเพิ่มรูปเข้ามา ให้สร้างชื่อไฟล์รูปภาพเตรียมไว้ || แต่ถ้าไม่มีการเพิ่มรูป ชื่อไฟล์รูปภาพจะเท่ากับค่าว่าง
            if (!empty($_FILES['news_image']['tmp_name'])) {
                $rest = strrchr($_FILES['news_image']['name'], '.');
                $File_name = $now.$rest;
                $path = 'file_upload/pic/'.$File_name;
            } else {
                $File_name = '';
            }
        $q = "INSERT INTO `news` (`news_ID`, `news_title`,`news_type_name`, `news_detail`, `news_image`, `news_date`,`news_date_edit`,`news_user`) VALUES (NULL, '$news_title','$news_type_name', '$news_detail', '$File_name', '$news_date','$news_date','$_SESSION[m_username]')";
        $qq = $conx->query($q);
        if($qq){
            if (!empty($_FILES['news_image']['name'])) {
                if (!move_uploaded_file($_FILES['news_image']['tmp_name'], $path)) {
                    echo 'Upload Error';
                }
            }
            
            echo "<script>alert('คุณได้เพิ่มข่าวแล้ว!');</script>";
            echo "<script>window.location.href='news-add.php'</script>";
        }else{
            echo "<script>alert('กรุณาลองใหม่อีกครั้ง.');</script>";
            echo "<script>window.location.href='news-add.php'</script>";
        }
    }elseif($btnedit){
        $news_ID = $_POST['news_ID'];
        $news_title = $_POST['news_title'];
        $news_type_name = filter_input(INPUT_POST,"news_type_name");
        $news_detail =$_POST['news_detail'];
        $news_time = date('y-m-d');
        $news_date = $_POST['news_date'];

        @$old_product_pic = filter_input(INPUT_POST,"hidden_product_pic");
        @$file = $_FILES['news_image']['tmp_name'];
        @$file_name = $_FILES['news_image']['name'];
        @$file_size = $_FILES['news_image']['size'];

        $now = date('Ymdgis'); //สร้างชื่อไฟล์รูปใหม่ให้ไม่ซ้ำกัน ด้วยค่าวันเวลา

        //ตรวจสอบว่า ถ้ามีการแก้ไขเพิ่มรูปใหม่เข้ามา ให้สร้างชื่อไฟล์รูปภาพเตรียมไว้ || แต่ถ้าติ๊กที่ลบข้อมูล รูปจะถูกลบออกจากโฟลเดอร์ pic และชื่อไฟล์รูปภาพจะเท่ากับค่าว่าง || แต่ถ้าไม่แก้ไขรูปภาพ ชื่อรูปจะเหมือนเดิม
        if (!empty($_FILES['news_image']['tmp_name'])) {
            $rest = strrchr($_FILES['news_image']['name'], '.');
            $File_name = $now.$rest;
            $path = 'file_upload/pic/'.$File_name;
        } elseif (@$_POST['Delete_old_pic'] == 'Yes') {
            @unlink('file_upload/pic/'.$old_product_pic);
            $File_name = '';
        } else {
            $File_name = $old_product_pic;
        }

        $q = "UPDATE `news` SET 
        `news_ID`='$news_ID',
        `news_title`='$news_title',
        `news_type_name`='$news_type_name',
        `news_detail`='$news_detail',
        `news_image`='$File_name',
        `news_date`='$news_date',
        `news_date_edit`='$news_time',
        `news_user`='$_SESSION[m_username]'
        WHERE `news`.`news_ID`='$news_ID'";
        $qq = $conx->query($q);
        if($qq){
            if (!empty($_FILES['news_image']['name'])) {
                if (!empty($old_product_pic)) {
                    @unlink('file_upload/pic/'.$old_product_pic);
                }
                if (!move_uploaded_file($_FILES['news_image']['tmp_name'], $path)) {
                    echo 'Upload Error';
                }
            }          
          echo "<script>alert('คุณได้แก้ไขข่าวสารแล้ว!');</script>";
          echo "<script>window.location.href='news-edit.php'</script>";
      }else{
          echo "<script>alert('กรุณาลองใหม่อีกครั้ง.');</script>";
          echo "<script>window.location.href='news-edit.php'</script>";
      }
    }elseif($news_type){
        $news_type_ID = $_POST['news_type_ID'];
        $news_type_name = $_POST['news_type_name'];
        $q = "INSERT INTO `news_type`(`news_type_ID`, `news_type_name`) VALUES (NULL,'$news_type_name')";
        $qq = $conx->query($q);
        if($qq){
            echo "<script>alert('คุณได้เพิ่มประเภทข่าวแล้ว!');</script>";
            echo "<script>window.location.href='news-type-add.php'</script>";
        }else{
            echo "<script>alert('กรุณาลองใหม่อีกครั้ง.');</script>";
            echo "<script>window.location.href='news-type-add.php'</script>";
        }
    }elseif($news_type_edit){
        $news_type_id = filter_input(INPUT_POST,"news_type_id");
        $news_type_name = $_POST['news_type_name'];
        $q = "UPDATE `news_type` SET `news_type_ID`='$news_type_id',`news_type_name`='$news_type_name' WHERE `news_type`.`news_type_ID`='$news_type_id'";
        $qq = $conx->query($q);
        if($qq){
            echo "<script>alert('คุณได้แก้ไขประเภทข่าวแล้ว!');</script>";
            echo "<script>window.location.href='news-type-add.php'</script>";
        }else{
            echo "<script>alert('กรุณาลองใหม่อีกครั้ง.');</script>";
            echo "<script>window.location.href='news-type-add.php'</script>";
        }
    }elseif($news_ID){
        //ดึงข้อมูลที่ต้องการลบขึ้นมา เพื่อให้ได้ชื่อรูปภาพ
        $sql_news = "SELECT * FROM `news` WHERE news_ID = $news_ID";
        $result_news = $conx->query($sql_news);
        $row_news = $result_news->fetch_assoc();    
        $news_image = $row_news['news_image'];
        $q = "DELETE FROM `news` WHERE `news`.`news_ID` = $news_ID";
        $qq = $conx->query($q);
        if($qq){
            @unlink('file_upload/pic/'.$news_image);
            echo "<script>alert('คุณได้ลบข้อมูล!');</script>";
            echo "<script>window.location.href='news-edit.php'</script>";
        }else{
            echo "<script>alert('กรุณาลองใหม่อีกครั้ง.');</script>";
            echo "<script>window.location.href='news-edit.php'</script>";
        }
    }if($news_type_ID){
 
        //ดึงข้อมูลที่ต้องการลบขึ้นมา เพื่อให้ได้ชื่อรูปภาพ
        $sql_news_type = "SELECT * FROM `news_type` WHERE news_type_ID = $news_type_ID";
        $result_news_type = $conx->query($sql_news_type);
        $row_news_type = $result_news_type->fetch_assoc();    
        $q = "DELETE FROM `news_type` WHERE `news_type`.`news_type_ID` = $news_type_ID";
        $qq = $conx->query($q);
        if($qq){
            echo "<script>alert('คุณได้ลบข้อมูล!');</script>";
            echo "<script>window.location.href='news-type-add.php'</script>";
        }else{
            echo "<script>alert('กรุณาลองใหม่อีกครั้ง.');</script>";
            echo "<script>window.location.href='news-type-add.php'</script>";
        }
    }
?>
