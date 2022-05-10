<?php require_once('menu-header.php'); ?>
<div class="page-heading header-text">
          <div class="container">
            <div class="row">
              <div class="col-md-12">
                <h1>ข่าวประชาสัมพันธ์</h1>
              </div>
            </div>
          </div>
    </div>
  <div class="single-services">
      <div class="container">
      <h1 class="mt-4 ">ข่าวประชาสัมพันธ์
      <small></small>
    </h1>
    
<?php
    $news_type_ID = filter_input(INPUT_GET,"news_type_ID");
    $btnsearch = filter_input(INPUT_POST,"btnsearch");
    $search_name = filter_input(INPUT_POST,"search_name");
    $search_date = filter_input(INPUT_POST,"search_date");

if ($btnsearch == true) { //ค้นหาข้อมูล

    $where = '';   // ประกาศตัวแปร
    if($search_name!=""){
    $where  .= " and news_title LIKE '%$search_name%' OR news_detail LIKE '%$search_name%' ";  // ถ้าเข้าเงื่อนไขไหนก็ จับต่อเข้าไป
    }

}
$per_page_record = 5;
if (isset($_GET["page"])) {
   $page  = $_GET["page"];
} else {
   $page = 1;
}
$start_from = ($page - 1) * $per_page_record;
$sql_news = "SELECT * FROM news LEFT JOIN news_type ON news.news_type_name = news_type.news_type_ID WHERE news_type_ID=$news_type_ID $where LIMIT $start_from,$per_page_record ";
$result_news = mysqli_query($conx,$sql_news);
$num_rows = $result_news->num_rows;
  
?>

    <hr>
        <div class="row">
          <div class="col-md-8">
            <section class='tabs-content'>
              <?php
                $i = 1;
                while ($row_news = mysqli_fetch_array($result_news)) {            
              ?> 
              <article id='tabs-1'>
              <?php if ($row_news['news_image'] != '') {                                                  
                            echo "<img src='file_upload/pic/$row_news[news_image]'  class='img-responsive wc-image'/>";
                        } else {
                            echo "<img src='img/blog-image-2-940x460.jpg' class='img-responsive wc-image'/>";
                        }?>
                <h4><a href="news-show.php?news_ID=<?php echo $row_news['news_ID']; ?>"><?php echo $row_news['news_title']; ?></a></h4>
                <div style="margin-bottom:10px;">
                  <span><?php echo $row_news['news_user']; ?> &nbsp;|&nbsp; <?php $dateData=$row_news['news_date']; echo thai_date_and_time(strtotime($dateData)); ?></span>
                </div>
                <p><?php echo iconv_substr($row_news['news_detail'],0,300);?></p>
                <br>
                <div>
                  <a  href="news-show.php?news_ID=<?php echo $row_news['news_ID']; ?>" class="filled-button">อ่านต่อ>></a>
                 
                </div>
              </article>


              <br>
              <br>
              <br>
              <?php }
                
             ?>
        </div>

          <div class="col-md-4">
              <h4 class="h4">ค้นหา</h4>
              
              <form class="form-inline" role="form" action="news-list.php" method="post" name="frm-product" enctype="multipart/form-data">
                <input type="text" class="form-control" name="search_name" id="search_name" placeholder="ชื่อข่าว">
                <button name="btnsearch" value="1" class="btn btn-primary" type="submit"> ค้นหา </button>
              </form>
              <br>
              <br>
              <h4 class="h4">ประเภทข่าว</h4>
              <ul>
              <?php $q =  "SELECT * FROM `news_type` order by news_type_ID DESC  ";
                        $qq = $conx->query($q);
                        while ($row_news_type = $qq->fetch_assoc()) { ?>
                  <li>
                      <h5 style="margin-bottom:10px;"><a href="news-type-show.php?news_type_ID=<?php echo $row_news_type['news_type_ID']; ?>"><?php echo $row_news_type['news_type_name'];?></a></h5>

                  </li>
                  <?php } ?>
                  <li><br></li>

              </ul>
              <br>
              <br>
          </div>
        </div>
      </div>
    </div>

    <br>  
         <nav aria-label="Page navigation example">
            <div class="container-fluid">
            <ul class="pagination justify-content-center">
               <?php
               $query = "SELECT count(*) FROM `news`WHERE news_type_ID=$news_type_ID";
               $rs_result = mysqli_query($conx, $query);
               $row = mysqli_fetch_row($rs_result);
               $total_records = $row[0];

               echo "</br>";
               // Number of pages required.   
               $total_pages = ceil($total_records / $per_page_record);
               $pagLink = "";

               if ($page >= 2) {
                  echo "<li class='page-item'><a class='page-link' href='news-type-show.php?page=" . ($page - 1) . "'>Previous</a></li>";
               }

               for ($i = 1; $i <= $total_pages; $i++) {
                  if ($i == $page) {
                     $pagLink .= "<li class='page-item'><a class='page-link' class = 'active' href='news-type-show.php?page="
                        . $i . "'>" . $i . " </a></li>";
                  } else {
                     $pagLink .= "<li class='page-item'><a class='page-link' href='news-type-show.php?page=" . $i . "'>   
                                                " . $i . " </a></li>";
                  }
               };
               echo $pagLink;

               if ($page < $total_pages) {
                  echo "<li class='page-item'><a class='page-link' href='news-type-show.php?page=" . ($page + 1) . "'>  Next </a></li>";
               }

               ?>
            </ul>
            </div>
         </nav>

    <br>  
    <br>  
    <br>  
  <!-- /.container -->

  <!-- Footer -->
<?php require_once('footer.php'); ?>
