<?php
	include("../include/condb.php");
	$result=mysqli_query($db,"SELECT * FROM CLIENTE");
	$count=mysqli_num_rows($result);
	echo "<table>";
	echo "<caption>CAMBIAR MIS DATOS</caption>";
	echo "<tr>";
	echo "<td rowspan='7'><img src='shared/thumbs/imgprofile_first.png'></td>";
	echo "<td width='30%'><b>NOMBRE DE ACCESO:</b></td>";
	echo "<td colspan='2' width='30%' style='padding-left:20px;' >";
		if(empty($_SESSION['user_name'])){
			echo "<font size='3' style='float:left;font-weight:bold;color:gray' id='loginname'></font>"; 
		}else{
			echo "<font size='3' style='float:left;font-weight:bold;color:gray' id='loginname'>".$_SESSION['user_name']."</font>"; 
		}	
	echo "</td>";
	echo "<td width='15%'><a onclick='deluser(this)' >(Eliminar cuenta)</a></td>";
	echo "</tr>";
	echo "<tr>";
	echo "<td><b>NOMBRE COMPLETO:</b></td>";
		if(empty($_SESSION['full_name'])){
		echo "<td colspan='3' width='13%'><input style='width:90%;' autocomplete='off' id='' placeholder='NOMBRE DEL USUARIO'/></td>";
		}else{
		echo "<td colspan='3' width='13%'><input style='width:90%;' autocomplete='off' id='namefull' value='".$_SESSION['full_name']."' placeholder='NOMBRE DEL USUARIO'/></td>";
		}		

	echo "</tr>";
	echo "<tr>";
	echo "<td><b>TELEFONO:</b></td>";
	echo "<td colspan='3' width='13%'><input style='width:90%;' autocomplete='off' id='teluser' placeholder='TELEFONO'/></td>";
	echo "</tr>";
	echo "<tr>";
	echo "<td><b>CORREO-E:</b></td>";
	echo "<td colspan='3' width='13%'><input type='email' required style='width:90%;' autocomplete='off' id='mailuser' placeholder='CORREO-E:'/></td>";
	echo "</tr>";
	echo "<tr>";
	echo "<td width='13%'><b>PREGUNTA:</b></td>";
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
	echo "<td width='13%'><b>RESPUESTA:</b></td>";
	echo "<td colspan='3'><textarea id='responseuser' style='width:100%;' cols='20' rows='3'></textarea></td>";
	echo "</tr>";
		echo "<tr>";
		echo "<td colspan='4' id='updateusermessage'></td>";
		echo "</tr>";	
	echo "</table>";
	echo "<table class='commands'>";	
		echo "<tr>";
		echo "<td width='46%'></td>";	
		echo "<td width='18%'><a class='commandbutton' id='menu1'  onclick='updateUser(this)' >";
		echo "<img src='shared/thumbs/btsale_ok.png' align='left' style='padding-right:5px;'> Actualizar </a></td>";
		echo "</tr>";	
			echo "</table>";
	echo "<table>";
	echo "<caption>CAMBIAR MI CONTRASEÑA</caption>";
	echo "<tr>";
	echo "<td width='30%'><b>CONTRASEÑA ACTUAL:</b></td>";	
	echo "<td><input id='password1'  type='password' required='true' placeholder='Tu Contraseña'  autocomplete='off' '/><br/></td>";
	echo "</tr>";	
	echo "<tr>";
	echo "<td width='30%'><b>NUEVA CONTRASEÑA:</b></td>";		
	echo "<td><input  id='password2'  type='password' required='true' placeholder='Nueva Contraseña'  autocomplete='off'/><br/></td>";
	echo "</tr>";
	echo "<tr>";	
	echo "<td width='30%'><b>CONFIRAMR CONTRASEÑA:</b></td>";	
	echo "<td><input id='password3'  type='password' required='true' placeholder='Confirmar Contraseña'  autocomplete='off'/><br/></td>";	
	echo "</tr>";
		echo "<tr>";
		echo "<td colspan='4' id='updatepassmessage'></td>";
		echo "</tr>";	
	echo "</table>";
	echo "<table class='commands'>";	
		echo "<tr>";
		echo "<td width='46%'></td>";	
		echo "<td width='18%'><a class='commandbutton' id='menu1'  onclick='updatePass(this)' >";
		echo "<img src='shared/thumbs/btsale_ok.png' align='left' style='padding-right:5px;'> guardar cambios </a></td>";
		echo "</tr>";	
	echo "</table>";				

?>