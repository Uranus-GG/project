
<?php require_once ('menu-header.php'); ?>
  <!-- Page Content -->
  <div class="page-heading header-text">
          <div class="container">
            <div class="row">
              <div class="col-md-12">
                <h1>แก้ไขรหัสผ่าน</h1>
              </div>
            </div>
          </div>
    </div>
    <style>
div.ex1 {
  margin-top: 100px;
}

</style>

<div class="container ex1 "align="center">
        <form action="user-save.php" method="post">   
                                
                <div class="col-md-6 pr-1" >
                <div class="form-group ">
                    <label>ชื่อผู้ใช้</label>
                    <input type="text" class="form-control text-center"  placeholder="" value="<?php echo $_SESSION['m_username']; ?>" readonly>
                </div>
                </div>

                <div class="col-md-6 pr-1">
                <div class="form-group">
                    <label>รหัสผ่านเดิม</label>
                    <input type="password" name="m_password" class="form-control text-center" placeholder="" value="">
                </div>
                </div>

                <div class="col-md-6 pr-1">
                <div class="form-group">
                    <label>รหัสผ่านใหม่</label>
                    <input type="password" name="m_password1" class="form-control text-center" placeholder="" value="">
                </div>
                </div>

                <button type="submit" name="btnpassword" value="1" class="btn btn-warning">เปลี่ยนรหัสผ่าน</button>
                <br>
                <br><br><br><br><br><br>
        </form>
</div>
  <!-- /.container -->

  <?php require_once ('footer.php'); ?>
