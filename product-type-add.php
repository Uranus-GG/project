<?php require_once('menu-admin.php') ?>
<?php 
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
<br>
  <!-- Page Content -->
  <div class="container">
        <section class="section-background">
        <h1 class="text-center text-primary">ประเภทผลิตภัณฑ์</h1> 
        <br>
        <form action="product-save.php" method="post">
        <div class="form-group col-md-3">
              <!-- <label for="news_ID" >ID</label> -->
              <input type="text" class="form-control " id="product_type_name" name="product_type_name" value="" >
            </div>
            <div class="form-group col-md-3 ">
            <button name="product_type" value="1" type="submit" class="btn btn-success" >เพิ่ม</button>
            </div>
        </form>

        <?php
        $product_type_ID = filter_input(INPUT_GET,"product_type_ID");
        if($product_type_ID){
          $q = "SELECT * FROM `product_type` WHERE product_type_ID=$product_type_ID";   
          $qq = $conx->query($q);
          $row = $qq->fetch_assoc();
             ?>
        <form action="product-save.php" method="post">
          <div class="form-group col-md-3">
          <input type="hidden" class="form-control" name="product_type_id" value="<?php echo $row['product_type_ID']; ?>"hidden>
               <input type="text" class="form-control " id="product_type_name" name="product_type_name" value="<?php echo $row['product_type_name']; ?>" >
          </div>
          <div class="form-group col-md-3 ">
               <button name="product_type_edit" value="1" type="submit" class="btn btn-warning" >แก้ไข</button>
          </div>
        </form>
        <?php } ?>
        <br>
               <table class="table table-hover table-bordered">
                    <thead>
                    <tr>
                         <th class="text-center">ลำดับ</th>
                         <th class="text-center">ประเภทผลิตภัณฑ์</th>
                         <th></th>
                         <th></th>
                    </tr>
                    </thead>      
                    <tbody>
                    <?php
                    $q = "SELECT * FROM `product_type`";
                    $qq = $conx->query($q);
                    $qn = $qq->num_rows;
                    if($qn > 0){
                    for($i = 0; $i<$qn; $i++){
                    $row = $qq->fetch_assoc();
                    ?>
                    <tr>
                         <th class="col-md-1 text-center"><?php echo $i+1 ?></th>
                         <td class="text-center"><?php echo $row['product_type_name']; ?></td>
                         <td class="col-md-1"><a class="btn btn-warning" href="product-type-add.php?product_type_ID=<?php echo $row['product_type_ID']; ?>">แก้ไข</a></td>
                         <td class="col-md-1"><a class="btn btn-danger" href="product-save.php?product_type_ID=<?php echo $row['product_type_ID']; ?>" onclick="return confirm('คุณต้องการลบข้อมูลที่เลือก')">ลบ</a></td>
                    </tr>
                    <?php 
      }
      } ?>
                    </tbody>
               </table>
        </section>

  </div>
  <!-- /.container -->

  <!-- Footer -->
<?php require_once('footer-admin.php'); ?>