
<?php 
require_once('connect.php');
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

<body id="top" data-spy="scroll" data-target=".navbar-collapse" data-offset="50">

    <!-- PRE LOADER -->
    <section class="preloader">
         <div class="spinner">

              <span class="spinner-rotate"></span>
              
         </div>
    </section>     
  <?php require_once('menu-admin.php'); ?> 
    <section>
         <div class="container">
           <form class="form" action="learn-save.php" method="post" enctype="multipart/form-data"> 
                     
           <div class="form-group">
              <!-- <label for="news_ID" >ID</label> -->
              <input type="hidden" class="form-control " id="l_ID" name="l_ID" >
            </div>

                <div class="panel panel-default">
                    <div class="panel-heading">
                    <h4>ชื่อกิจกรรมการเรียนรู้</h4>
                    <input type="text" class="form-control" id="l_title" name="l_title" placeholder="" value="" required>
                    </div>
                      <h4>รายละเอียดกิจกรรมการเรียนรู้</h4>
                      <div class="form-group">
                        <textarea class="form-control" rows="5" id="detail" name="l_detail" required></textarea>
                      </div>
                    </div>
                    <div class="form-group">
                        <label for="news_image">กรุณาใส่รูปภาพ</label>
                        <input type="file" class="form-control-file" id="l_image" name="l_image" value=""  required>              
                    </div>
                    <div class="clearfix">
                        <button type="submit" name="btnins" value="1" class="section-btn btn btn-primary pull-left">เพิ่ม</button>
                    </div>               
                </div>
          </div>
      </form>
    </section>
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






