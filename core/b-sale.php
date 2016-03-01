<?php
	include("../include/condb.php");
	if(isSet($_POST['categories'])){
				
		$result=mysqli_query($db,"SELECT * FROM INVENTARIO,SISTEMA");
		$count=mysqli_num_rows($result);
				
		$categories =array();
		$limits =array();
		$names =array();
		$cods =array();		
		
		if($count>0){
			while($row = mysqli_fetch_assoc($result)) {				
				$categories[ $row ['IDINVENTARIO'] ] = $row ['CANTIDADENINVENTARIO'];
				$limits[$row ['IDINVENTARIO']] = $row ['LIMITEENINVENTARIO'];
				$names[$row ['IDINVENTARIO']] = $row ['NOMBREPRODUCTO'];				
				$cods[0] = $row ['CONSECUTIVOIVA'];
				$cods[1] = $row ['CONSECUTIVO'];				
			}		

			$arr = array ('result'=>true,'categories'=>$categories,'limits'=>$limits,'names'=>$names,'cods'=>$cods);			
			echo json_encode($arr);
		}else {
			$arr = array ('result'=>false);
			echo json_encode($arr);
		}
	}
?>
