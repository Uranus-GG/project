<?php require_once('menu-admin.php') ?>
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

    <?php
   $e_ID = filter_input(INPUT_GET,"e_ID");
   $q = "SELECT * FROM `event` WHERE e_ID=$e_ID";   
   $qq = $conx->query($q);
   $row = $qq->fetch_assoc(); ?>

<div class="container">
  <section class="section-background">
    <h2 class="text-center">แก้ไขรายงานการจอง</h2>
    <form action="event-save.php" method="post" enctype="multipart/form-data">
                <div class="form-group text-center">
                  <!-- <label for="p_ID" >ID</label> -->
                  <input type="hidden" class="form-control" id="e_ID" name="e_ID" value="<?php echo $row['e_ID']; ?>" >
                </div>

                <div class="form-group">
                              <label class="control-label no-padding-right" for="status" required> สถานะ </label>
                                  <div class="col-3">
                                    <select class="form-select" aria-label="Default select example"type="text" id="role" name="status" placeholder="" >
                                      <option value="0" <?php if ($row['status'] == '0') {echo 'selected';}?>>รออนุมัติ</option>
                                      <option value="1" <?php if ($row['status'] == '1') {echo 'selected';}?>>อนุมัติ</option>
                                      <option value="2" <?php if ($row['status'] == '2') {echo 'selected';}?>>ไม่อนุมัติ</option>
                                      <option value="3" <?php if ($row['status'] == '3') {echo 'selected';}?>>ยกเลิก</option>
                                    </select>
                                  </div>
                </div>

                <div class="form-group">
                <label for="e_image">กรุณาใส่รูปภาพ</label>
                <input type="file" class="form-control-file" id="e_image" name="e_image" value="<?php echo $row['e_image']; ?>" >
                <br>
                <?php 
                          if ($row['e_image'] != '') {                           
                              echo "<input type='checkbox' name='Delete_old_pic' value='Yes'>ลบไฟล์รูปภาพ<br>";
                              echo "$row[e_image]<br><br>";
                              echo "<img src='file_upload/pic/event/$row[e_image]' width='200'/>";
                              echo "<input type='hidden' name='hidden_product_pic' id='hidden_product_pic' value='$row[e_image]'>";
                          } else {
                            echo "<img src='img/blog-image-2-940x460.jpg' class='img-responsive wc-image'width='200'/>";
                          }?>
              </div>

                <div class="form-group">
                  <label for="e_title">ชื่อกิจกรรม</label>
                  <input type="text" class="form-control" id="e_title" name="e_title" placeholder="" value="<?php echo $row['e_title']; ?>" required>
                </div>
                <div class="form-group">
                    <label for="e_detail">รายละเอียดกิจกรรม</label>
                    <textarea class="form-control" rows="5" id="detail" name="e_detail" required><?php echo $row['e_detail']; ?></textarea>
                </div>
                
                <div class="form-group">
                  <label for="e_start" required >เริ่ม&nbsp;&nbsp;&nbsp;&nbsp;:</label>
                    <input type="date" id="e_start" name="e_start" value="<?php $start = date('Y-m-d',strtotime($row['e_start']));echo $start;?>" >
                </div>
                <div class="form-group">
                  <label for="e_end" required >สิ้นสุด:</label>
                    <input type="date"  id="e_end" name="e_end" value="<?php $start = date('Y-m-d',strtotime($row['e_end']));echo $start;?>" >
                    
                    <!-- <label for="appt">เวลา:</label>
                    <input type="time" id="appt" name="appt"> -->
                </div>
                <br>
                <div class="form-group">
                    <label for="color">เลือกสีในการแสดง:</label>
                    <input type="color" id="color" name="color" value="<?php echo $row['color']; ?>">
                    <!-- <label for="appt">เวลา:</label>
                    <input type="time" id="appt" name="appt">                -->
                </div>
                  <br>
                    <button type="submit" name="btnedit" value="1" class="btn btn-warning">แก้ไข</button>
                    <button type="button" class="btn btn-danger" onClick="javascript: window.history.back();">ยกเลิก</button>
                  </div>
                  <br>
    </form>
  </section> 
</div>
<?php require_once('footer-admin.php'); ?>
<script>
    // Replace the <textarea id="editor1"> with a CKEditor
    // instance, using default configuration.
    CKEDITOR.replace('detail');
    function CKupdate() {
        for (instance in CKEDITOR.instances)
            CKEDITOR.instances[instance].updateElement();
    }
</script>


