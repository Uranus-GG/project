<?php
require_once('connect.php');

$data_id = filter_input(INPUT_POST,"data_id"); //ส่งข้อมูล method GET ผ่าน Url จากการกดปุ่มแก้ไข
$type_gallery_id = filter_input(INPUT_POST,"type_gallery_id"); //ส่งข้อมูล method GET ผ่าน Url จากการกดปุ่มแก้ไข
$action = filter_input(INPUT_GET,"action"); //ส่งข้อมูล method GET ผ่าน Url จากการกดปุ่มลบ

if ($_REQUEST["data_type"] == "view_images") {
    
    if (isset($_FILES["imgUpload"])) {
        foreach ($_FILES['imgUpload']['tmp_name'] as $key => $val){
            
            // $file_size = $_FILES['imgUpload']['size'][$key];
            $file_tmp = $_FILES['imgUpload']['tmp_name'][$key];
            // $file_type = $_FILES['imgUpload']['type'][$key];
            
            $filename = $_FILES['imgUpload']['name'][$key];
            @$extension = end(explode(".", $filename));
            $newNameImages = (rand(1, 100000) . $_REQUEST["type_gallery_id"] . "-" . $_REQUEST["data_id"]) . "." . $extension;
            /* Location */
            $location = "file_upload/gallery/" . $_REQUEST["type_gallery_id"] . "-" . $_REQUEST["data_id"] . "/" . $filename;
            $uploadOk = 1;
            $imageFileType = pathinfo($location, PATHINFO_EXTENSION);
            
            // Check image format
            if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
                $uploadOk = 0;
            }
            
            if ($uploadOk == 0) {
                echo "<font color='red'>กรุณาเลือกรูปที่ต้องการอัพโหลดด้วย</font>";
            } else {
                /* Upload file */
                $namefd = "file_upload/gallery/" . $_REQUEST["type_gallery_id"] . "-" . $_REQUEST["data_id"];
                @mkdir("$namefd",0777);
                if (move_uploaded_file($file_tmp, "file_upload/gallery/" . $_REQUEST["type_gallery_id"] . "-" . $_REQUEST["data_id"] . "/" . $newNameImages)) {
                    
                    
                     $insert_slideshow = $conx->query("insert into gallery set gallery_name = '$newNameImages' , gallery_path = 'file_upload/gallery/$_REQUEST[type_gallery_id]-$_REQUEST[data_id]/$newNameImages',data_id = $data_id, type_gallery_id = '$type_gallery_id'");
                                       
                    if ($insert_slideshow == TRUE) {
                        // log_data($username, "", "", "Insert_images", $newNameImages);
                        echo "<script>location='uploadImages.php?data_id=$data_id&type_gallery_id=$type_gallery_id'</script>";
                    }
                } else {
                    echo "<font color='red'>เกิดข้อผิดพลาดกรุณาลองใหม่อีกครั้ง</font>";
                }
            }
            // exit();
        }
    } else {
        echo "<font color='red'>กรุณาเลือกรูปที่ต้องการอัพโหลดด้วย</font>";
    }
}elseif ($action == 'del') { //ลบข้อมูล
    //ส่งค่า product_id แบบ method GET ผ่าน Url
    $gallery_id = filter_input(INPUT_GET,"gallery_id");
    $data_id = filter_input(INPUT_GET,"data_id"); //ส่งข้อมูล method GET ผ่าน Url
    $type_gallery_id = filter_input(INPUT_GET,"type_gallery_id"); //ส่งข้อมูล method GET ผ่าน Url

    //ดึงข้อมูลที่ต้องการลบขึ้นมา เพื่อให้ได้ชื่อรูปภาพ
    $sql_product = "SELECT * FROM `gallery` where gallery_id = '$gallery_id'";
    $result_product = $conx->query($sql_product);
    $row_product = $result_product->fetch_assoc();

    $gallery_path = $row_product['gallery_path'];

    //คำสั่ง sql ในการลบข้อมูล
    $sql_del = "DELETE FROM gallery WHERE gallery_id = '$gallery_id'";
    $result_del = $conx->query($sql_del);

    //ตรวจสอบว่าลบข้อมูลได้หรือไม่ ถ้าลบได้ให้ลบรูปภาพออกจากโฟลเดอร์ pic ด้วย
    if ($result_del) {
        @unlink($gallery_path);
        echo "<script langquage='javascript'>
				alert('ลบข้อมูลเรียบร้อยแล้ว')
				window.location='uploadImages.php?data_id=$data_id&type_gallery_id=$type_gallery_id';
			</script>";
    } else {
        echo "<script langquage='javascript'>
				alert('ไม่สามารถลบข้อมูลได้')
				window.location='uploadImages.php?data_id=$data_id&type_gallery_id=$type_gallery_id';
			</script>";
    }
}
?>