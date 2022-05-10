
  <?php require_once ('menu-header.php');
        require_once ('image-top.php'); ?>  
  <!-- Page Content -->
  <div class="container"> 
    <div class="more-info">
      <div class="container">
        <div class="row" id="tabs">
          <div class="col-md-4">
            <ul>
            <?php
                  $q = "SELECT * FROM `news`ORDER BY `news`.`news_ID` DESC";
                  $qq = $conx->query($q);      
                  for($i = 0; $i<=2; $i++){
                  $row = $qq->fetch_assoc();
                          
              ?> 
              <li><a href='#tabs-<?php echo $i+1?>'><?php echo iconv_substr($row['news_title'],0,50);?>...<br> <small><?php echo $row['news_user']; ?> &nbsp;|&nbsp; <?php $dateData=$row['news_date']; echo thai_date_and_time(strtotime($dateData)); ?></small></a></li>
              <?php 
                }
             ?>
            </ul>

            <br>

            <div class="text-center">
              <a href="news-list.php" class="filled-button">ข่าวทั้งหมด</a>
            </div>

            <br>
          </div>

          <div class="col-md-8">
            <section class='tabs-content'>
              <?php
                  $q = "SELECT * FROM `news`ORDER BY `news`.`news_ID` DESC";
                  $qq = $conx->query($q);      
                  for($i = 0; $i<=2; $i++){
                  $row = $qq->fetch_assoc();
                          
              ?> 
              <article id="tabs-<?php echo $i+1?>">
              <?php if ($row['news_image'] != '') {                                                  
                            echo "<div align='center'><img src='file_upload/pic/$row[news_image]' class='img-responsive wc-image' height='300'/></div> ";
                        } else {
                            echo "<img src='img/blog-image-2-940x460.jpg' class='img-responsive wc-image'/>";
                        }?>
                <h4><a href="news-show.php?news_ID=<?php echo $row['news_ID']; ?>"><?php echo $row['news_title']; ?></a></h4>
                <p><?php echo iconv_substr($row['news_detail'],0,100);?><a href="news-show.php?news_ID=<?php echo $row['news_ID']; ?>"> รายละเอียด>></a></p>
              </article>

              <?php 
                }
             ?>
            </section>
          </div>
        </div>      
      </div>
    </div>
  </div>


  <div class="more-info about-info">
  <?php
          $q = "SELECT * FROM `event` WHERE status=1 ORDER BY `event`.`e_ID` DESC LIMIT 1";
          $qq = $conx->query($q);
          $qn = $qq->num_rows;
          while ($row=$qq->fetch_assoc()) {
                  ?>
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="more-info-content">
              <div class="row">
                <div class="col-md-6 align-self-center">
                  <div class="right-content">
                    <!-- <span>งานกิจกรรม</span> -->
                    <h2><em><?php echo $row['e_title']; ?></em></h2>
                    <p><?php echo iconv_substr($row['e_detail'],0,100);?><a href="event-show.php?e_ID=<?php echo $row['e_ID']; ?>"> รายละเอียด>></a></p>
                  </div>
                  <a href="event-list.php" class="filled-button">รายงานกิจกรรมอื่น>></a>
                </div>
                <div class="col-md-6">
                  <div class="left-image">
                    <?php if ($row['e_image'] != '') {                                                  
                            echo "<div align='center'><img src='file_upload/pic/event/$row[e_image]'height='300'/></div> ";
                        } else {
                            echo "<img src='img/blog-image-2-940x460.jpg' class='img-responsive wc-image'/>";
                        }?>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <?php } ?>
    </div>
  <!-- /.container -->
  <div class="fun-facts">
      <div class="container">
        <div class="more-info-content">
          <div class="row">
            <div class="col-md-6">
              <div class="left-image">
                <img src="assets/images/01.jpg" class="img-fluid" alt="">
              </div>
            </div>
            <div class="col-md-6 align-self-center">
              <div class="right-content">
                <span></span>
                <h2>ประวัติศูนย์เรียนรู้ขยายผลโครงการอันเนื่องมาจากพระราชดำริ<em> อ.เชียงคาน จ.เลย  </em></h2>
                <p>นาสีดา เป็นชื่อที่คุ้นเคยและรู้จักของชาวเชียงคานกับที่ดินมรดกพื้นที่ จำนวน 9 ไร่ สืบทอดมาจากคุณตาทวดอุ่นและคุณยายทวดแพง จากไร่มะขามส่งต่อคุณยายไพเราะ (ทายาทรุ่นที่ 2)  สู่ไร่ไม้ดอกไม้ประดับและนาข้าว ต่อมาในปี พ.ศ.2551 ได้น้อมนำหลักปรัชญาเศรษฐกิจพอเพียงและขยายผลโครงการอันเนื่องมาจากพระราชดำริ เป็นเกษตรผสมผสานจนถึงปัจจุบันส่งต่อทายาท รุ่นที่ 3 รุ่นที่ 4 เพื่อก้าวสู่ Young Smart Farmer เพื่อพัฒนาคุณภาพชีวิตแบบองค์รวม ในนาม “บ้านสวนอุ่นรักฮักแพง” เป็นต้นแบบชาวเชียงคานและโครงการร่วมกับหอการค้าจังหวัดเลยจัดตั้งศูนย์ให้คำปรึกษาและพัฒนา SMEs และ OTOP ภายใต้กระบวนการบ่มเพาะธุรกิจตลอดโซ่อุปทาน  จนกระทั่งปี พ.ศ.2562 ได้รับคัดเลือกจากอำเภอเชียงคาน จังหวัดเลย ให้เป็นศูนย์เรียนรู้ขยายผลโครงการอันเนื่องมาจากพระราชดำริ อ.เชียงคาน จ.เลย (สืบสาน รักษา และต่อยอด)
                กิจกรรมภายในศูนย์เรียนรู้ขยายผลโครงการอันเนื่องมาจากพระราชดำริ อ.เชียงคาน จ.เลย 
                </p>
                <a href="history.php" class="filled-button">อ่านต่อ>></a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!--fun-facts-->
   

    <div class="services">
    <h2 class="text-center">ผลิตภัณฑ์</h2>
    <br>
      <div class="container">      
        <div class="row">
        <?php
                  $q = "SELECT * FROM product LEFT JOIN product_type ON product.product_type_name = product_type.product_type_ID ORDER BY `product`.`p_ID` DESC";
                  $qq = $conx->query($q);      
                  for($i = 0; $i<=2; $i++){
                  $row = $qq->fetch_assoc();
                          
              ?> 
          <div class="col-md-4">
            <div class="service-item">
              <?php echo "<a href='file_upload/pic/$row[p_image]' target = '_blank'><img class='card-img-top'  src='file_upload/pic/$row[p_image]'height='300' /></a>"; ?>
              <div class="down-content">
                <h4><?php echo $row['p_title']; ?></h4>
                <div style="margin-bottom:10px;">
                  <span>ราคา <?php echo $row['p_price']; ?> บาท</span>
                  <div style="margin-bottom:10px;">
                  <span>ประเภทผลิตภัณฑ์ : <?php echo $row['product_type_name']; ?></span>
                </div>   
                </div>
                <a href="product-list.php?p_ID=<?php echo $row['p_ID']; ?>"class="filled-button">รายละเอียดผลิตภัณฑ์>></a>
              </div>
            </div>

            <br>
          </div>
          <?php 
                }
             ?>
        </div>
        <br>
          <ul class="pagination pagination-lg justify-content-center">
             <a href="product-list.php"  class="filled-button">ผลิตภัณฑ์อื่นๆ>></a>
          </ul>
        <br>
        <br>
        <br>
        <br>

      </div>
    </div>


  <?php require_once ('footer.php'); ?>
