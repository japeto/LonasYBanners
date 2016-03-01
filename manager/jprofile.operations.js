/**
* Jefferson Amado Peña Torres
* jeffersonamado@gmail.com
*/
$(document).ready(function() {
	var nameuser=$("#loginname").text();
	var namefull=$("#namefull").val();
	var dataString = 'nameuser='+nameuser+'&namefull='+namefull;
	$.ajax({
		type: "POST",
		url: "core/b-profile.php",
		data: dataString,
		cache: false,
		success: function(response){
			var objects = jQuery.parseJSON(response);
			if(objects.result){
				$("#mailuser").val(objects.mail);
				$("#teluser").val(objects.phone);
				$("#questionuser").val(objects.question);
				$("#responseuser").text(objects.response);		
			}
		}
	});
});

function deluser(elem){
	var nameuser=$("#loginname").text();
	var namefull=$("#namefull").val();	
	var dataString = 'delnameuser='+nameuser+'&delnamefull='+namefull;
	$.ajax({
		type: "POST",
		url: "core/b-profile.php",
		//data: dataString,
		cache: false,
		success: function(response){
			var objects = jQuery.parseJSON(response);
			if(objects.result){}
		}
	});	
}
function updateUser(elem){
	var loginname=$("#loginname").text();
	var namefull=$("#namefull").val();
	var mailuser=$("#mailuser").val();
	var teluser=$("#teluser").val();
	var questionuser=$("#questionuser").val();
	var responseuser=$("#responseuser").val();	
	var dataString = 'loginname='+loginname+'&upnamefull='+namefull
					+'&upmailuser='+mailuser+'&upteluser='+teluser+'&upquestionuser='+questionuser	
					+'&upresponseuser='+responseuser;
	$.ajax({
		type: "POST",
		url: "core/b-profile.php",
		data: dataString,
		cache: false,
		success: function(response){
			var objects = jQuery.parseJSON(response);	
			if(objects.result){
			$("#updateusermessage").show();
		$("#updateusermessage").html("<span style='padding:3px;width: 100%; height:20px; "+
				"display:block;border-radius:10px' id='message'> EL USUARIO "+loginname+" HA SIDO ACTUALIZADO</span>");
			setInterval(function(){$("#updateusermessage").hide(); }, 3000);				
			}			
		}
	});
}
function updatePass(elem){
	if($("#password2").val() === $("#password3").val()){
		var dataString = 'oldpassword='+$("#password1").val()+'&newpassword='+$("#password2").val()+'&user='+$("#loginname").text()
		$.ajax({
			type: "POST",
			url: "core/b-profile.php",
			data: dataString,
			cache: false,
			success: function(response){
//				alert (response)
				var objects = jQuery.parseJSON(response);	
				if(objects.result){			
		$("#updatepassmessage").show();
		$("#updatepassmessage").html("<span style='padding:3px;width: 100%; height:20px; "+
				"display:block;border-radius:10px' id='message'> SU CONTRASEÑA HA SIDO ACTUALIZADA </span>");					
			setInterval(function(){$("#updatepassmessage").hide(); }, 3000);	
							
					$("#password1").val("")
					$("#password2").val("")
					$("#password3").val("")												
								
			
				}else{
		$("#updatepassmessage").show();					
		$("#updatepassmessage").html("<span style='color:white;padding:3px;width: 100%; height:20px; "+
				"background: url(shared/thumbs/bgerror_lg.jpg);border-radius:10px;display:block' "+
				"id='message'>ESTA NO ES SU CONTRASEÑA ACTUAL</span>");						
			setInterval(function(){$("#updatepassmessage").hide(); }, 3000);						
				}			
			}
		});	
			
	}else{
		$("#updatepassmessage").show();		
		$("#updatepassmessage").html("<span style='color:white;padding:3px;width: 100%; height:20px; "+
				"background: url(shared/thumbs/bgerror_lg.jpg);border-radius:10px;display:block' "+
				"id='message'>LAS CONTRASEÑAS NO SON IGUALES</span>");						
			setInterval(function(){$("#updatepassmessage").hide(); }, 3000);			
	}	
}