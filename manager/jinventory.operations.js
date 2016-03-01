/**
* Jefferson Amado Peña Torres
* jeffersonamado@gmail.com
*/
$(document).ready(function() {

});
$("#tableinventory").each(function() {
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

$('#inventoryfield1').on('input', function() {
	var input=$(this);
    if(!$.isNumeric( input.val())){
		$(this).val("");
	}
});
$('#inventoryfield2').on('input', function() {
	var input=$(this);
    if(!$.isNumeric( input.val())){
		$(this).val("");
	}
});
$('#inventoryqua').on('input', function() {
	var input=$(this);
    if(!$.isNumeric( input.val())){
		$(this).val("");
	}
});
$('#inventoryprice1').on('input', function() {
	var input=$(this);
    if(!$.isNumeric( input.val())){
		$(this).val("");
	}
});
$('#inventoryprice2').on('input', function() {
	var input=$(this);
    if(!$.isNumeric( input.val())){
		$(this).val("");
	}
});
$('#inventorycant').on('input', function() {
	var input=$(this);
    if(!$.isNumeric( input.val())){
		$(this).val("");
	}
});
$(function() {
    $("td.editable").dblclick(function() {
        var OriginalContent = $(this).text();
		var idObject = event.target.id;
        $(this).addClass("cellEditing");
        $(this).html("<input type='text' value='" + OriginalContent + "' />");
        $(this).children().first().focus();
        $(this).children().first().keypress(function(e) {
            if (e.which == 13) {
                var newContent = $(this).val();
                $(this).parent().text(newContent);
                $(this).parent().removeClass("cellEditing");
				updateRowInventory(idObject,newContent);
            }
        });
        $(this).children().first().blur(function() {
            $(this).parent().text(OriginalContent);			
            $(this).parent().removeClass("cellEditing");

        });
    });
});

function seerowinventoryclass(elem){
	var index = elem.id.split("_");
	$("#nomcategory").val($("#NOMBREPRODUCTO_"+index[1]).text());
	$("#inventoryprice1").val($("#VCONTADOINVENTARIO_"+index[1]).text());
	$("#inventoryprice2").val($("#VCREDITOINVENTARIO_"+index[1]).text());
	$("#inventorycant").val($("#LIMITEENINVENTARIO_"+index[1]).text());	
}

function editrowinventory(elem){
	var index = elem.id.split("_")
	$("#NOMBREPRODUCTO_"+index[1]).dblclick();
}
function delrowinventory(elem){
	var idinventory = elem.id.split("_")[1];
	var inventory = $("#NOMBREPRODUCTO_"+idinventory).text();
	var dataString = "idinventory="+idinventory+"&inventory="+inventory;
	$.ajax({
		type: "POST",
		url: "core/a-inventory.php",
		data: dataString,
		cache: false,
		success: function(response){			
			var objects = jQuery.parseJSON(response);				
			if(objects.result){													
				printInventoryMessage("","LA CATEGORIA "+inventory+" HA SIDO ELIMINADO");
				setTimeout(function(){$("#area").load("view/w-inventory.php");}, 1000)
			}
		}
	});
}

function updateRowInventory(field,value){
	var token = field.split("_");
	var dataString = "field="+token[0]+"&idinventory="+token[1]+"&value="+value;
	$.ajax({
		type: "POST",
		url: "core/a-inventory.php",
		data: dataString,
		cache: false,
		success: function(response){			
			var objects = jQuery.parseJSON(response);				
			if(objects.result){													
				printInventoryMessage("","LA CATEGORIA HA SIDO ACTUALIZADA");
//				setTimeout(function(){$("#area").load("view/w-inventory.php");}, 3000)
			}
		}
	});		
}

$("#inventorymove").change(function() {
	if($("#inventorymove").val()=== "1"){
		$("#inventorymessage").text("ACTUALIZANDO CANTIDADES"); 
		$("#lblwidth").text("ANCHO:"); 
		$("#lbllong").text("LARGO:"); 
		$("#rowquant").show();
	}else if($("#inventorymove").val() === "2"){
		$("#inventorymessage").text("CAMBIANDO PRECIOS");
		$("#lblwidth").text("PRECIO DE CONTADO:"); 
		$("#lbllong").text("PRECIO A CREDITO:"); 
		$("#rowquant").hide(); 
	}
});

function changeInventory(){
	if($("#inventorymove").val()=== "1"){							
		if ($("#inventorycat").val() != null
			&& $("#inventoryqua").val() !="" && $("#inventoryfield1").val() !="" && $("#inventoryfield2").val() !=""){

		var dataString ='idcategory='+$("#inventorycat").val()
					+'&quantity='+($("#inventoryfield1").val()*$("#inventoryfield2").val()*$("#inventoryqua").val());
					
			$.ajax({
				type: "POST",
				url: "core/a-inventory.php",
				data: dataString,
				cache: false,
				success: function(response){			
					var objects = jQuery.parseJSON(response);				
					if(objects.result){													
						printInventoryMessage("","CANTIDADES ACTUALIZADAS");
						setTimeout(function(){$("#area").load("view/w-inventory.php");}, 1000)
					}
				}
			});	
		}
	}else if($("#inventorymove").val() === "2"){				
	
		if ($("#inventorycat").val() != null && $("#inventoryfield1").val() !="" && $("#inventoryfield2").val() !=""){
				
		var dataString ='idcategory='+$("#inventorycat").val()
					+'&price1='+$("#inventoryfield1").val()+'&price2='+$("#inventoryfield2").val();
					
			$.ajax({
				type: "POST",
				url: "core/a-inventory.php",
				data: dataString,
				cache: false,
				success: function(response){			
					var objects = jQuery.parseJSON(response);				
					if(objects.result){													
						printInventoryMessage("","PRECIOS ACTUALIZADOS");
						setTimeout(function(){$("#area").load("view/w-inventory.php");}, 1000)
					}
				}
			});	
		}		
	}		
}


function addNewCategory(event){
	var dataString ='nomcategory='+$("#nomcategory").val()+'&inventoryprice1='+$("#inventoryprice1").val()+	
					'&inventoryprice2='+$("#inventoryprice2").val()+'&inventorycant='+$("#inventorycant").val();	
					
	if($("#nomcategory").val() =="" || $("#inventoryprice1").val() == "" 
				|| $("#inventoryprice2").val() =="" || +$("#inventorycant").val()==""){
					
		printInventoryMessage("error","LA CATEGORIA NO HA SIDO CREADA FALTAN CAMPOS");		
		return;
	}
	$.ajax({
		type: "POST",
		url: "core/a-inventory.php",
		data: dataString,
		cache: false,
		success: function(response){			
			var objects = jQuery.parseJSON(response);				
			if(objects.result){													
				printInventoryMessage("","NUEVA CATEGORIA <b>"+$("#nomcategory").val()+"</b> HA SIDO CREADA");
				setTimeout(function(){$("#area").load("view/w-inventoryclass.php");}, 1000)
			}
		}
	});		
	
	event.preventDefault; 
}

function printInventoryMessage(type,message){
	if(type==="warning"){
		$("#inventorymessage").html("<span style='padding:3px;width: 100%; height:20px; "+
				"background: url(shared/thumbs/bgwarning_lg.jpg);border-radius:10px;display:block' "+
				"id='message'>"+message+"</span>");
	}else if(type==="error"){
		$("#inventorymessage").html("<span style='color:white;padding:3px;width: 100%; height:20px; "+
				"background: url(shared/thumbs/bgerror_lg.jpg);border-radius:10px;display:block' "+
				"id='message'>"+message+"</span>");		
	}else{
		$("#inventorymessage").html("<span style='padding:3px;width: 100%; height:20px; "+
				"display:block;border-radius:10px' id='message'> "+message+"</span>");		
	}
	setInterval(function(){$("#message").fadeOut(); }, 3000);	
}
