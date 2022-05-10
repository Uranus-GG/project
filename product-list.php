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
   if($p_ID){
      $q = "SELECT * FROM product LEFT JOIN product_type ON product.product_type_name = product_type.product_type_ID WHERE p_ID=$p_ID";   
      $qq = $conx->query($q);
      $row = $qq->fetch_assoc(); ?>
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
                  <br>
                  <a href="product-show.php?p_ID=<?php echo $row['p_ID']; ?>"class="filled-button">ดูรูปภาพเพิ่มเติม>></a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <?php } ?>
    <!-- Page Heading/Breadcrumbs -->
    <br>
    <div class="row">

      <form class="form-inline" role="form" action="product-list.php" method="post" name="frm-product" enctype="multipart/form-data">
        <input type="text" class="form-control" name="search_name" id="search_name" placeholder="ชื่อผลิตภัณฑ์">
        <button name="btnsearch" value="1" class="btn btn-primary" type="submit"> ค้นหา </button>
      </form>
      <div class="dropdown ml-auto">
        <a  class="dropdown-toggle nav-link btn btn-primary " data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
          ประเภทผลิตภัณฑ์
        </a>
        <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
        <?php $q =  "SELECT * FROM `product_type` order by product_type_ID DESC  ";
            $qq = $conx->query($q);
            while ($row_product_type = $qq->fetch_assoc()) { ?>
          <li><a class="dropdown-item" href="product-type-show.php?product_type_ID=<?php echo $row_product_type['product_type_ID']; ?>"><?php echo $row_product_type['product_type_name'];?></a></li>
          <?php } ?>
        </ul>
      </div>
    </div>
       
  <div class="row">
        <?php 
              $btnsearch = filter_input(INPUT_POST,"btnsearch");
              $search_name = filter_input(INPUT_POST,"search_name");
              $search_date = filter_input(INPUT_POST,"search_date");

          if ($btnsearch == true) { //ค้นหาข้อมูล

              $where = '';   // ประกาศตัวแปร
              if($search_name!=""){
              $where  .= " and p_title LIKE '%$search_name%' OR p_detail LIKE '%$search_name%' ";  // ถ้าเข้าเงื่อนไขไหนก็ จับต่อเข้าไป
              }

          }
          $per_page_record = 9;
          if (isset($_GET["page"])) {
            $page  = $_GET["page"];
          } else {
            $page = 1;
          }

          $start_from = ($page - 1) * $per_page_record;
          $sql_product= "SELECT * FROM product LEFT JOIN product_type ON product.product_type_name = product_type.product_type_ID WHERE p_ID $where order by p_ID DESC LIMIT $start_from,$per_page_record ";
          $result_product = mysqli_query($conx,$sql_product);
          $num_rows = $result_product->num_rows;
          $i = 1;
          while ($row_product = mysqli_fetch_array($result_product)) { 
        ?> 
          <div class="col-md-4">
            <div class="service-item">
            <?php echo "<img href='file_upload/pic/$row_product[p_image]' target = '_blank'><img class='card-img-top'  src='file_upload/pic/$row_product[p_image]'height='300' /></img>"; ?>
              <div class="down-content">
                <h4><?php echo $row_product['p_title']; ?></h4>
                <div style="margin-bottom:10px;">
                  <span>ราคา <?php echo $row_product['p_price']; ?> บาท</span>
                </div>               
                <div style="margin-bottom:10px;">
                  <span>ประเภทผลิตภัณฑ์ : <?php echo $row_product['product_type_name']; ?></span>
                </div>               
                <a href="product-list.php?p_ID=<?php echo $row_product['p_ID']; ?>"class="filled-button">รายละเอียดผลิตภัณฑ์>></a>
              </div>
            </div>

            <br>
          </div>
          <?php } ?>
          
    <!-- ./row -->
    </div> 

    <nav aria-label="Page navigation example">
            <div class="container-fluid">
            <ul class="pagination pagination-lg justify-content-center">
               <?php
               $query = "SELECT count(*) FROM `product`";
               $rs_result = mysqli_query($conx, $query);
               $row = mysqli_fetch_row($rs_result);
               $total_records = $row[0];

               echo "</br>";
               // Number of pages required.   
               $total_pages = ceil($total_records / $per_page_record);
               $pagLink = "";

               if ($page >= 2) {
                  echo "<li class='page-item'><a class='page-link' href='product-list.php?page=" . ($page - 1) . "'>Previous</a></li>";
               }

               for ($i = 1; $i <= $total_pages; $i++) {
                  if ($i == $page) {
                     $pagLink .= "<li class='page-item'><a class='page-link' class = 'active' href='product-list.php?page="
                        . $i . "'>" . $i . " </a></li>";
                  } else {
                     $pagLink .= "<li class='page-item'><a class='page-link' href='product-list.php?page=" . $i . "'>   
                                                " . $i . " </a></li>";
                  }
               };
               echo $pagLink;

               if ($page < $total_pages) {
                  echo "<li class='page-item'><a class='page-link' href='product-list.php?page=" . ($page + 1) . "'>  Next </a></li>";
               }

               ?>
            </ul>
            </div>
      </nav>
      <br>

</div>
  <!-- /.container -->

<?php require_once('footer.php'); ?>
