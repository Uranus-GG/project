<?php require_once('menu-header.php'); ?>
<div class="page-heading header-text">
          <div class="container">
            <div class="row">
              <div class="col-md-12">
                <h1>รายงานกิจกรรม</h1>
              </div>
            </div>
          </div>
    </div>
  <div class="single-services">
      <div class="container">
      <h1 class="mt-4 ">รายงานกิจกรรม
      <small></small>
    </h1>
    
<?php
    $btnsearch = filter_input(INPUT_POST,"btnsearch");
    $search_name = filter_input(INPUT_POST,"search_name");
    $search_date = filter_input(INPUT_POST,"search_date");

if ($btnsearch == true) { //ค้นหาข้อมูล

    $where = '';   // ประกาศตัวแปร
    if($search_name!=""){
    $where  .= " and e_title LIKE '%$search_name%' OR e_detail LIKE '%$search_name%' ";  // ถ้าเข้าเงื่อนไขไหนก็ จับต่อเข้าไป
    }

}
$per_page_record = 5;
if (isset($_GET["page"])) {
   $page  = $_GET["page"];
} else {
   $page = 1;
}

$start_from = ($page - 1) * $per_page_record;
$sql_news = "SELECT * FROM `event` WHERE status=1 $where ORDER BY `event`.`e_start` DESC LIMIT $start_from,$per_page_record ";
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
              <?php if ($row_news['e_image'] != '') {                                                  
                            echo "<img src='file_upload/pic/event/$row_news[e_image]'  class='img-responsive wc-image'/>";
                        } else {
                            echo "<img src='img/blog-image-2-940x460.jpg' class='img-responsive wc-image'/>";
                        }?>
                <h4><a href="event-show.php?e_ID=<?php echo $row_news['e_ID']; ?>"><?php echo $row_news['e_title']; ?></a></h4>
                <div style="margin-bottom:10px;">
                  <span>เริ่ม <?php $dateData=$row_news['e_start']; echo thai_date_and_time(strtotime($dateData)); ?> | ถึง <?php $dateData=$row_news['e_start']; echo thai_date_and_time(strtotime($dateData)); ?></span>
                </div>               
                <p><?php echo iconv_substr($row_news['e_detail'],0,300);?></p>
                <br>
                <div>
                  <a  href="event-show.php?e_ID=<?php echo $row_news['e_ID']; ?>" class="filled-button">อ่านต่อ>></a>
                 
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
              
              <form class="form-inline" role="form" action="event-list.php" method="post" name="frm-product" enctype="multipart/form-data">
                <input type="text" class="form-control" name="search_name" id="search_name" placeholder="ชื่อรายงานกิจกรรม">
                <button name="btnsearch" value="1" class="btn btn-primary" type="submit"> ค้นหา </button>
              </form>
              <br>
              <br>
             
          </div>
        </div>
      </div>
    </div>

    <br>  
         <nav aria-label="Page navigation example">
            <div class="container-fluid">
            <ul class="pagination pagination-lg justify-content-center">
               <?php
               $query = "SELECT count(*) FROM `event` WHERE status=1";
               $rs_result = mysqli_query($conx, $query);
               $row = mysqli_fetch_row($rs_result);
               $total_records = $row[0];

               echo "</br>";
               // Number of pages required.   
               $total_pages = ceil($total_records / $per_page_record);
               $pagLink = "";

               if ($page >= 2) {
                  echo "<li class='page-item'><a class='page-link' href='event-list.php?page=" . ($page - 1) . "'>Previous</a></li>";
               }

               for ($i = 1; $i <= $total_pages; $i++) {
                  if ($i == $page) {
                     $pagLink .= "<li class='page-item'><a class='page-link ' class = 'active' href='event-list.php?page="
                        . $i . "'>" . $i . " </a></li>";
                  } else {
                     $pagLink .= "<li class='page-item'><a class='page-link' href='event-list.php?page=" . $i . "'>   
                                                " . $i . " </a></li>";
                  }
               };
               echo $pagLink;

               if ($page < $total_pages) {
                  echo "<li class='page-item'><a class='page-link' href='event-list.php?page=" . ($page + 1) . "'>  Next </a></li>";
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
