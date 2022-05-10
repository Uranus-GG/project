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
          </div>
          <?php 
              }
          } ?>
          
          </div>
        </div>
      </div>
    </div>
    
    <div class="fun-facts">
      <div class="container">
        <div class="row">
          <?php
          $sql_gallery = "SELECT * FROM `gallery`
                WHERE data_id = '$row[l_ID]' 
                and type_gallery_id = 3";
          $result_gallery = $conx->query($sql_gallery);
          while ($row_gallery = $result_gallery->fetch_assoc()) {
          ?>            
          <div class="col-md-6">
            <div class="service-item">
                      <div class="down-content">
                        <div class="page-content">
                          <img src="file_upload/gallery/3-<?php echo $row['l_ID']; ?>/<?php echo $row_gallery['gallery_name']; ?>" alt="" height="500">
                        </div>
                      </div>                     
                    </div>                 
                    <br>
                </div>
                
          <?php } ?> 
        </div>
      </div>
    </div>

<?php require_once('footer.php'); ?>