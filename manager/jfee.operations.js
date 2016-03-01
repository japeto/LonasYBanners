/**
* Jefferson Amado Peña Torres
* jeffersonamado@gmail.com
*/
$(document).ready(function() {
	$("#feeinvoice").focus();
});

$("#tablefee").each(function() {
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

$("#feeinvoice").keyup( function (event){
	var seek=$("#feeinvoice").val();
	if(seek != ""){
		$.ajax({
			type: "POST",
			url: "core/b-seeks.php",
			data: "feeinvoice="+seek,
			beforeSend: function(){
				$("#resultfee").empty();
				$("#tablebodyinvoices").empty();				
				$("#resultfee").append("<p align='center'><img src='shared/thumbs/lazy-loader.gif' /></p>");			
			},
			error: function(){
				$("#resultfee").last().append("<tr><td>ERROR</td></tr>");
				$("#resultfee").append("<tr><td><p align='center'><img src='shared/thumbs/lazy-loader.gif' /></p></td></tr>");							
				setTimeout(function(){$("#area").load("view/w-fee.php");}, 5000);
			},
			success: function(response){   
				var objects = jQuery.parseJSON(response);				
				if(objects.result){	
					$("#tablebodyfee").empty();
					$("#resultfee").empty();
					$("#tablebodyfee").last().append(objects.rows);									
				}else{
					$("#tablebodyfee").empty();
					$("#resultfee").empty();
					$("#tablebodyfee").last().append("<tr><td colspan='8' >NO HAY ABONOS PARA LA FACTURA \""+seek+"\"</td></tr>");					
				}						 
			}
		});	
	}else{
		setTimeout(function(){$("#area").load("view/w-fee.php");}, 50);
	}
	event.preventDefault;
});
function newfee(event){
	if($("#feevalue").val()=="" || $("#feevalue").val() < 1 ){
//		printFeeMessage("warning","NO SE ESPECIFICO EL MONTO");		
		return;
	}
		
	var dataString ='feeinvoice='+$("#feeinvoice").val()+'&datefee='+$("#datefee").val()
					+'&feevalue='+$("#feevalue").val()+		
					'&typepayfee='+$("#typepayfee").val();	
	$.ajax({
		type: "POST",
		url: "core/a-fee.php",
		data: dataString,
		cache: false,
		success: function(response){			
			var objects = jQuery.parseJSON(response);				
			if(objects.result){													
//				printFeeMessage("","EL NUEVO ABONO A LA FACTURA <b>"+$("#feeinvoice").val()+"</b> HA SIDO APROBADO");
				setTimeout(function(){$("#area").load("view/w-fee.php");}, 100)
			}
		}
	});	

	event.preventDefault; 	
}
