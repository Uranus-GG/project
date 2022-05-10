<?php require_once('menu-header.php') ?>
<div class="page-heading header-text">
          <div class="container">
            <div class="row">
              <div class="col-md-12">
                <h1>ผลิตภัณฑ์</h1>
              </div>
            </div>
          </div>
    </div>
  <!-- Page Content -->
<div class="container">
<?php
      $p_ID = filter_input(INPUT_GET,"p_ID");
      $q = "SELECT * FROM product LEFT JOIN product_type ON product.product_type_name = product_type.product_type_ID WHERE p_ID=$p_ID";   
      $qq = $conx->query($q);
      $row = $qq->fetch_assoc();?>


<div class="more-info about-info">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="more-info-content">
              <div class="row">
                <div class="col-md-6 align-self-center">
                  <div class="right-content">

                    <h2><?php echo $row['p_title']; ?><br><em>ราคา <?php echo $row['p_price']; ?> บาท</em></h2>
                    <h4>ประเภทผลิตภัณฑ์ : <?php echo $row['product_type_name']; ?></h4>
                    <p><?php echo $row['p_detail']; ?></p>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="left-image">
                  <?php echo "<img href='file_upload/pic/$row[p_image]' target = '_blank'><img class='card-img-top'  src='file_upload/pic/$row[p_image]'height='300' /></img>"; ?>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Page Heading/Breadcrumbs -->
    <br>

  <div class="row">

            <?php
                    $sql_gallery = "SELECT * FROM `gallery`WHERE data_id = '$row[p_ID]' and type_gallery_id = 2";
                    $result_gallery = $conx->query($sql_gallery);
                    while ($row_gallery = $result_gallery->fetch_assoc()) {
                    ?>
          <div class="col-md-4">
            <div class="service-item">
                      <div class="down-content">
                      <img src="file_upload/gallery/2-<?php echo $row['p_ID']; ?>/<?php echo $row_gallery['gallery_name']; ?>" alt="" height="300">
                      </div>
                      
                    </div>
                    
                    <br>
                </div>
                <?php } ?>

          
    <!-- ./row -->
    </div> 


      <br>

</div>
  <!-- /.container -->

<?php require_once('footer.php'); ?>
