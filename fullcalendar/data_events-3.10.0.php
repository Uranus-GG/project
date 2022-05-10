<?php
header("Content-type:application/json; charset=UTF-8");          
header("Cache-Control: no-store, no-cache, must-revalidate");         
header("Cache-Control: post-check=0, pre-check=0", false);  
include '../connect.php';
$data = array();
$query = "SELECT * FROM `event` WHERE status = 1";
if ($result = $conx->query($query)) {	
    /* fetch object array */
    while ($obj = $result->fetch_object()) {
       $data[] = array(
                    'id' => $obj->e_ID,
                    'title'=> $obj->e_title,
                    'detail'=> $obj->e_detail,
                    'start'=> $obj->e_start,
                    'end'=> $obj->e_end,
                    'color'=> $obj->color,
                    );
    }

    /* free result set */
    $result->close();
}
$conx->close();

$data=(isset($data))?$data:NULL;
$json= json_encode($data);  
if(isset($_GET['callback']) && $_GET['callback']!=""){  
echo $_GET['callback']."(".$json.");";      
}else{  
echo $json;  
}
?>
