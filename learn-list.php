<?php require_once('menu-header.php'); ?>
    <!-- Page Content -->
    <div class="page-heading header-text">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <h1>กิจกรรมการเรียนรู้</h1>
          </div>
        </div>
      </div>
    </div>

    <div class="more-info about-info">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="more-info-content">
              <div class="row">
                <div class="col-md-6 align-self-center">
                  <div class="right-content">
                    <span>ศูนย์การเรียนรู้ขยายผล</span>
                    <h2>โครงการอันเนื่องมาจากพระราชดำริ <em>อ.เชียงคาน จ.เลย</em></h2>
                    <p>การนำหลักการบริหารอุตสาหกรรมมาประยุกต์ใช้กับการบริหารบ้านสวน บนพื้นที่แห่งความอบอุ่น 9 ไร่ บนความพอเพียงอย่างเพียงพอ</p>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="left-image">
                    <img src="assets/images/about-1-570x350.jpg" alt="">
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
        <!-- <div id="demo" class="carousel slide" data-ride="carousel">

            <ul class="carousel-indicators">
              <li data-target="#demo" data-slide-to="0" class="active"></li>
              <li data-target="#demo" data-slide-to="1"></li>
              <li data-target="#demo" data-slide-to="2"></li>
              <li data-target="#demo" data-slide-to="3"></li>
            </ul> -->

            <!-- The slideshow -->
            <!-- style="background-color:powderblue;" -->
            <!-- <div class="carousel-inner" align="center" >
              <div class="carousel-item active">
                <img src="img/03.jpg" alt="Los Angeles" width="1100" height="500">
              </div>
              <div class="carousel-item">
                <img src="img/02.jpg" alt="Chicago" width="1100" height="500">
              </div>
              <div class="carousel-item">
                <img src="img/01.jpg" alt="New York" width="1100" height="500">
              </div>
            </div>

            <a class="carousel-control-prev" href="#demo" data-slide="prev">
              <span class="carousel-control-prev-icon"></span>
            </a>
            <a class="carousel-control-next" href="#demo" data-slide="next">
              <span class="carousel-control-next-icon"></span>
            </a>
        </div> -->
    <div class="fun-facts">
      <div class="container">
        <form class="form-inline" role="form" action="learn-list.php" method="post" name="frm-product" enctype="multipart/form-data">
          <input type="text" class="form-control" name="search_name" id="search_name" placeholder="ชื่อกิจกรรมการเรียนรู้">
          <button name="btnsearch" value="1" class="btn btn-primary" type="submit"> ค้นหา </button>
        </form>
        <br>
        <br>
        <div class="row">
        <?php
            $btnsearch = filter_input(INPUT_POST,"btnsearch");
            $search_name = filter_input(INPUT_POST,"search_name");
            $search_date = filter_input(INPUT_POST,"search_date");

            if ($btnsearch == true) { //ค้นหาข้อมูล

                $where = '';   // ประกาศตัวแปร
                if($search_name!=""){
                $where  .= " and l_title LIKE '%$search_name%' OR l_detail LIKE '%$search_name%' ";  // ถ้าเข้าเงื่อนไขไหนก็ จับต่อเข้าไป
                }

            }
            $per_page_record = 5;
            if (isset($_GET["page"])) {
              $page  = $_GET["page"];
            } else {
              $page = 1;
            }

            $start_from = ($page - 1) * $per_page_record;
            $sql_news = "SELECT * FROM `learn` WHERE l_ID $where order by l_ID DESC LIMIT $start_from,$per_page_record ";
            $result_news = mysqli_query($conx,$sql_news);
            $num_rows = $result_news->num_rows;

            $i = 1;
            while ($row = mysqli_fetch_array($result_news)) { 
        ?> 
          <div class="col-md-6">
                <h2><em><?php echo $row['l_title']; ?></em></h2>
                <p><?php echo iconv_substr($row['l_detail'],0,500);?></p>
                <a href="learn-show.php?l_ID=<?php echo $row['l_ID']; ?>" class="filled-button">อ่านต่อ>></a>
          </div>
          <div class="col-md-6 align-self-center">
              <div class="col-md">
                <div class="count-area-content">
                <?php echo "<img href='upload/learn/$row[l_image]' target = '_blank'><img class='card-img-top'  src='upload/learn/$row[l_image]' /></img>"; ?>
              </div>
              
            </div>
          </div>
          <?php   } ?>
        </div>
        <!-- ปิด -->
        <nav aria-label="Page navigation example">
            <div class="container-fluid">
            <ul class="pagination justify-content-center">
               <?php
               $query = "SELECT count(*) FROM `learn`";
               $rs_result = mysqli_query($conx, $query);
               $row = mysqli_fetch_row($rs_result);
               $total_records = $row[0];

               echo "</br>";
               // Number of pages required.   
               $total_pages = ceil($total_records / $per_page_record);
               $pagLink = "";

               if ($page >= 2) {
                  echo "<li class='page-item'><a class='page-link' href='learn-list.php?page=" . ($page - 1) . "'>Previous</a></li>";
               }

               for ($i = 1; $i <= $total_pages; $i++) {
                  if ($i == $page) {
                     $pagLink .= "<li class='page-item'><a class='page-link' class = 'active' href='learn-list.php?page="
                        . $i . "'>" . $i . " </a></li>";
                  } else {
                     $pagLink .= "<li class='page-item'><a class='page-link' href='learn-list.php?page=" . $i . "'>   
                                                " . $i . " </a></li>";
                  }
               };
               echo $pagLink;

               if ($page < $total_pages) {
                  echo "<li class='page-item'><a class='page-link' href='learn-list.php?page=" . ($page + 1) . "'>  Next </a></li>";
               }

               ?>
            </ul>
            </div>
         </nav>

      </div>
    </div>

<?php require_once('footer.php'); ?>