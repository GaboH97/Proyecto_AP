$(function() {

});

function val() {

	var uname = document.getElementById('uname').value;
	var upass = document.getElementById('upass').value;
	var ubirthdate = document.getElementById('ubirthdate').value;
	var uemail = document.getElementById('uemail').value;

	const emailRegexp = new RegExp("^([0-9a-zA-Z]([-.\w]*[0-9a-zA-Z])*@(([0-9a-zA-Z])+([-\w]*[0-9a-zA-Z])*\.)+[a-zA-Z]{2,9})$");
	const userRegexp = new RegExp("^[a-zA-Z]+[a-zA-Z0-9]*$");

	console.log(uname);

	//console.log("hay "+sec_ids.length+" elems");

	if(uemail==""){
		alert("Campo email no debe estar vacío");
		//return false;
	}else if(upass==""){
		alert("Campo contraseña no debe estar vacío");
		//return false;
	}else if(ubirthdate==""){
		alert("Campo fecha de nacimiento no debe estar vacío");
		//return false;
	}else if(uemail==""){
		alert("Campo email no debe estar vacío");
		//return false;
	}else if (!emailRegexp.test(uemail)) {
		alert("Email no tiene el formato adecuado");
		//return false;
	}else if (!userRegexp.test(uname)) {
		alert("Nombre de usuario no debe contener caracteres especiales");
	//	return false;
	}else{
		//return true;

	//GET THE IDS OF THE SELECTED SECTIONS
	var sec_pref = [];
	var sec_ids_elem = document.querySelectorAll('input.subOption:checked');
	for (var i = 0; i < sec_ids_elem.length; i++) {
		sec_pref[i] = sec_ids_elem[i].id;
	}
	console.log("hay "+sec_pref.length);

	//SENDS REQUEST FOR REGISTRATION
	$.ajax({
		type:'POST',
		url: 'http://localhost/Practica_14/php/registerUser.php',
		data:{uname:uname,
			upass:upass
		},
		success: function(data){
                  location.href="../index.html"
              }
          });
		//return true;
	}
}

