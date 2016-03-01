<?php
	include("../include/condb.php");
	echo "<table>";
		echo "<caption>AGREGAR ABONO O CUOTA A FACTURA</caption>";			
		echo "<td rowspan='4'><img src='shared/thumbs/imgfee_first.png'></td>";				
		echo "<tr>";
		echo "<td width='10%'><b>CODIGO:</b></td>";
		echo "<td width='20%'><input style='width:100%' id='feeinvoice' placeholder='NUM.FACTURA'/></td>";	
		echo "<td width='10%' ><b>FECHA:</b></td>";
		echo "<td width='15%'><input type='date' style='width:90%' id='datefee' placeholder='' value='".date('Y-m-d', time())."' /></td>";	
//		echo "<td width='10%'><b>CLIENTE:</b></td>";
//		echo "<td width='50%'><input style='width:100%' id='clientefee' placeholder='CLIENTE'/></td>";	
		echo "</tr>";
		echo "<tr>";
		echo "<td width='10%' ><b>PAGO:</b></td>";
		echo "<td width='12%'> <select id='typepayfee' style='width:80%;' value='1071'>";
		echo"<option value='EFECTIVO' selected='selected'> EFECTIVO </option>";				
		echo"<option value='CHEQUE'> CHEQUE </option>";				
		echo"<option value='OTRO...'> OTRO... </option>";								
		echo "</td>";	
		echo "<td width='10%' ><b>ABONO:</b></td>";
		echo "<td width='10%'><input style='width:90%' id='feevalue' placeholder='CANTIDAD'/></td>";	
		echo "</tr>";
	echo "</table>";
	/*botones*/
	echo "<table class='commands'>";	
		echo "<tr>";	
		echo "<td width='18%'><a class='commandbutton' id='menu1'  onclick='newfee(this)' >";
		echo "<img src='shared/thumbs/btsale_add.png' align='left' style='padding-right:5px;'> Abonar </a></td>";
		echo "</tr>";
		echo "<tr>";	
		echo "</tr>";
	/* mensajes*/
		echo "<tr>";
		echo "<td colspan='4' id='resultfee'></td>";
		echo "</tr>";		
	echo "</table>";	
	$result=mysqli_query($db,"select * from abonosaldo,factura,CLIENTE,USUARIO where USUARIOFACTURA=IDUSUARIO AND FACTURAABONO= IDFACTURA AND IDCLIENTE=CLIENTEFACTURA AND ESTADOFACTURA='PENDIENTE';");
	$count=mysqli_num_rows($result);	
	
	echo "<table id='tablefee'>";
	echo "<caption>LISTA DE ABONOS<font style='float:right;' color='black'> ".$count." Resultados</font> </caption>";
	if($count===0) {
		echo "<thead>";
		echo "<tr>";
			echo "<th>FECHA</th>";
			echo "<th>COD.FACTURA</th>";
			echo "<th>CLIENTE</th>";
			echo "<th>ABONO</td>";
			echo "<th>VENCIMIENTO</th>";
			echo "<th>ESTADO</th>";			
			echo "<th>CONTACTO</th>";
		echo "</tr>";
		echo "</thead>";	
		echo "<tbody id='tablebodyfee'>";		
		echo "<tr>";
			echo "<td colspan='8' > <font size='3' color='blue'>NO HAY ABOBNOS O CUOTAS</font> </td>";
		echo "</tr>";
		echo "</tbody>";		
	}else {
		echo "<thead>";
		echo "<tr>";
			echo "<th>FECHA</th>";
			echo "<th>COD.FACTURA</th>";
			echo "<th>CLIENTE</th>";
			echo "<th>ABONO</td>";
			echo "<th>VENCIMIENTO</th>";
			echo "<th>ESTADO</th>";						
			echo "<th>CONTACTO</th>";
//			echo "<th>ACCION</th>";			
		echo "</tr>";
		echo "</thead>";
		echo "<tbody id='tablebodyfee'>";								
		while($row = mysqli_fetch_assoc($result)) {
			echo "<tr>";
				echo "<td>".$row['FECHACREACION']."</td>";
				echo "<td>".$row['CODFACTURA']."</td>";
				echo "<td>".$row['NOMBRECLIENTE']."</td>";
				echo "<td>".$row['MONTOABONO']."</td>";
				echo "<td>".$row['VENCIMIENTOFACTURA']."</td>";
				echo "<td>".$row['ESTADOFACTURA']."</td>";				
				echo "<td>".$row['CONTACTOCLIENTE']."</td>";																
//				echo "<td><a class='imagelink' onclick='editrowfee(this)'><img src='shared/thumbs/edit_pen.png'/></a>";
//				echo " <a onclick='delrowfee(this)'><img src='shared/thumbs/edit_see.png'/></a>";																					
			echo "</tr>";
		}
		echo "</tbody>";		
	}
	echo "</table>";
?>
