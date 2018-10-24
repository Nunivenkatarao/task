$(document).ready(function () {
	$('#ffret').on('click',function(){
		var frmValues = $('#myFrm').serialize();
		var url = "ffret_ajax.php";
		$('.errMsg').html('');
		$('.succMsg').html('');
		$.ajax({
		  type: "POST",
		  url: url,
		  data: frmValues,
		  success: function(data) {
		  	var res = JSON.parse(data);
		  	if(res.status == false) {
		  		jQuery.each( res, function( i, val ) {
		  			keyId = Object.keys(val);
				    valMsg = Object.values(val);
				    if(keyId != '') {
				    	$('#'+keyId).html(valMsg);
					}
				});
		  	} else {
		  		$('.succMsg').html(res.msg);
		  	}
		  }
		});
	});
});