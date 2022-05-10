<?php require_once('menu-header.php');?>
<style>
.page-content img {
    max-width: 100%;
    height: 500px!important;
}
</style>
    <?php
      $news_ID = filter_input(INPUT_GET,"e_ID");
      $q = "SELECT * FROM `event` WHERE e_ID=$news_ID";   
      $qq = $conx->query($q);
      $row = $qq->fetch_assoc();?>
    <!-- Page Content -->
    <div class="page-heading header-text ">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <h1><?php echo $row['e_title']; ?></h1>
            <?php if ($row['e_image'] != '') { ?>
                        <div class="page-content">
                            <?php echo "<img src='file_upload/pic/event/$row[e_image]'  class='img-responsive wc-image'/>";?>
                        </div>
                        <?php
                        } else {
                            echo "<img src='img/blog-image-2-940x460.jpg' class='img-responsive wc-image'/>";
                        }?>
                        <br>
                        <br>
            <span><i class="fa fa-calendar"></i>  <?php $dateData=$row['e_start']; echo thai_date_and_time(strtotime($dateData)); ?>
            | <?php $dateData=$row['e_end']; echo thai_date_and_time(strtotime($dateData)); ?></span>

            <p><?php echo $row['e_detail']; ?></p>
          </div>
        </div>
      </div>
    </div>

  <!-- /.container -->
<?php require_once('footer.php'); ?>