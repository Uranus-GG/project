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
<br>
  <!-- Page Content -->
  <div class="container">
        <section class="section-background">
        <h1 class="text-center text-primary">แก้ไขข่าวสาร</h1> 
        <br>
               <table class="table table-hover table-bordered" id="example">
                    <thead>
                    <tr>
                         <th>ลำดับ</th>
                         <th>หัวข้อข่าว</th>
                         <th>รายละเอียดข่าว</th>
                         <th>รูป</th>
                         <th>อัลบั้ม</th>
                         <th></th>
                         <th></th>
                    </tr>
                    </thead>      
                    <tbody>
                    <?php
                    $q = "SELECT * FROM `news` ORDER BY `news`.`news_ID` DESC";
                    $qq = $conx->query($q);
                    $qn = $qq->num_rows;
                    if($qn > 0){
                    for($i = 0; $i<$qn; $i++){
                    $row = $qq->fetch_assoc();
                    ?>
                    <tr>
                         <th class="col-md-1 text-center"><?php echo $i+1 ?></th>
                         <td class="text-center"><?php echo $row['news_title']; ?></td>
                         <td><?php echo iconv_substr($row['news_detail'],0,300);?></td>
                         <td>
                         <?php if ($row['news_image'] != '') {                                                  
                            echo "<img src='file_upload/pic/$row[news_image]' width='200' height='200'/>";
                        } else {
                            echo "<img src='img/blog-image-2-940x460.jpg' class='img-responsive wc-image'/>";
                        }?>                       
                         </td>
                         <td class="text-center"><a href='uploadImages.php?data_id=<?php echo $row['news_ID']; ?>&type_gallery_id=1&data_name=<?php echo $row['news_title'];?>'><img src='img/picture.png' width='30'/></a></td>
                         <td><a class="btn btn-warning" href="news-formedit.php?news_ID=<?php echo $row['news_ID']; ?>">แก้ไข</a></td>
                         <td><a class="btn btn-danger" href="news-save.php?news_ID=<?php echo $row['news_ID']; ?>" onclick="return confirm('คุณต้องการลบข้อมูลที่เลือก')">ลบ</a></td>
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