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
           
 
        $q = "INSERT INTO `event`(`e_ID`, `ID_member`, `e_title`, `e_detail`, `e_start`, `e_end`,`color`) VALUES (NULL,'$_SESSION[m_ID]','$e_title','$e_detail','$e_start','$e_end','$color')";
        $qq = $conx->query($q);
        if($qq){

            echo "<script>alert('คุณได้กิจกรรมแล้ว!');</script>";
            echo "<script>window.location.href='index.php'</script>";
        }else{
            echo "<script>alert('กรุณาลองใหม่อีกครั้ง.');</script>";
            echo "<script>window.location.href='index.php'</script>";
        }
    }elseif($btnedit){
        $e_ID = $_POST['e_ID'];
        $status = $_POST['status'];
        $e_title =$_POST['e_title'];
        $e_detail = $_POST['e_detail'];
        $e_start = $_POST['e_start'];
        $e_end = $_POST['e_end'];
        $color = $_POST['color']; 


        $q ="UPDATE `event` SET `e_ID`='$e_ID',`status`='$status',`e_title`='$e_title',`e_detail`='$e_detail',`e_start`='$e_start',`e_end`='$e_end',`color`='$color' WHERE `event`.`e_ID`='$e_ID'";
        $qq = $conx->query($q);
        if($qq){
          
          echo "<script>alert('คุณได้แก้ไขข่าวกิจกรรมแล้ว!');</script>";
          echo "<script>window.location.href='index.php'</script>";
      }else{
          echo "<script>alert('กรุณาลองใหม่อีกครั้ง.');</script>";
          echo "<script>window.location.href='index.php'</script>";
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
            
            echo "<script>alert('คุณได้ลบกิจกรรมแล้ว!');</script>";
            echo "<script>window.location.href='index.php'</script>";
        }else{
            echo "<script>alert('กรุณาลองใหม่อีกครั้ง.');</script>";
            echo "<script>window.location.href='index.php'</script>";
        }

    }
?>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script type="text/javascript">
        function successalert1() {
            swal({
                title: 'สำเร็จ',  //สิ่งที่เปลี่ยนได้ คือหัว
                text: 'ได้ทำการดึงข้อมูลสำเร็จ',  // ข้อความที่แสดง
                type: 'success', // อันนี้คือประเภทว่าจะให้เป็นแบบไหน
                timer: 2000  // หน่วงเวลา 
            }).then(
                function () { },
                // handling the promise rejection
                function (dismiss) {
                    if (dismiss === 'timer') {
                        console.log('I was closed by the timer')
                    }
                }
            )
        }
</script>