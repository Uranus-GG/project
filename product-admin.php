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

    <!-- Page Heading/Breadcrumbs -->
    <h1 class="mt-4 mb-3 text-center text-primary">แก้ไขผลิตภัณฑ์
      <small></small>
    </h1>

<br>
    <?php
          $q = "SELECT * FROM `product`ORDER BY `product`.`p_ID` DESC";
          $qq = $conx->query($q);
          $qn = $qq->num_rows;
        ?>


    <div class="row">
    <table class="table table-striped table-hover  table-bordered " id="example">
          <thead class="thead-dark">

            <tr>

                <th class="text-center" >ลำดับ</th>
                <th class="col-md-2 text-center" >ชื่อผลิตภัณฑ์</th>
                <th class="text-center">รายละเอียด</th>
                <th class="text-center">ราคา</th>
                <th class="text-center">รูป</th>
                <th class="text-center">อัลบั้ม</th>
                <th class="text-center"></th>
                <th class="text-center"></th>
            </tr>
          </thead>
          <tbody>

          <?php
          if($qn > 0){
              for($i = 0; $i<$qn; $i++){
                  $row = $qq->fetch_assoc();
                  ?>
            <tr>
              
              <td class="text-center"><?php echo $i+1 ?></td>
              <td class="text-center"> <?php echo $row['p_title']; ?> </td>
              <td class="text-center"> <?php echo iconv_substr($row['p_detail'],0,300);?> </td>
              <td class="text-center"> <?php echo $row['p_price']; ?> </td>
              <td class="text-center">      
              <?php if ($row['p_image'] != '') {                                                  
                            echo "<img src='file_upload/pic/$row[p_image]'width='200' height='200'/>";
                        } else {
                            echo "<img src='img/blog-image-2-940x460.jpg' class='img-responsive wc-image'/>";
                        }?> 
              </td>
              <td class="text-center"><a href='uploadImages.php?data_id=<?php echo $row['p_ID']; ?>&type_gallery_id=2&data_name=<?php echo $row['p_title'];?>'><img src='img/picture.png' width='30'/></a></td>           
              <td class="text-center"><a class="btn btn-warning" href="product-edit.php?p_ID=<?php echo $row['p_ID']; ?>">แก้ไข</a></td>
              <td class="text-center"><a class="btn btn-danger"  href="product-save.php?p_ID=<?php echo $row['p_ID']; ?>" onclick="return confirm('คุณต้องการลบข้อมูลที่เลือก')">ลบ</a></td>
            </tr>

        <?php } ?>

          </tbody>  
        </table>
    <?php } ?> 
         
    </div>
  </div>
  <!-- /.container -->
<?php require_once('footer-admin.php'); ?>