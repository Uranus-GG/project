
<?php require_once ('menu-admin.php'); ?>
  <!-- Page Content -->


<!-- Page Heading/Breadcrumbs -->
    <h2 class="text-center">แก้ไขบัญชี</h2>

      <?php
    $m_ID = filter_input(INPUT_GET,"m_ID");
    $q = "SELECT * FROM `member` WHERE m_ID='{$_SESSION['m_ID']}'";   
    $qq = $conx->query($q);
    $row = $qq->fetch_assoc(); ?>
                <br>
<div class="container">
    
<form action="user-save.php" method="post">
                          <div class="row">
                              <div class="col-md-5 pr-1" hidden>
                              <div class="form-group">
                                  <label>ID </label>
                                  <input type="text" name="m_ID" class="form-control"  placeholder="" value="<?php echo $row['m_ID']; ?>">
                              </div>
                              </div>
                              <div class="col-md-6 px-1">
                              <div class="form-group">
                                  <label>ชื่อผู้ใช้</label>
                                  <input type="text" name="m_username" class="form-control" placeholder="Username" value="<?php echo $row['m_username']; ?>" readonly>
                              </div>
                              </div>

                          </div>
                          <div class="row">
                              <div class="col-md-6 pr-1">
                              <div class="form-group">
                                  <label>ชื่อ</label>
                                  <input type="text" name="f_name" class="form-control" placeholder="" value="<?php echo $row['f_name']; ?>">
                              </div>
                              </div>
                              <div class="col-md-6 pl-1">
                              <div class="form-group">
                                  <label>นามสกุล</label>
                                  <input type="text" name="l_name" class="form-control" placeholder="" value="<?php echo $row['l_name']; ?>">
                              </div>
                              </div>
                          </div>
                          <div class="row">
                              <div class="col-md-6">
                              <div class="form-group">
                                  <label>อีเมล</label>
                                  <input type="email" name="m_email" class="form-control" placeholder="" value="<?php echo $row['m_email']; ?>">
                              </div>
                              </div>
                              <div class="col-md-6">
                              <div class="form-group">
                                  <label>เบอร์โทร</label>
                                  <input type="nember" name="m_tel" class="form-control" placeholder="" value="<?php echo $row['m_tel']; ?>">
                              </div>
                              </div>
                          </div>
                          <div class="row">
                              <div class="ml-auto mr-auto">
                              <button type="submit" name="btnedit" value="1" class="btn btn-warning">แก้ไข</button>
                              </div>
                          </div>
                        </form>

</div>

    <!-- /.row -->

  </div>
  <!-- /.container -->

  <?php require_once ('footer-admin.php'); ?>
