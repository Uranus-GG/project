<?php require_once('connect.php');
      require_once('function.php');
      include 'func.php';
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
<!DOCTYPE html>
<html lang="en">
<head>

     <title>บ้านสวนอุ่นรักฮักแพง</title>

     <meta charset="UTF-8">
     <meta http-equiv="X-UA-Compatible" content="IE=Edge">
     <meta name="description" content="">
     <meta name="keywords" content="">
     <meta name="author" content="">
     <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

     <link rel="stylesheet" href="admin/css/bootstrap.min.css">
     <link rel="stylesheet" href="admin/css/font-awesome.min.css">
     <link rel="stylesheet" href="admin/css/owl.carousel.css">
     <link rel="stylesheet" href="admin/css/owl.theme.default.min.css">
     <link rel="icon" href="img/logo-01.png" />
     

     <!-- MAIN CSS -->
     <link rel="stylesheet" href="admin/css/style.css">

</head>
<body id="top" data-spy="scroll" data-target=".navbar-collapse" data-offset="50">

     <!-- PRE LOADER -->
     <section class="preloader">
          <div class="spinner">
               <span class="spinner-rotate"></span>
          </div>
     </section>


     <!-- MENU -->
     <section class="navbar custom-navbar navbar-fixed-top" role="navigation">
          <div class="container">

               <div class="navbar-header">
                    <button class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                         <span class="icon icon-bar"></span>
                         <span class="icon icon-bar"></span>
                         <span class="icon icon-bar"></span>
                    </button>

                    <!-- lOGO TEXT HERE -->
                    <a href="index.php" class="navbar-brand">บ้านสวนอุ่นรักฮักแพง</a>
               </div>

               <!-- MENU LINKS -->
               <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav navbar-nav-first">
                         <li><a href="admin.php">หน้าแรก</a></li>
                         <li class="dropdown">
                              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">ข่าว<span class="caret"></span></a>                       
                              <ul class="dropdown-menu">
                                   <li><a href="news-add.php">เพิ่มข่าวสาร</a></li>
                                   <li><a href="news-edit.php">แก้ไขข่าวสาร</a></li>
                                   <li><a href="news-type-add.php">เพิ่มประเภทข่าวสาร</a></li>
                              </ul>
                         </li>
                         <li class="dropdown">
                              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">ผลิตภัณฑ์<span class="caret"></span></a>                
                              <ul class="dropdown-menu">
                                   <li><a href="product-add.php">เพิ่มผลิตภัณฑ์</a></li>
                                   <li><a href="product-admin.php">แก้ไขผลิตภัณฑ์</a></li>
                                   <li><a href="product-type-add.php">เพิ่มประเภทผลิตภัณฑ์</a></li>
                              </ul>
                         </li>
                         <li class="dropdown">
                              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">ผู้ใช้งาน<span class="caret"></span></a>                           
                              <ul class="dropdown-menu">
                                   <li><a href="admin-add.php">เพิ่มสมาชิก</a></li>
                                   <li><a href="admin-list.php">แก้ไขสมาชิก</a></li>
                              </ul>
                         </li>
                         <li class="dropdown">
                              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">กิจกรรมการเรียนรู้<span class="caret"></span></a>                           
                              <ul class="dropdown-menu">
                                   <li><a href="learn-add.php">เพิ่มกิจกรรมการเรียนรู้</a></li>
                                   <li><a href="learn-edit.php">แก้ไขกิจกรรมการเรียนรู้</a></li>
                                   <li><a href="event.php">รายงานการจอง</a></li>
                                   <li><a href="fullcalendar/index.php">ปฏิทินกิจกรรม</a></li>
                              </ul>
                         </li>

                         <li class="dropdown">
                         <?php if(isset($_SESSION['m_ID'])) { ?>
                              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php echo $_SESSION['m_username']; ?>(<?php echo $_SESSION['role']; ?>)<span class="caret"></span></a>                           
                              <ul class="dropdown-menu">
                              <?php if($_SESSION['role']=='admin'){?>
                                   <li><a href="edit-admin.php">แก้ไขบัญชี</a></li>
                                   <li><a href="admin-edit-password.php">แก้ไขรหัสผ่าน</a></li>
                                   <li><a href="mybooking.php">รายการจองของฉัน</a></li>
                                   <li><a href="logout.php">ออกจากระบบ</a></li>
                                   <?php } ?>
                              <?php } ?>
  
                              </ul>
                         </li>
                         
                    </ul>
               </div>

          </div>
     </section>
     <?php require_once('footer-admin.php'); ?>

