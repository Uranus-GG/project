
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
<body id="top" data-spy="scroll" data-target=".navbar-collapse" data-offset="50">

    <!-- PRE LOADER -->
    <section class="preloader">
         <div class="spinner">

              <span class="spinner-rotate"></span>
              
         </div>
    </section>     
  <?php
  require_once('menu-admin.php');
  $l_ID = filter_input(INPUT_GET,"l_ID");
  $q = "SELECT * FROM learn WHERE l_ID=$l_ID";   
  $qq = $conx->query($q);
  $row = $qq->fetch_assoc(); ?> 
    <section>
         <div class="container">
         <form action="learn-save.php" method="post" enctype="multipart/form-data">
              <div class="form-group text-center">
                <!-- <label for="p_ID" >ID</label> -->
                <input type="hidden" class="form-control" id="l_ID" name="l_ID" value="<?php echo $row['l_ID']; ?>" >
              </div>
              <div class="form-group">
                <label for="p_title">ชื่อกิจกรรมการเรียนรู้</label>
                <input type="text" class="form-control" id="l_title" name="l_title" placeholder="" value="<?php echo $row['l_title']; ?>" required>
              </div>
              <div class="form-group">
                  <label for="formGroupExampleInput2">รายละเอียดกิจกรรมการเรียนรู้</label>
                  <textarea class="form-control" rows="5" id="detail" name="l_detail" required><?php echo $row['l_detail']; ?></textarea>
              </div>         
              <div class="form-group">
                <label for="l_image">กรุณาใส่รูปภาพ</label>
                <input type="file" class="form-control-file" id="l_image" name="l_image" value="<?php echo $row['l_image']; ?>" >
                <br>
                <?php 
                          if ($row['l_image'] != '') {                           
                              echo "<input type='checkbox' name='Delete_old_pic' value='Yes'>ลบไฟล์รูปภาพ<br>";
                              echo "$row[l_image]<br><br>";
                              echo "<img src='upload/learn/$row[l_image]' width='200'/>";
                              echo "<input type='hidden' name='hidden_product_pic' id='hidden_product_pic' value='$row[l_image]'>";
                          } else {
                              echo '<font color=red>ไม่มีข้อมูล</font>';
                          }?>
              </div>
              <div class="clearfix">
                    <button type="submit" name="btnedit" value="1" class="section-btn btn btn-primary pull-left">แก้ไข</button>
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
