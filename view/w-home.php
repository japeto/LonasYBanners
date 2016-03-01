<?php
	echo "<!doctype html>";
	echo "<html lang='es'>";
	echo "<head>";
	echo "<meta charset='UTF-8' />";
	echo "<title> SIGO </title>";
	echo "<link rel='stylesheet' href='shared/style.css'/>";
	echo "<script src='manager/jquery.min.js'></script>";
	echo "<script src='manager/jtransitions.home.js'></script>";
	echo "</head>";
	echo "<body>";
	
		echo "<div id='scrollingDiv' class='formhide'>";
		echo "<h4>INFORMACION</h4>";
		echo "<span id='lowquanti'></h4>";		
		echo"</div>";
	
	echo "<div id='main'  style='overflow: auto;'>";
	echo "<div id= 'header'>";
		echo "<p class='logout'>";
			echo "<b>Usuario: </b>"; 
			if(empty($_SESSION['full_name'])){
				echo "<i id='nameuser'> </i><br/>"; 
			}else{
				echo "<i id='nameuser'>".$_SESSION['full_name']."</i><br/>"; 
			}
		echo "(<a class='labellogin' style='color:red;' href='core/c-logout.php'>cerrar session</a>) </p> ";  //logout
	echo "</div>"; //header
	echo "<div id='content'>";
		echo "<div id='menu'>";
		echo "<ul>";//principal
			echo "<li><li class='active'><h3><span class='icon-Principal'></span> Principal</h3>";
			echo "<ul>";
			echo "<li><a class='item' id='menu1'  onclick='outstanding(this)' >Resumen </a></li>";
			echo "<li><a class='item' id='menu 2' onclick='newSale(this)' >Nueva Factura</a></li>";
			echo "<li><a class='item' id='menu 3' onclick='newCustomer(this)' >Nuevo Cliente </a></li>";
			echo "<li><a class='item' id='menu 4' onclick='newProduct(this)' >Nuevo Producto </a></li>";
		echo "</ul>";
			echo "<li><li class='active'><h3><span class='icon-Principal'></span> Factura y ventas</h3>";
		echo "<ul>";
			echo "<li><a class='item' id='menu 17' onclick='newSale(this)' >Nueva Factura</a></li>";		
			echo "<li><a class='item' id='menu 5'  onclick='invoices(this)' >Buscar Factura</a></li>";
			echo "<li><a class='item' id='menu 5'  onclick='reports(this)' >Reportes</a></li>";			
		echo "</ul>";
			echo "<li><li class='active'><h3><span class='icon-Principal'></span> Abonos y cuotas</h3>";
		echo "<ul>";
			echo "<li><a class='item' id='menu 6'  onclick='fee(this)' >Nuevo abono</a></li>";
			echo "<li><a class='item' id='menu 7'  onclick='seekfee(this)' >Buscar abono </a></li>";
		echo "</ul>";
			echo "<li><li class='active'><h3><span class='icon-Principal'></span> Clientes</h3>";
		echo "<ul>";
			echo "<li><a class='item' id='menu 8'  onclick='newCustomer(this)' >Nuevo Cliente </a></li>";
			echo "<li><a class='item' id='menu 9'  onclick='seekCustomer(this)' >Buscar Cliente </a></li>";
		echo "</ul>";
			echo "<li><li class='active'><h3><span class='icon-Principal'></span> Productos</h3>";
		echo "<ul>";
			echo "<li><a class='item' id='menu 10'  onclick='newProduct(this)' >Nuevo Producto </a></li>";
			echo "<li><a class='item' id='menu 11'  onclick='seekProduct(this)' >Buscar Producto </a></li>";
		echo "</ul>";
			echo "<li><li class='active'><h3><span class='icon-Principal'></span> Mercaderia y almacen </h3>";
		echo "<ul>";
			echo "<li><a class='item' id='menu 13'  onclick='inventoryclass(this)' >Nueva Categoria </a></li>";		
			echo "<li><a class='item' id='menu 12'  onclick='inventory(this)' >Inventario </a></li>";
		echo "</ul>";
			echo "<li><li class='active'><h3><span class='icon-Principal'></span> Sesion </h3>";
		echo "<ul>";
			echo "<li><a class='item' id='menu 14'  onclick='profile(this)' ></i>Mi perfil</a></li>";
			if(!empty($_SESSION['root'])){
				echo "<li><a class='item' style='color:orange;' id='menu 15'  onclick='admin(this)' ></i>Administracion</a></li>";            
			}
			echo "<li><a class='item' id='menu 16'  style='color:red;' href='core/c-logout.php' >Salir</a></li>";
		echo "</ul>";
		echo "</div>"; //menu
		echo "<div id='area' >";
		echo "<h1> SOFTWARE DE GESTIÓN </h1>";
//		echo "<img style='float:left; padding:20px;' src='shared/thumbs/imgtoday_first.png' height='128' width='128'>";
	if(empty($_SESSION['full_name'])){
		include("../core/c-home.php");					
	}else{
		include("core/c-home.php");					
	}		
		echo "</div>"; 	//area
	echo "</div>"; 	//content
	echo "<div id='footer'>";
	echo "Copyright © 2014-2015 jefferson amado peña  -- jeffersonamado@gmail.com ";
	echo "</div>"; //footer
	echo "</div>"; //main
	echo "</body>";
	echo "</html>";
?>
