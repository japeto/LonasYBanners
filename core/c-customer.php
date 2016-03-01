<?php
	include("../include/condb.php");
	echo "<table>";
	echo "<caption>AGREGAR UN NUEVO CLIENTE</caption>";
	echo "<tr>";
	echo "<td rowspan='7'><img src='shared/thumbs/imgclient_first.png'></td>";
	echo "<td width='30%'><b>NOMBRE DE LA EMPRESA:</b></td>";
	echo "<td colspan='3' width='13%'><input style='width:90%;' autocomplete='off' id='companyclient' placeholder='NOMBRE DE LA EMPRESA'/></td>";
	echo "</tr>";
	echo "<tr>";
	echo "<td><b>NOMBRE DEL CONTACTO:</b></td>";
	echo "<td colspan='3' width='13%'><input style='width:90%;' autocomplete='off' id='contactclient' placeholder='NOMBRE DEL CONTACTO'/></td>";
	echo "</tr>";
	echo "<tr>";
	echo "<td><b>DIRECCION:</b></td>";
	echo "<td colspan='3' width='13%'><input style='width:90%;' autocomplete='off' id='addressclient' placeholder='DIRECCION'/></td>";
	echo "</tr>";
	echo "<tr>";
	echo "<td><b>TELEFONO:</b></td>";
	echo "<td colspan='3' width='13%'><input style='width:90%;' autocomplete='off' id='phoneclient' placeholder='TELEFONO'/></td>";
	echo "</tr>";
	echo "<tr>";
	echo "<td><b>CORREO-E:</b></td>";
	echo "<td colspan='3' width='13%'><input style='width:90%;' autocomplete='off' id='mailclient' placeholder='CORREO-E:'/></td>";
	echo "</tr>";
	echo "<tr>";
	echo "<td><b>NIT / ID :</b></td>";
	echo "<td colspan='3' width='13%'><input style='width:90%;' autocomplete='off' id='nitclient' placeholder='NIT / ID'/></td>";
	echo "</tr>";
	echo "<tr>";
	echo "<td width='13%'><b>MUNICIPIO:</b></td>";
	$result=mysqli_query($db,"SELECT * FROM CIUDAD");
	echo "<td width='20%'> <select id='cmbcity' style='width:80%;'>";
	echo "<option value='-1' selected> -- Escoja un municipio -- </option>";		
		while($row = mysqli_fetch_assoc($result)) {				
			if($row['CDESCRIPCION']==="CALI"){
			echo"<option id ='ciudad_".$row['IDCIUDAD']."' value='".$row['CDESCRIPCION']."' selected='selected'> ".$row['CDESCRIPCION']."</option>";		
			}		
			echo"<option id ='ciudad_".$row['IDCIUDAD']."' value='".$row['CDESCRIPCION']."'> ".$row['CDESCRIPCION']."</option>";		
		}
	echo "</select></td>";
	echo "<td width='10%'><b>DEPTO.:</b></td>";
	echo "<td><input style='width:80%;' autocomplete='off' id='inDepto' placeholder='DEPARTAMENTO'/></td>";
	echo "</tr>";
	echo "<tr>";
	echo "</td id = '' ></td>";	
	echo "</tr>";	
	echo "</table>";
	
	/* botones */
	echo "<table class='commands'>";	
		echo "<tr>";
		echo "<td width='46%'></td>";
		echo "<td width='18%'><a class='commandbutton' id=''  onclick='delClient(this)' >";
		echo "<img src='shared/thumbs/btsale_del.png' align='left' style='padding-right:5px;'> Eliminar </a></td>";	
		echo "<td width='18%'><a class='commandbutton' id=''  onclick='addNewClient(this)' >";
		echo "<img src='shared/thumbs/btsale_add.png' align='left' style='padding-right:5px;'> Agregar </a></td>";
		echo "</tr>";	
	/* mensajes*/	
		echo "<tr>";
		echo "<td colspan='4' id='clientmessage'></td>";
		echo "</tr>";		
	echo "</table>";			
	echo "<table id='tablecustomer'>";
	$result=mysqli_query($db,"SELECT * FROM CLIENTE,CIUDAD WHERE CIUDEPTOCLIENTE=IDCIUDAD");
	$count=mysqli_num_rows($result);
	echo "<caption>LISTA DE CLIENTES EN EL SISTEMA</caption>";
	if($count===0) {
		echo "<thead>";
		echo "<tr>";
			echo "<th>NOMBRE</th>";
			echo "<th>DIRECCION</th>";
			echo "<th>CIUDAD</th>";
			echo "<th>TELEFONO</th>";
			echo "<th>NIT</th>";
			echo "<th>CORREO</th>";			
			echo "<th>CONTACTO</th>";	
			echo "<th>ACCION</th>";				
		echo "</tr>";
		echo "</thead>";	
		echo "<tbody>";
		echo "<tr>";
			echo "<td colspan='8' > <font size='3' color='blue'>NO HAY CLIENTES</font> </td>";
		echo "</tr>";
		echo "</tbody>";		
	}else {
		echo "<thead>";
		echo "<tr>";
			echo "<th>NOMBRE</th>";
			echo "<th>DIRECCION</th>";
			echo "<th>CIUDAD</th>";
			echo "<th>TELEFONO</th>";
			echo "<th>NIT</th>";
			echo "<th>CORREO</th>";			
			echo "<th>CONTACTO</th>";
			echo "<th width='8%'>ACCION</th>";										
		echo "</tr>";
		echo "</thead>";
		echo "<tbody>";									
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
			echo " <a id='seecustomer_".$row['IDCLIENTE']."' onclick='seerowclient(this)'><img class='imgbutton' src='shared/thumbs/edit_see.png'/></a></td>";																							
			echo "</tr>";
		}
		echo "</tbody>";		
	}
	echo "</table>";
?>