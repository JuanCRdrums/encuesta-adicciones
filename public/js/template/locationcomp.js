
var country,state, city,
 	$selectCountry =  $('#selectCountry'),
 	$selectState 	=  $('#selectState'),
 	$selectCity 	=  $('#selectCity');

function changeState(){
	$selectState.on('change', function (event) {
        event.preventDefault();
        state = $(this).val();
        $selectCity.empty().trigger('change');
       	getCities(state);
    });
}


function getCities(state){
		$.ajax({
		data: {state_id : state},
		url: BASEURL+'/app/ajax/location/cities/load/',
		type: 'GET',
		dataType: 'json',
		success: function (data) {
		    if (Object.keys(data).length > 0) {
		        $.each(data, function (key, element) {
		            var selected = '';
		            if (key.length == '') {
		                selected = 'selected';
		            };
		            $selectCity.append("<option value='" + key + "' " + selected + ">" + element + "</option>");
		        });
		    }
		}, complete: function (data) {
			$("#loading-ajax").fadeOut('400');
		}
	});
}


function getStates(country){
	$.ajax({
		data: {country_id : country},
		url: BASEURL+'/app/ajax/location/states/load/',
		type: 'GET',
		dataType: 'json',
		success: function (data) {
		    if (Object.keys(data).length > 0) {
		    	$selectState.append("<option value=''>--Seleccionar--</option>");
		        $.each(data, function (key, element) {
		            var selected = '';
		            if (key.length == '') {
		                selected = 'selected';
		            };
		            $selectState.append("<option value='" + key + "' " + selected + ">" + element + "</option>");
		        });
		    }
		}, complete: function (data) {
			$("#loading-ajax").fadeOut('400');

			state = $selectState.val();
			if (state.length > 0)
					getCities(state);

			changeState();

		}
	});
}


function initSetLocation(){

	country = $selectCountry.val();
	if (country.length > 0)
			getStates(country);

 	$selectCountry.on('change', function (event) {
        event.preventDefault();
        country = $(this).val();
        $selectState.empty();
        $selectCity.empty();
       	getStates(country);
    });
}

changeState();