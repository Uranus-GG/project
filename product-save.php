<?php
require_once('connect.php');

        $btnins = $_POST['btnins'];
        $btnedit = $_POST['btnedit'];
        $product_type = $_POST['product_type'];
        $product_type_edit = $_POST['product_type_edit'];
        $p_ID = filter_input(INPUT_GET,"p_ID");
        $product_type_ID = filter_input(INPUT_GET,"product_type_ID");


    if($btnins){ 
            $p_ID = $_POST['p_ID'];
            $p_title =$_POST['p_title'];
            $product_type_name =$_POST['product_type_name'];          
            $p_detail = $_POST['p_detail'];
            $p_price = $_POST['p_price'];
            $news_date = date('d-m-y H:i:s');  
           
            @$file = $_FILES['p_image']['tmp_name'];
            @$file_name = $_FILES['p_image']['name'];
            @$file_size = $_FILES['p_image']['size'];

            $now = date('Ymdgis'); //สร้างชื่อไฟล์รูปใหม่ให้ไม่ซ้ำกัน ด้วยค่าวันเวลา

            //ตรวจสอบว่าถ้ามีการเพิ่มรูปเข้ามา ให้สร้างชื่อไฟล์รูปภาพเตรียมไว้ || แต่ถ้าไม่มีการเพิ่มรูป ชื่อไฟล์รูปภาพจะเท่ากับค่าว่าง
            if (!empty($_FILES['p_image']['tmp_name'])) {
                $rest = strrchr($_FILES['p_image']['name'], '.');
                $File_name = $now.$rest;
                $path = 'file_upload/pic/'.$File_name;
            } else {
                $File_name = '';
            }
        $q = "INSERT INTO `product`(`p_ID`, `p_title`,`product_type_name`, `p_detail`, `p_price`, `p_image`, `p_date`) VALUES (NULL,'$p_title','$product_type_name','$p_detail','$p_price','$File_name','$news_date')";
        $qq = $conx->query($q);
        if($qq){
            if (!empty($_FILES['p_image']['name'])) {
                if (!move_uploaded_file($_FILES['p_image']['tmp_name'], $path)) {
                    echo 'Upload Error';
                }
            }
            
            echo "<script>alert('คุณได้เพิ่มผลิตภัณฑ์แล้ว!');</script>";
            echo "<script>window.location.href='product-admin.php'</script>";
        }else{
            echo "<script>alert('กรุณาลองใหม่อีกครั้ง.');</script>";
            echo "<script>window.location.href='product-admin.php'</script>";
        }
    }elseif($btnedit){
        $p_ID = $_POST['p_ID'];
        $p_title =$_POST['p_title'];
        $product_type_name =$_POST['product_type_name'];  
        $p_detail = $_POST['p_detail'];
        $p_price = $_POST['p_price'];
        $news_date = date('d-m-y H:i:s'); 

        @$old_product_pic = filter_input(INPUT_POST,"hidden_product_pic");
        @$file = $_FILES['p_image']['tmp_name'];
        @$file_name = $_FILES['p_image']['name'];
        @$file_size = $_FILES['p_image']['size'];

        $now = date('Ymdgis'); //สร้างชื่อไฟล์รูปใหม่ให้ไม่ซ้ำกัน ด้วยค่าวันเวลา

        //ตรวจสอบว่า ถ้ามีการแก้ไขเพิ่มรูปใหม่เข้ามา ให้สร้างชื่อไฟล์รูปภาพเตรียมไว้ || แต่ถ้าติ๊กที่ลบข้อมูล รูปจะถูกลบออกจากโฟลเดอร์ pic และชื่อไฟล์รูปภาพจะเท่ากับค่าว่าง || แต่ถ้าไม่แก้ไขรูปภาพ ชื่อรูปจะเหมือนเดิม
        if (!empty($_FILES['p_image']['tmp_name'])) {
            $rest = strrchr($_FILES['p_image']['name'], '.');
            $File_name = $now.$rest;
            $path = 'file_upload/pic/'.$File_name;
        } elseif (@$_POST['Delete_old_pic'] == 'Yes') {
            @unlink('file_upload/pic/'.$old_product_pic);
            $File_name = '';
        } else {
            $File_name = $old_product_pic;
        }

        $q = "UPDATE `product` SET `p_ID`='$p_ID',`p_title`='$p_title',`product_type_name`='$product_type_name',`p_detail`='$p_detail',`p_price`='$p_price',`p_image`='$File_name',`p_date`='$p_ID' WHERE `product`.`p_ID`='$p_ID'";
        $qq = $conx->query($q);
        if($qq){
            if (!empty($_FILES['p_image']['name'])) {
                if (!empty($old_product_pic)) {
                    @unlink('file_upload/pic/'.$old_product_pic);
                }
                if (!move_uploaded_file($_FILES['p_image']['tmp_name'], $path)) {
                    echo 'Upload Error';
                }
            }          
          echo "<script>alert('คุณได้แก้ไขผลิตภัณฑ์แล้ว!');</script>";
          echo "<script>window.location.href='product-admin.php'</script>";
      }else{
          echo "<script>alert('กรุณาลองใหม่อีกครั้ง.');</script>";
          echo "<script>window.location.href='product-admin.php'</script>";
      }
    }elseif($product_type){
        $product_type_name =$_POST['product_type_name'];
        $q= "INSERT INTO `product_type`(`product_type_ID`, `product_type_name`) VALUES (NULL,'$product_type_name')";
        $qq = $conx->query($q);
        if($qq){
            echo "<script>alert('คุณได้เพิ่มประเภทผลิตภัณฑ์แล้ว!');</script>";
            echo "<script>window.location.href='product-type-add.php'</script>";
        }else{
            echo "<script>alert('กรุณาลองใหม่อีกครั้ง.');</script>";
            echo "<script>window.location.href='product-type-add.php'</script>";
        }
    }elseif($product_type_edit){
        $product_type_id = filter_input(INPUT_POST,"product_type_id");
        $product_type_name =$_POST['product_type_name'];
        
        
        $q= "UPDATE `product_type` SET `product_type_ID`='$product_type_id',`product_type_name`='$product_type_name' WHERE `product_type`.`product_type_ID`='$product_type_id'";
        $qq = $conx->query($q);
        if($qq){
            echo "<script>alert('คุณได้แก้ไขประเภทผลิตภัณฑ์แล้ว!');</script>";
            echo "<script>window.location.href='product-type-add.php'</script>";
        }else{
            echo "<script>alert('กรุณาลองใหม่อีกครั้ง.');</script>";
            echo "<script>window.location.href='product-type-add.php'</script>";
        }
    }elseif($p_ID){
        $p_ID = filter_input(INPUT_GET,"p_ID");

        //ดึงข้อมูลที่ต้องการลบขึ้นมา เพื่อให้ได้ชื่อรูปภาพ
        $sql_product = "SELECT * FROM product WHERE p_ID = $p_ID";
        $result_product = $conx->query($sql_product);
        $row_product = $result_product->fetch_assoc();    
        $p_image = $row_product['p_image'];

        $q = "DELETE FROM `product` WHERE `product`.`p_ID` = $p_ID";
        $qq = $conx->query($q);
        if($qq){
            @unlink('file_upload/pic/'.$p_image);
            echo "<script>alert('คุณได้ลบผลิตภัณฑ์แล้ว!');</script>";
            echo "<script>window.location.href='product-admin.php'</script>";
        }else{
            echo "<script>alert('กรุณาลองใหม่อีกครั้ง.');</script>";
            echo "<script>window.location.href='product-admin.php'</script>";
        }

    }if($product_type_ID){
        //ดึงข้อมูลที่ต้องการลบขึ้นมา เพื่อให้ได้ชื่อรูปภาพ
        $sql_product = "SELECT * FROM product_type WHERE product_type_ID = $product_type_ID";
        $result_product = $conx->query($sql_product);
        $row_product = $result_product->fetch_assoc();    
        $q = "DELETE FROM `product_type` WHERE `product_type`.`product_type_ID` = $product_type_ID";
        $qq = $conx->query($q);
        if($qq){
            echo "<script>alert('คุณได้ลบประเภทผลิตภัณฑ์แล้ว!');</script>";
            echo "<script>window.location.href='product-type-add.php'</script>";
        }else{
            echo "<script>alert('กรุณาลองใหม่อีกครั้ง.');</script>";
            echo "<script>window.location.href=''product-type-add.php'</script>";
        }

    }
?>