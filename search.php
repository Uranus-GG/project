<?php if($q == true){ ?>
    <div class="row">
          <div class="col-md-8">
            <section class='tabs-content'>
              <?php
                     $sql = "SELECT * FROM news
                     WHERE news_title LIKE '%$q%' OR news_detail LIKE '%$q%'
                  ORDER BY id DESC";
                 $result = mysqli_query($conx, $sql);
                 while($row = mysqli_fetch_array($result)) {
                            
              ?> 
              <article id='tabs-1'>
              <?php echo "<a href='upload/$row[news_image]' target = '_blank'><img class='card-img-top'  src='upload/$row[news_image]'height='300'/></a>"; ?>
                <h4><a href="news-show.php?news_ID=<?php echo $row['news_ID']; ?>"><?php echo $row['news_title']; ?></a></h4>
                <div style="margin-bottom:10px;">
                  <span><?php echo $row['news_user']; ?> &nbsp;|&nbsp; <?php $dateData=$row['news_date']; echo thai_date_and_time(strtotime($dateData)); ?></span>
                </div>
                <p><?php echo iconv_substr($row['news_detail'],0,300);?></p>
                <br>
                <div>
                  <a  href="news-show.php?news_ID=<?php echo $row['news_ID']; ?>" class="filled-button">อ่านต่อ>></a>
                 
                </div>
              </article>


              <br>
              <br>
              <br>
              <?php }
             ?>
        </div>

          <div class="col-md-4">
              <h4 class="h4">Search</h4>
              
              <form id="search_form" name="gs" method="GET" action="#">
                <input type="text" name="q" class="form-control form-control-lg" placeholder="type to search..." autocomplete="on" required>
              </form>

              <br>
              <br>

              <h4 class="h4">Recent posts</h4>

              <ul>
                  <li>
                      <h5 style="margin-bottom:10px;"><a href="blog-details.html">Dolorum corporis ullam, reiciendis inventore est repudiandae</a></h5>
                      <small><i class="fa fa-user"></i> John Doe &nbsp;|&nbsp; <i class="fa fa-calendar"></i> 27.07.2020 10:10</small>
                  </li>

                  <li><br></li>

                  <li>
                      <h5 style="margin-bottom:10px;"><a href="blog-details.html">Culpa ab quasi in rerum dolorum impedit expedita</a></h5>
                      <small><i class="fa fa-user"></i> John Doe &nbsp;|&nbsp; <i class="fa fa-calendar"></i> 27.07.2020 10:10</small>
                  </li>

                  <li><br></li>

                  <li>
                    <h5 style="margin-bottom:10px;"><a href="blog-details.html">Explicabo soluta corrupti dolor doloribus optio dolorum</a></h5>

                    <small><i class="fa fa-user"></i> John Doe &nbsp;|&nbsp; <i class="fa fa-calendar"></i> 27.07.2020 10:10</small>
                  </li>
              </ul>
          </div>
        </div>
      </div>
    </div>
<?php } ?>