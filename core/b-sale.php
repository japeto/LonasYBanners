<?php
	include("../include/condb.php");
	if(isSet($_POST['categories'])){
				
		$result=mysqli_query($db,"SELECT * FROM INVENTARIO");
		$count=mysqli_num_rows($result);
				
		$categories =array();
		$limits =array();
		$names =array();
		
		if($count>0){
			while($row = mysqli_fetch_assoc($result)) {				
				$categories[ $row ['IDINVENTARIO'] ] = $row ['CANTIDADENINVENTARIO'];
				$limits[$row ['IDINVENTARIO']] = $row ['LIMITEENINVENTARIO'];
				$names[$row ['IDINVENTARIO']] = $row ['NOMBREPRODUCTO'];				
			}		
			$arr = array ('result'=>true,'categories'=>$categories,'limits'=>$limits,'names'=>$names);			
			echo json_encode($arr);
		}else {
			$arr = array ('result'=>false);
			echo json_encode($arr);
		}
	}
?>
