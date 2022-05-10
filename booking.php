
<?php 
    require_once('connect.php');
    require_once('menu-header.php');
if ($_SESSION['role'] =='admin' || $_SESSION['role'] =='user')  
{

} else {
    echo "<script>alert('กรุณาสมัครสมาชิก!'); window.location ='register.php';</script>";
}	 
  
?>
    <div class="page-heading header-text">
          <div class="container">
            <div class="row">
              <div class="col-md-12">
                <h1>จองเข้าใช้บริการ</h1>
              </div>
            </div>
          </div>
    </div>

  <!-- Page Content -->
  <div class="container col-md-7">
    <br>
    <!-- Page Heading/Breadcrumbs -->
    <form action="booking-save.php" method="post" enctype="multipart/form-data">
            <div class="form-group col-md-3 text-center">
              <!-- <label for="p_ID" >ID</label> -->
              <input type="text" class="form-control" id="e_ID" name="e_ID" value="" hidden>
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

        
            <button name="btnins" value="1" type="submit" class="btn btn-success">เพิ่ม</button>
            <a class="btn btn-pill btn-danger" onclick="location.href='index.php';">ยกเลิก</a>
            
    </form>
    <br>
    <br>
  </div>
<?php require_once('footer.php'); ?>

