<?php
	include("../include/condb.php");
	$result=mysqli_query($db,"SELECT * FROM CLIENTE,CIUDAD WHERE CIUDEPTOCLIENTE=IDCIUDAD;");
	$count=mysqli_num_rows($result);
	echo "<table>";
		echo "<caption>BUSCAR FACTURA</caption>";			
		echo "<tr>";
		echo "<td width='10%'><b>NOMBRE:</b></td>";
		echo "<td width='20%'><input id='seekclient' style='width:100%' placeholder='NOMBRE DE LA EMPRESA'/></td>";
		echo "<td width='10%' ><b>CONTACTO:</b></td>";
		echo "<td width='20%'><input id='seekcontact' style='width:100%' placeholder='NOMBRE DE CONTACTO'/></td>";		
		echo "<td width='10%'><b>NIT:</b></td>";
		echo "<td width='10%'><input id='seeknit' style='width:100%' placeholder='NIT - ID'/></td>";	
		echo "</tr>";		
	echo "</table>";
	/*buttons*/
	echo "<table class='commands'>";	
		echo "<tr>";
		echo "<td width='18%'><a class='commandbutton' id='menu1'  onclick='seekClient(this)' >";
		echo "<img src='shared/thumbs/btseek.png' align='left' style='padding-right:5px;'> Buscar </a></td>";
		echo "</tr>";
	/*mensajes*/	
		echo "<tr>";
		echo "<td colspan='4' id='resultclients'></td>";
		echo "</tr>";		
	echo "</table>";
	
	echo "<table id='tablecustomer'>";
	echo "<caption>RESULTADOS DE LA BUSQUEDA<fon4t id='countclients' style='float:right;' color='black'> ".$count." Resultados</font>";
		echo '<form action="core/c-export.php" method="post" target="_blank" id="FormularioExportacion">
<img class="imgbutton" id="exportclient" src="shared/thumbs/btexcel.png" align="right" style="padding-right:5px;">
<input type="hidden" id="datos_a_enviar" name="datos_a_enviar" />
<input type="hidden" id="nameexport" name="nameexport" />
</form>';
		echo "<a class='imgbutton' id='prnt'  onclick='printclient(this)' >";
		echo "<img src='shared/thumbs/btprint.png'align='right' style='padding-right:5px;'> </a>";
					
	echo "</caption>";		
	if($count===0) {
		echo "<thead>";
		echo "<tr>";
			echo "<th>NOMBRE</th>";
			echo "<th>DIRECCION</th>";
			echo "<th>CIUDAD</th>";
			echo "<th>TELEFONO</td>";
			echo "<th>NIT</th>";
			echo "<th>CORREO</th>";
			echo "<th>CONTACTO</th>";			
			echo "<th>ACCION</th>";				
		echo "</tr>";
		echo "</thead>";	
		echo "<tbody id='tablebodyclients'>";
		echo "<tr>";
			echo "<td colspan='8' > <font size='2' color='blue'>NO HAY CLIENTES EN EL SISTEMA</font> </td>";
		echo "</tr>";
		echo "</tbody>";		
	}else {
		echo "<thead>";
		echo "<tr>";
			echo "<th>NOMBRE</th>";
			echo "<th>DIRECCION</th>";
			echo "<th>CIUDAD</th>";
			echo "<th>TELEFONO</td>";
			echo "<th>NIT</th>";				
			echo "<th>CORREO</th>";
			echo "<th>CONTACTO</th>";			
			echo "<th>ACCION</th>";				
		echo "</tr>";
		echo "</thead>";
		echo "<tbody id='tablebodyclients'>";									
		while($row = mysqli_fetch_assoc($result)) {
			echo "<tr id='customer_".$row['IDCLIENTE']."'>";
				echo "<td class='editable' id='NOMBRECLIENTE_".$row['IDCLIENTE']."' >".$row['NOMBRECLIENTE']."</td>";
				echo "<td class='editable' id='DIRECCIONCLIENTE_".$row['IDCLIENTE']."' >".$row['DIRECCIONCLIENTE']."</td>";
				echo "<td id='CDESCRIPCION_".$row['IDCLIENTE']."' >".$row['CDESCRIPCION']."</td>";														
				echo "<td class='editable' id='TELEFONOCLIENTEr_".$row['IDCLIENTE']."' >".$row['TELEFONOCLIENTE']."</td>";														
				echo "<td class='editable' id='NItCLIENTE_".$row['IDCLIENTE']."' >".$row['NItCLIENTE']."</td>";														
				echo "<td class='editable' id='CORREOCLIENTE_".$row['IDCLIENTE']."' >".$row['CORREOCLIENTE']."</td>";																										
				echo "<td class='editable' id='CONTACTOCLIENTE_".$row['IDCLIENTE']."' >".$row['CONTACTOCLIENTE']."</td>";																														
			echo "<td><a id='editcustomer_".$row['IDCLIENTE']."' onclick='editrowclient(this)'><img class='imgbutton' src='shared/thumbs/edit_pen.png'/></a>";
			echo " <a id='delcustomer_".$row['IDCLIENTE']."' onclick='delrowclient(this)'><img class='imgbutton' src='shared/thumbs/edit_del.png'/></a>";																				
			echo "</tr>";
		}
		echo "</tbody>";		
	}
	echo "</table>";
?>
