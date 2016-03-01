<?php
	include("../include/condb.php");
	echo "<table>";
	echo "<caption>AGREGAR UN NUEVO TIPO PRODUCTO - CATEGORIA -</caption>";
	echo "<tr>";
	echo "<td rowspan='7'><img src='shared/thumbs/imgcategoryclass_first.png'></td>";
	echo "<tr>";
	echo "<td width='10%'><b>CATEGORIA:</b></td>";
	echo "<td colspan='3'><input id='nomcategory' style='width:96%;'  placeholder='NOMBRE DE LA CATEGORIA '/></td>";
	echo "</tr>";
	echo "<tr>";
	echo "<td width='13%'><b>VALOR DE CONTADO:</b></td>";
	echo "<td><input  type='number' step='any' id='inventoryprice1' placeholder='VALOR DE CONTADO'/></td>";
	echo "<td width='13%'><b>VALOR A CREDITO:</b></td>";
	echo "<td><input  type='number' step='any' id='inventoryprice2'  placeholder='VALOR A CREDITO'/></td>";
	echo "</tr>";
	echo "<tr>";
	echo "<td width='13%'><b>CANT. MINIMA:</b></td>";
	echo "<td><input  type='number' step='any' id='inventorycant' placeholder='CANTIDAD MINIMA'/></td>";
	echo "</tr>";
	echo "</table>";
	/*botones*/
	echo "<table class='commands'>";	
		echo "<tr>";	
		echo "<td width='18%'><a class='commandbutton' id='menu1'  onclick='addNewCategory(this)' >";
		echo "<img src='shared/thumbs/btsale_add.png' align='left' style='padding-right:5px;'> Agregar </a></td>";
		echo "</tr>";	
	/*menssages*/
		echo "<tr>";
		echo "<td colspan='4' id='inventorymessage'></td>";
		echo "</tr>";	
	echo "</table>";			
	$result=mysqli_query($db,"SELECT * FROM INVENTARIO");
	$count=mysqli_num_rows($result);	
	echo "<table id='tableinventory' >";
	echo "<caption>LISTA DE CATEGORIAS EN EL SISTEMA</caption>";
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
			echo "<th>ULTIMA MODIFICAION</th>";
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
				echo "<td><a id='editinventoryclass_".$row['IDINVENTARIO']."' onclick='editrowinventory(this)'><img class='imgbutton' src='shared/thumbs/edit_pen.png'/></a>";
				echo " <a id='seeinventoryclass_".$row['IDINVENTARIO']."' onclick='seerowinventoryclass(this)'><img class='imgbutton' src='shared/thumbs/edit_see.png'/></a>";																				
			echo "</tr>";
		}
		echo "</tbody>";		
	}
	echo "</table>";
?>