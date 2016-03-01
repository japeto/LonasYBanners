<?php
echo "<div style='padding:50px;' >";
echo "<div id='period' style='background:#ccc;padding:25px;border-radius: 3px;'>";
echo "<table>";
echo "<tr>";
echo "<caption><span>por fechas</span></caption>";
echo "</tr>";
echo "<tr>";
echo "<td>Ventas</td>";
echo "<td>Desde: <input type='date' id='sdate'  /></td>";
echo "<td>Hasta: <input type='date' id='edate'  /></td>";
echo "</tr>";
echo "<tr style='background:#ccc;'>";
echo "<td>Vencimiento</td>";
echo "<td>Desde: <input type='date' id='svdate'  /></td>";
echo "<td>Hasta: <input type='date' id='evdate'  /></td>";
echo "</tr>";
echo "</table>";
echo "</div>";

echo "<div id='codes' style='background:#e6e6e6;padding:25px;border-radius: 3px;'>";
echo "<table>";
echo "<tr>";
echo "<caption><span>por codigos de factura</span></caption>";
echo "</tr>";
echo "<tr>";
echo "<td>Desde el codigo: <input type='number' id='scode' /></td>";
echo "<td>Hasta el codigo: <input type='number' id='ecode'/></td>";
echo "</tr>";
echo "</table>";
echo "</div>";

echo "<div id='all' style='background:WhiteSmoke;padding:25px;border-radius: 3px;'>";
echo "<table>";
echo "<tr>";
echo "<caption><span>Generar</span></caption>";
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
echo "</tr>";
echo "</table>";
echo "<a id='genreport' class='commandbutton' style='float:center' >GENERAR REPORTE</a>";
echo "</div>";
echo "</div>";
?>