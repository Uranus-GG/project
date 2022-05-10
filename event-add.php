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

    <!-- Page Heading/Breadcrumbs -->
   

<div class="container">
  <section class="section-background">
  <h2 class="text-center">จองเข้าใช้บริการ</h2>
    <form action="event-save.php" method="post" enctype="multipart/form-data">
            <div class="form-group text-center">
              <!-- <label for="p_ID" >ID</label> -->
              <input type="hidden" class="form-control" id="e_ID" name="e_ID" value="" >
            </div>
            <div class="form-group">
              <label for="e_image">กรุณาใส่รูปภาพ</label>
              <input type="file" class="form-control-file" id="e_image" name="e_image" placeholder="" value="" required>
            </div>
            <div class="form-group">
              <label for="e_title">ชื่อกิจกรรม</label>
              <input type="text" class="form-control" id="e_title" name="e_title" placeholder="" value="" required>
            </div>
            <div class="form-group">
                <label for="e_detail">รายละเอียดกิจกรรม</label>
                <textarea class="form-control" rows="5" id="detail" name="e_detail" required></textarea>
            </div>
            <div class="form-group">
              <label for="e_start">เริ่ม&nbsp;&nbsp;&nbsp;&nbsp;:</label>
                <input type="date" id="e_start" name="e_start">
                <!-- <label for="appt">เวลา:</label>
                <input type="time" id="appt" name="appt"> -->
            </div>
            <div class="form-group">
                <label for="e_end">สิ้นสุด:</label>
                <input type="date" id="e_end" name="e_end">
            </div>
            <div class="form-group">
                <label for="color">เลือกสี</label>
                <input type="color" id="color" name="color">
                <!-- <label for="appt">เวลา:</label>
                <input type="time" id="appt" name="appt">                 -->
            </div>

        
            <button name="btnins" value="1" type="submit" class="btn btn-success">เพิ่ม</button>
            <a class="btn btn-pill btn-danger" onclick="location.href='event.php';">ยกเลิก</a>
            <br>
            <br>
    </form>
  </section>
</div>

    <!-- Bootstrap core JavaScript -->
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

  <!-- /.container -->

