<?php
require_once "menu-admin.php";

?>
		<link rel="stylesheet" href="assets/css/fucn/my.css">
		<link rel="stylesheet" href="assets/css/fucn/style-admin.css">
		<link rel="stylesheet" href="assets/css/fucn/style.css">
	<div class="row">
		<div class="col-sm-1">

		</div>
		<div class="col-sm-11">
			<div class="container">
				<section>
				<?php
				$data_id = filter_input(INPUT_GET, "data_id"); //ส่งข้อมูล method GET ผ่าน Url จากการกดปุ่มแก้ไข
				$type_gallery_id = filter_input(INPUT_GET, "type_gallery_id"); //ส่งข้อมูล method GET ผ่าน Url จากการกดปุ่มแก้ไข 
				//ดึงข้อมูลสินค้า
				/*$sql_product = 'SELECT * FROM product
inner join type_product 
on product.type_product_id = type_product.type_product_id
Order By product_id DESC'; //คำสั่ง sql*/

				$sql_gallery = "SELECT * FROM gallery 
				WHERE data_id = '$data_id' 
				and type_gallery_id = '$type_gallery_id'";
				$result_gallery = $conx->query($sql_gallery);
				$num_rows = $result_gallery->num_rows;
				?>
				<div class="head-text">ข้อมูลอัลบั้มภาพ</div>
				<div class="menu-text">
					<button class="btn btn-info" id="insert_images" name="insert_images" data-toggle="modal" data-target="#mainImages_Modal" title="เพิ่มรูปภาพ">
						<i class="fa fa-plus"></i> เพิ่มรูปภาพ
					</button>
				</div>
				<div class="menu-text"><?php echo "มีข้อมูลรูปภาพจำนวน $num_rows รายการ"; ?> </div>
				<div class="menu-text">
					<?php
					if ($type_gallery_id == 1) {
						$sql_data = "SELECT * FROM `news` WHERE news_ID = '$data_id'";
						$result_data = $conx->query($sql_data);
						$row_data = $result_data->fetch_assoc();

						echo $link = "<a href='news-edit.php' target = '_blank'>ข้อมูลข่าว</a> > อัลบั้มภาพ" . $row_data['news_title'];
					} elseif ($type_gallery_id == 2) {
						$sql_data = "SELECT * FROM product WHERE p_ID = '$data_id'";
						$result_data = $conx->query($sql_data);
						$row_data = $result_data->fetch_assoc();

						echo $link = "<a href='product-admin.php' target = '_blank'>ข้อมูลผลิตภัณฑ์</a> > อัลบั้มภาพ" . $row_data['p_title'];
					}elseif ($type_gallery_id == 3) {
						$sql_data = "SELECT * FROM learn WHERE l_ID = '$data_id'";
						$result_data = $conx->query($sql_data);
						$row_data = $result_data->fetch_assoc();

						echo $link = "<a href='learn-edit.php' target = '_blank'>ข้อมูลกิจกรรมการเรียนรู้</a> > อัลบั้มภาพ" . $row_data['l_title'];
					}

					?>
				</div>
				<div class="card-body p-0">
					<table class="table table-striped projects">
						<h5 class="card-header">อัลบั้มภาพ</h5>
						<div class="card-body">
							<table class="table table-bordered">
								<thead>
									<tr class="text-center">
										<th scope="col"class="text-center">ลำดับ</th>
										<th scope="col"class="text-center">รูปภาพ</th>
										<th scope="col" class="text-center">เครื่องมือ</th>
									</tr>
								</thead>
								<tbody>
									<?php
									$i = 1;
									while ($row_gallery = $result_gallery->fetch_assoc()) { //วนลูปดึงข้อมูลทีละแถวมาแสดงผล
									?>
										<tr>
											<td scope="row" class="text-center"><?php echo $i++; ?></th>
											<td class="text-center">
												<?php
												if ($row_gallery['gallery_name'] != '') {
													echo "<a href='file_upload/gallery/$type_gallery_id-$data_id/$row_gallery[gallery_name]' target = '_blank'><img src='file_upload/gallery/$type_gallery_id-$data_id/$row_gallery[gallery_name]' width='200'/></a>";
												} else {
													echo '<font color=red>ไม่มีรูปภาพ</font>';
												} ?>
											</td>
											<td class = "text-center">
											<?php myCfmPic($row_gallery['gallery_id'], "ลบ","ยืนยันการลบ", "ต้องการลบสินค้า <span style='color:blue; font-weight:bold;'> ".$row_gallery['gallery_name']." </span> จริงหรือไม่"," location.href='ajax_images.php?action=del&gallery_id=".$row_gallery['gallery_id']."&type_gallery_id=".$type_gallery_id."&data_id=".$data_id."'");?>
										
											</td>
										</tr>
									<?php
									}
									?>
								</tbody>
							</table>
						</div>
				</div>
				</section>
			</div>
		</div>
	</div>
	</div>

	<script>
	function confirmDelete(delUrl) {
		if (confirm("คุณต้องการลบข้อมูล?")) {
			document.location = delUrl;
		}
	}
</script>
<?php
require_once "footer-admin.php";
?>

<div class="modal fade" id="mainImages_Modal" tabindex="-1"
	role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"
					aria-hidden="true">&times;</button>
				<h4 class="modal-title" id="myModalLabel">
					<i class="fa fa-picture-o"></i> เพิ่มรูปภาพ Gallery
				</h4>
			</div>
			<form method="post" action="" id="frm_images" name="frm_images"
				enctype="multipart/form-data">
				<div class="modal-body">
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<!-- <img id="reViewImg" src="#" alt="" width="100%" /> -->
								<input type="file" class="form-control" name="imgUpload[]"
									id="imgUpload[]" onchange="readURL(this);" width="100%"
									ref={inputRef} multiple="multiple" />
							</div>
						</div>
					</div>
					<div style="text-align: center;">
						<div id="message_images"></div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-primary">เพิ่มรูปภาพ</button>
					<button type="button" class="btn btn-danger" data-dismiss="modal">ยกเลิก</button>
				</div>
				<input type="hidden" id="data_type" name="data_type"
					value="view_images"> <input type="hidden" id="type_gallery_id"
					name="type_gallery_id" value="<?php echo $type_gallery_id?>"> <input type="hidden" id="data_id"
					name="data_id" value="<?php echo $data_id?>">
			</form>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>

<div id="popup_images" class="modal fade" tabindex="-1" role="dialog"
	aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-body">
				<img class="img-responsive" id="popupImg" name="popupImg">
			</div>
		</div>
	</div>
</div>
<script src="js/jquery_imagesMain.js"></script>
<script>  
$(document).ready(function(){

	
	$('#insert_images').on('click', function() { 
		$('#sendData_gallery').val("บันทึกข้อมูล");
		$('#imgUpload').val(null);
	    
	});
});
</script>
