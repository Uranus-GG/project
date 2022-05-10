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

      <!-- Content Column -->
        <h2 class="text-center">เพิ่มรายชื่อสมาชิก</h2>
        <div class="container">
        <form action="admin-save.php" method="post">
                        <div class="form-group">

                            <input type="hidden" class="form-control" id="m_ID" name="m_ID" placeholder=""  readonly value="">
                        </div>

                        <div class="form-group col-md-6">
                            <label for="m_username">ชื่อผู้ใช้</label>
                            <input type="text" class="form-control" id="m_username" name="m_username" placeholder="username" value="">
                        </div>

                        <div class="form-group col-md-6">
                            <label for="m_password">รหัสผ่าน</label>
                            <input type="text" class="form-control" id="m_password" name="m_password" placeholder="password" value="">
                        </div>



                        <div class="form-group col-md-6">
                            <label for="f_name">ชื่อ</label>
                            <input type="text" class="form-control" id="f_name" name="f_name" placeholder="" value="">
                        </div>

                        <div class="form-group col-md-6">
                            <label for="l_name">นามสกุล</label>
                            <input type="text" class="form-control" id="l_name" name="l_name" placeholder="" value="">
                        </div>




                        <div class="form-group col-md-6">
                            <label  for="m_tel">เบอร์โทร</label>
                            <input type="number" class="form-control" id="m_tel" name="m_tel" placeholder="" value="">
                        </div>

                        <div class="form-group col-md-6">
                            <label  for="m_email">อีเมล</label>
                            <input type="email" class="form-control" id="m_email" name="m_email" placeholder=""value="">
                        </div>

                        <div class="form-group col-md-6">
                          <label class="control-label no-padding-right" for="role" required> สถานะ </label>
                              <div class="col-3">
                                <select class="form-select" aria-label="Default select example"type="text" id="role" name="role" placeholder="" >
                                    <option value="user">user</option>
                                    <option value="admin">admin</option>

                                </select>
                              </div>
            </div>

                        <div class="form-group col-md-12">
                            <button type="submit" name="btnins" value="1" class="btn btn-primary">เพิ่ม</button>
                            <button value="1" type="button"class="btn btn-danger" onClick="javascript:window.history.back();">ยกเลิก</button>                  
                        </div>
                    </form>
        </div>
  <!-- Footer -->
<?php require_once('footer-admin.php'); ?>

