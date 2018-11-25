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

function logout(){
	
	var new_pref_arr = [];
	$('input[name=checkbox]:checked').each(function() {
		new_pref_arr.push($(this).val());
	});

	console.log("SI");
	for (var i = 0; i < new_pref_arr.length; i++) {
		console.log(new_pref_arr[i]);
	}

	var unchk_pref_arr = [];
	$('input[name=checkbox]:not(:checked)').each(function() {
		unchk_pref_arr.push($(this).val());
	});

	console.log("NO");
	for (var i = 0; i < unchk_pref_arr.length; i++) {
		console.log(unchk_pref_arr[i]);
	}

	var new_pref_str = new_pref_arr.join(',');
	console.log(new_pref_str);

	$.ajax({
		type :'POST',
		url : 'logout.php',
		data : {
			new_pref: new_pref_str
		},
		success : function (data){
			if(data =="OK"){
				window.location.href ="../index.html";
			}else{
				$('body').html(data);
			}
		}
	});
}

