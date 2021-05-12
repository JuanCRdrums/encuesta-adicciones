jQuery(document).ready(function($) {
	//LISTA DEPENDIENTE UBICACION
	if ($('#selectCountry').length > 0) {
		$.getScript(BASEURL+"/js/template/locationcomp.js", function(){
			initSetLocation();
		});
	};
	
});	