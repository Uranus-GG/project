
<?php require_once('connect.php');
$news_date = date('d-m-y');
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
  <?php
  require_once('menu-admin.php');?> 
    <section>
         <div class="container">
           <form class="form" action="news-save.php" method="post" enctype="multipart/form-data"> 
                     
           <div class="form-group">
              <!-- <label for="news_ID" >ID</label> -->
              <input type="hidden" class="form-control " id="news_ID" name="news_ID" >
            </div>
                <div class="row">
                    <div class="col-lg-9 col-md-9 col-xs-12">
                              <p class="lead" name="news_user">ผู้ใช้ <strong class="text-primary"><?php echo $_SESSION['m_username']; ?></strong></p>
                              <p class="lead">
                              <i class="fa fa-calendar" name="news_date"></i> อัพโหลด<?php echo $news_date; ?>&nbsp;&nbsp;
                              <i class="fa fa-calendar" name="news_date_edit"></i> แก้ไข<?php echo $news_date; ?>&nbsp;&nbsp;
                              <br>
                              </p>
                              <p class="lead">
                                <label for="news_image">กรุณาใส่รูปภาพ</label>
                                <input type="file" class="form-control-file" id="news_image" name="news_image" value="" >
                              </p>
                    </div>
                </div>

                <div class="panel panel-default">
                    <div class="panel-heading">
                    <h4>หัวข้อข่าว</h4>
                    <input type="text" class="form-control" id="news_title" name="news_title" placeholder="" value="" required>
                    </div>
                      
                    <div class="panel-body">
                    <label>ประเภทข่าว : </label><span style="color: #F70C10; font-size: 16px;" >*</span>
                    <select  id="news_type_ID" name="news_type_ID" required>
				            <?php 
                    $q = "SELECT * FROM news_type";
                    $qq = $conx->query($q);
                    while ($row_news_type = $qq->fetch_assoc()) {
                    ?>
                        <option value='<?php echo $row_news_type['news_type_ID']; ?>'><?php echo $row_news_type['news_type_name']; ?></option>";
                    <?php } ?>
                    </select>
                      <h4>รายละเอียดข่าว</h4>
                      <div class="form-group">
                        <textarea class="form-control" rows="5" id="detail" name="news_detail" required></textarea>
                      </div>
                    </div>
                </div>
                <div class="clearfix">
                    <button type="submit" name="btnins" value="1" class="section-btn btn btn-primary pull-left">เพิ่ม</button>
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






