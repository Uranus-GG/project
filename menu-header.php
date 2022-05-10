<?php require_once('connect.php'); 
      require_once('function.php'); ?>
<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900&display=swap" rel="stylesheet">
    <link rel="icon" href="img/logo-01.png" />

    <title>บ้านสวนอุ่นรักฮักแพง</title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="assets/css/fontawesome.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/owl.css">
  </head>

  <body>

    <!-- ***** Preloader Start ***** -->
    <div id="preloader">
        <div class="jumper">
            <div></div>
            <div></div>
            <div></div>
        </div>
    </div>  
    <!-- ***** Preloader End ***** -->

    <!-- Header -->
    <div class="sub-header">
      <div class="container">
        <div class="row">
          <div class="col-md-8 col-xs-12">
            <ul class="left-info">
              <li><a href="#"><i class="fa fa-envelope"></i>loveyouchaingkan@gmail.com</a></li>
              <li><a href="#"><i class="fa fa-phone"></i>063 904 0414</a></li>
            </ul>
          </div>
          <div class="col-md-4">
            <ul class="right-icons">
              <li><a href="https://www.facebook.com/Ounrakhakpang"><i class="fa fa-facebook"></i></a></li>
              <li><a href="#"><i class="fa fa-twitter"></i></a></li>
              <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
            </ul>           
          </div>        
        </div>
      </div>
    </div>

    <header class="">
      <nav class="navbar navbar-expand-lg">
        <div class="container">
          <a class="navbar-brand" href="index.php"><h2>บ้านสวนอุ่นรักฮักแพง</h2></a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
              <li class="nav-item ">
                <a class="nav-link" href="index.php" style="font-size:18px">หน้าแรก
                  <span class="sr-only">(current)</span>
                </a>
              </li>
              <!-- <li class="nav-item">
                <a class="nav-link" href="news-list.php" style="font-size:18px" >ข่าว</a>
              </li> -->
              <li class="nav-item dropdown">
                <a class="dropdown-toggle nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false" style="font-size:18px">ข่าว</a>
              
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="news-list.php " style="font-size:18px">ข่าวทั้งหมด</a>
                    <?php $q =  "SELECT * FROM `news_type` order by news_type_ID DESC  ";
                        $qq = $conx->query($q);
                        while ($row_news_type = $qq->fetch_assoc()) { ?>
                      <a  style="font-size:18px" class="dropdown-item" href="news-type-show.php?news_type_ID=<?php echo $row_news_type['news_type_ID']; ?>"><?php echo $row_news_type['news_type_name'];?></a>
                  <?php } ?>
                    
                </div>
              </li>

              <li class="nav-item">
                <a class="nav-link" href="product-list.php" style="font-size:18px">ผลิตภัณฑ์</a>
              </li>

              <li class="nav-item dropdown">
                <a class="dropdown-toggle nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false" style="font-size:18px">กิจกรรม</a>
              
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="learn-list.php " style="font-size:18px">กิจกรรมการเรียนรู้</a>
                    <a class="dropdown-item" href="fullcalendar/index.php" style="font-size:18px">ปฏิทินกิจกรรม</a>
                    <a class="dropdown-item" href="booking.php" style="font-size:18px">จองเข้าใช้บริการ</a>
                </div>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="contact.php" style="font-size:18px">ติดต่อเรา</a>
              </li>
              <li class="nav-item dropdown">
              <?php if(isset($_SESSION['m_ID'])) { ?>
                <a style="font-size:18px" class="dropdown-toggle nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false"><?php echo $_SESSION['f_name']; ?>(<?php echo $_SESSION['role']; ?>)</a>               
                <div class="dropdown-menu">
                  <?php if($_SESSION['role']=='admin'){?>
                    <a class="dropdown-item" href="admin.php" style="font-size:18px">หน้าผู้ดูแลระบบ</a>
                    <?php } ?>
                    
                    <a class="dropdown-item" href="booking.php" style="font-size:18px">จองเข้าใช้บริการ</a>
                    <a class="dropdown-item" href="mybooking.php" style="font-size:18px">การจองของฉัน</a>
                    <a class="dropdown-item" href="user-edit.php" style="font-size:18px">แก้ไขบัญชี</a>
                  <a class="dropdown-item" href="password-edit.php" style="font-size:18px">แก้ไขรหัสผ่าน</a>
                    <a class="dropdown-item" href="logout.php" style="font-size:18px">ออกจากระบบ</a>
                </div>
                </li>
                <?php } else { ?>
                  <li class="nav-item">
                    <a class="nav-link" href="login.php" style="font-size:18px">เข้าสู่ระบบ</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="register.php" style="font-size:18px">สมัครสมาชิก</a>
                  </li>
                <?php } ?>               
            </ul>
          </div>
        </div>
      </nav>
    </header>


    


  
