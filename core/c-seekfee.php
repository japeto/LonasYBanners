<?php
	include("../include/condb.php");
	$result=mysqli_query($db,"SELECT * FROM FACTURA,ABONOSALDO WHERE FACTURAABONO= IDFACTURA");
	$count=mysqli_num_rows($result);
	echo "<table>";
		echo "<caption>BUSCAR FACTURA</caption>";			
		echo "<tr>";
		echo "<td width='10%'><b>COD. FACTURA:</b></td>";
		echo "<td width='12%'><input id='codinvoicefee' style='width:90%' id='' placeholder='NUMERO DE FACTURA'/></td>";
		echo "<td width='10%' ><b>FECHA:</b></td>";
		echo "<td width='15%'><input id='datefee' type='date' style='width:60%'  VALUE='".date('Y-m-d', time()-1)."'/></td></td>";	
		echo "</tr>";			
	echo "</table>";
	/*botones*/
	echo "<table class='commands'>";	
		echo "<tr>";
		echo "<td width='18%'><a class='commandbutton' id='menu1'  onclick='seekFee(this)' >";
		echo "<img src='shared/thumbs/btseek.png' align='left' style='padding-right:5px;'> Buscar </a></td>";
		echo "</tr>";	
	/* mensajes*/	
		echo "<tr>";
		echo "<td colspan='4' id='resultfee'></td>";
		echo "</tr>";		
	echo "</table>";	
	
	echo "<table id='tablefee'>";
	echo "<caption>RESULTADOS DE LA BUSQUEDA<font id='countfee' style='float:right;' color='black'> ".$count." Resultados</font> </caption>";
	if($count===0) {
		echo "<thead>";
		echo "<tr>";
			echo "<th>FECHA DE CREACION</th>";
			echo "<th>TIPO</th>";
			echo "<th>FACTURA</th>";
			echo "<th>ESTADO</td>";
			echo "<th>MONTO</th>";
			echo "<th>ACCION</th>";			
		echo "</tr>";
		echo "</thead>";	
		echo "<tbody id='tablebodyfee'>";
		echo "<tr>";
			echo "<td colspan='8' > <font size='2' color='blue'>NO HAY ABONOS, NI CUOTAS</font> </td>";
		echo "</tr>";
		echo "</tbody>";		
	}else {	
		echo "<thead>";
		echo "<tr>";
			echo "<th>FECHA DE CREACION</th>";
			echo "<th>TIPO</th>";
			echo "<th>FACTURA</th>";
			echo "<th>ESTADO</td>";
			echo "<th>MONTO</th>";
//			echo "<th>ACCION</th>";				
		echo "</tr>";
		echo "</thead>";
		echo "<tbody id='tablebodyfee'>";							
		while($row = mysqli_fetch_assoc($result)) {
			echo "<tr id='f_".$row['IDABONOSALDO']."'>";
				echo "<td>".$row['FECHACREACION']."</td>";
				echo "<td>".$row['TIPODEPAGO']."</td>";
				echo "<td>".$row['CODFACTURA']."</td>";
				echo "<td>".$row['ESTADOFACTURA']."</td>";
				echo "<td>".$row['MONTOABONO']."</td>";				
//				echo "<td><a class='imagelink' onclick='editrowfee(this)'><img src='shared/thumbs/edit_pen.png'/></a>";
//				echo " <a onclick='delrowfee(this)'><img src='shared/thumbs/edit_see.png'/></a>";																					
			echo "</tr>";
		}
		echo "</tbody>";		
	}
	echo "</table>";
?>
