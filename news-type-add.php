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
        <h1 class="text-center text-primary">ประเภทข่าว</h1> 
        <br>
        <form action="news-save.php" method="post">
        <div class="form-group col-md-3">
              <!-- <label for="news_ID" >ID</label> -->
              <input type="text" class="form-control " id="news_type_name" name="news_type_name" value="" >
            </div>
            <div class="form-group col-md-3 ">
            <button name="news_type" value="1" type="submit" class="btn btn-success" >เพิ่ม</button>
            </div>
        </form>
        <?php
        $news_type_ID = filter_input(INPUT_GET,"news_type_ID");
        if($news_type_ID){
          $q = "SELECT * FROM `news_type` WHERE news_type_ID=$news_type_ID";   
          $qq = $conx->query($q);
          $row = $qq->fetch_assoc();
             ?>
        <form action="news-save.php" method="post">
          <div class="form-group col-md-3">
          <input type="hidden" class="form-control" name="news_type_id" value="<?php echo $row['news_type_ID']; ?>"hidden>
               <input type="text" class="form-control " id="news_type_name" name="news_type_name" value="<?php echo $row['news_type_name']; ?>" >
          </div>
          <div class="form-group col-md-3 ">
               <button name="news_type_edit" value="1" type="submit" class="btn btn-warning" >แก้ไข</button>
          </div>
        </form>
        <?php } ?>
        <br>
               <table class="table table-hover table-bordered">
                    <thead>
                    <tr>
                         <th class="text-center">ลำดับ</th>
                         <th class="text-center">ประเภทข่าว</th>
                         <th></th>
                         <th></th>
                    </tr>
                    </thead>      
                    <tbody>
                    <?php
                    $q = "SELECT * FROM `news_type`";
                    $qq = $conx->query($q);
                    $qn = $qq->num_rows;
                    if($qn > 0){
                    for($i = 0; $i<$qn; $i++){
                    $row = $qq->fetch_assoc();
                    ?>
                    <tr>
                         <th class="col-md-1 text-center"><?php echo $i+1 ?></th>
                         <td class="text-center"><?php echo $row['news_type_name']; ?></td>
                         <td class="col-md-1"><a class="btn btn-warning" href="news-type-add.php?news_type_ID=<?php echo $row['news_type_ID']; ?>">แก้ไข</a></td>
                         <td class="col-md-1"><a class="btn btn-danger" href="news-save.php?news_type_ID=<?php echo $row['news_type_ID']; ?>" onclick="return confirm('คุณต้องการลบข้อมูลที่เลือก')">ลบ</a></td>
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