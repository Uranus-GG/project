<?php require_once ('menu-admin.php'); ?>
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
  <div class="container-fluid">
        <h2 class='text-center text-primary'>รายชื่อสมาชิก</h2>
        <table class="table table-striped table-hover table-bordered" id="example">
          <thead class="thead-dark">

            <tr>

                <th class='text-center'>ลำดับ</th>
                <th class='text-center'>ชื่อ</th>
                <th class='text-center'>นามสกุล</th>
                <th class='text-center'>เบอร์โทร</th>
                <th class='text-center'>อีเมล</th>
                <th class='text-center'>ชื่อผู้ใช้</th>
                <th class='text-center'>สถานะ</th>
                <th class='text-center'></th>
                <th class='text-center'></th>
            </tr>
          </thead>
          <tbody>

          <?php
          $q = "SELECT * FROM `member` ORDER BY `member`.`m_ID` DESC";
          $qq = $conx->query($q);
          $qn = $qq->num_rows;
          if($qn > 0){
              for($i = 0; $i<$qn; $i++){
                  $row = $qq->fetch_assoc();
                  ?>
            <tr>
              
              <td class='text-center'><?php echo $i+1; ?></td>
              <td class='text-center'> <?php echo $row['f_name']; ?> </td>
              <td class='text-center'> <?php echo $row['l_name']; ?> </td>
              <td class='text-center'> <?php echo $row['m_tel']; ?> </td>
              <td class='text-center'> <?php echo $row['m_email']; ?> </td>
              <td class='text-center'> <?php echo $row['m_username']; ?> </td>
              <td class='text-center'> 
              <?php
              if($row['role']=='admin'){
                echo "<font color='#0000ff'>ผู้ดูแลระบบ</font>";
              }
              if($row['role']=='user'){
                echo "<font color='#00cc00'>ผู้ใช้</font>";
                          
              }             
              ?>
              </td>              
              <td class='text-center'><a class="btn btn-warning" href="admin-edit.php?m_ID=<?php echo $row['m_ID']; ?>">แก้ไข</a></td>
              <td class='text-center'><a class="btn btn-danger"  href="admin-save.php?m_ID=<?php echo $row['m_ID']; ?>" onclick="return confirm('คุณต้องการลบข้อมูลที่เลือก')">ลบ</a></td>
            </tr>

        <?php } ?>

          </tbody>  
        </table>
    <?php } ?>          
      </div>
    </div>
    <!-- /.row -->

  </div>
  <!-- /.container -->

  <!-- Footer -->
<?php require_once('footer-admin.php'); ?>

