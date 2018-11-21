function showSection(secTitle){
	console.log(secTitle.innerHTML);
	alert("Estás viendo la sección '"+secTitle.innerHTML+"'");
}

$(document).ready(function(){
	$('input[name=checkbox]').change(function(){
		var id = $(this).val();
		console.log(id);
		if($(this).is(':checked')) {
			$('#sec'+id).show(200);
		} else {
			$('#sec'+id).hide(200);
		}
	});

	
});