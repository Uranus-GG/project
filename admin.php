<?php require_once('connect.php');
 if($_SESSION['m_ID'] == "") //หาก session mem_id เป็นค่าว่าง(คือยังไม่ได้ล๊อกอินเข้ามา)ให้แสดงข้อความด้านล่าง
	{
		echo "<script>alert('หน้าสำหรับผู้ดูแลระบบ.');</script>";
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
  <!-- Page Content -->
  <div class="container-fluid">

<!-- Page Heading/Breadcrumbs -->
    <!-- <h1 class="mt-4 mb-3">ADMIN
    <small></small>
    </h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="index.php">หน้กหลัก</a>
        </li>
        <li class="breadcrumb-item ">การตั้งค่าบัญชีทั่วไป</li>
    </ol>   -->
    <?php require_once('menu-admin.php'); ?>
    <section class="section-background">
          <div class="container">
               <div class="text-center">
                    <h1>ผู้ดูแลระบบ</h1>

                    <br>

                    <p class="lead"></p>
               </div>
          </div>
     </section>
</div>
  <!-- /.container -->

  <!-- Footer -->
  <?php require_once('footer-admin.php') ?>

