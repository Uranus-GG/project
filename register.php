
<?php require_once ('menu-header.php') ?>
<!doctype html>
<html lang="en">
  <head>
  	<title>Login 10</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	
	<link rel="stylesheet" href="login/css/style.css">
  <style>
div.ex1 {
  margin-top: 100px;
}

</style>
	</head>
	<body class="img js-fullheight" style="background-image: url(img/banner-image-1-1920x500.jpg);">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-md-6 text-center mb-5">
					<h2 class="heading-section"></h2>
				</div>
			</div>
			<div class="row justify-content-center ex1">
				<div class="col-md-6 col-lg-4">
					<div class="login-wrap p-0">
		      	<h3 class="mb-4 text-center">สมัครสมาชิก</h3>
		      	<form action="check-register.php" method="post" >
		      		<div class="form-group">
		      			<input type="text" name="f_name" class="form-control" placeholder="ชื่อ" required>
		      		</div>
              <div class="form-group">
		      			<input type="text" name="l_name" class="form-control" placeholder="นามสกุล" required>
		      		</div>
              <div class="form-group">
		      			<input type="text" name="m_email" class="form-control" placeholder="อีเมล" required>
		      		</div>
              <div class="form-group">
		      			<input type="text" name="m_tel" class="form-control" placeholder="เบอร์โทร" required>
		      		</div>
              <div class="form-group text-center">
		      			<input type="text" name="m_username" id="username" class="form-control" placeholder="ชื่อผู้ใช้" required>
						<span id="availablity"></span>
		      		</div>
              <div class="form-group">
	              <input id="password-field" name="m_password" type="password" class="form-control" placeholder="รหัสผ่าน" required>
	              <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>
	            </div>
	            <div class="form-group">
                     <button class="w-100 btn btn-lg btn-success" name="register" value="1" type="submit">สมัครสมาชิก</button>
	            </div>
	          </form>

		      </div>
				</div>
			</div>
		</div>

    <script src="login/js/jquery.min.js"></script>
  <script src="login/js/popper.js"></script>
  <script src="login/js/bootstrap.min.js"></script>
  <script src="login/js/main.js"></script>
    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script type="text/javascript"></script>
      <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Additional Scripts -->
    <script src="assets/js/custom.js"></script>
    <script src="assets/js/owl.js"></script>
    <script src="assets/js/slick.js"></script>
    <script src="assets/js/accordions.js"></script>

    <script language = "text/Javascript"> 
      cleared[0] = cleared[1] = cleared[2] = 0; //set a cleared flag for each field
      function clearField(t){                   //declaring the array outside of the
      if(! cleared[t.id]){                      // function makes it static and global
          cleared[t.id] = 1;  // you could use true and false, but that's more typing
          t.value='';         // with more chance of typos
          t.style.color='#fff';
          }
      }
    </script>

	<script type="text/javascript">	
	$('document').ready(function(){
          $('#username').change(function(){
               var username = $(this).val();
                $.ajax ({
                    url : "check-register.php",
                    method : "POST",
                    data :  {m_username :username },
                    dataType: "text",
                    success:function(html)
                    {
                        $('#availablity').html(html);
                    }
                });
            });
   });
	
	</script>
	</body>
</html>




