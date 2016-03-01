<?php
	if(empty($_SESSION['user_name'])){
		include("../include/condb.php");
	}else{
		include("include/condb.php");
	}
	$result=mysqli_query($db,"SELECT * FROM FACTURA,CLIENTE,USUARIO WHERE ESTADOFACTURA='PENDIENTE' AND VENCIMIENTOFACTURA=cast(now() as date) AND CLIENTEFACTURA=IDCLIENTE AND USUARIOFACTURA=IDUSUARIO;");
	$count=mysqli_num_rows($result);
	echo "<table>";
	echo "<caption>LISTA DE FACTURAS PENDIENTES PARA HOY</caption>";
	if($count===0) {
		echo "<thead>";
		echo "<tr>";
			echo "<th>FECHA</th>";
			echo "<th>COD.FACTURA</th>";
			echo "<th>CLIENTE</th>";
			echo "<th>MONTO</td>";
			echo "<th>VENCIMIENTO</th>";
			echo "<th>RESPONSABLE</th>";
			echo "<th>ACCION</th>";			
		echo "</tr>";
		echo "</thead>";	
		echo "<tbody>";
		echo "<tr>";
			echo "<td colspan='8' > <font size='2' color='blue'>NO HAY FACTURAS PENDIENTES</font> </td>";
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
			echo "<th>RESPONSABLE</th>";
			echo "<th>ACCION</th>";				
		echo "</tr>";
		echo "</thead>";
		echo "<tbody>";									
		while($row = mysqli_fetch_assoc($result)) {
			echo "<tr>";
				echo "<td>".$row['FECHAFACTURA']."</td>";
				echo "<td>".$row['CODFACTURA']."</td>";
				echo "<td>".$row['NOMBRECLIENTE']."</td>";
				echo "<td>".$row['MONTOFACTURA']."</td>";
				echo "<td>".$row['VENCIMIENTOFACTURA']."</td>";
				echo "<td>".$row['CONTACTOCLIENTE']."</td>";																
				echo "<td><a id='".$row['CODFACTURA']."' onclick='seeinvoice(this)'><img class='imgbutton' src='shared/thumbs/edit_see.png'/></a>";
				echo " <a id='".$row['CODFACTURA']."' onclick='addfee(this)'><img class='imgbutton' src='shared/thumbs/btadd_fee.png'/></a>";																							
			echo "</tr>";
		}
		echo "</tbody>";		
	}
	echo "</table>";
echo "<span><font size='5' style='float:left;color:silver;text-decoration:underline;padding-left:45px;' >¿Que quieres hacer?</font></span>";	
echo "<table>";
//	echo "<caption><font size='3' style='float:left;color:silver;text-decoration:underline;' >¿Que quieres hacer?</font><caption>";
	echo "<tr>";
	echo "<td class='mainbutton' align='center' valign='center'>";
	echo "<a onclick='newSale(this)'><img class='imgbutton' src='shared/thumbs/imgbill_first.png' alt='description here' /> <br/>";
	echo "<b class='imgbutton' >Nueva venta</b></a>";
	echo "</td>";
	echo "<td class='mainbutton' clasalign='center' valign='center'>";
	echo "<a onclick='newProduct(this)'><img class='imgbutton' src='shared/thumbs/imgproduct_first.png' alt='description here' /> <br/>";
	echo "<b class='imgbutton' >Nuevo Producto</b></a>";
	echo "</td>";
	echo "<td class='mainbutton' clasalign='center' valign='center'>";
	echo "<a onclick='newCustomer(this)'><img class='imgbutton' src='shared/thumbs/imgclient_first.png' alt='description here' /> <br/>";
	echo "<b class='imgbutton' >Nuevo cliente</b></a>";
	echo "</td>";	
	echo "</tr>";
	echo "<tr>";
	echo "<td class=' mainbutton' align='center' valign='center'>";
	echo "<a onclick='inventory(this)'><img class='imgbutton ' src='shared/thumbs/imginventory_first.png' alt='description here' /> <br/>";
	echo "<b class='imgbutton' >Actualizar Inventario</b></a>";
	echo "</td>";
	echo "<td class='mainbutton' clasalign='center' valign='center'>";
	echo "<a onclick='invoices(this)'><img class='imgbutton' src='shared/thumbs/imgsche_first.png' alt='description here' /> <br/>";
	echo "<b class='imgbutton' >Ver facturas</b></a>";
	echo "</td>";	
	echo "<td class='mainbutton' align='center' valign='center'>";
	echo "<a onclick='profile(this)'><img class='imgbutton' src='shared/thumbs/imgprofile_first.png' alt='description here' /> <br/>";
	echo "<b class='imgbutton' >Mi Perfil</b></a>";
	echo "</td>";		
	echo "</tr>";	
	echo "</table>";		
?>
