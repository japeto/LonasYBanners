<?php
	include("../include/condb.php");	
	$result=mysqli_query($db,"SELECT * FROM CLIENTE");
	echo "<form>";
	echo "<div id='headersale'>";
	echo "<table id='headinvoice'>";	
		echo "<caption>CREAR UNA NUEVA FACTURA</caption>";
		echo "<tr id='row1' >";
		echo "<td><b>CLIENTE:</b></td>";
		echo "<td> <select id='cmbClient' style='width:100%;'>";
		echo "<option value='-1' selected>  </option>";
		while($row = mysqli_fetch_assoc($result)) {
			echo"<option value=".$row['IDCLIENTE'].">".$row['NOMBRECLIENTE']."</option>";
		}
		echo "</select></td>";												
		echo "<td><b>FACTURA No.:</b></td></b><td><input id='codinvoice' style='width:100px; float:left;margin-left:10px' /></td>";
		
		echo "<div class='formhide' id='feeform' >";
		echo "<h4>Establezca la fecha de pago de pago</h4>";
		echo "<input type='date' id='datefee' value='".date('Y-m-d', time())."'/><br/><br/>";
		echo "<span class='commandbutton' id='setdate'>Aceptar</span>";
		echo "<span class='commandbutton' id='exit'>Cancelar</span>";
		echo"</div>";
			
		echo "</tr>";		
		echo "<tr>";
		echo "<td><b>DIRECCION:</b></td><td style='float:left; padding:3px 3px 3px 10px;'>";
		echo "</b><span id='clientaddress'></span></td>";
		echo "<td><b>FECHA DE FACTURA:</b></td><td id='dateinvoice' style='float:left; padding:3px 3px 3px 10px;'>".date("d-m-Y")."</td>";
		echo "</tr>";
		
		echo "<tr>";
		echo "<td><b>TELEFONO:</b></td><td style='float:left; padding:3px 3px 3px 10px;'>";
		echo "</b><span id='clientphone'></span></td>";
		echo "<td><b>FORMA DE PAGO:</b></td><td id='paybill' style='float:left; padding:3px 3px 3px 10px;'>CONTADO</td>";
		echo "<td><a id='typepay'>";
		echo "<img class='imgbutton' src='shared/thumbs/edit_pen.png'/></a></td>";
		echo "</tr>";
		
		echo "<tr>";
		echo "<td><b>CIUDAD:</b></td><td style='float:left; padding:3px 3px 3px 10px;'>";
		echo "</b><span id='clientciudad'></span></td>";
		echo "<td><b>ESTADO DE CREDITO:</b></td><td id='statepaybill' style='float:left; padding:3px 3px 3px 10px;'>CANCELADO</td>";
		echo "</tr>";		
	echo "</table>";	
	echo "</div>";
	echo "<hr width='90%'/>";	
	
	echo "<table>";
		echo "<thead>";
		echo "<tr>";
			echo "<th>Cantidad</th>";
			echo "<th>Descripcion</th>";
			echo "<th>Precio. 1</th>";
			echo "<th>Precio. 2</td>";	
			echo "<th>Precio. 3</td>";				
		echo "</tr>";
		echo "</thead>";	
		echo "<tr>";
		echo "<td width='7%'><input style='width:80px;' autocomplete='off' id='quatity'  placeholder='1'/></td>";
		$result=mysqli_query($db,"SELECT * FROM PRODUCTO");
		echo "<td width='40%'> <select id='cmbProduct' style='width:100%;'>";
		echo "<option disabled value='0' selected> -- Escoja un producto -- </option>";
		while($row = mysqli_fetch_assoc($result)) {
			echo'<OPTION VALUE="'.$row['IDPRODUCTO'].'">'.$row['CODPRODUCTO'].'</OPTION>';			
		}				
		echo "</select></td>";
		echo "<td width='6%'>$ <span id='value1product'></span></td>";
		echo "<td width='6%'>$ <span id='value2product'></span></td>";
		echo "<td width='6%'>$ <input id='value3product' style='width:70px;' autocomplete='off' id='value' placeholder='0'/></td>";
		echo "</tr>";	
		
		echo "<tr>";
		echo "<td><a class='buttonlink' id='delitem'  onclick='addItem(this)' >";
		echo "<img src='shared/thumbs/btsale_add.png'align='left' style='padding-right:5px;'>Agregar</a></td>";
		echo "<td><a class='buttonlink' id='delitem'  onclick='delItem(this)' >";
		echo "<img src='shared/thumbs/btsale_del.png'align='left' style='padding-right:5px;'>Eliminar</a></td>";
		echo "</tr>";
			
		echo "<tr>";
		echo "<td colspan='5' id='billmesage'></td>";
		echo "</tr>";
	echo "</table>";	
																	
	echo "<div id='details' style='width:99%;'>";	
		echo "<table id='detailstable'>";
		echo "<caption></caption>";
		echo "<thead>";
		echo "<tr>";
			echo "<th>COD. PRODUCTO</th>";
			echo "<th>CANTIDAD</th>";
			echo "<th>DESCRIPCIÓN</th>";
			echo "<th>MTS.</td>";
			echo "<th>VALOR MT2</th>";
			echo "<th>V. UNIDAD</th>";
			echo "<th>V. TOTAL</th>";		
		echo "</tr>";
		echo "</thead>";
		echo "<tbody>";										
		echo "</tbody>";				
	echo "</table>";	
	echo "</div>";
	
	echo "<div id='totals' style='width:99%;float: inherit;'>";
		echo "<table>";								
		echo "<tr>";
			echo "<td width='13%' style='float:right;'>SUBTOTAL </td>";
			echo "<td width='13%'>$ <input id='subvaluebill' style='width:70px;' autocomplete='off' value=0 placeholder='0' READONLY /></td>";
		echo "</tr>";	
		echo "<tr>";
			echo "<td width='13%'style='float:right;'>DESCUENTO</td>";
			echo "<td width='13%'>$ <input id='discountbill' style='width:70px;' autocomplete='off'  value=0 placeholder='0'/></td>";
		echo "</tr>";
		echo "<tr>";
			echo "<td width='13%' style='float:right;'>ABONO</td>";
			echo "<td width='13%'>$ <input id='feevaluebill' style='width:70px;' autocomplete='off'  value=0 placeholder='0'/></td>";
		echo "</tr>";	
		echo "<tr>";
			echo "<td width='13%' style='float:right;'>TOTAL</td>";
			echo "<td width='13%'>$ <input id='valuebill' style='width:70px;' autocomplete='off' value=0 placeholder='0' READONLY/></td>";
		echo "</tr>";	
		echo "<hr width='90%'/>";											
		echo "</table>";		
	echo "</div>";	
	echo "</div>";
	
	echo "<div id='msg' style='width:99%;float: inherit;'>";	
		echo "<hr width='90%'/>";	
		echo "<i><font color = '#F00'> PONEMOS LA MEJOR CALIDAD, USTED LA MEJOR IMAGEN</font></i>";
	echo "</div>";	
	
	echo "<div id='image' style='width:99%;float: inherit;'>";	
		echo "<hr width='90%'/>";	
		echo "<img src='shared/thumbs/barcode_lg.jpg'>";		
	echo "</div>";
	/*botones*/
	echo "<table class='commands'>";	
		echo "<tr>";
		echo "<td width='46%'></td>";
		echo "<td width='18%'><a class='commandbutton' id='menu1'  onclick='newSale(this)' >";
		echo "<img src='shared/thumbs/btsale_cancel.png' align='left' style='padding-right:5px;'> Anular </a></td>";	
		
		echo "<td width='18%'><a class='commandbutton' id='menu1'  onclick='invoiceSave(this)' >";
		echo "<img src='shared/thumbs/btsale_ok.png' align='left' style='padding-right:5px;'> Facturar </a></td>";
		
		echo "<td width='18%'><a class='commandbutton' id='menu1'  onclick='invoicePrint(this)' >";
		echo "<img src='shared/thumbs/btprint.png'align='left' style='padding-right:5px;'> Imprimir </a></td>";
		echo "</tr>";	
	echo "</table>";
	
	echo "</form>";
	echo "</body>";
?>
