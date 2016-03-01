/**
* Jefferson Amado Peña Torres
* jeffersonamado@gmail.com
*/
var sizeCategories =Array();
var limitsCategories=Array();
var namesCategories=Array();
var elementsInvoice= new Object();
var quantitiesInvoice= new Object();

$(document).ready(function() {
	loadCategories();
	$("#cmbClient").change(function() {
		updateClient($("#cmbClient").val()); 
	});
	$("#cmbProduct").change(function() {
		updateProduct($("#cmbProduct").val()); 
		$("#billmesage").text("");
	});	
	$("#discountbill").change(function() {
		if($("#discountbill").val()>0){
			$("#valuebill").val(parseInt($("#subvaluebill").val())-parseInt($("#feevaluebill").val())-parseInt($("#discountbill").val()));
		}else{
			$("#discountbill").val(0);
			$("#valuebill").val(parseInt($("#subvaluebill").val())-parseInt($("#feevaluebill").val())-parseInt($("#discountbill").val()));
		}			
	});	
	$("#feevaluebill").change(function() {
		if($("#feevaluebill").val()>0){
			$("#valuebill").val(parseInt($("#subvaluebill").val())-parseInt($("#feevaluebill").val())-parseInt($("#discountbill").val()));
		}else{
			$("#feevaluebill").val(0);
			$("#valuebill").val(parseInt($("#subvaluebill").val())-parseInt($("#feevaluebill").val())-parseInt($("#discountbill").val()));			
		}
	});	
});

$('#quatity').on('input', function() {
	var input=$(this);
    if(!$.isNumeric( input.val())){
		$(this).val("");
	}
});
$('#value3product').on('input', function() {
	var input=$(this);
    if(!$.isNumeric( input.val())){
		$(this).val("");
	}
});
$('#codinvoice').on('input', function() {
	var input=$(this);
    if(!$.isNumeric( input.val())){
		$(this).val("");
	}
});
$('#discountbill').on('input', function() {
	var input=$(this);
    if(!$.isNumeric( input.val())){
		$(this).val(0);
	}
});

$('#feevaluebill').on('input', function() {
	var input=$(this);
    if(!$.isNumeric( input.val())){
		$(this).val(0);
	}
});

function updateClient(index ){
	if(index>0){
		var idclient=$("#cmbClient").val();
		var client=$("#cmbClient option:selected").text();
		var dataString = 'idclient='+idclient+'&client='+client;
		$.ajax({
			type: "POST",
			url: "core/b-client.php",
			data: dataString,
			cache: false,
			beforeSend: function(){ 		
					$("#clientphone").text("Cargando...");		
					$("#clientciudad").text("Cargando...");		
					$("#clientaddress").text("Cargando...");},
			success: function(response){
			var objects = jQuery.parseJSON(response);
			if(objects.result === "true"){
					$("#clientphone").text(objects.TELEFONOCLIENTE);		
					$("#clientciudad").text(objects.CIUDADCLIENTE);		
					$("#clientaddress").text(objects.DIRECCIONCLIENTE );
			}else{
					$("#clientphone").text("No encontrado");		
					$("#clientciudad").text("No encontrado");		
					$("#clientaddress").text("No encontrado");				
			}}
		});
	}else{
		$("#clientphone").text("");		
		$("#clientciudad").text("");		
		$("#clientaddress").text("");						
	}
}

function updateProduct(index ){
	if(index>0){
		var idproduct=$("#cmbProduct").val();
		var product=$("#cmbProduct option:selected").text();
		var dataString = 'idproduct='+idproduct+'&product='+product;
		$.ajax({
			type: "POST",
			url: "core/b-product.php",
			data: dataString,
			cache: false,
			beforeSend: function(){ 		
					$("#value1product").text("Cargando...");		
					$("#value2product").text("Cargando...");},
			success: function(response){
			var objects = jQuery.parseJSON(response);
				if(objects.result === "true"){
						$("#value1product").text(objects.VCONTADOINVENTARIO);		
						$("#value2product").text(objects.VCREDITOINVENTARIO);		
				}else{
						$("#value1product").text("No encontrado");		
						$("#value2product").text("No encontrado");		
				}}
		});
	}else{
		$("#value1product").text("");		
		$("#value2product").text("");							
	}
}


$('#numinvoice').click(function(){
	$("#invoicediv").css("display", "block");
});

$('#typepay').click(function(){
	$("#feeform").css("display", "block");
});

$("#feeform #exit").click(function() {
	$(this).parent().hide();
});
$("#feeform #setdate").click(function() {
	$("#paybill").text("CREDITO");
	$("#statepaybill").text("PENDIENTE");
	$(this).parent().hide();
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
				sizeCategories = objects.categories;
				limitsCategories = objects.limits;
				namesCategories = objects.names;
			}else{	
//				alert(response)
			}
		}
	});
}

function addItem(event){
	var idproduct=$("#cmbProduct").val();
	var quatity=$("#quatity").val();
	var product=$("#cmbProduct option:selected").text();
	var reference="";
	var measures="";		
	var price="";	
	var uvalue="";	
	var tvalue="";	
	var state=true;

	if(quatity === ""){
		printInvoiceMessage("warning","DEBES ESTABLECER LA CANTIDAD A LLEVAR");
		return;		
	}
	if(quatity < 1){
		
		printInvoiceMessage("error","LA CANTIDAD DE NO PUEDE SER NEGATIVA");
		return;
	}
	if(idproduct == null){
		printInvoiceMessage("warning","DEBES SELECCIONAR UN PRODUCTO DE LA LISTA");
		return;
	}

	if($("#fila_"+product+"").attr("id") != undefined){
		var dataString = 'idproduct='+idproduct+'&product='+product;	
		$.ajax({
				type: "POST",
				async: false,
				url: "core/b-product.php",
				data: dataString,
				cache: false,
				success: function(response){			
				var objects = jQuery.parseJSON(response);
					if(objects.result === "true"){
						if(quatity*objects.AREAPRODUCTO>sizeCategories[objects.CATEGORIAPRODUCTO]){
							state=false;
						}else if(objects.DISPONIBLEPRODUCTO = 0){
							return;
						}else{					
							sizeCategories[objects.CATEGORIAPRODUCTO] = sizeCategories[objects.CATEGORIAPRODUCTO] - quatity*objects.AREAPRODUCTO;
						}
						reference= objects.REFERENCIAPRODUCTO;
						measures=objects.AREAPRODUCTO;

						if($("#value3product").val() != "" ){
							price=parseInt($("#value3product").val());
						}else if($("#paybill").text()==="CONTADO"){
							price=objects.VCONTADOINVENTARIO;
						}else if($("#paybill").text()==="CREDITO"){
							price=objects.VCREDITOINVENTARIO;
							$("#statepaybill").text("PENDIENTE");
						}		
						
					}else{
						reference="ERROR";
						measures="ERROR";
						price="ERROR";					
					}}
			});	
		if(state === true){
			uvalue= measures * price;
			tvalue= quatity * uvalue;		
			$("#subvaluebill").val(parseInt($("#subvaluebill").val())+tvalue);			
			$("#valuebill").val(parseInt($("#subvaluebill").val())-parseInt($("#feevaluebill").val())-parseInt($("#discountbill").val()));																
			quatity=parseInt(quatity)+parseInt($("#fila_"+product+" td:eq(1)").text());
			quantitiesInvoice["id"+idproduct+""] = quatity;		
			uvalue= measures * price;
			tvalue= quatity * uvalue;			
			var newRow = "<tr id='fila_"+product+"' ><td>"+product+"</td>"
										+"<td>"+quatity+"</td>"
										+"<td>"+reference+"</td>"								
										+"<td>"+measures+"</td>"																
										+"<td>$ "+price+"</td>"
										+"<td>$ "+uvalue+"</td>"
										+"<td>$ "+tvalue+"</td>"																																								
										+"</tr>";									
			$("#fila_"+product+"").replaceWith(newRow);									
			printInvoiceMessage("","EL PRODUCTO "+product+" FUE ACTUALIZADO");
		}else{
			printInvoiceMessage("error","LA CANTIDAD "+quatity+" PRODUCTO DEL "+product+" ES MAYOR AL DISPONIBLE"+sizeCategories[1]);
		}
	}else{
		var dataString = 'idproduct='+idproduct+'&product='+product;	
		elementsInvoice["id"+idproduct+""] = idproduct;		
			 $.ajax({
				type: "POST",
				async: false,
				url: "core/b-product.php",
				data: dataString,
				cache: false,
				success: function(response){			
				var objects = jQuery.parseJSON(response);
					if(objects.result === "true"){
						if(quatity*objects.AREAPRODUCTO>sizeCategories[objects.CATEGORIAPRODUCTO]){
							state=false;
						}else if(objects.DISPONIBLEPRODUCTO = 0){
							return;
						}else{
							sizeCategories[objects.CATEGORIAPRODUCTO] = sizeCategories[objects.CATEGORIAPRODUCTO] - quatity*objects.AREAPRODUCTO;
						}
						reference= objects.REFERENCIAPRODUCTO;
						measures=objects.AREAPRODUCTO;
					
						if($("#value3product").val() != "" ){
							price=parseInt($("#value3product").val());
						}else if($("#paybill").text()==="CONTADO"){
							price=objects.VCONTADOINVENTARIO;
						}else if($("#paybill").text()==="CREDITO"){
							price=objects.VCREDITOINVENTARIO;
							$("#statepaybill").text("PENDIENTE");
						}						
					}else{
						reference="ERROR";
						measures="ERROR";
						price="ERROR";					
					}}
			});

		if(state ===true){
			quantitiesInvoice["id"+idproduct+""] = quatity;		
			uvalue= measures * price;
			tvalue= quatity * uvalue;
			$("#subvaluebill").val(parseInt($("#subvaluebill").val())+tvalue);
			$("#valuebill").val(parseInt($("#subvaluebill").val())-parseInt($("#feevaluebill").val())-parseInt($("#discountbill").val()));								
			
			$("#detailstable").last().append("<tr id='fila_"+product+"' ><td>"+product+"</td>"
										+"<td>"+quatity+"</td>"
										+"<td>"+reference+"</td>"								
										+"<td>"+measures+"</td>"																
										+"<td>$ "+price+"</td>"
										+"<td>$ "+uvalue+"</td>"
										+"<td>$ "+tvalue+"</td>"																																								
										+"</tr>");
																
			printInvoiceMessage("","EL PRODUCTO "+product+" FUE AGREGADO");
		}else{
			printInvoiceMessage("error","LA CANTIDAD "+quatity+" PRODUCTO DEL "+product+" ES MAYOR AL DISPONIBLE");
		}
	}
		
	$("#quatity").val("");
	$("#value3product").val("");
	$("#cmbProduct").val(0);
	event.preventDefault; 
}
function printInvoiceMessage(type,message){
	if(type==="warning"){
		$("#billmesage").html("<span style='padding:3px;width: 100%; height:20px; "+
				"background: url(shared/thumbs/bgwarning_lg.jpg);border-radius:10px;display:block' "+
				"id='message'>"+message+"</span>");
	}else if(type==="error"){
		$("#billmesage").html("<span style='color:white;padding:3px;width: 100%; height:20px; "+
				"background: url(shared/thumbs/bgerror_lg.jpg);border-radius:10px;display:block' "+
				"id='message'>"+message+"</span>");		
	}else{
		$("#billmesage").html("<span style='padding:3px;width: 100%; height:20px; "+
				"display:block;border-radius:10px' id='message'> "+message+"</span>");		
	}
	setInterval(function(){$("#message").fadeOut(); }, 10000);
	
}

function delItem(event){
	var idproduct=$("#cmbProduct").val();
	var quatity=$("#quatity").val();
	var product=$("#cmbProduct option:selected").text();	
	if ($("#fila_"+product+"").attr("id")!= undefined && quatity === "") {		
		delete elementsInvoice["id"+idproduct+""];
		var dataString = 'idproduct='+idproduct+'&product='+product;				
			$.ajax({
				type: "POST",
				async: false,
				url: "core/b-product.php",
				data: dataString,
				cache: false,
				success: function(response){			
				var objects = jQuery.parseJSON(response);
					if(objects.result === "true"){
						if(objects.DISPONIBLEPRODUCTO = 0){
							return;
						}else{	
		sizeCategories[objects.CATEGORIAPRODUCTO] = sizeCategories[objects.CATEGORIAPRODUCTO] + parseInt($("#fila_"+product+" td:eq(1)").text())*objects.AREAPRODUCTO;	
						}
				
					}}
			});	
			delete quantitiesInvoice["id"+idproduct+""];
			var tvalue=parseInt($("#fila_"+product+" td:eq(6)").text().substring(1));
			$("#subvaluebill").val(parseInt($("#subvaluebill").val())-tvalue);
			$("#valuebill").val(parseInt($("#subvaluebill").val())-parseInt($("#feevaluebill").val())
						-parseInt($("#discountbill").val()));			
			$("#fila_"+product+"").remove();
								
			printInvoiceMessage("","EL PRODUCTO "+product+" FUE ELIMINADO DE LA FACTURA");			
						
	} else if ($("#fila_"+product+"").attr("id")!= undefined && quatity != "") {
		if(parseInt(quatity)<parseInt($("#fila_"+product+" td:eq(1)").text())){
			
			var removequa=(quatity* parseInt($("#fila_"+product+" td:eq(5)").text().substring(1)));	

		var dataString = 'idproduct='+idproduct+'&product='+product;						
			$.ajax({
				type: "POST",
				async: false,
				url: "core/b-product.php",
				data: dataString,
				cache: false,
				success: function(response){			
				var objects = jQuery.parseJSON(response);
					if(objects.result === "true"){
						if(objects.DISPONIBLEPRODUCTO = 0){
							return;
						}else{		
		sizeCategories[objects.CATEGORIAPRODUCTO] = sizeCategories[objects.CATEGORIAPRODUCTO] + quatity*objects.AREAPRODUCTO
						}
				
					}}
			});	

			var tvalue=parseInt($("#fila_"+product+" td:eq(6)").text().substring(1))
			-removequa;
			
			quatity=parseInt($("#fila_"+product+" td:eq(1)").text())-parseInt(quatity);
			quantitiesInvoice["id"+idproduct+""] = quatity;								
			var newRow = "<tr id='fila_"+product+"' ><td>"+product+"</td>"
										+"<td>"+quatity+"</td>"
										+"<td>"+$("#fila_"+product+" td:eq(2)").text()+"</td>"								
										+"<td>"+$("#fila_"+product+" td:eq(3)").text()+"</td>"																
										+"<td>$ "+$("#fila_"+product+" td:eq(4)").text().substring(1)+"</td>"
										+"<td>$ "+$("#fila_"+product+" td:eq(5)").text().substring(1)+"</td>"
										+"<td>$ "+tvalue+"</td>"																																								
										+"</tr>";
										
			$("#subvaluebill").val(parseInt($("#subvaluebill").val())-removequa);
			$("#valuebill").val(parseInt($("#subvaluebill").val())-parseInt($("#feevaluebill").val())
			-parseInt($("#discountbill").val()));													
			$("#fila_"+product+"").replaceWith(newRow);		
										
		}else{
			printInvoiceMessage("error","LA CANTIDAD "+quatity+" A ELIMINAR DE EL PRODUCTO "+product+" ES MAYOR AL DE LA FACTURA");
		}
	}else if(idproduct != null){
		printInvoiceMessage("warning","EL PRODUCTO "+product+" NO ESTA EN LA FACTURA");		
	}else{
		printInvoiceMessage("warning","NO HAY PRODUCTO SELECCIONADO");		
	}

	$("#quatity").val("");
	$("#cmbProduct").val(0);
	event.preventDefault; 
}
function invoiceUpadteStock(elem){
	var dataString =sizeCategories[1];
	var index=2;
	while (sizeCategories[index] != undefined){
		dataString+= "&"+sizeCategories[index];
		if(parseInt(sizeCategories[index]) < parseInt(limitsCategories[index])){
			$("#scrollingDiv").css("display", "block");
			$("#scrollingDiv h4").text("ADVERTENCIA");
			$("#scrollingDiv #lowquanti").append("<span>La categoria <b>"+namesCategories[index]+"</b> ESTA POR ACABARSE <br/></span><br/>");
		}
		index++;
	}
	$.ajax({
		type: "POST",
		url: "core/a-sale.php",
		data: {"categories" : JSON.stringify(dataString)},
		success: function(response){   
//			var objects = jQuery.parseJSON(response);				
		}
	});
}
function invoiceSave(elem){
	var ids="";
	var qids="";
	for (var k in elementsInvoice) {
		if (elementsInvoice.hasOwnProperty(k)) {
			ids+= "-"+elementsInvoice[k];
			qids+= "-"+quantitiesInvoice[k];			
//			alert('key is: ' + k + ', value is: ' + elementsInvoice[k]+ ' >> '+ ids);
		}
	}	
	/*save invoice*/	
	var dataString = "dateinvoice="+$("#dateinvoice").text()+"&codinvoice="+$("#codinvoice").val()
			+"&idcostumer="+$("#cmbClient option:selected").index()+"&stateinvoice="+$("#statepaybill").text()
			+"&quantinvoice="+$("#valuebill").val()
			+"&ids="+ids.substring(1)+"&qids="+qids.substring(1)+"&duedate="+$("#datefee").val()+"&userid="+$("#nameuser").text();
	/*save details*/	
	$.ajax({
		type: "POST",
		url: "core/a-sale.php",
		data: dataString,
		beforeSend: function(){			
		},
		error: function(){
		},
		success: function(response){   
			var objects = jQuery.parseJSON(response);				
			if(objects.result){
		printInvoiceMessage("","FACRURA CREADA Y GUARDADA");						
		setTimeout(function(){$("#area").load("view/w-sale.php");}, 1000);			
			}
		}
	});
	invoiceUpadteStock(elem);	
	//desea imprimir
	
}
function invoicePrint(elem){
	invoiceSave(elem)
	if($("#codinvoice").val() !=""){
		var opened = window.open("view/w-template.html",'_blank', 'width=650, height=600,toolbar=0,menubar=0,resizable=0');
		opened.onload = function() {
			//left
			opened.document.getElementById("cliente").innerHTML = $("#cmbClient option:selected").text();
			opened.document.getElementById("direccion").innerHTML = $("#clientaddress").text();
			opened.document.getElementById("telefono").innerHTML = $("#clientphone").text();		
			opened.document.getElementById("ciudad").innerHTML = $("#clientciudad").text();		
			//right
			opened.document.getElementById("nfactura").innerHTML = $("#codinvoice").val();
			opened.document.getElementById("ffactura").innerHTML = $("#dateinvoice").text();
			opened.document.getElementById("pfactura").innerHTML = $("#paybill").text();		
			opened.document.getElementById("esfactura").innerHTML = $("#statepaybill").text();				
			//down
			opened.document.getElementById("sub").innerHTML = "$ "+$("#subvaluebill").val();
			opened.document.getElementById("des").innerHTML = "$ "+$("#discountbill").val();
			opened.document.getElementById("abon").innerHTML = "$ "+$("#feevaluebill").val();		
			opened.document.getElementById("total").innerHTML = "$ "+$("#valuebill").val();						
			//table
			$("#detailstable tbody").clone().appendTo(opened.document.getElementById("contenido"));
			opened.document.getElementById("contenido").style.textAlign = "center";
			opened.print();
			opened.close();
		}
	}
}