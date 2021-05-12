jQuery(document).ready(function($) {

	$('input[name=manager_id]').attr('disabled', 'disabled');
	//LISTA DEPENDIENTE UBICACION
	if ($('#selectCountry').length > 0) {
		$.getScript(BASEURL+"/js/template/locationcomp.js", function(){
			initSetLocation();
		});
	};
	
});	