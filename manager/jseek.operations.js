/**
* Jefferson Amado Peña Torres
* jeffersonamado@gmail.com
*/
$(document).ready(function() {

});

$("#tableinvoices").each(function() {
    var currentPage = 0;
    var numPerPage = 10;
    var $table = $(this);
    $table.bind('repaginate', function() {
        $table.find('tbody tr').hide().slice(currentPage * numPerPage, (currentPage + 1) * numPerPage).show();
    });
    $table.trigger('repaginate');
    var numRows = $table.find('tbody tr').length;
    var numPages = Math.ceil(numRows / numPerPage);
    var $pager = $('<div class="pager"></div>');
    for (var page = 0; page < numPages; page++) {
        $('<span class="page-number"></span>').text(page + 1).bind('click', {
            newPage: page
        }, function(event) {
            currentPage = event.data['newPage'];
            $table.trigger('repaginate');
            $(this).addClass('active').siblings().removeClass('active');
        }).appendTo($pager).addClass('clickable');
    }
    $pager.insertAfter($table).find('span.page-number:first').addClass('active');
});

$("#seekclient").keyup(function (event){
	var seek=$("#seekclient").val();
	if(seek != ""){
		$.ajax({
			type: "POST",
			url: "core/b-seeks.php",
			data: "client="+seek,
			beforeSend: function(){
				$("#resultclients").empty();
				$("#tablebodyclients").empty();				
				$("#resultclients").append("<p align='center'><img src='shared/thumbs/lazy-loader.gif' /></p>");							
			},
			error: function(){
				$("#resultclients").last().append("<tr><td>ERROR</td></tr>");
				$("#resultclients").append("<tr><td><p align='center'><img src='shared/thumbs/lazy-loader.gif' /></p></td></tr>");							
				setTimeout(function(){$("#area").load("view/w-seekcustomer.php");}, 5000);
			},
			success: function(response){   
				var objects = jQuery.parseJSON(response);				
				if(objects.result){	
					$("#tablebodyclients").empty();
					$("#resultclients").empty();
					$("#countclients").text(objects.count+" Encontrados");
					$("#tablebodyclients").last().append(objects.rows);									
				}else{
					$("#tablebodyclients").empty();
					$("#resultclients").empty();
					$("#countclients").text("0 Encontrados");					
					$("#tablebodyclients").last().append("<tr><td colspan='8' >REGISTROS CON \""+seek+"\" NO ENCONTRADOS </td></tr>");					
				}						 
			}
		});	
	}else{
		setTimeout(function(){$("#area").load("view/w-seekcustomer.php");}, 50);
	}
	event.preventDefault;
});

$("#seekcontact").keyup(function (event){
	var seek=$("#seekcontact").val();
	if(seek != ""){
		$.ajax({
			type: "POST",
			url: "core/b-seeks.php",
			data: "contact="+seek,
			beforeSend: function(){
				$("#resultclients").empty();
				$("#tablebodyclients").empty();				
				$("#resultclients").append("<p align='center'><img src='shared/thumbs/lazy-loader.gif' /></p>");			
			},
			error: function(){
				$("#resultclients").last().append("<tr><td>ERROR</td></tr>");
				$("#resultclients").append("<tr><td><p align='center'><img src='shared/thumbs/lazy-loader.gif' /></p></td></tr>");							
				setTimeout(function(){$("#area").load("view/w-seekcustomer.php");}, 5000);
			},
			success: function(response){   						
				var objects = jQuery.parseJSON(response);		
				if(objects.result){	
					$("#tablebodyclients").empty();
					$("#resultclients").empty();
					$("#countclients").text(objects.count+" Encontrados");
					$("#tablebodyclients").last().append(objects.rows);									
				}else{
					$("#tablebodyclients").empty();
					$("#resultclients").empty();
					$("#countclients").text("0 Encontrados");										
					$("#tablebodyclients").last().append("<tr><td colspan='8' >REGISTROS CON \""+seek+"\" NO ENCONTRADOS </td></tr>");					
				}						 
			}
		});	
	}else{
		setTimeout(function(){$("#area").load("view/w-seekcustomer.php");}, 50);
	}
	event.preventDefault;
});

$("#seeknit").keyup(function (event){
	var seek=$("#seeknit").val();
	if(seek != ""){
		$.ajax({
			type: "POST",
			url: "core/b-seeks.php",
			data: "nit="+seek,
			beforeSend: function(){
				$("#resultclients").empty();
				$("#tablebodyclients").empty();				
				$("#resultclients").append("<p align='center'><img src='shared/thumbs/lazy-loader.gif' /></p>");			
			},
			error: function(){
				$("#resultclients").last().append("<tr><td>ERROR</td></tr>");
				$("#resultclients").append("<tr><td><p align='center'><img src='shared/thumbs/lazy-loader.gif' /></p></td></tr>");							
				setTimeout(function(){$("#area").load("view/w-seekcustomer.php");}, 5000);
			},
			success: function(response){   
				var objects = jQuery.parseJSON(response);				
				if(objects.result){	
					$("#tablebodyclients").empty();
					$("#resultclients").empty();
					$("#countclients").text(objects.count+" Encontrados");					
					$("#tablebodyclients").last().append(objects.rows);									
				}else{
					$("#tablebodyclients").empty();
					$("#resultclients").empty();
					$("#countclients").text("0 Encontrados");										
					$("#tablebodyclients").last().append("<tr><td colspan='8' >REGISTROS CON \""+seek+"\" NO ENCONTRADOS </td></tr>");					
				}						 
			}
		});	
	}else{
		setTimeout(function(){$("#area").load("view/w-seekcustomer.php");}, 50);
	}
	event.preventDefault;
});
/**/
$("#dateinvoice").change(function (event){
	var seek=$("#dateinvoice").val();
	if(seek != ""){
		$.ajax({
			type: "POST",
			url: "core/b-seeks.php",
			data: "dateinvoice="+seek,
			beforeSend: function(){
				$("#resultinvoices").empty();
				$("#tablebodyinv").empty();				
				$("#resultinvoices").append("<p align='center'><img src='shared/thumbs/lazy-loader.gif' /></p>");			
			},
			error: function(){
				$("#resultinvoices").last().append("<tr><td>ERROR</td></tr>");
				$("#resultinvoices").append("<tr><td><p align='center'><img src='shared/thumbs/lazy-loader.gif' /></p></td></tr>");							
				setTimeout(function(){$("#area").load("view/w-invoices.php");}, 5000);
			},
			success: function(response){   			
				var objects = jQuery.parseJSON(response);				
				if(objects.result){	
					$("#tablebodyinv").empty();
					$("#resultinvoices").empty();
					$("#countinvoices").text(objects.count+" Encontradas");								
					$("#tablebodyinv").last().append(objects.rows);									
				}else{
					$("#tablebodyinv").empty();
					$("#resultinvoices").empty();
					$("#countinvoices").text("0 Encontradas");	
					$("#tablebodyinv").last().append("<tr><td colspan='8' >FACTURAS CON  FECHA \""+seek+"\" NO ENCONTRADAS </td></tr>");					
				}							 
			}
		});	
	}else{
		setTimeout(function(){$("#area").load("view/w-invoices.php");}, 50);
	}
	event.preventDefault;
});

$("#codinvoice").keyup(function (event){
	var seek=$("#codinvoice").val();
	if(seek != ""){
		$.ajax({
			type: "POST",
			url: "core/b-seeks.php",
			data: "codinvoice="+seek,
			beforeSend: function(){
				$("#resultinvoices").empty();
				$("#tablebodyinv").empty();				
				$("#resultinvoices").append("<p align='center'><img src='shared/thumbs/lazy-loader.gif' /></p>");			
			},
			error: function(){
				$("#resultinvoices").last().append("<tr><td>ERROR</td></tr>");
				$("#resultinvoices").append("<tr><td><p align='center'><img src='shared/thumbs/lazy-loader.gif' /></p></td></tr>");							
				setTimeout(function(){$("#area").load("view/w-invoices.php");}, 5000);
			},
			success: function(response){   
				var objects = jQuery.parseJSON(response);				
				if(objects.result){	
					$("#tablebodyinv").empty();
					$("#resultinvoices").empty();
					$("#countinvoices").text(objects.count+" Encontradas");								
					$("#tablebodyinv").last().append(objects.rows);									
				}else{
					$("#tablebodyinv").empty();
					$("#resultinvoices").empty();
					$("#countinvoices").text("0 Encontradas");	
					$("#tablebodyinv").last().append("<tr><td colspan='8' >FACTURAS CON CODIGO \""+seek+"\" NO ENCONTRADAS </td></tr>");					
				}					 
			}
		});	
	}else{
		setTimeout(function(){$("#area").load("view/w-invoices.php");}, 50);
	}
	event.preventDefault;
});
$("#duedateinvoice").change(function (event){
	var seek=$("#duedateinvoice").val();
	if(seek != ""){
		$.ajax({
			type: "POST",
			url: "core/b-seeks.php",
			data: "duedateinvoice="+seek,
			beforeSend: function(){
				$("#resultinvoices").empty();
				$("#tablebodyinv").empty();				
				$("#resultinvoices").append("<p align='center'><img src='shared/thumbs/lazy-loader.gif' /></p>");			
			},
			error: function(){
				$("#resultinvoices").last().append("<tr><td>ERROR</td></tr>");
				$("#resultinvoices").append("<tr><td><p align='center'><img src='shared/thumbs/lazy-loader.gif' /></p></td></tr>");							
				setTimeout(function(){$("#area").load("view/w-invoices.php");}, 5000);
			},
			success: function(response){   
				var objects = jQuery.parseJSON(response);				
				if(objects.result){	
					$("#tablebodyinv").empty();
					$("#resultinvoices").empty();
					$("#countinvoices").text(objects.count+" Encontradas");								
					$("#tablebodyinv").last().append(objects.rows);									
				}else{
					$("#tablebodyinv").empty();
					$("#resultinvoices").empty();
					$("#countinvoices").text("0 Encontradas");	
					$("#tablebodyinv").last().append("<tr><td colspan='8' >FACTURAS CON VENCIMIENTO \""+seek+"\" NO ENCONTRADAS </td></tr>");					
				}						 
			}
		});	
	}else{
		setTimeout(function(){$("#area").load("view/w-invoices.php");}, 50);
	}
	event.preventDefault;
});

$("#cliinvoice").keyup(function (event){
	var seek=$("#cliinvoice").val();
	if(seek != ""){
		$.ajax({
			type: "POST",
			url: "core/b-seeks.php",
			data: "cliinvoice="+seek,
			beforeSend: function(){
				$("#resultinvoices").empty();
				$("#tablebodyinv").empty();				
				$("#resultinvoices").append("<p align='center'><img src='shared/thumbs/lazy-loader.gif' /></p>");			
			},
			error: function(){
				$("#resultinvoices").last().append("<tr><td>ERROR</td></tr>");
				$("#resultinvoices").append("<tr><td><p align='center'><img src='shared/thumbs/lazy-loader.gif' /></p></td></tr>");							
				setTimeout(function(){$("#area").load("view/w-invoices.php");}, 5000);
			},
			success: function(response){   
				var objects = jQuery.parseJSON(response);				
				if(objects.result){	
					$("#tablebodyinv").empty();
					$("#resultinvoices").empty();
					$("#countinvoices").text(objects.count+" Encontradas");								
					$("#tablebodyinv").last().append(objects.rows);									
				}else{
					$("#tablebodyinv").empty();
					$("#resultinvoices").empty();
					$("#countinvoices").text("0 Encontradas");	
					$("#tablebodyinv").last().append("<tr><td colspan='8' >EL CLIENTE \""+seek+"\" NO TIENE FACTURAS </td></tr>");					
				}						 
			}
		});	
	}else{
		setTimeout(function(){$("#area").load("view/w-invoices.php");}, 50);
	}
	event.preventDefault;
});
$("#stateinvoice").change(function (event){
	var seek=$("#stateinvoice").val();
	if(seek != "" && seek != -1){
		$.ajax({
			type: "POST",
			url: "core/b-seeks.php",
			data: "stateinvoice="+seek,
			beforeSend: function(){
				$("#resultinvoices").empty();
				$("#tablebodyinv").empty();				
				$("#resultinvoices").append("<p align='center'><img src='shared/thumbs/lazy-loader.gif' /></p>");			
			},
			error: function(){
				$("#resultinvoices").last().append("<tr><td>ERROR</td></tr>");
				$("#resultinvoices").append("<tr><td><p align='center'><img src='shared/thumbs/lazy-loader.gif' /></p></td></tr>");							
				setTimeout(function(){$("#area").load("view/w-invoices.php");}, 5000);
			},
			success: function(response){   
				var objects = jQuery.parseJSON(response);				
				if(objects.result){	
					$("#tablebodyinv").empty();
					$("#resultinvoices").empty();
					$("#countinvoices").text(objects.count+" Encontradas");								
					$("#tablebodyinv").last().append(objects.rows);									
				}else{
					$("#tablebodyinv").empty();
					$("#resultinvoices").empty();
					$("#countinvoices").text("0 Encontradas");	
					$("#tablebodyinv").last().append("<tr><td colspan='8' >NO HAY FACTURAS CON ESTADO \""+seek+"\" </td></tr>");					
				}						 
			}
		});	
	}else{
		setTimeout(function(){$("#area").load("view/w-invoices.php");}, 50);
	}
	event.preventDefault;
});

$("#userinvoice").keyup(function (event){
	var seek=$("#userinvoice").val();
	if(seek != ""){
		$.ajax({
			type: "POST",
			url: "core/b-seeks.php",
			data: "userinvoice="+seek,
			beforeSend: function(){
				$("#resultinvoices").empty();
				$("#tablebodyinv").empty();				
				$("#resultinvoices").append("<p align='center'><img src='shared/thumbs/lazy-loader.gif' /></p>");			
			},
			error: function(){
				$("#resultinvoices").last().append("<tr><td>ERROR</td></tr>");
				$("#resultinvoices").append("<tr><td><p align='center'><img src='shared/thumbs/lazy-loader.gif' /></p></td></tr>");							
				setTimeout(function(){$("#area").load("view/w-invoices.php");}, 5000);
			},
			success: function(response){   
				var objects = jQuery.parseJSON(response);				
				if(objects.result){	
					$("#tablebodyinv").empty();
					$("#resultinvoices").empty();
					$("#countinvoices").text(objects.count+" Encontradas");								
					$("#tablebodyinv").last().append(objects.rows);									
				}else{
					$("#tablebodyinv").empty();
					$("#resultinvoices").empty();
					$("#countinvoices").text("0 Encontradas");	
					$("#tablebodyinv").last().append("<tr><td colspan='8' >NO HAY FACTURAS DEL USUARIO \""+seek+"\" </td></tr>");					
				}						 
			}
		});	
	}else{
		setTimeout(function(){$("#area").load("view/w-invoices.php");}, 50);
	}
	event.preventDefault;
});

/**/
$("#codinvoicefee").keyup(function (event){
	var seek=$("#codinvoicefee").val();
	if(seek != ""){
		$.ajax({
			type: "POST",
			url: "core/b-seeks.php",
			data: "codinvoicefee="+seek,
			beforeSend: function(){
				$("#resultfee").empty();
				$("#tablebodyfee").empty();				
				$("#resultfee").append("<p align='center'><img src='shared/thumbs/lazy-loader.gif' /></p>");			
			},
			error: function(){
				$("#resultfee").last().append("<tr><td>ERROR</td></tr>");
				$("#resultfee").append("<tr><td><p align='center'><img src='shared/thumbs/lazy-loader.gif' /></p></td></tr>");							
				setTimeout(function(){$("#area").load("view/w-seekfee.php");}, 5000);
			},
			success: function(response){   
				var objects = jQuery.parseJSON(response);				
				if(objects.result){	
					$("#tablebodyfee").empty();
					$("#resultfee").empty();
					$("#countfee").text(objects.count+" Encontradas");								
					$("#tablebodyfee").last().append(objects.rows);									
				}else{
					$("#tablebodyfee").empty();
					$("#resultfee").empty();
					$("#countfee").text("0 Encontradas");	
					$("#tablebodyfee").last().append("<tr><td colspan='8' >NO HAY ABONOS PARA EL CODIGO \""+seek+"\" </td></tr>");					
				}						 
			}
		});	
	}else{
		setTimeout(function(){$("#area").load("view/w-seekfee.php");}, 50);
	}
	event.preventDefault;
});
$("#datefee").change(function (event){
	var seek=$("#datefee").val();
	if(seek != ""){
		$.ajax({
			type: "POST",
			url: "core/b-seeks.php",
			data: "datefee="+seek,
			beforeSend: function(){
				$("#resultfee").empty();
				$("#tablebodyfee").empty();				
				$("#resultfee").append("<p align='center'><img src='shared/thumbs/lazy-loader.gif' /></p>");			
			},
			error: function(){
				$("#resultfee").last().append("<tr><td>ERROR</td></tr>");
				$("#resultfee").append("<tr><td><p align='center'><img src='shared/thumbs/lazy-loader.gif' /></p></td></tr>");							
				setTimeout(function(){$("#area").load("view/w-seekfee.php");}, 5000);
			},
			success: function(response){   
				var objects = jQuery.parseJSON(response);				
				if(objects.result){	
					$("#tablebodyfee").empty();
					$("#resultfee").empty();
					$("#countfee").text(objects.count+" Encontradas");								
					$("#tablebodyfee").last().append(objects.rows);									
				}else{
					$("#tablebodyfee").empty();
					$("#resultfee").empty();
					$("#countfee").text("0 Encontradas");	
					$("#tablebodyfee").last().append("<tr><td colspan='8' >NO HAY ABONOS EN LA FECHA \""+seek+"\" </td></tr>");					
				}						 
			}
		});	
	}else{
		setTimeout(function(){$("#area").load("view/w-seekfee.php");}, 50);
	}
	event.preventDefault;
});

$("#codproduct").keyup(function (event){
	var seek=$("#codproduct").val();
	if(seek != ""){
		$.ajax({
			type: "POST",
			url: "core/b-seeks.php",
			data: "codproduct="+seek,
			beforeSend: function(){
				$("#resultproduct").empty();
				$("#tablebodyroduct").empty();				
				$("#resultproduct").append("<p align='center'><img src='shared/thumbs/lazy-loader.gif' /></p>");			
			},
			error: function(){
				$("#resultproduct").last().append("<tr><td>ERROR</td></tr>");
				$("#resultproduct").append("<tr><td><p align='center'><img src='shared/thumbs/lazy-loader.gif' /></p></td></tr>");							
				setTimeout(function(){$("#area").load("view/w-seekproduct.php");}, 5000);
			},
			success: function(response){   			
				var objects = jQuery.parseJSON(response);				
				if(objects.result){	
					$("#tablebodyroduct").empty();
					$("#resultproduct").empty();
					$("#countproduct").text(objects.count+" Encontradas");								
					$("#tablebodyroduct").last().append(objects.rows);									
				}else{
					$("#tablebodyroduct").empty();
					$("#resultproduct").empty();
					$("#countproduct").text("0 Encontradas");	
					$("#tablebodyroduct").last().append("<tr><td colspan='8' >NO PRODUCTOS CON \""+seek+"\" </td></tr>");					
				}						 
			}
		});	
	}else{
		setTimeout(function(){$("#area").load("view/w-seekproduct.php");}, 50);
	}
	event.preventDefault;
});

$("#refproduct").keyup(function (event){
	var seek=$("#refproduct").val();
	if(seek != ""){
		$.ajax({
			type: "POST",
			url: "core/b-seeks.php",
			data: "refproduct="+seek,
			beforeSend: function(){
				$("#resultproduct").empty();
				$("#tablebodyroduct").empty();				
				$("#resultproduct").append("<p align='center'><img src='shared/thumbs/lazy-loader.gif' /></p>");			
			},
			error: function(){
				$("#resultproduct").last().append("<tr><td>ERROR</td></tr>");
				$("#resultproduct").append("<tr><td><p align='center'><img src='shared/thumbs/lazy-loader.gif' /></p></td></tr>");							
				setTimeout(function(){$("#area").load("view/w-seekproduct.php");}, 5000);
			},
			success: function(response){   			
				var objects = jQuery.parseJSON(response);				
				if(objects.result){	
					$("#tablebodyroduct").empty();
					$("#resultproduct").empty();
					$("#countproduct").text(objects.count+" Encontradas");								
					$("#tablebodyroduct").last().append(objects.rows);									
				}else{
					$("#tablebodyroduct").empty();
					$("#resultproduct").empty();
					$("#countproduct").text("0 Encontradas");	
					$("#tablebodyroduct").last().append("<tr><td colspan='8' >NO PRODUCTOS CON \""+seek+"\" </td></tr>");					
				}						 
			}
		});	
	}else{
		setTimeout(function(){$("#area").load("view/w-seekproduct.php");}, 50);
	}
	event.preventDefault;
});

$("#catproduct").keyup(function (event){
	var seek=$("#catproduct").val();
	if(seek != ""){
		$.ajax({
			type: "POST",
			url: "core/b-seeks.php",
			data: "catproduct="+seek,
			beforeSend: function(){
				$("#resultproduct").empty();
				$("#tablebodyroduct").empty();				
				$("#resultproduct").append("<p align='center'><img src='shared/thumbs/lazy-loader.gif' /></p>");			
			},
			error: function(){
				$("#resultproduct").last().append("<tr><td>ERROR</td></tr>");
				$("#resultproduct").append("<tr><td><p align='center'><img src='shared/thumbs/lazy-loader.gif' /></p></td></tr>");							
				setTimeout(function(){$("#area").load("view/w-seekproduct.php");}, 5000);
			},
			success: function(response){   			
				var objects = jQuery.parseJSON(response);				
				if(objects.result){	
					$("#tablebodyroduct").empty();
					$("#resultproduct").empty();
					$("#countproduct").text(objects.count+" Encontradas");								
					$("#tablebodyroduct").last().append(objects.rows);									
				}else{
					$("#tablebodyroduct").empty();
					$("#resultproduct").empty();
					$("#countproduct").text("0 Encontradas");	
					$("#tablebodyroduct").last().append("<tr><td colspan='8' >NO PRODUCTOS CON \""+seek+"\" </td></tr>");					
				}						 
			}
		});	
	}else{
		setTimeout(function(){$("#area").load("view/w-seekproduct.php");}, 50);
	}
	event.preventDefault;
});

function seekFee(event){
	var seek="";
	var data="";
	if($("#seekclient").val() !=""){
		seek = $("#seekclient").val();
		data= "client="+seek;
	}else if($("#seekcontact").val() !=""){
		seek = $("#seekcontact").val();
		data= "contact="+seek;		
	}else if($("#seeknit").val() !=""){
		seek = $("#seeknit").val();
		data= "nit="+seek;
	}else if($("#seeknit").val() !=""){
		seek = $("#seeknit").val();
		data= "nit="+seek;
	}
	if(seek != ""){
		$.ajax({
			type: "POST",
			url: "core/b-seeks.php",
			data: data,
			beforeSend: function(){
				$("#resultclients").empty();
				$("#tablebodyclients").empty();				
				$("#resultclients").append("<p align='center'><img src='shared/thumbs/lazy-loader.gif' /></p>");			
			},
			error: function(){
				$("#resultclients").last().append("<tr><td>ERROR</td></tr>");
				$("#resultclients").append("<tr><td><p align='center'><img src='shared/thumbs/lazy-loader.gif' /></p></td></tr>");							
				setTimeout(function(){$("#area").load("view/w-seekcustomer.php");}, 5000);
			},
			success: function(response){   
				var objects = jQuery.parseJSON(response);				
				if(objects.result){	
					$("#tablebodyinv").empty();
					$("#resultinvoices").empty();
					$("#countinvoices").text(objects.count+" Encontradas");								
					$("#tablebodyinv").last().append(objects.rows);									
				}else{
					$("#tablebodyinv").empty();
					$("#resultinvoices").empty();
					$("#countinvoices").text("0 Encontradas");	
					$("#tablebodyinv").last().append("<tr><td colspan='8' >REGISTROS CON \""+seek+"\" NO ENCONTRADOS </td></tr>");					
				}					 
			}
		});	
	}else{
		setTimeout(function(){$("#area").load("view/w-seekcustomer.php");}, 50);
	}
	event.preventDefault;
}


function seekInvoice(event){
	var seek="";
	var data="";
	if($("#codinvoice").val() != null){
		seek = $("#codinvoice").val();
		data= "codinvoice="+seek;		
	}else if($("#cliinvoice").val() !=""){
		seek = $("#cliinvoice").val();
		data= "cliinvoice="+seek;
	}else if($("#stateinvoice").val() !="" && $("#stateinvoice").val() != -1){
		seek = $("#stateinvoice").val();
		data= "stateinvoice="+seek;
	}else if($("#userinvoice").val() !=""){
		seek = $("#userinvoice").val();
		data= "userinvoice="+seek;
	}
	if(seek != ""){
		$.ajax({
			type: "POST",
			url: "core/b-seeks.php",
			data: data,
			beforeSend: function(){
				$("#resultclients").empty();
				$("#tablebodyclients").empty();				
				$("#resultclients").append("<p align='center'><img src='shared/thumbs/lazy-loader.gif' /></p>");			
			},
			error: function(){
				$("#resultclients").last().append("<tr><td>ERROR</td></tr>");
				$("#resultclients").append("<tr><td><p align='center'><img src='shared/thumbs/lazy-loader.gif' /></p></td></tr>");							
				setTimeout(function(){$("#area").load("view/w-invoices.php");}, 5000);
			},
			success: function(response){   
				var objects = jQuery.parseJSON(response);				
				if(objects.result){	
					$("#tablebodyinv").empty();
					$("#resultinvoices").empty();
					$("#countinvoices").text(objects.count+" Encontradas");								
					$("#tablebodyinv").last().append(objects.rows);									
				}else{
					$("#tablebodyinv").empty();
					$("#resultinvoices").empty();
					$("#countinvoices").text("0 Encontradas");	
					$("#tablebodyinv").last().append("<tr><td colspan='8' >REGISTROS CON \""+seek+"\" NO ENCONTRADOS </td></tr>");					
				}					 
			}
		});	
	}else{
		setTimeout(function(){$("#area").load("view/w-invoices.php");}, 50);
	}
	event.preventDefault;
}

function seekClient(event){
	var seek="";
	var data="";
	if($("#seekclient").val() !=""){
		seek = $("#seekclient").val();
		data= "client="+seek;
	}else if($("#seekcontact").val() !=""){
		seek = $("#seekcontact").val();
		data= "contact="+seek;		
	}else if($("#seeknit").val() !=""){
		seek = $("#seeknit").val();
		data= "nit="+seek;
	}else if($("#seeknit").val() !=""){
		seek = $("#seeknit").val();
		data= "nit="+seek;
	}
	if(seek != ""){
		$.ajax({
			type: "POST",
			url: "core/b-seeks.php",
			data: data,
			beforeSend: function(){
				$("#resultclients").empty();
				$("#tablebodyclients").empty();				
				$("#resultclients").append("<p align='center'><img src='shared/thumbs/lazy-loader.gif' /></p>");			
			},
			error: function(){
				$("#resultclients").last().append("<tr><td>ERROR</td></tr>");
				$("#resultclients").append("<tr><td><p align='center'><img src='shared/thumbs/lazy-loader.gif' /></p></td></tr>");							
				setTimeout(function(){$("#area").load("view/w-seekcustomer.php");}, 5000);
			},
			success: function(response){   
				var objects = jQuery.parseJSON(response);				
				if(objects.result){	
					$("#tablebodyinv").empty();
					$("#resultinvoices").empty();
					$("#countinvoices").text(objects.count+" Encontradas");								
					$("#tablebodyinv").last().append(objects.rows);									
				}else{
					$("#tablebodyinv").empty();
					$("#resultinvoices").empty();
					$("#countinvoices").text("0 Encontradas");	
					$("#tablebodyinv").last().append("<tr><td colspan='8' >REGISTROS CON \""+seek+"\" NO ENCONTRADOS </td></tr>");					
				}					 
			}
		});	
	}else{
		setTimeout(function(){$("#area").load("view/w-seekcustomer.php");}, 50);
	}
	event.preventDefault;
}

