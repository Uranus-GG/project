<?php require_once('menu-header.php'); ?>
<style>
.page-content img {
    max-width: 100%;
    height: 500px!important;
}
</style>
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

    <div class="fun-facts">
      <div class="container">
        <div class="row">
        <?php
        $l_ID = filter_input(INPUT_GET,"l_ID");
        $q = "SELECT * FROM `learn`WHERE l_ID=$l_ID";
        $qq = $conx->query($q);
        $qn = $qq->num_rows;
          if($qn > 0){
            for($i = 0; $i<$qn; $i++){
            $row = $qq->fetch_assoc();
            ?> 
            <div class="col-md align-self-center">
                <div class="col-md">
                  <div class="count-area-content">
                  <div class="page-content">
                    <?php echo "<img href='upload/learn/$row[l_image]' target = '_blank'><img src='upload/learn/$row[l_image]'/></img>"; ?>
                  </div>
                </div>            
              </div>
            </div>
          <div class="col-md-12 " >
            <br>
                <h2 class="text-center"><em><?php echo $row['l_title']; ?></em></h2>
                <p align="justify"><?php echo $row['l_detail']; ?></p>              
          </div>
          <?php 
              }
          } ?>
        </div>
        <a href="learn-show-image.php?l_ID=<?php echo $row['l_ID']; ?>"class="filled-button">รูปภาพเพิ่มเติม>></a>
      </div>
    </div>

<?php require_once('footer.php'); ?>