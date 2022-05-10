<?php require_once('connect.php');
 if($_SESSION['m_ID'] == "") //หาก session mem_id เป็นค่าว่าง(คือยังไม่ได้ล๊อกอินเข้ามา)ให้แสดงข้อความด้านล่าง
	{
		echo "<script>alert('กรุณาลองใหม่อีกครั้ง.');</script>";
        echo "<script>window.location.href='index.php'</script>";
		exit();
	}
if($_SESSION['role'] != "admin")//และถ้า session mem_status หรือสถานะไม่ใช่ admin ให้แสดงข้อความด้านล่าง
	{
		echo "<script>alert('หน้าสำหรับผู้ดูแลระบบ.');</script>";
        echo "<script>window.location.href='index.php'</script>";
		exit();
	}	 
?>

    <?php require_once('menu-admin.php'); ?> 

    <?php

   $m_ID = filter_input(INPUT_GET,"m_ID");
   $q = "SELECT * FROM `member` WHERE m_ID=$m_ID";   
   $qq = $conx->query($q);
   $row = $qq->fetch_assoc(); ?> 
      <!-- Content Column -->
        <h2 class="text-center">แก้ไขรายชื่อสมาชิก</h2>
        <div class="container">
        <form action="admin-save.php" method="post">


                        <div class="form-group">

                            <input type="hidden" class="form-control" id="m_ID" name="m_ID" placeholder=""  readonly value="<?php echo $row['m_ID']; ?>">
                        </div>

                        <div class="form-group col-md-6">
                            <label for="m_username">ชื่อผู้ใช้</label>
                            <input type="text" class="form-control" id="m_username" name="m_username" placeholder="username" value="<?php echo $row['m_username']; ?>">
                        </div>

                        <div class="form-group col-md-6">
                            <label  for="m_email">อีเมล</label>
                            <input type="email" class="form-control" id="m_email" name="m_email" placeholder=""value="<?php echo $row['m_email']; ?>">
                        </div>

                        <div class="form-group col-md-6">
                            <label for="f_name">ชื่อ</label>
                            <input type="text" class="form-control" id="f_name" name="f_name" placeholder="" value="<?php echo $row['f_name']; ?>">
                        </div>

                        <div class="form-group col-md-6">
                            <label for="l_name">นามสกุล</label>
                            <input type="text" class="form-control" id="l_name" name="l_name" placeholder="" value="<?php echo $row['l_name']; ?>">
                        </div>

                        <div class="form-group col-md-6">
                            <label  for="m_tel">เบอร์โทร</label>
                            <input type="number" class="form-control" id="m_tel" name="m_tel" placeholder="" value="<?php echo $row['m_tel']; ?>">
                        </div>



                        <div class="form-group col-md-6">
                          <label class="control-label no-padding-right" for="role" required> สถานะ </label>
                              <div class="col-3">
                                <select class="form-select" aria-label="Default select example"type="text" id="role" name="role" placeholder="" >
                                  <option value="admin" <?php if ($row['role'] == 'admin') {echo 'selected';}?>>admin</option>
                                  <option value="user" <?php if ($row['role'] == 'user') {echo 'selected';}?>>user</option>

                                </select>
                               
                              </div>
                        </div>
                        <div class="form-group col-md-12">
                              <div class="col-3">
                                <a class="btn btn-primary" href="admin-edit-password-user.php?m_ID=<?php echo $row['m_ID']; ?>">แก้ไขรหัสผ่าน</a>
                              </div>
                        </div>

                        <div class="form-group col-md-12">
                            <button value="1" type="submit" name="btnedit" class="btn btn-warning">แกไข</button>
                            <button value="1" type="button"class="btn btn-danger" onClick="javascript: window.history.back();">ยกเลิก</button>                  
                        </div>
                    </form>
        </div>

  <!-- Footer -->
<?php require_once('footer-admin.php'); ?>

