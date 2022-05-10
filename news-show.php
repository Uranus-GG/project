<?php require_once('menu-header.php');
      ?>

    <?php
      $news_ID = filter_input(INPUT_GET,"news_ID");
      $q = "SELECT * FROM `news` WHERE news_ID=$news_ID";   
      $qq = $conx->query($q);
      $row = $qq->fetch_assoc();?>
    <!-- Page Content -->
    <div class="page-heading header-text ">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <h1><?php echo $row['news_title']; ?></h1>
            <span><i class="fa fa-user"></i> <?php echo $row['news_user']; ?> &nbsp;|&nbsp; <i class="fa fa-calendar"></i> อัพโหลด <?php $dateData=$row['news_date']; echo thai_date_and_time(strtotime($dateData)); ?>
            แก้ไข <?php $dateData=$row['news_date_edit']; echo thai_date_and_time(strtotime($dateData)); ?></span>
          </div>
        </div>
      </div>
    </div>

    <div class="more-info about-info">
      <div class="container">
        <div class="more-info-content">
          <div class="right-content">
            <div class="text-center">
            <div id="demo" class="carousel slide" data-ride="carousel">

                <!-- The slideshow -->
                <!-- style="background-color:powderblue;" -->
                <div class="carousel-inner" align="center" style="background-color:#F1FCE8;" >
                  <div class="carousel-item active">
                  <?php if ($row['news_image'] != '') {                                                  
                            echo "<img src='file_upload/pic/$row[news_image]'  class='img-responsive wc-image' height='500'/>";
                        } else {
                            echo "<img src='img/blog-image-2-940x460.jpg' class='img-responsive wc-image'  width='1100' height='500' '/>";
                        }?>
                  </div>
                    <?php
                    $sql_gallery = "SELECT * FROM `gallery`
                          WHERE data_id = '$row[news_ID]' 
                          and type_gallery_id = 1";
                    $result_gallery = $conx->query($sql_gallery);
                    while ($row_gallery = $result_gallery->fetch_assoc()) {
                    ?>
                      <div class="carousel-item ">
                      <img src="file_upload/gallery/1-<?php echo $row['news_ID']; ?>/<?php echo $row_gallery['gallery_name']; ?>" alt="" height="500">
                      </div>
                    <?php } ?>
                  
                </div>

                <a class="carousel-control-prev" href="#demo" data-slide="prev">
                  <span class="carousel-control-prev-icon"></span>
                </a>
                <a class="carousel-control-next" href="#demo" data-slide="next">
                  <span class="carousel-control-next-icon"></span>
                </a>
                </div> 
                <br>           
          </div>
            </div>
            <br>
            <div class="col-md">
              <h4><?php echo $row['news_title']; ?></h4>
              <br>
              <p align="justify" ><?php echo $row['news_detail']; ?></p>
            </div>
            <!-- ./col-md -->
             <br>           
        </div>
      </div>
    </div>

  <!-- Page Content -->
 
  <!-- /.container -->
<?php require_once('footer.php'); ?>