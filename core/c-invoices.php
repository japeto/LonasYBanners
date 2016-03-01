<?php
	include("../include/condb.php");
	$result=mysqli_query($db,"SELECT * FROM FACTURA,CLIENTE,USUARIO WHERE CLIENTEFACTURA=IDCLIENTE AND USUARIOFACTURA=IDUSUARIO;");
	$count=mysqli_num_rows($result);
	echo "<input type='hidden' id='current_page' />";
	echo "<input type='hidden' id='show_per_page' />";
	echo "<table>";
		echo "<caption>BUSCAR FACTURA</caption>";			
		echo "<tr>";
		echo "<td width='10%'><b>FECHA:</b></td>";
		echo "<td width='12%'><input id='dateinvoice' type='date' style='width:100%'  VALUE='".date('Y-m-d', time()-1)."'/></td>";
		echo "<td width='10%' ><b>CODIGO:</b></td>";
		echo "<td width='15%'><input id='codinvoice' style='width:90%'  placeholder='CODIGO'/></td>";	
		echo "<td width='10%'><b>CLIENTE:</b></td>";
		echo "<td width='60%'><input id='cliinvoice' style='width:100%'  placeholder='CLIENTE'/></td>";	
		echo "</tr>";
		echo "<tr>";
		echo "<td width='10%' ><b>VENCIMIENTO:</b></td>";
		echo "<td width='12%'><input id='duedateinvoice' type='date'style='width:100%'  VALUE='".date('Y-m-d', time())."' /></td>";	
		echo "<td width='10%' ><b>ESTADO:</b></td>";
		echo "<td width='20%'><select id='stateinvoice' style='width:90%' selectedIndex='-1' placeholder='CANCELADA'>";
		echo "<option selected='selected' value='-1' style='color:gray;'>ESTADO</option>";		
		echo "<option value='CANCELADO'>CANCELADO</option>";
		echo "<option value='PENDIENTE'>PENTIENTE</option>";
		echo "</select>";	
		echo "<td width='10%'><b> RESPONSABLE:</b></td>";
		echo "<td width='60%'><input id='userinvoice' style='width:100%'  placeholder='RESPONSABLE'/></td>";	
		echo "</tr>";				
	echo "</table>";
	/*botones*/
	echo "<table class='commands'>";	
		echo "<tr>";
		echo "<td width='18%'><a class='commandbutton' id='menu1'  onclick='seekInvoice(this)' >";
		echo "<img src='shared/thumbs/btseek.png' align='left' style='padding-right:5px;'> Buscar </a></td>";
		echo "</tr>";	
	/* mensajes*/	
		echo "<tr>";
		echo "<td colspan='4' id='resultinvoices'></td>";
		echo "</tr>";		
	echo "</table>";
	
	echo "<table id='tableinvoices'>";
	echo "<caption>RESULTADOS DE LA BUSQUEDA<font id='countinvoices' style='float:right;' color='black'> ".$count." Resultados</font> </caption>";
	if($count===0) {
		echo "<thead>";
		echo "<tr>";
			echo "<th>FECHA</th>";
			echo "<th>COD.FACTURA</th>";
			echo "<th>CLIENTE</th>";
			echo "<th>MONTO</td>";
			echo "<th>VENCIMIENTO</th>";
			echo "<th>ESTADO</th>";			
			echo "<th>RESPONSABLE</th>";
		echo "</tr>";
		echo "</thead>";	
		echo "<tbody id='tablebodyinv'>";
		echo "<tr>";
			echo "<td colspan='8' > <font size='3' color='blue'>NO HAY FACTURAS PENDIENTES</font> </td>";
		echo "</tr>";
		echo "</tbody>";		
	}else {
		echo "<thead>";
		echo "<tr>";
			echo "<th>FECHA</th>";
			echo "<th>COD.FACTURA</th>";
			echo "<th>CLIENTE</th>";
			echo "<th>MONTO</td>";
			echo "<th>VENCIMIENTO</th>";
			echo "<th>ESTADO</th>";						
			echo "<th>RESPONSABLE</th>";
			echo "<th>ACCION</th>";			
		echo "</tr>";
		echo "</thead>";
		echo "<tbody id='tablebodyinv'>";								
		while($row = mysqli_fetch_assoc($result)) {
			echo "<tr>";
				echo "<td>".$row['FECHAFACTURA']."</td>";
				echo "<td>".$row['CODFACTURA']."</td>";
				echo "<td>".$row['NOMBRECLIENTE']."</td>";
				echo "<td>".$row['MONTOFACTURA']."</td>";
				echo "<td>".$row['VENCIMIENTOFACTURA']."</td>";
				echo "<td>".$row['ESTADOFACTURA']."</td>";				
				echo "<td>".$row['CONTACTOCLIENTE']."</td>";																
				echo "<td><a id='".$row['CODFACTURA']."' onclick='seeinvoice(this)'><img class='imgbutton' src='shared/thumbs/edit_see.png'/></a>";
//				echo " <a onclick='delroinvoice(this)'><img class='imgbutton' src='shared/thumbs/edit_del.png'/></a>";																	
			echo "</tr>";
		}
		echo "</tbody>";		
	}
	echo "</table>";
	echo "<div id='page_navigation'></div> "
?>
