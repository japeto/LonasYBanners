/**
 * Jefferson Amado Peña Torres
 * jeffersonamado@gmail.com
 */
 
var sizeCategories =Array();
var limitsCategories=Array();
var namesCategories=Array();

$(document).ready(function(){
    $(this).scrollTop(90);
        var $scrollingDiv = $("#scrollingDiv");

        $(window).scroll(function(){            
            $scrollingDiv
                .stop()
                .animate({"marginTop": ($(window).scrollTop() )}, "slow" );         
        });
		loadCategories();
});

function loadCategories(){
	$.ajax({
		type: "POST",
		url: "core/b-sale.php",
		data: "categories",
		cache: false,
		success: function(response){
			var objects = jQuery.parseJSON(response);
			if(objects.result){
				var index =1;
				while (objects.categories[index] != undefined){

					if(parseInt(objects.categories[index]) < parseInt(objects.limits[index])){
						$("#scrollingDiv").css("display", "block");
						$("#scrollingDiv h4").text("ADVERTENCIA");
						$("#scrollingDiv #lowquanti").append("<span>La categoria <b>"+objects.names[index]+"</b> ESTA POR ACABARSE <br/></span><br/>");
					}
					index++;
				}				
			}else{	
//				alert(response)
			}
		}
	});	
}

 /*nuevo pendientes	*/
function outstanding(event){
	$("#area").load("view/w-main.php");
	event.preventDefault; 
}
/*nueva venta*/
function newSale(event){
	$("#area").load("view/w-sale.php");
	event.preventDefault; 
}
/*factuas*/
function invoices(event){
	$("#area").load("view/w-invoices.php");
	event.preventDefault; 
}
function reports(elem){
	$("#area").load("view/w-reports.php");	
	event.preventDefault; 
}

/*abonos*/
function fee(event){
	$("#area").load("view/w-fee.php");
	event.preventDefault; 
}
function seekfee(event){
	$("#area").load("view/w-seekfee.php");
	event.preventDefault; 
}
/*nuevo cliente*/
function newCustomer(event){
	$("#area").load("view/w-customer.php");
	event.preventDefault; 
}
function seekCustomer(event){
	$("#area").load("view/w-seekcustomer.php");
	event.preventDefault; 
}
/*nuevo producto*/
function newProduct(event){
	$("#area").load("view/w-product.php");
	event.preventDefault; 
}
function seekProduct(event){
	$("#area").load("view/w-seekproduct.php");
	event.preventDefault; 
}
/*inventario*/
function inventory(event){
	$("#area").load("view/w-inventory.php");
	event.preventDefault; 
}
function inventoryclass(event){
	$("#area").load("view/w-inventoryclass.php");
	event.preventDefault; 
}
/*perfil*/
function profile(event){
	$("#area").load("view/w-profile.php");
	event.preventDefault; 
}
function users(event){
	$("#area").load("view/w-usuarios.php");
	event.preventDefault; 
}
/*OTROS*/
function seeinvoice(elem){
	var opened = window.open("view/w-template.html",'_blank', 'width=650, height=600,toolbar=0,menubar=0,resizable=0');				
		opened.onload = function() {	
		var nclient;
		var dclient;
		var tclient;		
		var ccclient;	
		var nfactura;
		var ffactura;
		var fpago;	
		var stfactura;			
		var subval;
		var totalval;				
		var rows;
		
		$.ajax({
			type: "POST",
			url: "core/a-sale.php",
			cache: false,		
			async: false,		
			data: "showinvoice="+elem.id,
			success: function(response){   
				var objects = jQuery.parseJSON(response);				
				if(objects.result){
					nclient=objects.nclient;
					dclient = objects.dclient;
					tclient = objects.tclient;		
					ccclient = objects.ccclient;	
					nfactura = objects.nfactura;
					ffactura = objects.ffactura;
					fpago = objects.fpago;	
					stfactura = objects.stfactura;			
					subval = objects.subval;
					totalval = objects.totalval;				
					rows = objects.rows;		
				}
			}
		});	
		opened.document.getElementById("cliente").innerHTML = nclient;
		opened.document.getElementById("direccion").innerHTML = dclient;
		opened.document.getElementById("telefono").innerHTML = tclient;		
		opened.document.getElementById("ciudad").innerHTML = ccclient;	
		//right
		opened.document.getElementById("nfactura").innerHTML = nfactura;
		opened.document.getElementById("ffactura").innerHTML = ffactura;
		opened.document.getElementById("pfactura").innerHTML = fpago;	
		opened.document.getElementById("esfactura").innerHTML = stfactura;			
		//down
		opened.document.getElementById("sub").innerHTML = "$ "+subval;
		opened.document.getElementById("des").innerHTML = "$ 0"
		opened.document.getElementById("abon").innerHTML = "$ 0"
		opened.document.getElementById("total").innerHTML = "$ "+totalval;				
		//table
		opened.document.getElementById("contenido").innerHTML = rows;
		opened.document.getElementById("contenido").style.textAlign = "center";	
				
		}
}
function addfee(elem){
	$("#area").load("view/w-fee.php",function() {
		$("#feeinvoice").val(elem.id);
		$("#feeinvoice").keyup();
	});	
}
