<?php
    echo "<!doctype html>";
    echo "<html lang='es'>";
    echo "<head>";
	echo "<meta charset='UTF-8' />";
	echo "<title>Sistema de Gestion Empresarial</title>";
	echo "<link rel='stylesheet' href='shared/styledefault.css'/>";
	echo "<script src='manager/jquery.min.js'></script>";
	echo "<script src='manager/jquery.ui.shake.js'></script>";
	echo "<script src='manager/jlogin.index.js'></script>";
	echo "</head>";
	echo "<body>";
	echo "<div id='main'>";
	echo "<div id='container'>";
	echo "<div class='forms'>";
	echo "<ul class='tabs'>";
	echo "<li>";
	echo "<a href='#login' class='active'>Entrada</a>";
	echo "</li>";
	echo "<li>";
//	echo "<a href='#reset'>Ayuda</a>";
	echo "</li>";
	echo "</ul>";
	echo "<div id='login' class='form-action show'>";
//	echo "<img src='shared/thumbs/avatar_main.png' />";
	echo "<form id='loginform' action='' method='post'>";
	echo "<input type='text' name='username' type='text' required='' placeholder='Usuario'  autocomplete='off' id='username'/>";
	echo "<br/>";
	echo "<input type='password' name='password'  type='password' required='' placeholder='Contraseña'  autocomplete='off' id='password'/><br/>";
		echo "<div id='error'></div>";
	echo "<br/>";
	echo "<input class='button' type='submit' class='button button-primary' value='Acceder' id='btnlogin'/>"; 
	echo "</form>";	
	echo "</div>";  
	echo "<!--/#login.form-action-->";
	
	echo "<div id='reset' class='form-action hide'>";	
	echo "<table>";
	echo "<tr>";		
		echo "<td colspan='3'><b>Recupera tu contraseña</b></td>";	
	echo "</tr>";			
	echo "<tr>";	
	echo "<td><b>Usuario:</b></td>";
	echo "<td><input type='text' required style='width:90%;'  id='userr' placeholder='Usuario'/></td>";
	echo "</tr>";
	echo "<tr>";
	echo "<td width='13%'><b>Pregunta:</b></td>";
	echo "<td colspan ='2' width='30%'> <select id='questionuser' style='width:90%;'>";
	echo "<option value='1'>¿Cual es la fecha de nacimiento de tu madre?</option>";
	echo "<option value='2'>¿Cual fue tu primer vehiculo?</option>";					
	echo "<option value='3'>¿Cual es tu cancion favorita?</option>";						
	echo "<option value='4'>¿Cual es el nombre de tu primera mascota?</option>";							
	echo "<option value='5'>¿Cual es tu equipo deportivo favorito?</option>";								
	echo "<option value='6'>¿Donde enterraste el tesoro pirata?</option>";									
	echo "</select></td>";
	echo "</tr>";
	echo "<tr>";
	echo "<td width='13%'><b>Respuesta:</b></td>";
	echo "<td colspan='3'><textarea id='responseuser' style='width:90%;' cols='20' rows='3'></textarea></td>";
	echo "</tr>";
		echo "<tr>";
		echo "<td colspan='4' id='updateusermessage'></td>";
		echo "</tr>";	
	echo "</table>";
	echo "<form id='loginform' action='' method='post'>";	
	echo "<input class='button' type='submit' class='button button-primary' value='Recuperar' id='btnrecup'/>"; 	
	echo "</form>";	
	echo "</div>";
	
	echo "<!--/#register.form-action-->";
	echo "</div>";
	
	echo "</body>";
	echo "</html>";
?>
