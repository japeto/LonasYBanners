$(document).ready(function() {
	$('#btnlogin').click(function(){
		var username=$("#username").val();
		var password=$("#password").val();
		var dataString = 'username='+username+'&password='+password;
		if($.trim(username).length>0 && $.trim(password).length>0){
			$.ajax({
				type: "POST",
				url: "core/c-login.php",
				data: dataString,
				cache: false,
				beforeSend: function(){ $("#btnlogin").val('Connecting...');},
				success: function(response){
					var objects = jQuery.parseJSON(response);
					if(objects.result === "true"){
						$('body').load('view/w-home.php',function() {
						  $("#nameuser").text(objects.full_name);
						});	
					}else{
						$('#login').shake();
						$('#username').focus();
						$("#error").html("<span style='color:#cc0000'>Usuario invalido</span>");
						$("#btnlogin").val('Acceder');
					}
				}
			});
		}else{
			$("#error").html("<span style='color:#01BF24'>Debes llenar los campos para acceder</span>");
            $('#username').focus();
		}
		return false;
	});
});

$(function() {
  // constants
  var SHOW_CLASS = 'show',
      HIDE_CLASS = 'hide',
      ACTIVE_CLASS = 'active';
  
  $( '.tabs' ).on( 'click', 'li a', function(e){
    e.preventDefault();
    var $tab = $( this ),
         href = $tab.attr( 'href' );
  
     $( '.active' ).removeClass( ACTIVE_CLASS );
     $tab.addClass( ACTIVE_CLASS );
  
     $( '.show' )
        .removeClass( SHOW_CLASS )
        .addClass( HIDE_CLASS )
        .hide();
    
      $(href)
        .removeClass( HIDE_CLASS )
        .addClass( SHOW_CLASS )
        .hide()
        .fadeIn( 550 );
  });
});
