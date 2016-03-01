<?php
	include("../include/condb.php");
	echo "<table>";
	echo "<caption>CAMBIAR EL INVENTARIO</caption>";
	echo "<tr>";
	echo "<td rowspan='8'><img src='shared/thumbs/imgcategory_first.png'></td>";
	echo "</tr>";	
	echo "<td width='10%'><b>MOVIMIENTO:</b></td>";
	echo "<td colspan='2'><select id='inventorymove' style='width:90%;' placeholder='TIPO DE MOVIMIENTO'>";
	echo "<option value='-1' selected disabled='disabled'> -- Escoja el movimiento -- </option>";		
	echo "<option value='1' >ACTUALIZAR CANTIDADES</option>";
	echo "<option value='2' >CAMBIAR PRECIOS</option>";	
	echo "</select>";
	echo "<td width='10%'><font id='inventorymessage' >MENSAJE</font></td>";
	echo "</tr>";
	echo "<tr>";
	echo "<td width='10%'><b>CATEGORIA:</b></td>";
	$result=mysqli_query($db,"SELECT * FROM INVENTARIO");	
	echo "<td colspan='2'> <select id='inventorycat' style='width:90%;' selectedIndex='-1'>";	
	echo "<option value='-1' selected disabled='disabled'> -- Escoja una categoria -- </option>";	
	while($row = mysqli_fetch_assoc($result)) {				
		echo"<option id ='categ_".$row['IDINVENTARIO']."' value='".$row['IDINVENTARIO']."'> ".$row['NOMBREPRODUCTO']."</option>";		
	}			
	echo "</select></td>";
	echo "<tr>";
	echo "</tr>";	
	echo "<tr>";
	echo "<td width='13%' id='lblwidth' >ANCHO:</td>";
	echo "<td><input type='number' step='any' id='inventoryfield1' placeholder='' required /></td>";
	echo "<td width='13%' id='lbllong' >LARGO:</td>";
	echo "<td><input type='number' step='any' id='inventoryfield2' placeholder='' required /></td>";
	echo "</tr>";
	echo "<tr id='rowquant'>";
	echo "<td width='13%' id='lblquant' ><b>UNIDADES:</b></td>";
	echo "<td><input type='number' step='any' id='inventoryqua' placeholder='UNIDADES COMPRADAS'/></td>";
	echo "</tr>";
	echo "</table>";
	/*botones*/
	echo "<table class='commands'>";	
		echo "<tr>";
		echo "<td width='46%'></td>";
		echo "<td width='18%'><a class='commandbutton' id='menu1'  onclick='changeInventory(this)' >";
		echo "<img src='shared/thumbs/btsale_ok.png' align='left' style='padding-right:5px;'> Aceptar </a></td>";
		echo "</tr>";	
	echo "</table>";
	$result=mysqli_query($db,"SELECT * FROM INVENTARIO;");
	$count=mysqli_num_rows($result);	
	echo "<table id='tableinventory' >";
	echo "<caption>RESULTADOS DE LA BUSQUEDA<font style='float:right;' color='black'> ".$count." Resultados</font> </caption>";
	if($count===0) {
		echo "<thead>";
		echo "<tr>";
			echo "<th>CATEGORIA</th>";
			echo "<th>DISPONIBLE</th>";
			echo "<th>VAL. CONTADO</th>";
			echo "<th>VAL. CREDITO</th>";
			echo "<th>ULTIMA MODIFICAION</th>";
			echo "<th>LIMITE</th>";						
			echo "<th>ACCION</th>";			
		echo "</tr>";
		echo "</thead>";	
		echo "<tbody>";
		echo "<tr>";
			echo "<td colspan='8' > <font size='2' color='blue'>NO HAY CATEGORIAS EN INVENTARIO</font> </td>";
		echo "</tr>";
		echo "</tbody>";		
	}else {
		echo "<thead>";
		echo "<tr>";
			echo "<th>CATEGORIA</th>";
			echo "<th>DISPONIBLE</th>";
			echo "<th>VAL. CONTADO</th>";
			echo "<th>VAL. CREDITO</th>";
			echo "<th>ULTIMA MODIFICACION</th>";
			echo "<th>LIMITE</th>";						
			echo "<th>ACCION</th>";			
		echo "</tr>";
		echo "</thead>";
		echo "<tbody>";									
		while($row = mysqli_fetch_assoc($result)) {
			echo "<tr id='customer_".$row['IDINVENTARIO']."'>";
				echo "<td class='editable' id='NOMBREPRODUCTO_".$row['IDINVENTARIO']."'>".$row['NOMBREPRODUCTO']."</td>";
				echo "<td id='CANTIDADENINVENTARIO_".$row['IDINVENTARIO']."' >".$row['CANTIDADENINVENTARIO']."</td>";
				echo "<td class='editable' id='VCONTADOINVENTARIO_".$row['IDINVENTARIO']."'>".$row['VCONTADOINVENTARIO']."</td>";
				echo "<td class='editable' id='VCREDITOINVENTARIO_".$row['IDINVENTARIO']."' >".$row['VCREDITOINVENTARIO']."</td>";
				echo "<td id='FECHAINVENTARIO_".$row['IDINVENTARIO']."'>".$row['FECHAINVENTARIO']."</td>";
				echo "<td class='editable' id='LIMITEENINVENTARIO_".$row['IDINVENTARIO']."'>".$row['LIMITEENINVENTARIO']."</td>";				
				echo "<td><a id='editinventory_".$row['IDINVENTARIO']."' onclick='editrowinventory(this)'><img class='imgbutton' src='shared/thumbs/edit_pen.png'/></a>";
				echo " <a id='delinventory_".$row['IDINVENTARIO']."' onclick='delrowinventory(this)'><img class='imgbutton' src='shared/thumbs/edit_del.png'/></a></td>";																			
			echo "</tr>";
		}
		echo "</tbody>";		
	}
	echo "</table>";
?>
