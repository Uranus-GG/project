
<?php require_once ('menu-admin.php'); ?>
  <!-- Page Content -->

    <style>
div.ex1 {
  margin-top: 100px;
}

</style>
<?php

$m_ID = filter_input(INPUT_GET,"m_ID");
$q = "SELECT * FROM `member` WHERE m_ID=$m_ID";   
$qq = $conx->query($q);
$row = $qq->fetch_assoc(); ?> 
<div class="container ex1 "align="center">
<h2 class="text-center">แก้ไขรหัสผ่าน</h2>
        <form action="user-save.php" method="post"> 
            <div class="row justify-content-center">     
                <div class="form-group ">
                    <label>ชื่อผู้ใช้</label>
                    <input type="text" class="form-control text-center"  placeholder="" value="<?php echo $row['m_username']; ?>" readonly>
                </div>

                <div class="form-group">
                    <label>รหัสผ่านเดิม</label>
                    <input type="password" name="m_password" class="form-control text-center" placeholder="" value="">
                </div>

                <div class="form-group">
                    <label>รหัสผ่านใหม่</label>
                    <input type="password" name="m_password1" class="form-control text-center" placeholder="" value="">
                </div>

                <button type="submit" name="btnpassworduser" value="1" class="btn btn-warning">เปลี่ยนรหัสผ่าน</button>
                <br>
                <br><br><br><br><br><br>
            
            </div>  
        </form>
</div>
  <!-- /.container -->

  <?php require_once ('footer-admin.php'); ?>
