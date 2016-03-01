<?php
	include("../include/condb.php");
	if(isSet($_POST['sdate']) && isSet($_POST['edate']) && isSet($_POST['orderby']) && isSet($_POST['groupby'])){	
	
		$orderby=mysqli_real_escape_string($db,$_POST['orderby']); 	
		$groupby=mysqli_real_escape_string($db,$_POST['groupby']); 		
		$sdate=mysqli_real_escape_string($db,$_POST['sdate']); 	
		$edate=mysqli_real_escape_string($db,$_POST['edate']); 	
	
		$result=mysqli_query($db,"SELECT * FROM FACTURA,CLIENTE,USUARIO WHERE "
								."( FECHAFACTURA BETWEEN '".$sdate."' and '".$edate."') "
								."AND CLIENTEFACTURA=IDCLIENTE AND USUARIOFACTURA=IDUSUARIO ORDER BY ".$orderby." ASC");										
								
		$count=mysqli_num_rows($result);		
		if($count>0){
			$rows = "";
			while($row = mysqli_fetch_assoc($result)) {
				$rows .= "<tr id='f_".$row['IDFACTURA']."'>"
				 ."<td>".$row['FECHAFACTURA']."</td>"
				 ."<td>".$row['NOMBRECLIENTE']."</td>"
				 ."<td>".$row['MONTOFACTURA']."</td>"
				 ."<td>".$row['VENCIMIENTOFACTURA']."</td>"
				 ."<td>".$row['NOMBREUSUARIO']."</td>";
			}
			$arr = array ('result'=>true,'count'=>$count,'rows' => $rows);
			echo json_encode($arr);
		}else {
			$arr = array ('result'=>false);
			echo json_encode($arr);
		}
	}
	if(isSet($_POST['svdate']) && isSet($_POST['evdate']) && isSet($_POST['orderby']) && isSet($_POST['groupby'])){	
	
		$orderby=mysqli_real_escape_string($db,$_POST['orderby']); 	
		$groupby=mysqli_real_escape_string($db,$_POST['groupby']); 		
		$svdate=mysqli_real_escape_string($db,$_POST['svdate']); 	
		$evdate=mysqli_real_escape_string($db,$_POST['evdate']); 	
	
		$result=mysqli_query($db,"SELECT * FROM FACTURA,CLIENTE,USUARIO WHERE "
								."( VENCIMIENTOFACTURA BETWEEN '".$svdate."' and '".$evdate."') "
								."AND CLIENTEFACTURA=IDCLIENTE AND USUARIOFACTURA=IDUSUARIO ORDER BY ".$orderby." ASC");																				
								
		$count=mysqli_num_rows($result);		
		if($count>0){
			$rows = "";
			while($row = mysqli_fetch_assoc($result)) {
				$rows .= "<tr id='f_".$row['IDFACTURA']."'>"
				 ."<td>".$row['FECHAFACTURA']."</td>"
				 ."<td>".$row['NOMBRECLIENTE']."</td>"
				 ."<td>".$row['MONTOFACTURA']."</td>"
				 ."<td>".$row['VENCIMIENTOFACTURA']."</td>"
				 ."<td>".$row['NOMBREUSUARIO']."</td>";
			}
			$arr = array ('result'=>true,'count'=>$count,'rows' => $rows);
			echo json_encode($arr);
		}else {
			$arr = array ('result'=>false);
			echo json_encode($arr);
		}
	}	
	if(isSet($_POST['scode']) && isSet($_POST['ecode']) && isSet($_POST['orderby']) && isSet($_POST['groupby'])){	
	
		$orderby=mysqli_real_escape_string($db,$_POST['orderby']); 	
		$groupby=mysqli_real_escape_string($db,$_POST['groupby']); 		
		$scode=mysqli_real_escape_string($db,$_POST['scode']); 	
		$ecode=mysqli_real_escape_string($db,$_POST['ecode']); 	
	
		$result=mysqli_query($db,"SELECT * FROM FACTURA,CLIENTE,USUARIO WHERE "
								."( CODFACTURA BETWEEN ".$scode." and ".$ecode.") "
								."AND CLIENTEFACTURA=IDCLIENTE AND USUARIOFACTURA=IDUSUARIO ORDER BY ".$orderby." ASC");																			
								
		$count=mysqli_num_rows($result);		
		if($count>0){
			$rows = "";
			while($row = mysqli_fetch_assoc($result)) {
				$rows .= "<tr id='f_".$row['IDFACTURA']."'>"
				 ."<td>".$row['FECHAFACTURA']."</td>"
				 ."<td>".$row['NOMBRECLIENTE']."</td>"
				 ."<td>".$row['MONTOFACTURA']."</td>"
				 ."<td>".$row['VENCIMIENTOFACTURA']."</td>"
				 ."<td>".$row['NOMBREUSUARIO']."</td>";
			}
			$arr = array ('result'=>true,'count'=>$count,'rows' => $rows,'sum');
			echo json_encode($arr);
		}else {
			$arr = array ('result'=>false);
			echo json_encode($arr);
		}
	}	
?>
