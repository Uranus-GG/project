
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
require_once('menu-admin.php');?> 
<section>
  <!-- Page Content -->
    <div class="container">
      <br>
      <!-- Page Heading/Breadcrumbs -->
      <h2 class="text-center">แก้ไขผลิตภัณฑ์</h2>

      <?php
    $p_ID = filter_input(INPUT_GET,"p_ID");
    $q = "SELECT * FROM `product`LEFT JOIN product_type ON product.product_type_name = product_type.product_type_ID WHERE p_ID=$p_ID";   
    $qq = $conx->query($q);
    $row = $qq->fetch_assoc(); ?> 
            <!-- Blog Post -->
      <form action="product-save.php" method="post" enctype="multipart/form-data">
              <div class="form-group text-center">
                <!-- <label for="p_ID" >ID</label> -->
                <input type="hidden" class="form-control" id="p_ID" name="p_ID" value="<?php echo $row['p_ID']; ?>" >
              </div>
              <div class="form-group">
                <label for="p_title">ชื่อผลิตภัณฑ์</label>
                <input type="text" class="form-control" id="p_title" name="p_title" placeholder="" value="<?php echo $row['p_title']; ?>" required>
              </div>
              <label>ประเภทผลิตภัณฑ์ : </label><span style="color: #F70C10; font-size: 16px;" >*</span>
                        <select id="product_type_name" name="product_type_name" required>
                        <?php 
                        $q =  "SELECT * FROM `product_type` ORDER BY `product_type_ID` ASC ";
                        $qq = $conx->query($q);
                        while ($row_product_type = $qq->fetch_assoc()) {
                        ?>
                            <option value="<?php echo $row_product_type['product_type_ID'];?>" <?php if ($row_product_type['product_type_ID'] == $row['product_type_ID']) {echo 'selected';}?>><?php echo $row_product_type['product_type_name'];?></option>
                            
                        <?php } ?>
                        <?php if($row['product_type_ID']==0){ ?>
                            <option value="<?php echo $row_news_type['product_type_ID'];?>" <?php if ($row_news_type['product_type_ID'] == $row['product_type_ID']) {echo 'selected';}?>>ผลิตภัณฑ์ไม่มีประเภท</option>
                            <?php } ?>
                        </select>

              <div class="form-group">
                  <label for="formGroupExampleInput2">รายละเอียดผลิตภัณฑ์</label>
                  <textarea class="form-control" rows="5" id="detail" name="p_detail" required><?php echo $row['p_detail']; ?></textarea>
              </div>   
              <div class="form-group">
                <label for="p_price">ราคาผลิตภัณฑ์</label>
                <input type="number" class="form-control" id="p_price" name="p_price" placeholder="" value="<?php echo $row['p_price']; ?>" required>
              </div>        
              <div class="form-group">
                <label for="p_image">กรุณาใส่รูปภาพ</label>
                <input type="file" class="form-control-file" id="p_image" name="p_image" value="<?php echo $row['p_image']; ?>" >
                <br>
                <?php 
                          if ($row['p_image'] != '') {                           
                              echo "<input type='checkbox' name='Delete_old_pic' value='Yes'>ลบไฟล์รูปภาพ<br>";
                              echo "$row[p_image]<br><br>";
                              echo "<img src='file_upload/pic/$row[p_image]' width='200'/>";
                              echo "<input type='hidden' name='hidden_product_pic' id='hidden_product_pic' value='$row[p_image]'>";
                          } else {
                            echo "<img src='img/blog-image-2-940x460.jpg' class='img-responsive wc-image'width='200'/>";
                          }?>
              </div>
              <div class="clearfix">
                    <button type="submit" name="btnedit" value="1" class="section-btn btn btn-primary pull-left">แก้ไข</button>
                </div>  
      </form>
    </div>
  </section>
    <br>

<?php require_once('footer-admin.php') ?>
<script>
    // Replace the <textarea id="editor1"> with a CKEditor
    // instance, using default configuration.
    CKEDITOR.replace('detail');
    function CKupdate() {
        for (instance in CKEDITOR.instances)
            CKEDITOR.instances[instance].updateElement();
    }
</script>


