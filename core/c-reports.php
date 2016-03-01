<?php
echo "<div style='padding:20px;' >";
echo "<div id='period' style='background:WhiteSmoke;padding:25px;border-radius: 3px;'>";
echo "<table>";
echo "<tr>";
echo "<caption><span>por fechas</span></caption>";
echo "</tr>";
echo "<tr>";
echo "<td>Ventas</td>";
echo "<td>Desde: <input type='date' id='sdate'  /></td>";
echo "<td>Hasta: <input type='date' id='edate'  /></td>";
echo "</tr>";
echo "<tr style='background:WhiteSmoke;'>";
echo "<td>Vencimiento</td>";
echo "<td>Desde: <input type='date' id='svdate'  /></td>";
echo "<td>Hasta: <input type='date' id='evdate'  /></td>";
echo "</tr>";
echo "</table>";
echo "<table>";
echo "<tr>";
echo "<caption><span>por codigos de factura</span></caption>";
echo "</tr>";
echo "<tr>";
echo "<td>Desde el codigo: <input type='number' id='scode' /></td>";
echo "<td>Hasta el codigo: <input type='number' id='ecode'/></td>";
echo "</tr>";
echo "</table>";
echo "<table>";
echo "<tr>";
/*echo "<caption><span>Generar</span></caption>";
echo "<td>Ordenar por...</td>";
echo "<td></td>";

echo "<td><select id='cmbOrder' style='width:50%'>";
echo "<option value='FECHAFACTURA' >FECHA</option>";
echo "<option value='CLIENTEFACTURA' >CLIENTE</option>";
echo "<option value='MONTOFACTURA' >MONTO</option>";
echo "<option value='USUARIOFACTURA' >VENDENDOR</option>";
echo "</select></td>";

echo "</tr>";
echo "<tr>";
echo "<td>Agrupar por...</td>";
echo "<td></td>";
echo "<td><select id='cmbGroup' style='width:50%;'>";
echo "<option value='DAY' >DIA</option>";
echo "<option value='MONTH' >MES</option>";
echo "<option value='YEAR' >AÑO</option>";
echo "</select>";
echo "</tr>";*/
echo "</table>";
echo "<a id='genreport' class='commandbutton' style='float:center' >GENERAR REPORTE</a>";
echo "</div>";
echo "<div id='all' style='padding:20px;border-radius: 3px;'>";
	echo "<table id='reportcommands' style='display:none;' >";	
		echo "<tr>";
		echo "<td width='2%'>";
						
		echo '<form action="core/c-export.php" method="post" target="_blank" id="FormularioExportacion">
<img class="imgbutton" id="exportreport" src="shared/thumbs/btexcel.png" align="left" style="padding-right:5px;">
<input type="hidden" id="nameexport" name="nameexport" />
<input type="hidden" id="datos_a_enviar" name="datos_a_enviar" />
</form>';	

		echo "<a class='imgbutton' id='prnt'  onclick='printreport(this)' >";
		echo "<img src='shared/thumbs/btprint.png'align='left' style='padding-right:5px;'> </a>";
				
		echo "</td>";	
		echo "</tr>";	
	echo "</table>";		
echo "<table id='tablereport' style='display:none;'>";
echo "<thead>";
echo "<tr>";
echo "<th>FECHA</th>";
echo "<th>CLIENTE</th>";
echo "<th>MONTO</td>";
echo "<th>VENCIMIENTO</th>";
echo "<th>VENDEDOR</th>";			
echo "</tr>";
echo "</thead>";	
echo "<tbody>";
echo "<tr>";
echo "</tr>";
echo "</tbody>";	
echo "</table>";
echo "</div>";
?>