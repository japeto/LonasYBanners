<?php
	include("../include/condb.php");
	if(isSet($_POST['sdate']) && isSet($_POST['edate']) && isSet($_POST['orderby']) && isSet($_POST['groupby'])){	
	
		$orderby=mysqli_real_escape_string($db,$_POST['orderby']); 	
		$groupby=mysqli_real_escape_string($db,$_POST['groupby']); 		
		$sdate=mysqli_real_escape_string($db,$_POST['sdate']); 	
		$edate=mysqli_real_escape_string($db,$_POST['edate']); 	
	
		$result=mysqli_query($db,"SELECT * FROM FACTURA,CLIENTE,USUARIO WHERE "
								."( FECHAFACTURA BETWEEN '".$sdate."' and '".$edate."') "
								."AND CLIENTEFACTURA=IDCLIENTE AND USUARIOFACTURA=IDUSUARIO");										
								
		$count=mysqli_num_rows($result);		
		if($count>0){
			$rows = "";
			while($row = mysqli_fetch_assoc($result)) {
				$rows .= "<tr id='f_".$row['IDFACTURA']."'>"
				 ."<td>".$row['FECHAFACTURA']."</td>"
				 ."<td>".$row['CODFACTURA']."</td>"
				 ."<td>".$row['NOMBRECLIENTE']."</td>"
				 ."<td>".$row['MONTOFACTURA']."</td>"
				 ."<td>".$row['VENCIMIENTOFACTURA']."</td>"
				 ."<td>".$row['ESTADOFACTURA']."</td>"		
				 ."<td>".$row['CONTACTOCLIENTE']."</td>";
			}
			$arr = array ('result'=>true,'count'=>$count,'rows' => $rows);
			echo json_encode($arr);
		}else {
			$arr = array ('result'=>false);
			echo json_encode($arr);
		}
	}
?>
