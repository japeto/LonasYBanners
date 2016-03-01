<?php
	include("../include/condb.php");
	if(isSet($_POST['feeinvoice']) && isSet($_POST['datefee']) 
			&& isSet($_POST['typepayfee']) && isSet($_POST['feevalue'])){
		
		$feeinvoice=mysqli_real_escape_string($db,$_POST['feeinvoice']); 		
		$datefee=mysqli_real_escape_string($db,$_POST['datefee']); 		
		$typepayfee=mysqli_real_escape_string($db,$_POST['typepayfee']); 												
		$feevalue=mysqli_real_escape_string($db,$_POST['feevalue']); 														

		$exist=mysqli_query($db,"select * from factura where ESTADOFACTURA='PENDIENTE' "
								."AND CODFACTURA='".$feeinvoice."' ");
		$count=mysqli_num_rows($exist);											
		if($count>0){
			$row = mysqli_fetch_assoc($exist);
			$result=mysqli_query($db,"INSERT INTO ABONOSALDO (FECHACREACION, TIPODEPAGO, ESTADOABONO, "
								." MONTOABONO, FACTURAABONO) VALUES ('".$datefee."', '".$typepayfee."', 'APROBADO', '".$feevalue."', '".$row['IDFACTURA']."')");
			
			mysqli_query($db,"UPDATE FACTURA SET ESTADOFACTURA='CANCELADO' "
						."WHERE IDFACTURA='".$row['IDFACTURA']."' AND "
						."MONTOFACTURA <= (SELECT SUM(MONTOABONO) FROM ABONOSALDO "
						."WHERE IDFACTURA=FACTURAABONO AND IDFACTURA='".$row['IDFACTURA']."')");
											
			if($result){
				$arr = array ('result'=>true,'update'=>mysqli_affected_rows($db));
				echo json_encode($arr);
			}else {
				$arr = array ('result'=>false);
				echo json_encode($arr);
			}	
			
		}else{
			$arr = array ('result'=>$count);
			echo json_encode($feeinvoice);
		}
	}
?>