function showSection(secTitle){
	console.log(secTitle.innerHTML);
  alert("Estás viendo la sección '"+secTitle.innerHTML+"'");
}

$('input[name=checkbox]').change(function(){
    if($(this).is(':checked')) {
        console.log('checked');
    } else {
        console.log('Unchecked');
    }
});