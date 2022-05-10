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
        <!-- นำเข้า  CSS จาก dataTables -->
        <link rel="stylesheet" type="text/css" href="http://cdn.datatables.net/1.10.12/css/jquery.dataTables.css">        
        <!-- นำเข้า  Javascript จาก  Jquery -->
        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        <!-- นำเข้า  Javascript  จาก   dataTables -->
        <script type="text/javascript" charset="utf8" src="http://cdn.datatables.net/1.10.12/js/jquery.dataTables.js"></script>
        <script type="text/javascript">
            //คำสั่ง Jquery เริ่มทำงาน เมื่อ โหลดหน้า Page เสร็จ 
            $(function(){
                //กำหนดให้  Plug-in dataTable ทำงาน ใน ตาราง Html ที่มี id เท่ากับ example
                $('#example').dataTable();
                
            });
        </script>
  <!-- Page Content -->
  <div class="container">
  <section class="section-background">
        <h1 class="text-center text-primary">รายงานการจอง</h1> 
        <br>
        <div class="form-group col-md-3 ">
            <a  href="event-add.php" value="1" type="button" class="btn btn-success" >เพิ่มรายงานการจอง</a>
        </div>
  <table class="table table-striped table-hover  table-bordered "  id="example">
          <thead class="thead-dark">

            <tr>

                <th >ลำดับ</th>
                <th class="text-center col-md-3">ชื่อกิจกรรม</th>
                <th class="text-center col-md-3">รายละเอียด</th>              
                <th class="text-center">วันที่เริ่ม</th>
                <th class="text-center">วันที่สิ้นสุด</th>             
                <th class="text-center">สถานะ</th>
                <th class="text-center" >รูป</th>
                <th class="text-center" ></th>
                <th class="text-center"></th>
            </tr>
          </thead>
          <tbody>

          <?php
          $q = "SELECT * FROM `event`ORDER BY `event`.`status` ASC";
          $qq = $conx->query($q);
          $qn = $qq->num_rows;
          if($qn > 0){
              for($i = 0; $i<$qn; $i++){
                  $row = $qq->fetch_assoc();
                  //echo "ตำแหน่งงาน :".$row['posName']."<br>";
                  ?>
            <tr>
              
              <td class="text-center"><?php echo $i+1 ?></td>
              <td> <?php echo $row['e_title']; ?> </td>
              <td> <?php echo iconv_substr($row['e_detail'],0,300);?> </td>
              <td> <?php $dateData=$row['e_start']; echo thai_date_and_time(strtotime($dateData)); ?> </td>
              <td> <?php $dateData=$row['e_end']; echo thai_date_and_time(strtotime($dateData)); ?> </td>
              
              <td><?php
              if($row['status']==0){
                echo "<font color='#00ABAA '>รออนุมัติ</font>";
              }
              elseif($row['status']==1){
                echo "<font color='#079F0D'>อนุมัติ</font>";
                          
              }elseif($row['status']==2){
                echo "<font color='#C2A805'>ไม่อนุมัติ</font>";

              }if($row['status']==3){
                echo "<font color='#C10606 '>ยกเลิก</font>";
              }             
              ?>

              </td>          
              <td>
                <?php if ($row['e_image'] != '') {                                                  
                  echo "<img src='file_upload/pic/event/$row[e_image]' width='200' height='200'/>";
              } else {
                  echo "<img src='img/blog-image-2-940x460.jpg' class='img-responsive wc-image'/>";
              }?>                       
              </td>
              <td><a class="btn btn-warning" href="event-edit.php?e_ID=<?php echo $row['e_ID']; ?>">แก้ไข</a></td>
              <td><a class="btn btn-danger"  href="event-save.php?e_ID=<?php echo $row['e_ID']; ?>" onclick="return confirm('คุณต้องการลบข้อมูลที่เลือก')">ลบ</a></td>
            </tr>

        <?php } ?>

          </tbody>  
        </table>
    <?php } ?> 
    </section>
  </div>
  

  <!-- Bootstrap core JavaScript -->
<?php require_once('footer-admin.php') ?>
  <!-- /.container -->
