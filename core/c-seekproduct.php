<?php
	include("../include/condb.php");
	$result=mysqli_query($db,"SELECT * FROM PRODUCTO,INVENTARIO WHERE CATEGORIAPRODUCTO=IDINVENTARIO");
	$count=mysqli_num_rows($result);
	echo "<table>";
		echo "<caption>BUSCAR FACTURA</caption>";			
		echo "<tr>";
		echo "<td width='10%'><b>COD. PRODUCTO:</b></td>";
		echo "<td width='20%'><input id='codproduct' style='width:100%' id='' placeholder='COD. PRODUCTO'/></td>";
		echo "<td width='10%'><b>REFERENCIA:</b></td>";
		echo "<td width='20%'><input id='refproduct' style='width:100%' id='' placeholder='REFERENCIA'/></td>";		
		echo "<td width='10%'><b>CATEGORIA:</b></td>";
		echo "<td width='20%'><input id='catproduct' style='width:100%' id='' placeholder='CATEGORIA'/></td>";		
		echo "</tr>";		
	echo "</table>";
	/*buttons*/
	echo "<table class='commands'>";	
		echo "<tr>";
		echo "<td width='18%'><a class='commandbutton' id='menu1'  onclick='seekprouct(this)' >";
		echo "<img src='shared/thumbs/btseek.png' align='left' style='padding-right:5px;'> Buscar </a></td>";
		echo "</tr>";	
	/*messages*/
	/* mensajes*/	
		echo "<tr>";
		echo "<td colspan='4' id='productmessage'></td>";
		echo "</tr>";	
		echo "<tr>";
		echo "<td colspan='4' id='resultproduct'></td>";
		echo "</tr>";		
	echo "</table>";
		
	echo "<table id='tableproducts'>";
	echo "<caption>RESULTADOS DE LA BUSQUEDA<font id='countproduct' style='float:right;' color='black'> ".$count." Resultados</font> </caption>";
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
		echo "<tbody id='tablebodyroduct'>";
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
			echo "<th>ACCION</th>";				
		echo "</tr>";
		echo "</thead>";
		echo "<tbody id='tablebodyroduct'>";						
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
			echo "</tr>";
		}
		echo "</tbody>";		
	}
	echo "</table>";
?>
