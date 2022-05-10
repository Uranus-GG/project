<?php
  require_once('connect.php');
?>
<?php
   
    $m_ID = filter_input(INPUT_GET,"m_ID");
    if($m_ID){
        $q = "DELETE FROM `member` WHERE `member`.`m_ID` = $m_ID";
        $qq = $conx->query($q);
        if($qq){
            echo "<script>alert('คุณได้ลบสมาชิกแล้ว!');</script>";
            echo "<script>window.location.href='admin.php'</script>";
        }else{
            echo "<script>alert('กรุณาลองใหม่อีกครั้ง.');</script>";
            echo "<script>window.location.href='admin.php'</script>";
        }
        ?>
        <?php
    }
?>
