<?php require_once('menu-header.php'); 

?>
<?php 
if ($_SESSION['role'] =='admin' || $_SESSION['role'] =='user')  
{

} else {
    echo "<script>alert('กรุณาสมัครสมาชิก!'); window.location ='register.php';</script>";
}	 
?>

    <div class="page-heading header-text">
          <div class="container">
            <div class="row">
              <div class="col-md-12">
                <h1>รายการจองของฉัน</h1>

              </div>
            </div>
          </div>
    </div>
  <!-- Page Content -->
  <div class="container">
  <br>
    <?php
          $q = "SELECT * FROM `event`WHERE ID_member ='$_SESSION[m_ID]'ORDER BY `event`.`e_ID` DESC";
          $qq = $conx->query($q);
          $qn = $qq->num_rows;
          // echo "มีรายการข่าวทั้งหมด $qn เรื่อง <br>";
          $rows = $row[0];
        ?>


    <div class="row">
    <table class="table table-striped table-hover  table-bordered ">
          <thead class="thead-dark">

            <tr>

                <th class="text-center">ลำดับ</th>
                <th class="text-center">ชื่อกิจกรรม</th>
                <th class="text-center">รายละเอียด</th>               
                <th class="text-center">วันที่เริ่ม</th>
                <th class="text-center">วันที่สิ้นสุด</th>               
                <th class="text-center">สถานะ</th>

            </tr>
          </thead>
          <tbody>

          <?php
          if($qn > 0){
              for($i = 0; $i<$qn; $i++){
                  $row = $qq->fetch_assoc();
                  //echo "ตำแหน่งงาน :".$row['posName']."<br>";
                  ?>
            <tr>
              
              <td class="text-center"><?php echo $i+1; ?></td>
              <td class="text-center"> <?php echo $row['e_title']; ?> </td>
              <td> <?php echo iconv_substr($row['e_detail'],0,300);?> </td>
              <td class="text-center"> <?php $dateData=$row['e_start']; echo thai_date_and_time(strtotime($dateData)); ?> </td>
              <td class="text-center"> <?php $dateData=$row['e_end']; echo thai_date_and_time(strtotime($dateData)); ?> </td>
              <td class="text-center"><?php
              if($row['status']==0){
                echo "<span class='badge bg-info'>รออนุมัติ</span>";
              }
              elseif($row['status']==1){
                echo "<span class='badge bg-success'>อนุมัติ</span>";
                          
              }elseif($row['status']==2){
                echo "<span class='badge bg-warning'>ไม่อนุมัติ</span>";

              }if($row['status']==3){
                echo "<span class='badge bg-danger'>ยกเลิก</span>";
              }             
              ?>

              </td>          
            </tr>

        <?php } ?>

          </tbody>  
        </table>
    <?php } ?> 
         
    </div>
                


  </div>
  

<?php require_once('footer.php');?>
