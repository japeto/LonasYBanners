/**
* Jefferson Amado Peña Torres
* jeffersonamado@gmail.com
*/
$(document).ready(function() {

});
$("#tablecustomer").each(function() {
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
function editrowclient(elem){
	var index = elem.id.split("_")
	$("#NOMBRECLIENTE_"+index[1]).dblclick();
	event.preventDefault;	
}

$("#cmbcity").change(function (){
	var dataString = "cityClient="+$("#cmbcity option:selected").index();
	$.ajax({
		type: "POST",
		url: "core/b-client.php",
		data: dataString,
		cache: false,
		success: function(response){		
			var objects = jQuery.parseJSON(response);				
			if(objects.result){	
				$("#inDepto").val(objects.DDESCRIPCION);
			}
			
		}
	});		
});

function delrowclient(elem){
	var idcostumer = elem.id.split("_")[1];
	var costumer = $("#NOMBRECLIENTE_"+idcostumer).text();
	delRowClient(idcostumer,costumer);
	event.preventDefault; 
}

function seerowclient(elem){
	var index = elem.id.split("_")
	$("#companyclient").val($("#NOMBRECLIENTE_"+index[1]).text());
	$("#contactclient").val($("#CONTACTOCLIENTE_"+index[1]).text());							
	$("#addressclient").val($("#DIRECCIONCLIENTE_"+index[1]).text());
	$("#cmbcity").val($("#CDESCRIPCION_"+index[1]).text());
	$("#phoneclient").val($("#TELEFONOCLIENTEr_"+index[1]).text());
	$("#nitclient").val($("#NItCLIENTE_"+index[1]).text());
	$("#mailclient").val($("#CORREOCLIENTE_"+index[1]).text());
	event.preventDefault;		
}

$(function() {
    $("td.editable").dblclick(function() {
        var OriginalContent = $(this).text();
		var idObject = event.target.id;
        $(this).addClass("cellEditing");
        $(this).html("<input class ='editable' type='text' value='" + OriginalContent + "' />");
        $(this).children().first().focus();
        $(this).children().first().keypress(function(e) {
            if (e.which == 13) {
                var newContent = $(this).val();
                $(this).parent().text(newContent);
                $(this).parent().removeClass("cellEditing");
				updateRowClient(idObject,newContent);
            }
        });
        $(this).children().first().blur(function() {
            $(this).parent().text(OriginalContent);			
            $(this).parent().removeClass("cellEditing");

        });
    });
});

function delClient(event){
	if($("#companyclient").val()!="" && $("#phoneclient").val()!="" && $("#nitclient").val()!=""){
	
		var dataString ='delcompany='+$("#companyclient").val()+'&delphone='+$("#phoneclient").val()+'&delnit='+$("#nitclient").val();	
		$.ajax({
			type: "POST",
			url: "core/a-client.php",
			data: dataString,
			cache: false,
			success: function(response){		
				var objects = jQuery.parseJSON(response);				
				if(objects.result){													
					printClientMessage("warning","EL CLIENTE <b>"+$("#companyclient").val()+"</b> HA SIDO ELIMINADO");
					setTimeout(function(){$("#area").load("view/w-customer.php");}, 3000)
				}
				
			}
		});	
	}else{
		printClientMessage("error","ESCOJA EL CLIENTE A ELIMINAR");		
	}	
	event.preventDefault;
}

function addNewClient(event){
	if($("#companyclient").val()!="" && $("#phoneclient").val()!="" && $("#nitclient").val()!=""){
	
		var dataString ='company='+$("#companyclient").val()+'&contact='+$("#contactclient").val()+
					'&address='+$("#addressclient").val()+'&phone='+$("#phoneclient").val()+		
					'&mail='+$("#mailclient").val()+'&idcity='+$("#cmbcity option:selected").index()+'&nit='+$("#nitclient").val();	
		$.ajax({
			type: "POST",
			url: "core/a-client.php",
			data: dataString,
			cache: false,
			success: function(response){			
				var objects = jQuery.parseJSON(response);				
				if(objects.result){													
					printClientMessage("","EL NUEVO CLIENTE <b>"+$("#companyclient").val()+"</b> HA SIDO CREADO");
					setTimeout(function(){$("#area").load("view/w-customer.php");}, 3000)
				}else{
					printClientMessage("","EL CLIENTE <b>"+$("#companyclient").val()+"</b> YA EXISTE");
				}
			}
		});	
			
	}else{
		printClientMessage("error","EXISTEN CAMPOS VACIOS");		
	}
	event.preventDefault; 
}

function updateRowClient(field,value){	
	var token = field.split("_");
	var dataString = "field="+token[0]+"&idcostumer="+token[1]+"&value="+value;
	$.ajax({
		type: "POST",
		url: "core/a-client.php",
		data: dataString,
		cache: false,
		success: function(response){			
//			alert (response)
			var objects = jQuery.parseJSON(response);				
			if(objects.result){													
				printClientMessage("","EL CLIENTE HA SIDO ACTUALIZADO");
				setTimeout(function(){$("#area").load("view/w-customer.php");}, 2000)
			}
		}
	});		
}

function delRowClient(idcostumer,costumer){
	var dataString = "idcostumer="+idcostumer+"&costumer="+costumer;
	$.ajax({
		type: "POST",
		url: "core/a-client.php",
		data: dataString,
		cache: false,
		success: function(response){			
//			alert (response)
			var objects = jQuery.parseJSON(response);				
			if(objects.result){													
				printClientMessage("","EL CLIENTE "+costumer+" HA SIDO ELIMINADO");
				setTimeout(function(){$("#area").load("view/w-customer.php");}, 2000)
			}
		}
	});		
}
function printClientMessage(type,message){
	if(type==="warning"){
		$("#clientmessage").html("<span style='padding:3px;width: 100%; height:20px; "+
				"background: url(shared/thumbs/bgwarning_lg.jpg);border-radius:10px;display:block' "+
				"id='message'>"+message+"</span>");
	}else if(type==="error"){
		$("#clientmessage").html("<span style='color:white;padding:3px;width: 100%; height:20px; "+
				"background: url(shared/thumbs/bgerror_lg.jpg);border-radius:10px;display:block' "+
				"id='message'>"+message+"</span>");		
	}else{
		$("#clientmessage").html("<span style='padding:3px;width: 100%; height:20px; "+
				"display:block;border-radius:10px' id='message'> "+message+"</span>");		
	}
	setInterval(function(){$("#message").fadeOut(); }, 4000);	
}