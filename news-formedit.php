
<?php require_once('connect.php');

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
<body id="top" data-spy="scroll" data-target=".navbar-collapse" data-offset="50">

    <!-- PRE LOADER -->
    <section class="preloader">
         <div class="spinner">

              <span class="spinner-rotate"></span>
              
         </div>
    </section>     
  <?php
  require_once('menu-admin.php');
  $news_ID = filter_input(INPUT_GET,"news_ID");
  $q = "SELECT * FROM news LEFT JOIN news_type ON news.news_type_name = news_type.news_type_ID WHERE news_ID=$news_ID";   
  $qq = $conx->query($q);
  $row = $qq->fetch_assoc(); ?> 
    <section>
         <div class="container">
           <form class="form" action="news-save.php" method="post" enctype="multipart/form-data"> 
                     
           <div class="form-group">
              <!-- <label for="news_ID" >ID</label> -->
              <input type="hidden" class="form-control " id="news_ID" name="news_ID" value="<?php echo $row['news_ID']; ?>"hidden>
            </div>
                <div class="row">
                    <div class="col-lg-3 col-md-3 col-xs-12">
                          <div class="form-group">
                          <?php if ($row['news_image'] != '') {                                                  
                            echo "<img src='file_upload/pic/$row[news_image]'  class='img-responsive wc-image'/>";
                             echo "<input type='hidden' name='hidden_product_pic' id='hidden_product_pic' value='$row[news_image]'>";
                        } else {
                            echo "<img src='img/blog-image-2-940x460.jpg' class='img-responsive wc-image'/>";
                        }?>
                          </div>
                    </div>
                              
                    <div class="col-lg-9 col-md-9 col-xs-12">
                              <h2><?php echo $row['news_title']; ?></h2>
                              <p class="lead" name="news_user" >ผู้ใช้ <strong class="text-primary"><?php echo $_SESSION['m_username']; ?></strong></p>
                              <p class="lead">                              
                              <p> <input type="hidden" id="news_date" name="news_date"  value="<?php $start = date('Y-m-d',strtotime($row['news_date']));echo $start;?>" >
                                  <input type="hidden" id="news_date_edit" name="news_date_edit" readonly value="<?php $start = date('Y-m-d',strtotime($row['news_date_edit']));echo $start;?>" ></p>
                              <div class="form-group">
                              <label for="news_image">กรุณาใส่รูปภาพ</label>
                                <input type="file" class="form-control-file" id="news_image" name="news_image" value="<?php echo $row['news_image']; ?>" >
                                <?php if ($row['news_image'] != '') {
                                  echo "<input type='checkbox' name='Delete_old_pic' value='Yes'>ลบไฟล์รูปภาพ<br>";
                                  echo "$row[news_image]";
                                } ?>
                              </div>

                              <br>
                              </p>
                    </div>
                </div>

                <div class="panel panel-default">
                    <div class="panel-heading">
                    <h4>หัวข้อข่าว</h4>
                    <input type="text" class="form-control" id="news_title" name="news_title" placeholder="" value="<?php echo $row['news_title']; ?>" required>
                    </div>
                      
                    <div class="panel-body">
                        <label>ประเภทข่าว : </label><span style="color: #F70C10; font-size: 16px;" >*</span>
                        <select id="news_type_name" name="news_type_name" required>
                        <?php 
                        $q =  "SELECT * FROM `news_type` ORDER BY `news_type_ID` ASC ";
                        $qq = $conx->query($q);
                        while ($row_news_type = $qq->fetch_assoc()) {
                        ?>
                            <option value="<?php echo $row_news_type['news_type_ID'];?>" <?php if ($row_news_type['news_type_ID'] == $row['news_type_ID']) {echo 'selected';}?>><?php echo $row_news_type['news_type_name'];?></option>
                            
                        <?php } ?>
                        <?php if($row['news_type_ID']==0){ ?>
                            <option value="<?php echo $row_news_type['news_type_ID'];?>" <?php if ($row_news_type['news_type_ID'] == $row['news_type_ID']) {echo 'selected';}?>>ข่าวไม่มีประเภท</option>
                            <?php } ?>
                        </select>
                      <h4>รายละเอียดข่าว</h4>
                      <div class="form-group">
                        <textarea class="form-control" rows="5" id="detail" name="news_detail" required><?php echo $row['news_detail']; ?></textarea>
                      </div>
                    </div>
                </div>
                <div class="clearfix">
                    <button type="submit" name="btnedit" value="1" class="section-btn btn btn-primary pull-left">แก้ไข</button>
                </div>               
          </div>
      </form>

<?php require_once('footer-admin.php'); ?>
<script>
    // Replace the <textarea id="editor1"> with a CKEditor
    // instance, using default configuration.
    CKEDITOR.replace('detail');
    function CKupdate() {
        for (instance in CKEDITOR.instances)
            CKEDITOR.instances[instance].updateElement();
    }
</script>
