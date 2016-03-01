<?php
	include("../include/condb.php");
	echo "<table>";
	echo "<caption>AGREGAR UN NUEVO PRODUCTO</caption>";
	echo "<tr>";
	echo "<td rowspan='7'><img src='shared/thumbs/imgproduct_first.png'></td>";
	echo "<tr>";
	echo "<td width='1%'><b>REFERENCIA:</b></td>";
	echo "<td><input id='refProduct' placeholder='REFERENCIA'/></td>";
	echo "<td width='10%'><b>CODIGO REF.:</b></td>";
	echo "<td><input id='codProduct' placeholder='CODIGO REF.'/></td>";
	echo "</tr>";
	echo "<tr>";
	echo "<td width='13%'><b>ANCHO:</b></td>";
	echo "<td><input type='number' step='any' required id='widthProduct' placeholder='ANCHO EN METROS'/></td>";
	echo "<td width='13%'><b>LARGO:</b></td>";
	echo "<td><input type='number' step='any' required  id='longProduct' placeholder='ALTO EN METROS'/></td>";
	echo "<tr>";
	echo "<td width='13%'><b>VOLUMEN:</b></td>";
	echo "<td><input id='volProduct' placeholder='VOLUMEN EN ONZAS'/></td>";
	echo "<td width='13%'><b>METROS CUADRADOS:</b></td>";
	echo "<td><input type='number' step='any' READONLY id='areaProduct' placeholder='METROS CUADRADOS'/></td>";
	echo "</tr>";
	echo "<tr>";
	$result=mysqli_query($db,"SELECT * FROM INVENTARIO");
	echo "<td width='13%'><b>CATEGORIA:</b></td>";
	echo "<td width='35%' > <select id='categoryProduct' style='width:80%;'>";	
	echo "<option value='-1' selected> -- Escoja una categoria -- </option>";		
	while($row = mysqli_fetch_assoc($result)) {				
		echo"<option id ='categ_".$row['IDINVENTARIO']."' value='".$row['NOMBREPRODUCTO']."'> ".$row['NOMBREPRODUCTO']."</option>";		
	}			
	echo "</select></td>";
	echo "</tr>";
	echo "<tr>";
	echo "<td width='13%'><b>DESCRIPCION:</b></td>";
	echo "<td colspan='3'><textarea id='descriProduct' style='width:100%;' cols='20' rows='3'></textarea></td>";
	echo "</tr>";
	echo "</table>";
	/*botones*/
	echo "<table class='commands'>";	
		echo "<tr>";
		echo "<td width='46%'></td>";
		echo "<td width='18%'><a class='commandbutton' id='menu1'  onclick='delProduct(this)' >";
		echo "<img src='shared/thumbs/btsale_del.png' align='left' style='padding-right:5px;'> Eliminar </a></td>";	
		echo "<td width='18%'><a class='commandbutton' id='menu1'  onclick='addNewProduct(this)' >";
		echo "<img src='shared/thumbs/btsale_add.png' align='left' style='padding-right:5px;'> Agregar </a></td>";
		echo "</tr>";	
	/* mensajes*/	
		echo "<tr>";
		echo "<td colspan='4' id='productmessage'></td>";
		echo "</tr>";		
	echo "</table>";		
	$result=mysqli_query($db,"SELECT * FROM PRODUCTO,INVENTARIO WHERE CATEGORIAPRODUCTO=IDINVENTARIO");
	$count=mysqli_num_rows($result);		
	echo "<table id='tableproducts'>";
	echo "<caption>LISTA DE PRODUCTOS EN EL SISTEMA</caption>";
	if($count===0) {
		echo "<thead>";
		echo "<tr>";
			echo "<th>COD. PRODUCTO</th>";
			echo "<th>REFERENCIA</th>";
			echo "<th>MEDIDAS</th>";
			echo "<th>VOLUMEN</th>";
			echo "<th>AREA</th>";
			echo "<th>DESCRIPCION</th>";			
			echo "<th>CATEGORIA</th>";	
			echo "<th>ACCION</th>";					
		echo "</tr>";
		echo "</thead>";	
		echo "<tbody>";
		echo "<tr>";
			echo "<td colspan='8' > <font size='3' color='blue'>NO HAY PRODUCTOS</font> </td>";
		echo "</tr>";
		echo "</tbody>";		
	}else {
		echo "<thead>";
		echo "<tr>";
			echo "<th>COD. PRODUCTO</th>";
			echo "<th>REFERENCIA</th>";
			echo "<th>MEDIDAS</th>";
			echo "<th>VOLUMEN</th>";
			echo "<th>AREA (M2)</th>";
			echo "<th>DESCRIPCION</th>";			
			echo "<th>CATEGORIA</th>";				
			echo "<th width='8%'>ACCION</th>";							
		echo "</tr>";
		echo "</thead>";
		echo "<tbody>";									
		while($row = mysqli_fetch_assoc($result)) {
			echo "<tr id='product_".$row['IDPRODUCTO']."'>";
			echo "<td class='editable' id='CODPRODUCTO_".$row['IDPRODUCTO']."' >".$row['CODPRODUCTO']."</td>";
			echo "<td class='editable' id='REFERENCIAPRODUCTO_".$row['IDPRODUCTO']."' >".$row['REFERENCIAPRODUCTO']."</td>";
			echo "<td class='' id='MEDIDASPRODUCTO_".$row['IDPRODUCTO']."' >".$row['MEDIDASPRODUCTO']."</td>";														
			echo "<td class='editable' id='VOLUMENPRODUCTO_".$row['IDPRODUCTO']."' >".$row['VOLUMENPRODUCTO']."</td>";														
			echo "<td class='' id='AREAPRODUCTO_".$row['IDPRODUCTO']."' >".$row['AREAPRODUCTO']."</td>";														
			echo "<td class='editable' id='DESCRIPCIONPRODUCTO_".$row['IDPRODUCTO']."' >".$row['DESCRIPCIONPRODUCTO']."</td>";																										
			echo "<td class='' id='NOMBREPRODUCTO_".$row['IDPRODUCTO']."' >".$row['NOMBREPRODUCTO']."</td>";	
																																
			echo "<td><a id='editproduct_".$row['IDPRODUCTO']."' onclick='editrowproduct(this)'><img class='imgbutton' src='shared/thumbs/edit_pen.png'/></a>";
			echo " <a id='delproduct_".$row['IDPRODUCTO']."' onclick='delrowproduct(this)'><img class='imgbutton' src='shared/thumbs/edit_del.png'/></a>";																								
			echo " <a id='seecustomer_".$row['IDPRODUCTO']."' onclick='seerowproduct(this)'><img class='imgbutton' src='shared/thumbs/edit_see.png'/></a></td>";																										
			echo "</tr>";
		}
		echo "</tbody>";		
	}
	echo "</table>";
?>