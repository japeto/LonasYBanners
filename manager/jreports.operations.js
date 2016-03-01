/**
* Jefferson Amado Peña Torres
* jeffersonamado@gmail.com
*/
var dataString="";

$(document).ready(function() {
	var today = new Date();
	var dd = today.getDate();
	var mm = today.getMonth()+1; //January is 0!
	
	var yyyy = today.getFullYear();
	if(dd<10){dd='0'+dd} if(mm<10){mm='0'+mm} today = yyyy+'-'+mm+'-'+dd;
	
	$('#sdate').attr('value', today);
	$('#edate').attr('value', today);	
	$('#svdate').attr('value', today);
	$('#evdate').attr('value', today);		
	
});
$('#sdate').change(function(){
	dataString ="sdate="+$('#sdate').val()+"&edate="+$('#edate').val();
});

$('#edate').change(function(){
	dataString ="sdate="+$('#sdate').val()+"&edate="+$('#edate').val();
});

$('#svdate').change(function(){
	dataString ="svdate="+$('#svdate').val()+"&evdate="+$('#evdate').val();
});

$('#evdate').change(function(){
	dataString ="svdate="+$('#svdate').val()+"&evdate="+$('#evdate').val();
});

$('#scode').change(function(){
	dataString ="scode="+$('#scode').val()+"&ecode="+$('#ecode').val();
});
$('#ecode').change(function(){
	dataString ="scode="+$('#scode').val()+"&ecode="+$('#ecode').val();
});


$("#genreport").click(function(){
	dataString+="&orderby="+$('#cmbOrder').val()+"&groupby="+$('#cmbGroup').val();
	alert (dataString)
	$.ajax({
		type: "POST",
		url: "core/b-reports.php",
		data: dataString,
		cache: false,
		success: function(response){			
		alert (response)
			var objects = jQuery.parseJSON(response);				
			if(objects.result){													
			}
		}
	});
});