/**
* Jefferson Amado Peña Torres
* jeffersonamado@gmail.com
*/
$(document).ready(function() {

});

$("#tableproducts").each(function() {
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

$('#widthProduct').on('input', function() {
	var input=$(this);
    if(!$.isNumeric( input.val())){
		$(this).val("");
	}
});
$('#longProduct').on('input', function() {
	var input=$(this);
    if(!$.isNumeric( input.val())){
		$(this).val("");
	}
});
$("#widthProduct").keyup(function (){
	if($("#longProduct").val()!="" && $("#longProduct").val()>0){
		$("#areaProduct").val(parseFloat($("#longProduct").val())*parseFloat($("#widthProduct").val()));
	}
});

$("#longProduct").keyup(function (){
	if($("#widthProduct").val()!="" && $("#widthProduct").val()>0){
		$("#areaProduct").val(parseFloat($("#longProduct").val())*parseFloat($("#widthProduct").val()));
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
				updateRowProduct(idObject,newContent);
            }
        });
        $(this).children().first().blur(function() {
            $(this).parent().text(OriginalContent);			
            $(this).parent().removeClass("cellEditing");

        });
    });
});

function editrowproduct(elem){
	var index = elem.id.split("_")
	$("#CODPRODUCTO_"+index[1]).dblclick();
}

function delrowproduct(elem){
	var idproduct = elem.id.split("_")[1];
	var product = $("#CODPRODUCTO_"+idproduct).text();
	var dataString = "idproduct="+idproduct+"&product="+product
	$.ajax({
		type: "POST",
		url: "core/a-product.php",
		data: dataString,
		cache: false,
		success: function(response){			
			var objects = jQuery.parseJSON(response);				
			if(objects.result){													
				printProductMessage("","EL PRODUCTO "+product+" HA SIDO ELIMINADO");
				setTimeout(function(){$("#area").load("view/w-product.php");}, 2000)
			}
		}
	});
}
function seerowproduct(elem){
	var index = elem.id.split("_")
	$("#refProduct").val($("#REFERENCIAPRODUCTO_"+index[1]).text());
	$("#codProduct").val($("#CODPRODUCTO_"+index[1]).text());	
	$("#widthProduct").val($("#MEDIDASPRODUCTO_"+index[1]).text().split("x")[0]);
	$("#longProduct").val($("#MEDIDASPRODUCTO_"+index[1]).text().split("x")[1]);
	$("#volProduct").val($("#VOLUMENPRODUCTO_"+index[1]).text());
	$("#areaProduct").val($("#AREAPRODUCTO_"+index[1]).text());	
	$("#descriProduct").val($("#DESCRIPCIONPRODUCTO_"+index[1]).text());
	$("#categoryProduct").val($("#NOMBREPRODUCTO_"+index[1]).text());
		
	event.preventDefault;		
}
function updateRowProduct(field,value){
	var token = field.split("_");
	var dataString = "field="+token[0]+"&idproduct="+token[1]+"&value="+value;
	$.ajax({
		type: "POST",
		url: "core/a-product.php",
		data: dataString,
		cache: false,
		success: function(response){			
			var objects = jQuery.parseJSON(response);				
			if(objects.result){													
				printProductMessage("","EL PRODUCTO HA SIDO ACTUALIZADA");
			}
		}
	});		
}

function delProduct(){
	if ($("#refProduct").val()!="" && $("#codProduct").val()!="" && $("#widthproduct").val()!="" && $("#longproduct").val()!=""
				&& $("#volproduct").val()!="" && $("#areaproduct").val()!="" && $("#categoryProduct").val()!= 0 && $("#descriProduct").val()!=""){
	
		var dataString ='delrefProduct='+$("#refProduct").val()+'&delcodproduct='+$("#codProduct").val();	

		$.ajax({
			type: "POST",
			url: "core/a-product.php",
			data: dataString,
			cache: false,
			success: function(response){		
				var objects = jQuery.parseJSON(response);				
				if(objects.result){													
					printProductMessage("warning","EL PRODUCTO <b>"+$("#refProduct").val()+"</b> HA SIDO ELIMINADO");
					setTimeout(function(){$("#area").load("view/w-product.php");}, 3000)
				}
			}
		});	
	}else{
		printClientMessage("error","ESCOJA EL PRODUCTO A ELIMINAR");		
	}
	event.preventDefault;	
}

function addNewProduct(event){		
				
	if ($("#refProduct").val()!="" && $("#codProduct").val()!="" && $("#widthProduct").val()!="" && $("#longProduct").val()!=""
				 && $("#areaProduct").val()!="" && $("#categoryProduct").val()!= 0 && $("#descriProduct").val()!=""){

		var dataString ='&refproduct='+$("#refProduct").val()+'&codproduct='+$("#codProduct").val()+
						'&widthproduct='+$("#widthProduct").val()+'&longproduct='+$("#longProduct").val()+
						'&volproduct='+$("#volProduct").val()+'&areaproduct='+$("#areaProduct").val()+
						'&categoryproduct='+$("#categoryProduct option:selected").index()+'&descriproduct='+$("#descriProduct").val();	
	
		$.ajax({
			type: "POST",
			url: "core/a-product.php",
			data: dataString,
			cache: false,
			success: function(response){			
				var objects = jQuery.parseJSON(response);				
				if(objects.result){												
					printProductMessage("","EL NUEVO PRODUCTO <b>"+$("#refProduct").val()+"</b> HA SIDO CREADO");
					setTimeout(function(){$("#area").load("view/w-product.php");}, 3000)
				}else{
					printProductMessage("","EL PRODUCTO <b>"+objects.problem+"</b> YA EXISTE");
				}
			}
		});	
	}else{
		printProductMessage("error","HAY CAMPOS SIN LLENAR");		
	}
	event.preventDefault; 
}
function printProductMessage(type,message){
	if(type==="warning"){
		$("#productmessage").html("<span style='padding:3px;width: 100%; height:20px; "+
				"background: url(shared/thumbs/bgwarning_lg.jpg);border-radius:10px;display:block' "+
				"id='message'>"+message+"</span>");
	}else if(type==="error"){
		$("#productmessage").html("<span style='color:white;padding:3px;width: 100%; height:20px; "+
				"background: url(shared/thumbs/bgerror_lg.jpg);border-radius:10px;display:block' "+
				"id='message'>"+message+"</span>");		
	}else{
		$("#productmessage").html("<span style='padding:3px;width: 100%; height:20px; "+
				"display:block;border-radius:10px' id='message'> "+message+"</span>");		
	}
	setInterval(function(){$("#message").fadeOut(); }, 4000);	
}