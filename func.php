<?php
// ฟังก์ชันหน้าต่างคอนเฟริ์ม 
function myCfm($btnName, $btnStr, $messageStr, $descriptStr, $action){
?>
  <button class="btn btn-danger" onclick="document.getElementById('confirmDiv<?php echo $btnName;?>').style.display='block'"><?php echo $btnStr; ?></button>

  <div id="confirmDiv<?php echo $btnName;?>" class="modalConfirm">

  <div class="modalConfirm-content">
    <div class="modalConfirmcontainer">
      <img src="img/cancel.png" style="width:60px;"><br>  
      <h1><?php echo $messageStr ?></h1>
      <p><?php echo $descriptStr ?></p>
    
      <div class="modalConfirmclearfix">
        <button type="button" onclick="document.getElementById('confirmDiv<?php echo $btnName;?>').style.display='none'" class="btn btn-secondary">ยกเลิก</button>
        <button type="button" onclick="document.getElementById('confirmDiv<?php echo $btnName;?>').style.display='none'; <?php echo $action; ?>" class="btn btn-danger">ยืนยัน</button>
      </div>
    </div>
  </div>
</div>

<?php
}
// ฟังก์ชันหน้าต่างคอนเฟริ์ม 
function myCfmPic($btnName, $btnStr, $messageStr, $descriptStr, $action){
  ?>
    <img src="img/cancel.png" width="30" onclick="document.getElementById('confirmDiv<?php echo $btnName;?>').style.display='block'"/>
  
    <div id="confirmDiv<?php echo $btnName;?>" class="modalConfirm">
  
    <div class="modalConfirm-content">
      <div class="modalConfirmcontainer">
        <img src="img/cancel.svg" style="width:60px;"><br>  
        <h1><?php echo $messageStr ?></h1>
        <p><?php echo $descriptStr ?></p>
      
        <div class="modalConfirmclearfix">
          <button type="button" onclick="document.getElementById('confirmDiv<?php echo $btnName;?>').style.display='none'" class="btn btn-secondary">ยกเลิก</button>
          <button type="button" onclick="document.getElementById('confirmDiv<?php echo $btnName;?>').style.display='none'; <?php echo $action; ?>" class="btn btn-danger">ยืนยัน</button>
        </div>
      </div>
    </div>
  </div>
  
  <?php
  }

function myRes($status,$messageStr){
    if($status == true){
        ?>
                  <div class='alert alert-success'>
                  <strong><img src="../assets/imgs/icons/check24px.svg"> สำเร็จ!</strong> <?php echo $messageStr; ?>
                  </div>
        <?php

    }else{
        ?>
                <div class='alert alert-warning'>
                <strong><img src="../imgs/icons/clear24px.svg"> ไม่สำเร็จ!</strong> <?php echo $messageStr; ?>
                 </div>
       <?php

    }
}
function delAllFileInfolder($folder=''){
	if (is_dir($folder)&&$folder!='') {
		//Get a list of all of the file names in the folder.
		$files = glob($folder . '/*');
		 
		//Loop through the file list.
		foreach($files as $file){
			//Make sure that this is a file and not a directory.
			if(is_file($file)){
				//Use the unlink function to delete the file.
				unlink($file);
			}
		}
	}
}
?>